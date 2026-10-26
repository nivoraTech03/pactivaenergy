<?php
/**
 * PACTIVA ENERGY Child Theme Functions
 *
 * @package Pactiva_Energy
 */

defined( 'ABSPATH' ) || exit;

// Define theme version and paths
define( 'PACTIVA_THEME_VERSION', '1.0.0' );
define( 'PACTIVA_THEME_DIR', get_stylesheet_directory() );
define( 'PACTIVA_THEME_URI', get_stylesheet_directory_uri() );

// Modular file inclusions
require_once PACTIVA_THEME_DIR . '/inc/setup.php';
require_once PACTIVA_THEME_DIR . '/inc/assets.php';
require_once PACTIVA_THEME_DIR . '/inc/security.php';
require_once PACTIVA_THEME_DIR . '/inc/customizer.php';
require_once PACTIVA_THEME_DIR . '/inc/page-templates.php';
require_once PACTIVA_THEME_DIR . '/inc/product-helpers.php';
require_once PACTIVA_THEME_DIR . '/inc/whatsapp.php';
require_once PACTIVA_THEME_DIR . '/inc/admin-settings.php';
require_once PACTIVA_THEME_DIR . '/inc/integrations.php';
require_once PACTIVA_THEME_DIR . '/inc/seo.php';
