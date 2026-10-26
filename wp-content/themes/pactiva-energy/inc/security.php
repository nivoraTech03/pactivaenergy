<?php
/**
 * Security, Sanitization & Anti-Abuse
 *
 * @package Pactiva_Energy
 */

defined( 'ABSPATH' ) || exit;

/**
 * Add comprehensive security headers & Clickjacking / Iframe protection
 */
function pactiva_security_headers() {
    if ( ! is_admin() && ! headers_sent() ) {
        // Anti-Clickjacking: Strict Iframe Embed Prevention
        header( 'X-Frame-Options: SAMEORIGIN' );
        header( "Content-Security-Policy: frame-ancestors 'self';" );
        
        // Anti-MIME sniffing & XSS Protections
        header( 'X-Content-Type-Options: nosniff' );
        header( 'X-XSS-Protection: 1; mode=block' );
        header( 'Referrer-Policy: strict-origin-when-cross-origin' );
        header( 'Permissions-Policy: camera=(), microphone=(), geolocation=()' );
        header( 'X-Permitted-Cross-Domain-Policies: none' );
    }
}
add_action( 'send_headers', 'pactiva_security_headers' );

// Hide WordPress Generator Version Info
remove_action( 'wp_head', 'wp_generator' );

// Disable XML-RPC API to block brute-force attack vectors
add_filter( 'xmlrpc_enabled', '__return_false' );

// Block malicious user/author enumeration scanning (?author=1)
function pactiva_block_user_enumeration() {
    if ( ! is_admin() && isset( $_REQUEST['author'] ) && ! empty( $_REQUEST['author'] ) ) {
        wp_die( esc_html__( 'Direct user enumeration query is blocked for security.', 'pactiva-energy' ), 'Forbidden', array( 'response' => 403 ) );
    }
}
add_action( 'init', 'pactiva_block_user_enumeration' );

/**
 * Rate limiting check for public enquiry forms using transients
 *
 * @param string $action
 * @param int $limit Max attempts allowed
 * @param int $period In seconds
 * @return bool True if allowed, false if rate limited
 */
function pactiva_check_rate_limit( $action = 'enquiry', $limit = 5, $period = 300 ) {
    $ip = isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : '0.0.0.0';
    $transient_key = 'pactiva_rate_' . md5( $action . '_' . $ip );
    $attempts = get_transient( $transient_key );

    if ( false === $attempts ) {
        set_transient( $transient_key, 1, $period );
        return true;
    }

    if ( $attempts >= $limit ) {
        return false;
    }

    set_transient( $transient_key, $attempts + 1, $period );
    return true;
}

/**
 * Validate and sanitize form submission payloads
 *
 * @param array $data Raw input array
 * @return array Sanitized array
 */
function pactiva_sanitize_enquiry_data( $data ) {
    $sanitized = array();

    if ( isset( $data['name'] ) ) {
        $sanitized['name'] = sanitize_text_field( wp_unslash( $data['name'] ) );
    }
    if ( isset( $data['email'] ) ) {
        $sanitized['email'] = sanitize_email( wp_unslash( $data['email'] ) );
    }
    if ( isset( $data['phone'] ) ) {
        $sanitized['phone'] = sanitize_text_field( wp_unslash( $data['phone'] ) );
    }
    if ( isset( $data['company'] ) ) {
        $sanitized['company'] = sanitize_text_field( wp_unslash( $data['company'] ) );
    }
    if ( isset( $data['product_name'] ) ) {
        $sanitized['product_name'] = sanitize_text_field( wp_unslash( $data['product_name'] ) );
    }
    if ( isset( $data['product_sku'] ) ) {
        $sanitized['product_sku'] = sanitize_text_field( wp_unslash( $data['product_sku'] ) );
    }
    if ( isset( $data['quantity'] ) ) {
        $sanitized['quantity'] = absint( $data['quantity'] );
    }
    if ( isset( $data['message'] ) ) {
        $sanitized['message'] = sanitize_textarea_field( wp_unslash( $data['message'] ) );
    }

    return $sanitized;
}

/**
 * Honeypot spam detection helper
 *
 * @param array $data
 * @param string $field_name
 * @return bool True if bot detected, false if human
 */
function pactiva_is_spam_honeypot( $data, $field_name = 'pactiva_hp_website' ) {
    return ! empty( $data[ $field_name ] );
}
