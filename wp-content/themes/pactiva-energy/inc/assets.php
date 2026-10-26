<?php
/**
 * Asset Enqueuing & Optimization
 *
 * @package Pactiva_Energy
 */

defined( 'ABSPATH' ) || exit;

function pactiva_enqueue_scripts() {
    // 1. Parent theme style
    wp_enqueue_style( 'astra-theme-css', get_template_directory_uri() . '/style.css', array(), '1.0.0' );

    // 2. Google Fonts (Plus Jakarta Sans, Outfit & Space Grotesk) for modern industrial tech typography
    wp_enqueue_style(
        'pactiva-fonts',
        'https://fonts.googleapis.com/css2?family=Outfit:wght@500;600;700;800;900&family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&family=Space+Grotesk:wght@500;600;700&display=swap',
        array(),
        null
    );

    // 3. Child theme compiled production Tailwind CSS (ZERO CDN!)
    $css_path = PACTIVA_THEME_DIR . '/assets/css/app.min.css';
    $css_version = ( file_exists( $css_path ) ? filemtime( $css_path ) : time() ) . '.111';
    
    wp_enqueue_style(
        'pactiva-production-css',
        PACTIVA_THEME_URI . '/assets/css/app.min.css',
        array( 'astra-theme-css' ),
        $css_version
    );

    // 4. Main Vanilla JavaScript
    $js_path = PACTIVA_THEME_DIR . '/assets/js/main.js';
    $js_version = ( file_exists( $js_path ) ? filemtime( $js_path ) : time() ) . '.107';

    wp_enqueue_script(
        'pactiva-main-js',
        PACTIVA_THEME_URI . '/assets/js/main.js',
        array( 'jquery' ),
        $js_version,
        true
    );

    // 5. Localize script with dynamic data for live search, WhatsApp builder, and AJAX forms
    $wa_number = get_option( 'pactiva_whatsapp_number', '+919818280807' );
    // Normalize whatsapp number by stripping non-numeric characters for wa.me URL
    $clean_wa = preg_replace( '/[^0-9]/', '', $wa_number );

    wp_localize_script( 'pactiva-main-js', 'pactivaData', array(
        'ajaxUrl'        => admin_url( 'admin-ajax.php' ),
        'nonce'          => wp_create_nonce( 'pactiva_security_nonce' ),
        'whatsappNumber' => $clean_wa,
        'brandName'      => get_bloginfo( 'name' ),
        'currencySymbol' => function_exists( 'get_woocommerce_currency_symbol' ) ? get_woocommerce_currency_symbol() : '₹',
        'cartUrl'        => function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : '',
        'shopUrl'        => function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/shop/' ),
        'themeUri'       => PACTIVA_THEME_URI,
        'i18n'           => array(
            'searchPlaceholder' => __( 'Search lithium batteries, BMS, inverters...', 'pactiva-energy' ),
            'searching'         => __( 'Searching products...', 'pactiva-energy' ),
            'noResults'         => __( 'No products found matching your search.', 'pactiva-energy' ),
            'submitting'        => __( 'Submitting enquiry...', 'pactiva-energy' ),
            'success'           => __( 'Thank you! Your enquiry has been received. Our engineering team will contact you shortly.', 'pactiva-energy' ),
            'error'             => __( 'An error occurred. Please try again or WhatsApp us directly.', 'pactiva-energy' ),
        ),
    ) );
}
add_action( 'wp_enqueue_scripts', 'pactiva_enqueue_scripts', 20 );

/**
 * Add preconnect headers for Google Fonts for performance
 */
function pactiva_resource_hints( $urls, $relation_type ) {
    if ( 'preconnect' === $relation_type ) {
        $urls[] = array(
            'href'        => 'https://fonts.googleapis.com',
            'crossorigin' => 'anonymous',
        );
        $urls[] = array(
            'href'        => 'https://fonts.gstatic.com',
            'crossorigin' => 'anonymous',
        );
    }
    return $urls;
}
add_filter( 'wp_resource_hints', 'pactiva_resource_hints', 10, 2 );
