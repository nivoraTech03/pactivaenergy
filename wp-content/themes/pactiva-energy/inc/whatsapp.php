<?php
/**
 * WhatsApp Integration & Dynamic Lead / Order Routing — PACTIVA ENERGY
 *
 * @package Pactiva_Energy
 */

defined( 'ABSPATH' ) || exit;

/**
 * Get sanitized WhatsApp number for wa.me links
 *
 * @return string
 */
function pactiva_get_clean_whatsapp_number() {
    $raw_number = get_option( 'pactiva_whatsapp_number', '+919818280807' );
    $clean = preg_replace( '/[^0-9]/', '', $raw_number );
    // Ensure international prefix (e.g. 91)
    if ( strlen( $clean ) === 10 ) {
        $clean = '91' . $clean;
    }
    return $clean;
}

/**
 * Build dynamic product WhatsApp enquiry URL
 *
 * @param WC_Product $product
 * @return string
 */
function pactiva_build_whatsapp_product_url( $product ) {
    if ( ! is_a( $product, 'WC_Product' ) ) {
        return 'https://wa.me/' . pactiva_get_clean_whatsapp_number();
    }

    $number = pactiva_get_clean_whatsapp_number();
    $name   = $product->get_name();
    $sku    = $product->get_sku() ? $product->get_sku() : 'PCT-' . $product->get_id();
    $price  = $product->get_price() ? '₹' . number_format( (float) $product->get_price(), 2 ) : 'Quotation Basis';
    $url    = $product->get_permalink();

    $message = sprintf(
        "⚡ *PACTIVA ENERGY & POWER - PRODUCT ENQUIRY*\n----------------------------------------\n📦 *Product:* %s\n🔖 *SKU:* %s\n💰 *Price:* %s\n🔗 *Link:* %s\n----------------------------------------\nHello Team, please share stock availability, wholesale rates, and technical specifications for this product.",
        $name,
        $sku,
        $price,
        $url
    );

    return 'https://wa.me/' . $number . '?text=' . rawurlencode( $message );
}

/**
 * Build dynamic category WhatsApp enquiry URL
 *
 * @param WP_Term|string $category
 * @return string
 */
function pactiva_build_whatsapp_category_url( $category ) {
    $number = pactiva_get_clean_whatsapp_number();
    $cat_name = is_a( $category, 'WP_Term' ) ? $category->name : (string) $category;

    $message = sprintf(
        "⚡ *PACTIVA ENERGY & POWER - CATEGORY ENQUIRY*\n----------------------------------------\n📁 *Sector / Category:* %s\n----------------------------------------\nHello Team, please share your complete dealer/distributor catalog and pricing for this product line.",
        $cat_name
    );

    return 'https://wa.me/' . $number . '?text=' . rawurlencode( $message );
}

/**
 * Build dynamic general / bulk inquiry WhatsApp URL
 *
 * @param string $topic
 * @return string
 */
function pactiva_build_whatsapp_general_url( $topic = 'General B2B Inquiry' ) {
    $number = pactiva_get_clean_whatsapp_number();
    $message = sprintf(
        "⚡ *PACTIVA ENERGY & POWER - B2B ENQUIRY*\n----------------------------------------\n📌 *Topic:* %s\n----------------------------------------\nHello Team, I would like to consult with a technical sales engineer regarding custom lithium battery solutions.",
        $topic
    );

    return 'https://wa.me/' . $number . '?text=' . rawurlencode( $message );
}

/**
 * Build dynamic cart WhatsApp order URL
 *
 * @return string
 */
function pactiva_get_cart_whatsapp_url() {
    if ( ! function_exists( 'WC' ) || ! WC()->cart || WC()->cart->is_empty() ) {
        return pactiva_build_whatsapp_general_url( 'Cart Inquiry' );
    }

    $clean_number = pactiva_get_clean_whatsapp_number();
    $msg = "⚡ *PACTIVA ENERGY & POWER - CART ORDER / RFQ*\n";
    $msg .= "----------------------------------------\n";
    $msg .= "📦 *ITEMS IN MY CART:*\n";

    $i = 1;
    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
        $product = $cart_item['data'];
        $qty = $cart_item['quantity'];
        $sku = $product->get_sku() ? $product->get_sku() : 'N/A';
        $subtotal = $cart_item['line_total'];

        $msg .= sprintf(
            "%d. *%s*\n   Qty: %d | Amount: ₹%s (SKU: %s)\n",
            $i++,
            $product->get_name(),
            $qty,
            number_format( (float) $subtotal, 2 ),
            $sku
        );
    }

    $msg .= "\n💰 *Estimated Total:* ₹" . number_format( (float) WC()->cart->get_total( 'edit' ), 2 ) . "\n";
    $msg .= "----------------------------------------\n";
    $msg .= "Hello Team, please confirm stock availability, delivery timeline, and share official GST proforma invoice.";

    return 'https://wa.me/' . $clean_number . '?text=' . rawurlencode( $msg );
}

