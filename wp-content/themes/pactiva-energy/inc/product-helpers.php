<?php
/**
 * WooCommerce Dynamic Product Helpers & Query Handlers
 *
 * @package Pactiva_Energy
 */

defined( 'ABSPATH' ) || exit;

/**
 * Extract clean, dynamic data array from a WooCommerce Product
 *
 * @param int|WC_Product $product
 * @return array|false
 */
function pactiva_get_product_card_data( $product ) {
    if ( ! function_exists( 'wc_get_product' ) ) {
        return false;
    }

    if ( is_numeric( $product ) ) {
        $product = wc_get_product( $product );
    }

    if ( ! is_a( $product, 'WC_Product' ) ) {
        return false;
    }

    $id             = $product->get_id();
    $name           = $product->get_name();
    $sku            = $product->get_sku();
    $permalink      = $product->get_permalink();
    $price_html     = $product->get_price_html();
    $price          = $product->get_price();
    $regular_price  = $product->get_regular_price();
    $sale_price     = $product->get_sale_price();
    $is_on_sale     = $product->is_on_sale();
    $is_in_stock    = $product->is_in_stock();
    $stock_status   = $product->get_stock_status(); // 'instock', 'outofstock', 'onbackorder'
    $stock_quantity = $product->get_stock_quantity();
    $type           = $product->get_type();
    $image_id       = $product->get_image_id();
    $image_url      = $image_id ? wp_get_attachment_image_url( $image_id, 'medium_large' ) : wc_placeholder_img_src();
    $categories     = wp_get_post_terms( $id, 'product_cat', array( 'fields' => 'names' ) );
    $primary_cat    = ! empty( $categories ) && ! is_wp_error( $categories ) ? $categories[0] : '';
    
    // Technical Attributes extraction (e.g. Voltage, Capacity, Chemistry)
    $attributes = array();
    $raw_attributes = $product->get_attributes();
    if ( ! empty( $raw_attributes ) ) {
        foreach ( $raw_attributes as $attr_name => $attribute ) {
            if ( is_a( $attribute, 'WC_Product_Attribute' ) ) {
                $label = wc_attribute_label( $attribute->get_name() );
                $options = $attribute->get_options();
                if ( $attribute->is_taxonomy() ) {
                    $terms = wc_get_product_terms( $id, $attribute->get_name(), array( 'fields' => 'names' ) );
                    $val = implode( ', ', $terms );
                } else {
                    $val = implode( ', ', $options );
                }
                if ( ! empty( $val ) ) {
                    $attributes[ $label ] = $val;
                }
            }
        }
    }

    // Enquiry Only Flag (meta or catalog mode)
    $is_enquiry_only = get_post_meta( $id, '_pactiva_enquiry_only', true );
    $catalog_mode = get_option( 'pactiva_catalog_mode', 'enquiry_first' );
    if ( 'enquiry_only' === $catalog_mode || '' === $price || '0' === $price ) {
        $is_enquiry_only = true;
    }

    // Build dynamic WhatsApp link
    $wa_url = pactiva_build_whatsapp_product_url( $product );

    return array(
        'id'             => $id,
        'name'           => $name,
        'sku'            => $sku ? $sku : 'PCT-' . $id,
        'permalink'      => $permalink,
        'price_html'     => $price_html,
        'price'          => $price,
        'regular_price'  => $regular_price,
        'sale_price'     => $sale_price,
        'is_on_sale'     => $is_on_sale,
        'is_in_stock'    => $is_in_stock,
        'stock_status'   => $stock_status,
        'stock_quantity' => $stock_quantity,
        'type'           => $type,
        'image_url'      => $image_url,
        'category'       => $primary_cat,
        'attributes'     => $attributes,
        'is_enquiry_only'=> (bool) $is_enquiry_only,
        'wa_url'         => $wa_url,
    );
}

/**
 * Reusable dynamic product card renderer
 *
 * @param int|WC_Product $product
 * @param string $layout 'grid' or 'list'
 */
