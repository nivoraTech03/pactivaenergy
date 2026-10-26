<?php
/**
 * PACTIVA ENERGY - Custom Luxury B2B Cart Template
 *
 * @package Pactiva_Energy
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' );

$cart_wa_url = function_exists( 'pactiva_get_cart_whatsapp_url' ) 
    ? pactiva_get_cart_whatsapp_url() 
    : 'https://wa.me/919911212494';
$shop_url = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/shop/' );
?>

<div class="py-10 lg:py-14 bg-slate-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header Banner -->
        <div class="mb-8">
            <nav class="text-[11px] font-mono text-slate-400 uppercase tracking-wider mb-2">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hover:text-brand-orange"><?php esc_html_e( 'Home', 'pactiva-energy' ); ?></a>
                <span class="mx-2">&rsaquo;</span>
                <a href="<?php echo esc_url( $shop_url ); ?>" class="hover:text-brand-orange"><?php esc_html_e( 'Catalog', 'pactiva-energy' ); ?></a>
                <span class="mx-2">&rsaquo;</span>
                <span class="text-brand-orange"><?php esc_html_e( 'Hardware Cart', 'pactiva-energy' ); ?></span>
            </nav>
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h1 class="text-3xl sm:text-4xl font-black font-heading tracking-tight text-slate-950">
                        <?php esc_html_e( 'Hardware Quotation Cart', 'pactiva-energy' ); ?>
                    </h1>
                    <p class="text-xs sm:text-sm text-slate-500 mt-1 max-w-2xl">
                        <?php esc_html_e( 'Review items, update volume, or instantly transmit entire cart to our engineering desk on WhatsApp.', 'pactiva-energy' ); ?>
                    </p>
                </div>

                <a href="<?php echo esc_url( $cart_wa_url ); ?>" 
                   target="_blank" 
                   rel="noopener noreferrer" 
                   class="btn-whatsapp text-xs font-bold py-3 px-5 shadow-lg shadow-emerald-500/20 shrink-0">
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                    <span><?php esc_html_e( 'Order Cart on WhatsApp', 'pactiva-energy' ); ?></span>
                </a>
            </div>
        </div>

        <form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
            <?php do_action( 'woocommerce_before_cart_table' ); ?>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                
                <!-- Left Column: Products List (8 cols) -->
                <div class="lg:col-span-8 space-y-4">
                    <div class="bg-white rounded-3xl border border-slate-200/90 shadow-sm overflow-hidden p-4 sm:p-6">
                        
                        <div class="divide-y divide-slate-100">
                            <?php do_action( 'woocommerce_before_cart_contents' ); ?>

                            <?php
                            foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                                $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                                $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

                                if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 ) {
                                    $product_permalink = $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '';
                                    $thumbnail = $_product->get_image( array( 90, 90 ), array( 'class' => 'w-20 h-20 object-contain rounded-xl bg-slate-50 p-1 border border-slate-100' ) );
                                    $sku = $_product->get_sku() ? $_product->get_sku() : 'PCT-' . $product_id;
                                    ?>
                                    <div class="py-4 first:pt-0 last:pb-0 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                                        
                                        <!-- Product Image & Title -->
                                        <div class="flex items-center gap-4 flex-1 min-w-0">
                                            <a href="<?php echo esc_url( $product_permalink ); ?>" class="shrink-0">
                                                <?php echo $thumbnail; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                                            </a>
                                            <div class="min-w-0 flex-1">
                                                <span class="inline-block text-[10px] font-mono font-bold text-slate-400 uppercase tracking-wider mb-1">
                                                    SKU: <?php echo esc_html( $sku ); ?>
                                                </span>
                                                <h3 class="text-sm font-bold text-slate-900 truncate hover:text-brand-orange transition-colors">
                                                    <a href="<?php echo esc_url( $product_permalink ); ?>">
                                                        <?php echo wp_kses_post( $_product->get_name() ); ?>
                                                    </a>
                                                </h3>
                                                <div class="text-xs font-semibold text-slate-500 mt-0.5">
                                                    <?php echo WC()->cart->get_product_price( $_product ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                                                    <span class="text-[10px] text-slate-400 font-normal">/ unit</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Quantity Input & Subtotal -->
                                        <div class="flex items-center justify-between sm:justify-end gap-6 shrink-0 pt-2 sm:pt-0 border-t sm:border-t-0 border-slate-100">
                                            <div class="quantity">
                                                <?php
                                                if ( $_product->is_sold_individually() ) {
                                                    $min_quantity = 1;
                                                    $max_quantity = 1;
                                                } else {
                                                    $min_quantity = 0;
                                                    $max_quantity = $_product->get_max_purchase_quantity();
                                                }

                                                $product_quantity = woocommerce_quantity_input(
                                                    array(
                                                        'input_name'   => "cart[{$cart_item_key}][qty]",
                                                        'input_value'  => $cart_item['quantity'],
                                                        'max_value'    => $max_quantity,
                                                        'min_value'    => $min_quantity,
                                                        'product_name' => $_product->get_name(),
                                                    ),
                                                    $_product,
                                                    false
                                                );

                                                echo $product_quantity; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                                ?>
                                            </div>

                                            <div class="text-right min-w-[100px]">
                                                <div class="text-xs font-bold text-slate-400 uppercase"><?php esc_html_e( 'Subtotal', 'pactiva-energy' ); ?></div>
                                                <div class="text-base font-black text-slate-950 font-heading">
                                                    <?php echo WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                                                </div>
                                            </div>

                                            <!-- Remove button -->
                                            <div>
                                                <?php
                                                echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                                    'woocommerce_cart_item_remove_link',
                                                    sprintf(
                                                        '<a href="%s" class="text-slate-300 hover:text-rose-600 p-2 rounded-lg hover:bg-rose-50 transition-colors inline-block" aria-label="%s" data-product_id="%s" data-product_sku="%s">
                                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                        </a>',
                                                        esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                                                        esc_attr( sprintf( __( 'Remove %s', 'pactiva-energy' ), wp_strip_all_tags( $_product->get_name() ) ) ),
                                                        esc_attr( $product_id ),
                                                        esc_attr( $_product->get_sku() )
                                                    ),
                                                    $cart_item_key
                                                );
                                                ?>
                                            </div>
                                        </div>

                                    </div>
                                    <?php
                                }
                            }
                            ?>

                            <?php do_action( 'woocommerce_cart_contents' ); ?>
                        </div>

                        <!-- Cart Bottom Action Bar -->
                        <div class="pt-6 mt-6 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-4">
                            <a href="<?php echo esc_url( $shop_url ); ?>" class="inline-flex items-center gap-2 text-xs font-bold text-slate-600 hover:text-brand-orange transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                                <span><?php esc_html_e( 'Continue Exploring Hardware Catalog', 'pactiva-energy' ); ?></span>
                            </a>

                            <!-- Hidden programmatic button for seamless automatic quantity updates on +/- -->
                            <button type="submit" class="hidden" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'pactiva-energy' ); ?>">
                                <?php esc_html_e( 'Update Quantities', 'pactiva-energy' ); ?>
                            </button>

                            <?php do_action( 'woocommerce_cart_actions' ); ?>
                            <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
                        </div>

                    </div>

                    <!-- B2B Supply Notice -->
                    <div class="p-4 bg-orange-50/60 rounded-2xl border border-orange-200/60 flex items-start gap-3">
                        <div class="w-7 h-7 rounded-lg bg-brand-orange text-white flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div class="text-xs text-slate-600 leading-relaxed">
                            <span class="font-bold text-slate-900"><?php esc_html_e( 'B2B Wholesale Note:', 'pactiva-energy' ); ?></span>
                            <?php esc_html_e( 'All battery orders are dispatched directly from our Greater Noida manufacturing unit. GST tax invoices and pan-India insured freight schedules are shared directly on WhatsApp.', 'pactiva-energy' ); ?>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Order Summary & Actions (4 cols) -->
                <div class="lg:col-span-4 bg-white p-6 sm:p-8 rounded-3xl border border-slate-200/90 shadow-sm sticky top-28 space-y-6">
                    <h2 class="text-base font-black text-slate-900 font-heading pb-3 border-b border-slate-100 flex items-center gap-2">
                        <svg class="w-5 h-5 text-brand-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                        <span><?php esc_html_e( 'Quotation Summary', 'pactiva-energy' ); ?></span>
                    </h2>

                    <!-- Order Totals -->
                    <div class="space-y-3 text-xs">
                        <div class="flex items-center justify-between text-slate-500">
                            <span><?php esc_html_e( 'Items Subtotal', 'pactiva-energy' ); ?></span>
                            <span class="font-bold text-slate-900"><?php wc_cart_totals_subtotal_html(); ?></span>
                        </div>
                        <div class="flex items-center justify-between text-slate-500">
                            <span><?php esc_html_e( 'GST (18% / 12% / 28%)', 'pactiva-energy' ); ?></span>
                            <span class="font-semibold text-slate-600"><?php esc_html_e( 'Included / As Applicable', 'pactiva-energy' ); ?></span>
                        </div>
                        <div class="flex items-center justify-between text-slate-500">
                            <span><?php esc_html_e( 'Pan-India Cargo Freight', 'pactiva-energy' ); ?></span>
                            <span class="font-semibold text-emerald-600"><?php esc_html_e( 'Calculated on Weight', 'pactiva-energy' ); ?></span>
                        </div>
                        <div class="pt-3 border-t border-slate-100 flex items-center justify-between text-base font-black text-slate-950 font-heading">
                            <span><?php esc_html_e( 'Estimated Total', 'pactiva-energy' ); ?></span>
                            <span class="text-brand-orange text-xl"><?php wc_cart_totals_order_total_html(); ?></span>
                        </div>
                    </div>

                    <!-- Dual Action Buttons -->
                    <div class="space-y-3 pt-2">
                        <!-- Primary 1: WhatsApp Direct Order -->
                        <a href="<?php echo esc_url( $cart_wa_url ); ?>" 
                           target="_blank" 
                           rel="noopener noreferrer" 
                           class="w-full py-4 px-6 bg-[#25D366] hover:bg-[#20BD5A] text-white font-black text-xs uppercase tracking-wider rounded-2xl shadow-xl shadow-emerald-600/30 hover:shadow-emerald-600/50 hover:scale-[1.01] active:scale-[0.99] transition-all duration-300 flex items-center justify-center gap-2.5">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                            </svg>
                            <span><?php esc_html_e( 'Order Cart on WhatsApp 💬', 'pactiva-energy' ); ?></span>
                        </a>

                        <!-- Secondary 2: Proceed to Checkout (Enter Delivery Address) -->
                        <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" 
                           class="w-full py-3.5 px-6 bg-slate-900 hover:bg-brand-black text-white font-bold text-xs uppercase tracking-wider rounded-2xl shadow-md transition-all duration-300 flex items-center justify-center gap-2">
                            <span><?php esc_html_e( 'Enter Delivery Address &rarr;', 'pactiva-energy' ); ?></span>
                        </a>
                    </div>

                    <!-- Trust indicators -->
                    <div class="pt-4 border-t border-slate-100 space-y-2 text-[11px] text-slate-500">
                        <div class="flex items-center gap-2">
                            <span class="text-emerald-500 font-bold">✓</span>
                            <span><?php esc_html_e( 'Direct Factory Pricing • No Middlemen', 'pactiva-energy' ); ?></span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-emerald-500 font-bold">✓</span>
                            <span><?php esc_html_e( 'Official GST Tax Invoice Provided', 'pactiva-energy' ); ?></span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-emerald-500 font-bold">✓</span>
                            <span><?php esc_html_e( 'Safe Pan-India Hazardous Cargo Transit', 'pactiva-energy' ); ?></span>
                        </div>
                    </div>

                </div>

            </div>
            <?php do_action( 'woocommerce_after_cart_table' ); ?>
        </form>

    </div>
</div>

<?php do_action( 'woocommerce_after_cart' ); ?>