/**
 * Add "Order Entire Cart on WhatsApp" button on WooCommerce Cart page
 */
function pactiva_cart_whatsapp_button() {
    if ( ! function_exists( 'WC' ) || ! WC()->cart || WC()->cart->is_empty() ) {
        return;
    }
    $cart_wa_url = pactiva_get_cart_whatsapp_url();
    ?>
    <div class="mt-4 mb-2">
        <a href="<?php echo esc_url( $cart_wa_url ); ?>" 
           target="_blank" 
           rel="noopener noreferrer" 
           class="w-full py-3.5 px-6 bg-[#25D366] hover:bg-[#20BD5A] text-white font-black text-xs uppercase tracking-wider rounded-xl shadow-lg shadow-emerald-600/25 hover:shadow-emerald-600/40 transition-all duration-300 flex items-center justify-center gap-2">
            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
            </svg>
            <span><?php esc_html_e( 'Instant Order Entire Cart via WhatsApp', 'pactiva-energy' ); ?></span>
        </a>
    </div>
    <?php
}
add_action( 'woocommerce_proceed_to_checkout', 'pactiva_cart_whatsapp_button', 20 );

/**
 * ============================================================================
 * WooCommerce Custom WhatsApp Checkout Gateway (No Online Payment Required)
 * ============================================================================
 */
if ( class_exists( 'WC_Payment_Gateway' ) && ! class_exists( 'WC_Gateway_Pactiva_WhatsApp' ) ) {

    class WC_Gateway_Pactiva_WhatsApp extends WC_Payment_Gateway {

        public function __construct() {
            $this->id                 = 'pactiva_whatsapp';
            $this->icon               = '';
            $this->has_fields         = false;
            $this->method_title       = __( 'PACTIVA WhatsApp RFQ & Order Desk', 'pactiva-energy' );
            $this->method_description = __( 'Redirects customer to WhatsApp with complete order breakdown and delivery address. No online payment gateway needed.', 'pactiva-energy' );

            $this->title              = __( 'Send Order & RFQ via WhatsApp (No Online Payment Required)', 'pactiva-energy' );
            $this->description        = __( 'Place your B2B order without paying online now. Your complete order breakdown, billing info, and delivery address will be transmitted directly to our WhatsApp engineering desk for instant inventory verification, GST tax invoice, and logistics scheduling.', 'pactiva-energy' );
            $this->order_button_text  = __( 'Submit Order via WhatsApp 💬', 'pactiva-energy' );

            $this->init_form_fields();
            $this->init_settings();

            $this->enabled = 'yes';

            add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, array( $this, 'process_admin_options' ) );
        }

        public function init_form_fields() {
            $this->form_fields = array(
                'enabled' => array(
                    'title'   => __( 'Enable/Disable', 'pactiva-energy' ),
                    'type'    => 'checkbox',
                    'label'   => __( 'Enable WhatsApp Checkout Gateway', 'pactiva-energy' ),
                    'default' => 'yes',
                ),
            );
        }

        public function process_payment( $order_id ) {
            $order = wc_get_order( $order_id );
            if ( ! $order ) {
                return array( 'result' => 'failure' );
            }

            // Mark as on-hold (awaiting WhatsApp confirmation)
            $order->update_status( 'on-hold', __( 'Order submitted via WhatsApp B2B Gateway. Customer forwarded to WhatsApp.', 'pactiva-energy' ) );

            // Reduce stock
            wc_reduce_stock_levels( $order_id );

            // Empty cart
            if ( function_exists( 'WC' ) && WC()->cart ) {
                WC()->cart->empty_cart();
            }

            // Build WhatsApp message
            $clean_number  = pactiva_get_clean_whatsapp_number();
            $customer_name = $order->get_formatted_billing_full_name();
            $phone         = $order->get_billing_phone();
            $email         = $order->get_billing_email();
            $company       = $order->get_billing_company();
            $city          = $order->get_billing_city();
            $state         = $order->get_billing_state();
            $postcode      = $order->get_billing_postcode();
            $address       = trim( $order->get_billing_address_1() . ' ' . $order->get_billing_address_2() );
            if ( ! empty( $city ) ) {
                $address .= ', ' . $city;
            }
            if ( ! empty( $state ) ) {
                $address .= ', ' . $state;
            }
            if ( ! empty( $postcode ) ) {
                $address .= ' - ' . $postcode;
            }

            $notes = $order->get_customer_note();

            $msg = "⚡ *NEW B2B ORDER / RFQ #" . $order->get_order_number() . " - PACTIVA ENERGY & POWER*\n";
            $msg .= "----------------------------------------\n";
            $msg .= "👤 *Customer:* " . $customer_name . "\n";
            if ( ! empty( $company ) ) {
                $msg .= "🏢 *Company / GST:* " . $company . "\n";
            }
            $msg .= "📞 *Phone / WhatsApp:* " . $phone . "\n";
            if ( ! empty( $email ) ) {
                $msg .= "✉️ *Email:* " . $email . "\n";
            }
            $msg .= "📍 *Delivery Destination:* " . $address . "\n\n";

            $msg .= "📦 *ORDERED ITEMS:*\n";
            $item_index = 1;
            foreach ( $order->get_items() as $item_id => $item ) {
                $product = $item->get_product();
                $sku = $product ? $product->get_sku() : 'N/A';
                $msg .= sprintf(
                    "%d. *%s*\n   Qty: %d | Amount: ₹%s (SKU: %s)\n",
                    $item_index++,
                    $item->get_name(),
                    $item->get_quantity(),
                    number_format( (float) $item->get_total(), 2 ),
                    $sku
                );
            }

            $msg .= "\n💰 *Order Total:* ₹" . number_format( (float) $order->get_total(), 2 ) . "\n";
            if ( ! empty( $notes ) ) {
                $msg .= "📝 *Notes / Special Specs:* " . $notes . "\n";
            }
            $msg .= "----------------------------------------\n";
            $msg .= "Hello PACTIVA Team, please confirm stock readiness, GST invoice, and freight charges.";

            $whatsapp_url = 'https://wa.me/' . $clean_number . '?text=' . rawurlencode( $msg );

            // Store whatsapp url on order meta so thank you page can reference it
            $order->update_meta_data( '_pactiva_whatsapp_url', $whatsapp_url );
            $order->save();

            return array(
                'result'   => 'success',
                'redirect' => $whatsapp_url,
            );
        }
    }
}