function pactiva_render_product_card( $product, $layout = 'grid' ) {
    $data = pactiva_get_product_card_data( $product );
    if ( ! $data ) {
        return;
    }
    ?>
    <div class="pactiva-product-card tech-glow-card group relative bg-white rounded-2xl border border-slate-200/80 hover:border-brand-orange/40 shadow-[0_2px_10px_-2px_rgba(0,0,0,0.04)] hover:shadow-[0_20px_35px_-10px_rgba(0,0,0,0.1)] hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between overflow-hidden w-full">
        
        <!-- Top Media & Badges Area -->
        <div class="relative bg-gradient-to-b from-slate-50/90 via-slate-50/40 to-white p-3.5 sm:p-5 flex items-center justify-center min-h-[195px] sm:min-h-[220px] overflow-hidden border-b border-slate-100">
            <!-- Badges (Top Left - Max width prevents overlap) -->
            <div class="absolute top-2.5 left-2.5 flex flex-col items-start gap-1 z-10 max-w-[70%]">
                <?php if ( ! empty( $data['category'] ) ) : ?>
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 text-[10px] sm:text-[10.5px] font-extrabold tracking-wide uppercase bg-slate-950/90 backdrop-blur-xs text-white rounded-lg shadow-sm border border-white/10 max-w-full truncate" title="<?php echo esc_attr( $data['category'] ); ?>">
                        <span class="w-1.5 h-1.5 rounded-full bg-brand-orange shrink-0"></span>
                        <span class="truncate"><?php echo esc_html( $data['category'] ); ?></span>
                    </span>
                <?php endif; ?>

                <?php if ( $data['is_on_sale'] ) : ?>
                    <span class="inline-block px-2 py-0.5 text-[9px] sm:text-[9.5px] font-black uppercase tracking-wider bg-gradient-to-r from-brand-orange to-brand-deep text-white rounded-md shadow-xs">
                        <?php esc_html_e( 'Direct OEM Deal', 'pactiva-energy' ); ?>
                    </span>
                <?php endif; ?>
            </div>

            <!-- Stock Status Badge (Bottom Right of Image Container - Completely eliminates category overlap) -->
            <div class="absolute bottom-2.5 right-2.5 z-10 pointer-events-none">
                <?php if ( $data['is_in_stock'] ) : ?>
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 text-[10px] sm:text-[11px] font-bold text-emerald-700 bg-white/95 backdrop-blur-md rounded-full border border-emerald-200/90 shadow-xs">
                        <span class="relative flex h-2 w-2 shrink-0">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                        </span>
                        <span><?php esc_html_e( 'In Stock', 'pactiva-energy' ); ?></span>
                    </span>
                <?php else : ?>
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 text-[10px] sm:text-[11px] font-semibold text-slate-600 bg-white/95 backdrop-blur-md rounded-full border border-slate-200/90 shadow-xs">
                        <span class="w-1.5 h-1.5 rounded-full bg-slate-400 shrink-0"></span>
                        <span><?php esc_html_e( 'Custom Build', 'pactiva-energy' ); ?></span>
                    </span>
                <?php endif; ?>
            </div>

            <!-- Product Image with lazy loading and layout containment -->
            <a href="<?php echo esc_url( $data['permalink'] ); ?>" class="block w-full h-full flex items-center justify-center group-hover:scale-105 transition-transform duration-300 will-change-transform">
                <img src="<?php echo esc_url( $data['image_url'] ); ?>" 
                     alt="<?php echo esc_attr( $data['name'] ); ?>" 
                     loading="lazy" 
                     decoding="async"
                     width="240"
                     height="170"
                     class="max-h-[155px] sm:max-h-[175px] w-auto max-w-[88%] object-contain mx-auto drop-shadow-sm">
            </a>
        </div>

        <!-- Card Content Area -->
        <div class="p-3.5 sm:p-5 flex-1 flex flex-col justify-between">
            <div>
                <!-- SKU and Hardware Tier -->
                <div class="flex items-center justify-between text-[11px] font-mono text-slate-400 mb-1.5 gap-2">
                    <span class="truncate"><?php esc_html_e( 'SKU:', 'pactiva-energy' ); ?> <strong class="text-slate-700 font-mono"><?php echo esc_html( $data['sku'] ); ?></strong></span>
                    <span class="text-[9px] font-sans font-extrabold text-brand-orange bg-orange-50 px-2 py-0.5 rounded-md border border-orange-200/60 uppercase tracking-wider shrink-0">B2B Tier-1</span>
                </div>

                <!-- Product Title -->
                <h3 class="text-sm sm:text-base font-extrabold text-slate-900 group-hover:text-brand-orange transition-colors line-clamp-2 leading-snug mb-2.5 min-h-[2.4rem] sm:min-h-[2.5rem]">
                    <a href="<?php echo esc_url( $data['permalink'] ); ?>">
                        <?php echo esc_html( $data['name'] ); ?>
                    </a>
                </h3>

                <!-- Key Technical Highlights (Voltage, Chemistry, Cells) -->
                <?php if ( ! empty( $data['attributes'] ) ) : ?>
                    <div class="flex flex-wrap gap-1.5 py-2 mb-3 border-t border-b border-slate-100/90">
                        <?php 
                        $count = 0;
                        foreach ( $data['attributes'] as $label => $val ) : 
                            if ( $count >= 3 ) break; 
                            $count++;
                        ?>
                            <span class="inline-flex items-center px-2 py-0.5 text-[10px] font-mono font-bold tracking-tight bg-slate-50 text-slate-700 rounded-md border border-slate-200/70" title="<?php echo esc_attr( $label . ': ' . $val ); ?>">
                                <span class="text-slate-400 mr-1"><?php echo esc_html( $label ); ?>:</span>
                                <strong><?php echo esc_html( $val ); ?></strong>
                            </span>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Pricing and Action Buttons -->
            <div class="pt-3 border-t border-slate-100 flex flex-col gap-2.5">
                <div class="flex items-end justify-between gap-2">
                    <div class="min-w-0">
                        <span class="text-[9.5px] sm:text-[10px] text-slate-400 block font-bold uppercase tracking-wider"><?php esc_html_e( 'Wholesale Rate', 'pactiva-energy' ); ?></span>
                        <div class="pactiva-card-price text-sm sm:text-base font-black text-slate-950 font-mono tracking-tight leading-tight mt-0.5 truncate">
                            <?php if ( ! empty( $data['price_html'] ) ) : ?>
                                <?php echo wp_kses_post( $data['price_html'] ); ?>
                            <?php else : ?>
                                <span class="text-xs font-bold text-brand-orange"><?php esc_html_e( 'Request Quotation', 'pactiva-energy' ); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <a href="<?php echo esc_url( $data['permalink'] ); ?>" class="text-[11px] font-bold text-slate-500 hover:text-brand-orange inline-flex items-center gap-1 transition-colors shrink-0 pb-0.5">
                        <span><?php esc_html_e( 'Specs', 'pactiva-energy' ); ?></span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>

                <!-- Dual Action: WhatsApp Enquiry + Add to Cart / Fast Quote (Optimized for 320px screens) -->
                <div class="grid grid-cols-2 gap-2 pt-1">
                    <!-- WhatsApp Quote Button -->
                    <a href="<?php echo esc_url( $data['wa_url'] ); ?>" 
                       target="_blank" 
                       rel="noopener noreferrer" 
                       aria-label="<?php esc_attr_e( 'WhatsApp Quote', 'pactiva-energy' ); ?>"
                       class="inline-flex items-center justify-center gap-1 sm:gap-1.5 px-2 sm:px-2.5 py-2.5 bg-[#25D366] hover:bg-[#1EBE5B] text-white text-[10.5px] sm:text-xs font-bold rounded-xl shadow-xs active:scale-95 transition-all duration-200 min-w-0 text-center">
                        <svg class="w-3.5 h-3.5 fill-current shrink-0" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                        <span class="truncate"><?php esc_html_e( 'WhatsApp', 'pactiva-energy' ); ?></span>
                    </a>

                    <!-- Direct Fast Quote Modal Trigger or Add to Cart -->
                    <?php if ( ! $data['is_enquiry_only'] && function_exists( 'woocommerce_template_loop_add_to_cart' ) ) : ?>
                        <a href="<?php echo esc_url( '?add-to-cart=' . $data['id'] ); ?>" 
                           data-quantity="1" 
                           data-product_id="<?php echo esc_attr( $data['id'] ); ?>" 
                           data-product_sku="<?php echo esc_attr( $data['sku'] ); ?>" 
                           aria-label="<?php esc_attr_e( 'Add to Cart', 'pactiva-energy' ); ?>"
                           class="ajax_add_to_cart add_to_cart_button inline-flex items-center justify-center gap-1 sm:gap-1.5 px-2 sm:px-2.5 py-2.5 bg-slate-900 hover:bg-black text-white text-[10.5px] sm:text-xs font-bold rounded-xl shadow-xs active:scale-95 transition-all duration-200 min-w-0 text-center">
                            <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                            <span class="truncate"><?php esc_html_e( 'Add to Cart', 'pactiva-energy' ); ?></span>
                        </a>
                    <?php else : ?>
                        <button type="button" 
                                onclick="pactivaOpenEnquiryModal('<?php echo esc_js( $data['name'] ); ?>', '<?php echo esc_js( $data['sku'] ); ?>')"
                                aria-label="<?php esc_attr_e( 'Get Quote', 'pactiva-energy' ); ?>"
                                class="inline-flex items-center justify-center gap-1 sm:gap-1.5 px-2 sm:px-2.5 py-2.5 bg-brand-orange hover:bg-brand-deep text-white text-[10.5px] sm:text-xs font-bold rounded-xl shadow-xs active:scale-95 transition-all duration-200 min-w-0 text-center">
                            <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                            <span class="truncate"><?php esc_html_e( 'Get Quote', 'pactiva-energy' ); ?></span>
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <?php
}

