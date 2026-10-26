<?php
/**
 * WordPress Customizer Settings for PACTIVA ENERGY
 *
 * @package Pactiva_Energy
 */

defined( 'ABSPATH' ) || exit;

function pactiva_customize_register( $wp_customize ) {
    // Section: PACTIVA Brand & Header Settings
    $wp_customize->add_section( 'pactiva_brand_section', array(
        'title'       => __( 'PACTIVA Brand & Contact Settings', 'pactiva-energy' ),
        'priority'    => 30,
        'description' => __( 'Manage contact numbers, WhatsApp, announcement bar, and social channels.', 'pactiva-energy' ),
    ) );

    // Announcement Bar Text
    $wp_customize->add_setting( 'pactiva_announcement_text', array(
        'default'           => '⚡ High-Grade LiFePO4 & Lithium-Ion Battery Technology | Pan-India B2B Dispatch & Technical Support',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'pactiva_announcement_text', array(
        'label'    => __( 'Announcement Bar Text', 'pactiva-energy' ),
        'section'  => 'pactiva_brand_section',
        'type'     => 'text',
    ) );

    // Announcement Bar Enabled
    $wp_customize->add_setting( 'pactiva_announcement_enabled', array(
        'default'           => '1',
        'sanitize_callback' => 'pactiva_sanitize_checkbox',
    ) );
    $wp_customize->add_control( 'pactiva_announcement_enabled', array(
        'label'    => __( 'Show Announcement Bar', 'pactiva-energy' ),
        'section'  => 'pactiva_brand_section',
        'type'     => 'checkbox',
    ) );

    // WhatsApp Number
    $wp_customize->add_setting( 'pactiva_whatsapp_number', array(
        'default'           => '+919818280807',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'pactiva_whatsapp_number', array(
        'label'       => __( 'WhatsApp Business Number', 'pactiva-energy' ),
        'description' => __( 'Include country code without spaces (e.g. +919818280807)', 'pactiva-energy' ),
        'section'     => 'pactiva_brand_section',
        'type'        => 'text',
    ) );

    // Business Support Phone
    $wp_customize->add_setting( 'pactiva_support_phone', array(
        'default'           => '+91 9818280807',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'pactiva_support_phone', array(
        'label'    => __( 'Customer Support Phone', 'pactiva-energy' ),
        'section'  => 'pactiva_brand_section',
        'type'     => 'text',
    ) );

    // Official General Business Email
    $wp_customize->add_setting( 'pactiva_business_email', array(
        'default'           => 'info@pactivaenergy.com',
        'sanitize_callback' => 'sanitize_email',
    ) );
    $wp_customize->add_control( 'pactiva_business_email', array(
        'label'    => __( 'Official General Email', 'pactiva-energy' ),
        'section'  => 'pactiva_brand_section',
        'type'     => 'email',
    ) );

    // Direct Representative Email
    $wp_customize->add_setting( 'pactiva_direct_email', array(
        'default'           => 'shivanshu@pactivaenergy.com',
        'sanitize_callback' => 'sanitize_email',
    ) );
    $wp_customize->add_control( 'pactiva_direct_email', array(
        'label'    => __( 'Direct Representative Email', 'pactiva-energy' ),
        'section'  => 'pactiva_brand_section',
        'type'     => 'email',
    ) );

    // Enquiry Notification Recipient
    $wp_customize->add_setting( 'pactiva_enquiry_recipient_email', array(
        'default'           => 'sales1@pactivaenergy.com',
        'sanitize_callback' => 'sanitize_email',
    ) );
    $wp_customize->add_control( 'pactiva_enquiry_recipient_email', array(
        'label'    => __( 'Enquiry Lead Recipient Email', 'pactiva-energy' ),
        'section'  => 'pactiva_brand_section',
        'type'     => 'email',
    ) );

    // Corporate Address
    $wp_customize->add_setting( 'pactiva_corporate_address', array(
        'default'           => 'C-111, Sector -65, NOIDA - 201301',
        'sanitize_callback' => 'sanitize_textarea_field',
    ) );
    $wp_customize->add_control( 'pactiva_corporate_address', array(
        'label'    => __( 'Corporate Office Address', 'pactiva-energy' ),
        'section'  => 'pactiva_brand_section',
        'type'     => 'textarea',
    ) );

    // Catalog Mode: Enquiry Only vs Cart Enabled
    $wp_customize->add_setting( 'pactiva_catalog_mode', array(
        'default'           => 'enquiry_first',
        'sanitize_callback' => 'pactiva_sanitize_select',
    ) );
    $wp_customize->add_control( 'pactiva_catalog_mode', array(
        'label'       => __( 'Product Action Mode', 'pactiva-energy' ),
        'description' => __( 'Enquiry-First emphasizes WhatsApp and Bulk Quote CTAs while keeping standard cart optional.', 'pactiva-energy' ),
        'section'     => 'pactiva_brand_section',
        'type'        => 'select',
        'choices'     => array(
            'enquiry_first' => __( 'Enquiry & WhatsApp First (Recommended for B2B)', 'pactiva-energy' ),
            'cart_enabled'  => __( 'Standard Cart & Add to Cart Enabled', 'pactiva-energy' ),
            'enquiry_only'  => __( 'Strict Enquiry Only (Hide Add to Cart)', 'pactiva-energy' ),
        ),
    ) );
}
add_action( 'customize_register', 'pactiva_customize_register' );

function pactiva_sanitize_checkbox( $checked ) {
    return ( ( isset( $checked ) && true == $checked ) ? '1' : '0' );
}

function pactiva_sanitize_select( $input, $setting ) {
    $input = sanitize_key( $input );
    $choices = $setting->manager->get_control( $setting->id )->choices;
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}
