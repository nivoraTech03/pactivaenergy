<?php
/**
 * PACTIVA ENERGY Theme Header
 *
 * @package Pactiva_Energy
 */

defined( 'ABSPATH' ) || exit;
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    
    <!-- Favicon & Brand Icons -->
    <link rel="icon" type="image/x-icon" href="<?php echo esc_url( PACTIVA_THEME_URI . '/assets/images/favicon.ico' ); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo esc_url( PACTIVA_THEME_URI . '/assets/images/favicon-32x32.png' ); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo esc_url( PACTIVA_THEME_URI . '/assets/images/favicon-16x16.png' ); ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url( PACTIVA_THEME_URI . '/assets/images/apple-touch-icon.png' ); ?>">

    <?php wp_head(); ?>
</head>

<body <?php body_class( 'bg-slate-50 text-slate-800 antialiased selection:bg-brand-orange selection:text-white' ); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site min-h-screen flex flex-col justify-between">
    <a class="skip-link screen-reader-text sr-only focus:not-sr-only focus:fixed focus:top-4 focus:left-4 focus:z-50 focus:p-4 focus:bg-brand-orange focus:text-white" href="#primary">
        <?php esc_html_e( 'Skip to content', 'pactiva-energy' ); ?>
    </a>

    <!-- Top Announcement Bar -->
    <?php get_template_part( 'template-parts/header/announcement' ); ?>

    <!-- Main Navigation Bar -->
    <?php get_template_part( 'template-parts/header/navbar' ); ?>

    <main id="primary" class="site-main flex-1" style="margin-top:0px">