/**
 * Register WhatsApp gateway in WooCommerce
 */
function pactiva_add_whatsapp_gateway( $gateways ) {
    $gateways[] = 'WC_Gateway_Pactiva_WhatsApp';
    return $gateways;
}
add_filter( 'woocommerce_payment_gateways', 'pactiva_add_whatsapp_gateway' );

/**
 * Ensure WhatsApp gateway is selected as default
 */
add_filter( 'default_checkout_payment_method', function( $default ) {
    return 'pactiva_whatsapp';
} );

/**
 * Remove coupon code banner and form completely from checkout (B2B wholesale quotation)
 */
remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
add_filter( 'woocommerce_coupons_enabled', '__return_false' );

/**
 * Custom Checkout Place Order Button Text
 */
add_filter( 'woocommerce_order_button_text', function( $button_text ) {
    return __( 'Submit Order & Send on WhatsApp 💬', 'pactiva-energy' );
} );

/**
 * Customize Checkout fields for Indian B2B Customers
 */
add_filter( 'woocommerce_checkout_fields', function( $fields ) {
    if ( isset( $fields['billing']['billing_first_name'] ) ) {
        $fields['billing']['billing_first_name']['class'] = array( 'form-row-first', 'pactiva-col-50' );
        $fields['billing']['billing_first_name']['priority'] = 10;
    }
    if ( isset( $fields['billing']['billing_last_name'] ) ) {
        $fields['billing']['billing_last_name']['class'] = array( 'form-row-last', 'pactiva-col-50' );
        $fields['billing']['billing_last_name']['priority'] = 20;
    }
    if ( isset( $fields['billing']['billing_phone'] ) ) {
        $fields['billing']['billing_phone']['label'] = __( 'Phone / WhatsApp Number (Required for Dispatch)', 'pactiva-energy' );
        $fields['billing']['billing_phone']['placeholder'] = __( 'e.g. +91 98765 43210', 'pactiva-energy' );
        $fields['billing']['billing_phone']['required'] = true;
    }
    if ( isset( $fields['billing']['billing_company'] ) ) {
        $fields['billing']['billing_company']['label'] = __( 'Company Name / GSTIN (Optional)', 'pactiva-energy' );
        $fields['billing']['billing_company']['placeholder'] = __( 'e.g. Singhania CleanTech / 07AAAAA0000A1Z5', 'pactiva-energy' );
    }
    return $fields;
} );

/**
 * WhatsApp Order Confirmation Box on Thank-You Page
 */
