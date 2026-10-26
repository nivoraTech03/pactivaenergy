<?php
/**
 * Theme Setup and Configuration
 *
 * @package Pactiva_Energy
 */

defined( 'ABSPATH' ) || exit;

function pactiva_setup() {
    // Make theme available for translation
    load_child_theme_textdomain( 'pactiva-energy', PACTIVA_THEME_DIR . '/languages' );

    // Add default posts and comments RSS feed links to head
    add_theme_support( 'automatic-feed-links' );

    // Enable title tag management
    add_theme_support( 'title-tag' );

    // Enable post thumbnails
    add_theme_support( 'post-thumbnails' );

    // Register navigation menus
    register_nav_menus( array(
        'primary-menu'   => __( 'Primary Header Navigation', 'pactiva-energy' ),
        'category-menu'  => __( 'Product Category Menu', 'pactiva-energy' ),
        'footer-menu'    => __( 'Footer Quick Links', 'pactiva-energy' ),
        'footer-legal'   => __( 'Footer Legal & Compliance', 'pactiva-energy' ),
    ) );

    // Switch default core markup for search form, comment form, and comments to output valid HTML5
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ) );

    // WooCommerce Support
    add_theme_support( 'woocommerce', array(
        'thumbnail_image_width' => 450,
        'single_image_width'    => 800,
        'product_grid'          => array(
            'default_rows'    => 4,
            'min_rows'        => 1,
            'max_rows'        => 12,
            'default_columns' => 4,
            'min_columns'     => 2,
            'max_columns'     => 5,
        ),
    ) );

    // WooCommerce Product Gallery Features
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );

    // Custom Image Sizes
    add_image_size( 'pactiva-product-card', 400, 400, true );
    add_image_size( 'pactiva-category-thumb', 200, 200, true );
    add_image_size( 'pactiva-hero-banner', 1440, 600, true );
}
add_action( 'after_setup_theme', 'pactiva_setup', 20 );

/**
 * Remove parent theme Astra styles if needed or let them integrate cleanly.
 */
function pactiva_dequeue_unneeded_parent_styles() {
    // Keep Astra base intact while overriding component presentations cleanly
}
add_action( 'wp_enqueue_scripts', 'pactiva_dequeue_unneeded_parent_styles', 15 );

/**
 * Hide default page title on WooCommerce Cart and Checkout pages in Astra
 */
add_filter( 'astra_the_title_enabled', function( $enabled ) {
    if ( ( function_exists( 'is_cart' ) && is_cart() ) || ( function_exists( 'is_checkout' ) && is_checkout() ) ) {
        return false;
    }
    return $enabled;
} );

/**
 * Performance Optimization: Cap outbound HTTP request timeouts to 5 seconds.
 * Prevents third-party API / WordPress.org / WooCommerce calls from hanging Windows XAMPP for 120s.
 */
add_filter( 'http_request_timeout', function( $timeout ) {
    return 5;
} );

add_filter( 'http_request_args', function( $args, $url ) {
    $args['timeout'] = 5;
    return $args;
}, 10, 2 );

/**
 * Prevent Action Scheduler queue runner from running on synchronous frontend requests.
 */
add_filter( 'action_scheduler_run_queue', function( $run ) {
    if ( ! is_admin() && ! wp_doing_cron() && ! wp_doing_ajax() ) {
        return false;
    }
    return $run;
} );

/**
 * Filter default site icon to use Pactiva Energy favicon
 */
add_filter( 'get_site_icon_url', function( $url, $size, $blog_id ) {
    if ( empty( $url ) ) {
        if ( $size <= 32 ) {
            return PACTIVA_THEME_URI . '/assets/images/favicon-32x32.png';
        }
        if ( $size <= 180 ) {
            return PACTIVA_THEME_URI . '/assets/images/apple-touch-icon.png';
        }
        return PACTIVA_THEME_URI . '/assets/images/android-chrome-192x192.png';
    }
    return $url;
}, 10, 3 );



