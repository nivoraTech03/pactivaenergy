<?php
/**
 * Administrator Selectable Page Templates
 *
 * @package Pactiva_Energy
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register custom page templates with WordPress
 */
function pactiva_register_page_templates( $templates ) {
    $templates['templates/template-home.php']        = __( 'Homepage / Main Portal', 'pactiva-energy' );
    $templates['templates/template-about.php']       = __( 'About Us — Company & Infrastructure', 'pactiva-energy' );
    $templates['templates/template-contact.php']     = __( 'Contact Us & Corporate Inquiries', 'pactiva-energy' );
    $templates['templates/template-landing.php']     = __( 'Product Solutions Landing Page', 'pactiva-energy' );
    $templates['templates/template-bulk-order.php']  = __( 'Bulk Order & B2B Quotation', 'pactiva-energy' );
    $templates['templates/template-full-width.php']   = __( 'Full-Width Content Page', 'pactiva-energy' );
    
    return $templates;
}
add_filter( 'theme_page_templates', 'pactiva_register_page_templates' );

/**
 * Filter template hierarchy so templates located in templates/ subdirectory load correctly
 */
function pactiva_load_page_templates( $template ) {
    if ( is_page() ) {
        $meta_template = get_post_meta( get_the_ID(), '_wp_page_template', true );
        if ( ! empty( $meta_template ) && 'default' !== $meta_template ) {
            $file = PACTIVA_THEME_DIR . '/' . $meta_template;
            if ( file_exists( $file ) ) {
                return $file;
            }
        }
    }
    return $template;
}
add_filter( 'template_include', 'pactiva_load_page_templates', 99 );