add_action( 'woocommerce_thankyou', function( $order_id ) {
    $order = wc_get_order( $order_id );
    if ( ! $order ) return;

    $wa_url = $order->get_meta( '_pactiva_whatsapp_url' );
    if ( empty( $wa_url ) ) {
        $clean_number = pactiva_get_clean_whatsapp_number();
        $msg = "Hello PACTIVA Team, I placed Order #" . $order->get_order_number() . " on your website. Please confirm dispatch details.";
        $wa_url = 'https://wa.me/' . $clean_number . '?text=' . rawurlencode( $msg );
    }
    ?>
    <div class="my-8 p-6 bg-emerald-50 rounded-3xl border border-emerald-200 text-center max-w-2xl mx-auto shadow-sm">
        <div class="w-16 h-16 rounded-2xl bg-emerald-500 text-white mx-auto flex items-center justify-center mb-4 shadow-md shadow-emerald-500/30">
            <svg class="w-8 h-8 fill-current" viewBox="0 0 24 24">
                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
            </svg>
        </div>
        <h3 class="text-lg font-black text-slate-900 mb-1"><?php esc_html_e( 'Order Registered! Send to WhatsApp for Instant Confirmation', 'pactiva-energy' ); ?></h3>
        <p class="text-xs text-slate-600 mb-5 leading-relaxed">
            <?php esc_html_e( 'If WhatsApp did not open automatically, tap the button below to send your order items and delivery details directly to our dispatch engineering desk.', 'pactiva-energy' ); ?>
        </p>
        <a href="<?php echo esc_url( $wa_url ); ?>" 
           target="_blank" 
           rel="noopener noreferrer" 
           class="inline-flex items-center gap-2 px-8 py-4 bg-[#25D366] hover:bg-[#20BD5A] text-white font-black text-xs uppercase tracking-wider rounded-2xl shadow-xl shadow-emerald-600/30 hover:scale-105 transition-all">
            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
            <span><?php esc_html_e( 'Click to Send / Chat on WhatsApp', 'pactiva-energy' ); ?></span>
        </a>
    </div>
    <?php
}, 10 );

/**
 * Render Floating WhatsApp Widget
 */
function pactiva_render_floating_whatsapp() {
    $general_url = pactiva_build_whatsapp_general_url();
    ?>
    <!-- Floating WhatsApp Widget (Elevated position to prevent covering footer text/links) -->
    <div id="pactiva-wa-widget" class="group select-none" style="position: fixed !important; bottom: 85px !important; right: 24px !important; z-index: 999999 !important; display: flex !important; align-items: center !important; outline: none !important; border: none !important;">
        <!-- Hover / Tap Tooltip -->
        <div class="hidden sm:flex items-center mr-3 px-3.5 py-2 bg-slate-900/95 backdrop-blur-md text-white text-xs font-semibold rounded-xl shadow-xl border border-slate-700/80 pointer-events-none transform translate-x-2 opacity-0 group-hover:translate-x-0 group-hover:opacity-100 transition-all duration-300" style="white-space: nowrap !important;">
            <span class="w-2 h-2 rounded-full bg-emerald-400 mr-2 animate-pulse" style="display: inline-block; width: 8px; height: 8px; border-radius: 50%; background: #34d399; margin-right: 8px;"></span>
            <?php esc_html_e( 'Direct WhatsApp Support', 'pactiva-energy' ); ?>
        </div>

        <!-- Floating Button -->
        <a href="<?php echo esc_url( $general_url ); ?>" 
           target="_blank" 
           rel="noopener noreferrer" 
           aria-label="<?php esc_attr_e( 'Chat with PACTIVA Energy on WhatsApp', 'pactiva-energy' ); ?>"
           style="position: relative !important; display: flex !important; align-items: center !important; justify-content: center !important; width: 56px !important; height: 56px !important; background-color: #25D366 !important; color: #ffffff !important; border-radius: 9999px !important; box-shadow: 0 10px 25px -5px rgba(37,211,102,0.55) !important; outline: none !important; border: none !important; text-decoration: none !important; cursor: pointer !important; transition: transform 0.2s ease-in-out !important;"
           class="hover:scale-110 active:scale-95 transition-all duration-300 select-none">
            
            <!-- WhatsApp Icon SVG -->
            <svg class="w-8 h-8 fill-current drop-shadow-sm pointer-events-none" style="width: 30px; height: 30px; fill: #ffffff;" viewBox="0 0 24 24">
                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
            </svg>

            <!-- Small online green indicator -->
            <span class="absolute top-1 right-1 w-3.5 h-3.5 bg-emerald-400 border-2 border-white rounded-full" style="position: absolute; top: 2px; right: 2px; width: 14px; height: 14px; background: #34d399; border: 2px solid #ffffff; border-radius: 50%;"></span>
        </a>
    </div>
    <?php
}
add_action( 'wp_footer', 'pactiva_render_floating_whatsapp', 50 );
