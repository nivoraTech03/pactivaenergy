<?php
/**
 * PACTIVA ENERGY - Custom Review Order Table
 * Clean, responsive B2B dispatch item breakdown
 *
 * @package Pactiva_Energy
 */

defined( 'ABSPATH' ) || exit;
?>
<table class="shop_table woocommerce-checkout-review-order-table w-full text-left border-collapse">
    <thead>
        <tr class="border-b border-slate-200 text-[11px] font-bold uppercase tracking-wider text-slate-400">
            <th class="product-name pb-3"><?php esc_html_e( 'Item Description', 'pactiva-energy' ); ?></th>
            <th class="product-total pb-3 text-right whitespace-nowrap pl-4"><?php esc_html_e( 'Amount', 'pactiva-energy' ); ?></th>
        </tr>
    </thead>
    <tbody class="divide-y divide-slate-100 text-xs">
        <?php
        do_action( 'woocommerce_review_order_before_cart_contents' );

        foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
            $_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

            if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                $sku = $_product->get_sku() ? $_product->get_sku() : 'PCT-' . $_product->get_id();
                ?>
                <tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?> py-3">
                    <td class="product-name py-3.5 pr-2">
                        <div class="font-bold text-slate-900 leading-snug text-xs sm:text-sm">
                            <?php echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) ); ?>
                        </div>
                        <div class="mt-1.5 flex flex-wrap items-center gap-2">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-[10px] font-extrabold bg-slate-900 text-white">
                                Qty: <?php echo esc_html( $cart_item['quantity'] ); ?>
                            </span>
                            <span class="text-[10px] font-mono text-slate-400 font-medium">SKU: <?php echo esc_html( $sku ); ?></span>
                        </div>
                        <?php echo wc_get_formatted_cart_item_data( $cart_item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                    </td>
                    <td class="product-total py-3.5 text-right font-black text-slate-950 align-top whitespace-nowrap text-xs sm:text-sm pl-4">
                        <?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                    </td>
                </tr>
                <?php
            }
        }

        do_action( 'woocommerce_review_order_after_cart_contents' );
        ?>
    </tbody>
    <tfoot class="border-t-2 border-slate-200/90 text-xs text-slate-600">
        <tr class="cart-subtotal">
            <th class="py-3 font-semibold text-slate-500"><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></th>
            <td class="py-3 text-right font-bold text-slate-900 text-sm whitespace-nowrap pl-4"><?php wc_cart_totals_subtotal_html(); ?></td>
        </tr>

        <?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
            <tr class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
                <th class="py-2.5 font-medium"><?php wc_cart_totals_coupon_label( $coupon ); ?></th>
                <td class="py-2.5 text-right whitespace-nowrap pl-4"><?php wc_cart_totals_coupon_html( $coupon ); ?></td>
            </tr>
        <?php endforeach; ?>

        <tr class="cart-tax">
            <th class="py-2.5 font-semibold text-slate-500"><?php esc_html_e( 'GST / Taxes', 'pactiva-energy' ); ?></th>
            <td class="py-2.5 text-right font-medium text-slate-600 whitespace-nowrap pl-4"><?php esc_html_e( 'Included / As Applicable', 'pactiva-energy' ); ?></td>
        </tr>

        <tr class="order-total border-t border-slate-200">
            <th class="pt-3.5 pb-2 text-sm sm:text-base font-black text-slate-950 font-heading"><?php esc_html_e( 'Total Amount', 'woocommerce' ); ?></th>
            <td class="pt-3.5 pb-2 text-right text-lg sm:text-2xl font-black text-brand-orange font-heading whitespace-nowrap pl-4"><?php wc_cart_totals_order_total_html(); ?></td>
        </tr>

        <?php do_action( 'woocommerce_review_order_after_order_total' ); ?>
    </tfoot>
</table>