/**
 * Retrieve dynamic featured products
 *
 * @param int $limit
 * @param string $category_slug
 * @return WC_Product[]
 */
function pactiva_get_featured_products( $limit = 8, $category_slug = '' ) {
    if ( ! function_exists( 'wc_get_products' ) ) {
        return array();
    }

    $args = array(
        'status'   => 'publish',
        'limit'    => $limit,
        'featured' => true,
        'orderby'  => 'date',
        'order'    => 'DESC',
    );

    if ( ! empty( $category_slug ) ) {
        $args['category'] = array( $category_slug );
    }

    $products = wc_get_products( $args );

    // If no explicitly marked featured products, retrieve the latest published products
    if ( empty( $products ) ) {
        unset( $args['featured'] );
        $products = wc_get_products( $args );
    }

    return $products;
}

/**
 * Live AJAX Search Endpoint for Products & SKUs
 */
function pactiva_ajax_live_search() {
    check_ajax_referer( 'pactiva_security_nonce', 'security' );

    $term = isset( $_POST['query'] ) ? sanitize_text_field( wp_unslash( $_POST['query'] ) ) : '';
    if ( empty( $term ) || strlen( $term ) < 2 ) {
        wp_send_json_success( array( 'results' => array() ) );
    }

    $products = wc_get_products( array(
        'status'  => 'publish',
        'limit'   => 8,
        's'       => $term,
    ) );

    // Also search by SKU if fewer than 4 results
    if ( count( $products ) < 4 ) {
        $sku_product_id = wc_get_product_id_by_sku( $term );
        if ( $sku_product_id && ! in_array( $sku_product_id, wp_list_pluck( $products, 'id' ) ) ) {
            $sku_prod = wc_get_product( $sku_product_id );
            if ( $sku_prod && 'publish' === $sku_prod->get_status() ) {
                array_unshift( $products, $sku_prod );
            }
        }
    }

    $results = array();
    foreach ( $products as $prod ) {
        $data = pactiva_get_product_card_data( $prod );
        if ( $data ) {
            $results[] = array(
                'id'        => $data['id'],
                'name'      => $data['name'],
                'sku'       => $data['sku'],
                'permalink' => $data['permalink'],
                'image'     => $data['image_url'],
                'price'     => $data['price_html'] ? strip_tags( $data['price_html'] ) : 'Quote on Request',
                'category'  => $data['category'],
            );
        }
    }

    wp_send_json_success( array( 'results' => $results ) );
}
add_action( 'wp_ajax_pactiva_live_search', 'pactiva_ajax_live_search' );
add_action( 'wp_ajax_nopriv_pactiva_live_search', 'pactiva_ajax_live_search' );

