<?php
/**
 * PACTIVA ENERGY - Custom WhatsApp B2B Checkout Payment Section
 * Eliminates traditional payment gateways and routes orders directly to WhatsApp.
 *
 * @package Pactiva_Energy
 */

defined( 'ABSPATH' ) || exit;

$clean_number = function_exists( 'pactiva_get_clean_whatsapp_number' ) ? pactiva_get_clean_whatsapp_number() : '919818280807';
?>
<div id="payment" class="woocommerce-checkout-payment mt-6 pt-6 border-t border-slate-200/90">
    
    <!-- Hidden input to select pactiva_whatsapp automatically -->
    <input type="hidden" name="payment_method" value="pactiva_whatsapp" checked="checked">

    <!-- B2B WhatsApp Dispatch Notice Card (Clean, non-scrollable, zero clipping) -->
    <div class="p-4 bg-emerald-50/80 rounded-2xl border border-emerald-200/90 mb-4">
        <div class="flex items-center justify-between gap-2 flex-wrap mb-2">
            <div class="flex items-center gap-2">
                <span class="w-2.5 h-2.5 rounded-full bg-[#25D366] animate-pulse"></span>
                <h4 class="text-xs font-black text-slate-900 uppercase tracking-wider">
                    <?php esc_html_e( 'WhatsApp B2B Dispatch Desk', 'pactiva-energy' ); ?>
                </h4>
            </div>
            <span class="px-2.5 py-0.5 rounded-full text-[10px] font-extrabold bg-emerald-100 text-emerald-800 uppercase tracking-wider shrink-0">
                <?php esc_html_e( 'Zero Online Fees', 'pactiva-energy' ); ?>
            </span>
        </div>
        <p class="text-xs text-slate-600 leading-relaxed">
            <?php esc_html_e( 'No credit card or online payment required now. Your complete order breakdown, billing info, and delivery address will be sent directly to our WhatsApp dispatch desk for instant inventory verification, GST invoice generation, and logistics coordination.', 'pactiva-energy' ); ?>
        </p>
    </div>

    <!-- Privacy Policy / Terms Notice (Clean spacing) -->
    <div class="text-xs text-slate-500 leading-relaxed mb-4 px-1">
        <?php wc_get_template( 'checkout/terms.php' ); ?>
    </div>

    <!-- Place Order Button -->
    <div class="form-row place-order pt-2">
        <noscript>
            <p class="text-xs text-amber-700 bg-amber-50 p-3 rounded-xl border border-amber-200 mb-4">
                <?php esc_html_e( 'JavaScript is required for optimal WhatsApp redirection. Please ensure JavaScript is enabled in your browser.', 'pactiva-energy' ); ?>
            </p>
        </noscript>

        <?php do_action( 'woocommerce_review_order_before_submit' ); ?>

        <!-- High-Impact WhatsApp Submit Button -->
        <button type="submit" 
                class="w-full py-4 px-6 bg-[#25D366] hover:bg-[#20BD5A] text-white font-black text-sm uppercase tracking-wider rounded-2xl shadow-xl shadow-emerald-600/30 hover:shadow-emerald-600/50 hover:scale-[1.01] active:scale-[0.99] transition-all duration-300 flex items-center justify-center gap-2.5 cursor-pointer" 
                name="woocommerce_checkout_place_order" 
                id="place_order" 
                value="<?php esc_attr_e( 'Submit Order via WhatsApp 💬', 'pactiva-energy' ); ?>" 
                data-value="<?php esc_attr_e( 'Submit Order via WhatsApp 💬', 'pactiva-energy' ); ?>">
            <svg class="w-5 h-5 fill-current shrink-0" viewBox="0 0 24 24">
                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
            </svg>
            <span><?php esc_html_e( 'Submit Order & Send on WhatsApp', 'pactiva-energy' ); ?></span>
        </button>

        <?php do_action( 'woocommerce_review_order_after_submit' ); ?>

        <?php wp_nonce_field( 'woocommerce-process_checkout', 'woocommerce-process-checkout-nonce' ); ?>
    </div>
</div>


