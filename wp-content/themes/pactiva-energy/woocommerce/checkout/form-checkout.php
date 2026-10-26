<?php
/**
 * PACTIVA ENERGY - Custom Checkout Form Template
 *
 * @package Pactiva_Energy
 */

defined( 'ABSPATH' ) || exit;

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
    echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
    return;
}
?>

<div class="py-8 sm:py-12 lg:py-14 bg-slate-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header Banner -->
        <div class="mb-6 sm:mb-8">
            <nav class="text-[11px] font-mono text-slate-400 uppercase tracking-wider mb-2">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hover:text-brand-orange"><?php esc_html_e( 'Home', 'pactiva-energy' ); ?></a>
                <span class="mx-2">&rsaquo;</span>
                <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="hover:text-brand-orange"><?php esc_html_e( 'Cart', 'pactiva-energy' ); ?></a>
                <span class="mx-2">&rsaquo;</span>
                <span class="text-brand-orange"><?php esc_html_e( 'Direct WhatsApp Checkout', 'pactiva-energy' ); ?></span>
            </nav>
            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-black font-heading tracking-tight text-slate-950">
                <?php esc_html_e( 'B2B Quotation & Dispatch Checkout', 'pactiva-energy' ); ?>
            </h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-1 max-w-2xl leading-relaxed">
                <?php esc_html_e( 'Fill in your delivery address and requirements. Your complete order breakdown will be sent directly to our WhatsApp dispatch desk for instant inventory confirmation, GST proforma invoice, and freight schedule.', 'pactiva-energy' ); ?>
            </p>
        </div>

        <?php do_action( 'woocommerce_before_checkout_form', $checkout ); ?>

        <form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data" aria-label="<?php echo esc_attr__( 'Checkout', 'woocommerce' ); ?>">
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 items-start">
                
                <!-- Left Column: Customer & Delivery Details -->
                <div class="lg:col-span-7 bg-white p-5 sm:p-8 rounded-3xl border border-slate-200/90 shadow-sm">
                    
                    <?php if ( $checkout->get_checkout_fields() ) : ?>

                        <?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

                        <div id="customer_details">
                            <div class="woocommerce-billing-fields">
                                <h2 class="text-base font-black text-slate-900 font-heading mb-4 pb-2 border-b border-slate-100 flex items-center gap-2">
                                    <svg class="w-5 h-5 text-brand-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                    <span><?php esc_html_e( 'Customer & Delivery Information', 'pactiva-energy' ); ?></span>
                                </h2>
                                
                                <?php do_action( 'woocommerce_checkout_billing' ); ?>
                            </div>

                            <div class="woocommerce-shipping-fields mt-6">
                                <?php do_action( 'woocommerce_checkout_shipping' ); ?>
                            </div>
                        </div>

                        <?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

                    <?php endif; ?>

                </div>

                <!-- Right Column: Order Review & WhatsApp Dispatch Desk -->
                <div class="lg:col-span-5 bg-white p-5 sm:p-7 rounded-3xl border border-slate-200/90 shadow-sm lg:sticky lg:top-24 self-start">
                    
                    <h2 class="text-base font-black text-slate-900 font-heading mb-4 pb-2 border-b border-slate-100 flex items-center gap-2">
                        <svg class="w-5 h-5 text-brand-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                        <span><?php esc_html_e( 'Order Review & Dispatch Desk', 'pactiva-energy' ); ?></span>
                    </h2>

                    <?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

                    <div id="order_review" class="woocommerce-checkout-review-order">
                        <?php do_action( 'woocommerce_checkout_order_review' ); ?>
                    </div>

                    <?php do_action( 'woocommerce_checkout_after_order_review' ); ?>

                </div>

            </div>

        </form>

    </div>
</div>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