/**
 * Dynamic Category URL Helper (Safely resolves product_cat terms)
 *
 * @param string $slug
 * @return string
 */
function pactiva_get_category_url( $slug ) {
    $aliases = array(
        'ev-battery-solutions'        => 'ev-battery-solutions',
        'solar-energy-storage'        => 'solar-ess-systems',
        'battery-management-systems'  => 'smart-bms-hardware',
        'inverters'                   => 'wall-mounted-inverters',
    );

    $target_slug = isset( $aliases[ $slug ] ) ? $aliases[ $slug ] : $slug;
    $term = get_term_by( 'slug', $target_slug, 'product_cat' );

    if ( $term && ! is_wp_error( $term ) ) {
        return get_term_link( $term );
    }

    return function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/shop/' );
}

/**
 * Dynamic Page URL Helper (Safely resolves page permalinks by path/slug)
 *
 * @param string $slug
 * @return string
 */
function pactiva_get_page_url( $slug ) {
    $page = get_page_by_path( $slug );
    if ( $page && 'publish' === $page->post_status ) {
        return get_permalink( $page );
    }
    return home_url( '/' . trim( $slug, '/' ) . '/' );
}

/**
 * Universal 301 Redirect Handler for category aliases & legacy URLs to prevent 404s
 */
function pactiva_handle_category_redirects() {
    $req_uri = isset( $_SERVER['REQUEST_URI'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REQUEST_URI'] ) ) : '';

    // Alias mapping for old slugs or wrong slugs
    $alias_map = array(
        'solar-energy-storage'       => 'solar-ess-systems',
        'battery-management-systems' => 'smart-bms-hardware',
        'inverters'                  => 'wall-mounted-inverters',
    );

    // 1. If someone accesses /category/{slug}/ (legacy WordPress category base)
    if ( preg_match( '~/category/([^/?#]+)/?~i', $req_uri, $matches ) ) {
        $slug = $matches[1];
        $target_slug = isset( $alias_map[ $slug ] ) ? $alias_map[ $slug ] : $slug;
        $term = get_term_by( 'slug', $target_slug, 'product_cat' );
        if ( $term && ! is_wp_error( $term ) ) {
            wp_safe_redirect( get_term_link( $term ), 301 );
            exit;
        } else {
            wp_safe_redirect( function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/shop/' ), 301 );
            exit;
        }
    }

    // 2. If someone accesses /product-category/{alias_slug}/ where alias exists
    foreach ( $alias_map as $old_slug => $target_slug ) {
        if ( preg_match( '~/product-category/' . preg_quote( $old_slug, '~' ) . '(/|$)~i', $req_uri ) ) {
            $term = get_term_by( 'slug', $target_slug, 'product_cat' );
            if ( $term && ! is_wp_error( $term ) ) {
                wp_safe_redirect( get_term_link( $term ), 301 );
                exit;
            }
        }
    }
}
add_action( 'template_redirect', 'pactiva_handle_category_redirects', 1 );
