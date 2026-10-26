<?php
/**
 * PACTIVA ENERGY WooCommerce Content Single Product
 *
 * @package Pactiva_Energy
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Security check
if ( empty( $product ) || ! is_a( $product, 'WC_Product' ) ) {
    return;
}

$id             = $product->get_id();
$data           = pactiva_get_product_card_data( $product );
$gallery_ids    = $product->get_gallery_image_ids();
$short_desc     = $product->get_short_description();
$full_desc      = $product->get_description();
$wa_url         = $data['wa_url'];
$catalog_mode   = get_option( 'pactiva_catalog_mode', 'enquiry_first' );

// Technical Attributes
$attributes = $data['attributes'];

// Related Products
$related_ids = wc_get_related_products( $id, 4 );
?>

<div id="product-<?php echo esc_attr( $id ); ?>" <?php wc_product_class( 'py-12 bg-slate-50', $product ); ?>>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Breadcrumbs Navigation -->
        <nav class="text-xs font-mono text-slate-400 uppercase tracking-wider mb-8 flex items-center gap-2">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hover:text-brand-orange"><?php esc_html_e( 'Home', 'pactiva-energy' ); ?></a>
            <span>&rsaquo;</span>
            <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="hover:text-brand-orange"><?php esc_html_e( 'Products', 'pactiva-energy' ); ?></a>
            <?php if ( ! empty( $data['category'] ) ) : ?>
                <span>&rsaquo;</span>
                <span class="text-slate-600 font-semibold"><?php echo esc_html( $data['category'] ); ?></span>
            <?php endif; ?>
            <span>&rsaquo;</span>
            <span class="text-brand-orange font-bold truncate max-w-xs"><?php echo esc_html( $data['name'] ); ?></span>
        </nav>

        <!-- Product Overview Grid -->
        <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-10 shadow-sm mb-12">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
                
                <!-- Left: Product Image & Gallery with Flipkart-Style Zoom -->
                <div class="lg:col-span-5 space-y-4">
                    <div id="pactiva-zoom-container" 
                         class="pactiva-zoom-container bg-slate-50 rounded-2xl p-6 border border-slate-200/90 flex items-center justify-center min-h-[380px] sm:min-h-[420px] overflow-hidden relative cursor-crosshair group select-none shadow-sm transition-all">
                        
                        <!-- In Stock Badge -->
                        <div class="absolute top-4 left-4 z-20 pointer-events-none">
                            <?php if ( $data['is_in_stock'] ) : ?>
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200 shadow-sm">
                                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                    <?php esc_html_e( 'In Stock — Ready for Dispatch', 'pactiva-energy' ); ?>
                                </span>
                            <?php else : ?>
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-slate-100 text-slate-600 border border-slate-200 shadow-sm">
                                    <?php esc_html_e( 'Built to Order', 'pactiva-energy' ); ?>
                                </span>
                            <?php endif; ?>
                        </div>

                        <!-- Hover to Zoom Hint -->
                        <div id="pactiva-zoom-hint" class="absolute bottom-3 right-3 z-20 pointer-events-none inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-[10px] font-bold bg-slate-900/75 text-white backdrop-blur-xs transition-opacity duration-300 group-hover:opacity-0 shadow-sm">
                            <svg class="w-3 h-3 text-brand-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7"/></svg>
                            <span><?php esc_html_e( 'Roll over image to zoom in', 'pactiva-energy' ); ?></span>
                        </div>

                        <!-- Main Image with Dynamic Zoom Origin -->
                        <img id="pactiva-main-product-img"
                             src="<?php echo esc_url( $data['image_url'] ); ?>" 
                             alt="<?php echo esc_attr( $data['name'] ); ?>" 
                             class="pactiva-zoom-image max-h-[340px] sm:max-h-[380px] w-auto object-contain mx-auto drop-shadow-md transition-transform duration-150 ease-out will-change-transform">
                    </div>

                    <!-- Gallery Thumbnails -->
                    <?php if ( ! empty( $gallery_ids ) ) : ?>
                        <div class="grid grid-cols-4 gap-3" id="pactiva-gallery-thumbs">
                            <button type="button" 
                                    onclick="pactivaSwitchProductGalleryImage('<?php echo esc_url( $data['image_url'] ); ?>', this)"
                                    class="pactiva-thumb-btn border-2 border-brand-orange rounded-xl p-1.5 bg-slate-50 transition-all hover:scale-105 cursor-pointer outline-none shadow-sm">
                                <img src="<?php echo esc_url( $data['image_url'] ); ?>" alt="Thumb" class="h-16 w-auto mx-auto object-contain pointer-events-none">
                            </button>
                            <?php foreach ( $gallery_ids as $g_id ) : 
                                $g_url = wp_get_attachment_image_url( $g_id, 'large' );
                                $g_thumb = wp_get_attachment_image_url( $g_id, 'medium' );
                                if ( ! $g_url ) {
                                    $g_url = $g_thumb;
                                }
                            ?>
                                <button type="button" 
                                        onclick="pactivaSwitchProductGalleryImage('<?php echo esc_url( $g_url ); ?>', this)"
                                        class="pactiva-thumb-btn border border-slate-200 rounded-xl p-1.5 bg-slate-50 hover:border-brand-orange transition-all hover:scale-105 cursor-pointer outline-none shadow-sm">
                                    <img src="<?php echo esc_url( $g_thumb ); ?>" alt="Thumb" class="h-16 w-auto mx-auto object-contain pointer-events-none">
                                </button>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Right: Product Specifications & Actions -->
                <div class="lg:col-span-7 flex flex-col justify-between">
                    <div>
                        <!-- Category & SKU Tag -->
                        <div class="flex items-center gap-3 mb-2">
                            <?php if ( ! empty( $data['category'] ) ) : ?>
                                <span class="badge-category"><?php echo esc_html( $data['category'] ); ?></span>
                            <?php endif; ?>
                            <span class="text-xs font-mono font-bold text-slate-400">SKU: <?php echo esc_html( $data['sku'] ); ?></span>
                        </div>

                        <!-- Title -->
                        <h1 class="text-2xl sm:text-3xl font-black text-slate-950 font-heading leading-tight mb-4">
                            <?php echo esc_html( $data['name'] ); ?>
                        </h1>

                        <!-- Pricing Display -->
                        <div class="p-4 bg-orange-50/50 rounded-2xl border border-orange-100/80 mb-6 flex items-center justify-between">
                            <div>
                                <span class="text-[11px] text-slate-500 font-semibold uppercase tracking-wider block">
                                    <?php esc_html_e( 'Wholesale / B2B Rate', 'pactiva-energy' ); ?>
                                </span>
                                <div class="text-2xl font-black text-slate-950 font-heading mt-0.5">
                                    <?php if ( ! empty( $data['price_html'] ) ) : ?>
                                        <?php echo wp_kses_post( $data['price_html'] ); ?>
                                    <?php else : ?>
                                        <span class="text-lg text-brand-orange font-bold"><?php esc_html_e( 'Request Official Quotation', 'pactiva-energy' ); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <span class="text-xs font-semibold text-slate-500">
                                <?php esc_html_e( '+ GST Extra as applicable', 'pactiva-energy' ); ?>
                            </span>
                        </div>

                        <!-- Short Description -->
                        <?php if ( ! empty( $short_desc ) ) : ?>
                            <div class="text-xs sm:text-sm text-slate-600 leading-relaxed mb-6">
                                <?php echo wp_kses_post( $short_desc ); ?>
                            </div>
                        <?php endif; ?>

                        <!-- Technical Specification Highlights -->
                        <?php if ( ! empty( $attributes ) ) : ?>
                            <div class="mb-6">
                                <h3 class="text-xs font-bold text-slate-900 uppercase tracking-wider mb-2.5">
                                    <?php esc_html_e( 'Key Hardware Specifications', 'pactiva-energy' ); ?>
                                </h3>
                                <div class="grid grid-cols-2 sm:grid-cols-3 gap-2.5 text-xs">
                                    <?php foreach ( $attributes as $label => $val ) : ?>
                                        <div class="p-2.5 bg-slate-50 rounded-xl border border-slate-100">
                                            <span class="text-[10px] text-slate-400 block uppercase font-medium"><?php echo esc_html( $label ); ?></span>
                                            <span class="font-bold text-slate-900 truncate block mt-0.5"><?php echo esc_html( $val ); ?></span>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Dual CTAs: WhatsApp Primary + Fast Quote / Add to Cart -->
                    <div class="pt-6 border-t border-slate-100 space-y-3">
                        <div class="flex flex-col sm:flex-row items-center gap-3">
                            <!-- WhatsApp Enquiry CTA -->
                            <a href="<?php echo esc_url( $wa_url ); ?>" 
                               target="_blank" 
                               rel="noopener noreferrer" 
                               class="btn-whatsapp text-sm font-bold w-full sm:flex-1 py-3.5 justify-center shadow-lg shadow-emerald-600/20">
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                                <span><?php esc_html_e( 'WhatsApp RFQ', 'pactiva-energy' ); ?></span>
                            </a>

                            <!-- Formal Quotation Modal Trigger -->
                            <button type="button" 
                                    onclick="pactivaOpenEnquiryModal('<?php echo esc_js( $data['name'] ); ?>', '<?php echo esc_js( $data['sku'] ); ?>')"
                                    class="btn-primary text-sm font-bold w-full sm:flex-1 py-3.5 justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                <span><?php esc_html_e( 'Request Official Quote', 'pactiva-energy' ); ?></span>
                            </button>
                        </div>

                        <!-- Add to Cart (when cart mode is enabled) -->
                        <?php if ( ! $data['is_enquiry_only'] && function_exists( 'woocommerce_template_single_add_to_cart' ) ) : ?>
                            <div class="pt-2 text-center">
                                <?php woocommerce_template_single_add_to_cart(); ?>
                            </div>
                        <?php endif; ?>

                        <div class="flex items-center justify-between text-[11px] text-slate-400 pt-2">
                            <span>🛡️ <?php esc_html_e( '1-Year Standard Factory Warranty', 'pactiva-energy' ); ?></span>
                            <span>🚚 <?php esc_html_e( 'Pan-India Insured Cargo Dispatch', 'pactiva-energy' ); ?></span>
                        </div>
                    </div>

                </div>

            </div>
        </div>

        <!-- Detailed Specifications & Tabs -->
        <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-10 shadow-sm mb-12">
            <h2 class="text-lg font-black text-slate-950 font-heading mb-4 pb-2 border-b border-slate-100">
                <?php esc_html_e( 'Technical Description & Engineering Details', 'pactiva-energy' ); ?>
            </h2>

            <div class="prose prose-slate max-w-none text-xs sm:text-sm text-slate-600 leading-relaxed space-y-4">
                <?php if ( ! empty( $full_desc ) ) : ?>
                    <?php echo wp_kses_post( $full_desc ); ?>
                <?php else : ?>
                    <p><?php echo esc_html( $data['name'] ); ?> <?php esc_html_e( 'is tested under rigorous Indian ambient conditions. Built with high-purity materials, low internal resistance cells, and intelligent BMS thermal protections.', 'pactiva-energy' ); ?></p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Related Products Section -->
        <?php if ( ! empty( $related_ids ) ) : ?>
            <div class="mb-12">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-black text-slate-950 font-heading">
                        <?php esc_html_e( 'Complementary Hardware & Packs', 'pactiva-energy' ); ?>
                    </h2>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <?php foreach ( $related_ids as $rel_id ) : ?>
                        <?php pactiva_render_product_card( $rel_id ); ?>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

    </div>
</div>
