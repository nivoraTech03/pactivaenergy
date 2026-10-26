<?php
/**
 * Main Navbar Component (Clean 2-Tier Header, Active Nav Indicators, 100% Mobile Responsive)
 *
 * @package Pactiva_Energy
 */

defined( 'ABSPATH' ) || exit;

$home_url   = home_url( '/' );
$shop_url   = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/shop/' );
$cart_url   = function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : home_url( '/cart/' );
$cart_count = ( function_exists( 'WC' ) && WC()->cart ) ? WC()->cart->get_cart_contents_count() : 0;
$wa_url     = pactiva_build_whatsapp_general_url( 'Direct Query from Header' );
$phone      = get_option( 'pactiva_support_phone', '+91 9818280807' );

// Fetch top-level categories dynamically from WooCommerce database
$product_categories = get_terms( array(
    'taxonomy'   => 'product_cat',
    'hide_empty' => false,
    'parent'     => 0,
    'number'     => 8,
) );

if ( ! function_exists( 'pactiva_is_nav_active' ) ) {
    function pactiva_is_nav_active( $target_url, $is_home = false, $wp_condition = false ) {
        if ( $wp_condition ) {
            return true;
        }
        $current_path = trim( str_replace( 'index.php/', '', parse_url( $_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH ) ?? '' ), '/' );
        $target_path  = trim( str_replace( 'index.php/', '', parse_url( $target_url, PHP_URL_PATH ) ?? '' ), '/' );

        if ( $is_home ) {
            $home_path = trim( str_replace( 'index.php/', '', parse_url( home_url( '/' ), PHP_URL_PATH ) ?? '' ), '/' );
            return ( $current_path === $home_path || empty( $current_path ) || is_front_page() || is_home() );
        }

        if ( ! empty( $target_path ) && ( $current_path === $target_path || str_ends_with( $current_path, $target_path ) ) ) {
            return true;
        }
        return false;
    }
}

$ev_url      = pactiva_get_category_url( 'ev-battery-solutions' );
$solar_url   = pactiva_get_category_url( 'solar-ess-systems' );
$bms_url     = pactiva_get_category_url( 'smart-bms-hardware' );
$inv_url     = pactiva_get_category_url( 'wall-mounted-inverters' );
$bulk_url    = pactiva_get_page_url( 'bulk-orders' );
$about_url   = pactiva_get_page_url( 'about-us' );
$contact_url = pactiva_get_page_url( 'contact-us' );

// Navigation Items with Precise Active State Indicators
$nav_items = array(
    array(
        'label'  => __( 'Home', 'pactiva-energy' ),
        'url'    => $home_url,
        'active' => pactiva_is_nav_active( $home_url, true, is_front_page() || is_home() ),
        'icon'   => '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>',
    ),
    array(
        'label'  => __( 'All Products', 'pactiva-energy' ),
        'url'    => $shop_url,
        'active' => pactiva_is_nav_active( $shop_url, false, ( function_exists( 'is_shop' ) && is_shop() ) || ( is_post_type_archive( 'product' ) && ! is_tax( 'product_cat' ) ) ),
        'icon'   => '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>',
    ),
    array(
        'label'  => __( 'EV Batteries', 'pactiva-energy' ),
        'url'    => $ev_url,
        'active' => pactiva_is_nav_active( $ev_url, false, is_tax( 'product_cat', 'ev-battery-solutions' ) ),
        'icon'   => '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>',
    ),
    array(
        'label'  => __( 'Solar & ESS', 'pactiva-energy' ),
        'url'    => $solar_url,
        'active' => pactiva_is_nav_active( $solar_url, false, is_tax( 'product_cat', 'solar-ess-systems' ) ),
        'icon'   => '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>',
    ),
    array(
        'label'  => __( 'Smart BMS', 'pactiva-energy' ),
        'url'    => $bms_url,
        'active' => pactiva_is_nav_active( $bms_url, false, is_tax( 'product_cat', 'smart-bms-hardware' ) ),
        'icon'   => '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/></svg>',
    ),
    array(
        'label'  => __( 'Inverters', 'pactiva-energy' ),
        'url'    => $inv_url,
        'active' => pactiva_is_nav_active( $inv_url, false, is_tax( 'product_cat', 'wall-mounted-inverters' ) ),
        'icon'   => '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>',
    ),
    array(
        'label'  => __( 'Bulk Inquiries', 'pactiva-energy' ),
        'url'    => $bulk_url,
        'active' => pactiva_is_nav_active( $bulk_url, false, is_page( 'bulk-orders' ) ),
        'icon'   => '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>',
    ),
    array(
        'label'  => __( 'About PACTIVA', 'pactiva-energy' ),
        'url'    => $about_url,
        'active' => pactiva_is_nav_active( $about_url, false, is_page( 'about-us' ) ),
        'icon'   => '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
    ),
    array(
        'label'  => __( 'Contact Us', 'pactiva-energy' ),
        'url'    => $contact_url,
        'active' => pactiva_is_nav_active( $contact_url, false, is_page( 'contact-us' ) ),
        'icon'   => '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>',
    ),
);
?>
<header id="pactiva-site-header" class="sticky top-0 z-50 bg-white border-b border-slate-200 shadow-sm transition-all duration-300" style="background-color: #ffffff !important; opacity: 1 !important; z-index: 9999 !important;">
    <style>
        /* Bulletproof Global Logo Sizing Across All Pages (Home, Shop, Category, Product) */
        #pactiva-site-header .pactiva-site-logo,
        img.pactiva-site-logo {
            height: 60px !important;
            max-height: 60px !important;
            min-height: 60px !important;
            width: auto !important;
            max-width: 280px !important;
            object-fit: contain !important;
            display: block !important;
            margin: 0 !important;
            padding: 0 !important;
        }
        @media (max-width: 640px) {
            #pactiva-site-header .pactiva-site-logo,
            img.pactiva-site-logo {
                height: 42px !important;
                max-height: 42px !important;
                max-width: 200px !important;
            }
        }
    </style>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- 1. Primary Header Row (Logo, Categories, Action CTAs) -->
        <div class="flex items-center justify-between h-20 sm:h-22 gap-4">
            
            <!-- Left: Brand Logo & Categories Trigger -->
            <div class="flex items-center gap-4 sm:gap-6 shrink-0">
                <a href="<?php echo esc_url( $home_url ); ?>" class="flex items-center shrink-0 group" style="display:flex;align-items:center;height:60px;max-height:60px;text-decoration:none;">
                    <!-- Complete Pactiva Energy Brand Logo Image with dark high-contrast text on white -->
                    <img src="<?php echo esc_url( PACTIVA_THEME_URI . '/assets/images/pactiva-logo-light.png' ); ?>" 
                         alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" 
                         width="280"
                         height="60"
                         class="pactiva-site-logo"
                         style="height:60px !important;max-height:60px !important;min-height:60px !important;width:auto !important;max-width:280px !important;object-fit:contain !important;display:block !important;margin:0 !important;">
                </a>

                <!-- Desktop Category Dropdown Trigger -->
                <div class="hidden sm:relative sm:block group">
                    <button type="button" class="inline-flex items-center gap-2 px-3.5 py-2.5 text-xs font-bold uppercase tracking-wider text-slate-700 bg-slate-100 hover:bg-slate-200 rounded-xl transition-colors cursor-pointer">
                        <svg class="w-4 h-4 text-brand-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/></svg>
                        <span><?php esc_html_e( 'Categories', 'pactiva-energy' ); ?></span>
                        <svg class="w-3.5 h-3.5 text-slate-400 group-hover:rotate-180 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>

                    <!-- Dropdown Menu with zero-gap hover bridge -->
                    <div class="absolute top-full left-0 pt-1.5 w-72 hidden group-hover:block transition-all duration-200 z-50">
                        <div class="bg-white rounded-2xl shadow-2xl border border-slate-100 py-2">
                            <div class="px-3.5 py-2 text-[10px] font-bold text-slate-400 uppercase tracking-wider border-b border-slate-100 flex items-center justify-between">
                                <span><?php esc_html_e( 'Energy Sectors & Solutions', 'pactiva-energy' ); ?></span>
                                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                            </div>
                            <?php if ( ! empty( $product_categories ) && ! is_wp_error( $product_categories ) ) : ?>
                                <?php foreach ( $product_categories as $cat ) : ?>
                                    <a href="<?php echo esc_url( get_term_link( $cat ) ); ?>" class="flex items-center justify-between px-3.5 py-2.5 text-xs font-medium text-slate-700 hover:text-brand-orange hover:bg-orange-50/50 transition-colors">
                                        <span class="truncate"><?php echo esc_html( $cat->name ); ?></span>
                                        <span class="text-[10px] font-mono text-slate-400 bg-slate-100 px-2 py-0.5 rounded-full font-bold shrink-0 ml-2">
                                            <?php echo esc_html( $cat->count ); ?>
                                        </span>
                                    </a>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            <div class="p-2 border-t border-slate-100 bg-slate-50/70 rounded-b-2xl">
                                <a href="<?php echo esc_url( $shop_url ); ?>" class="block text-center py-1.5 text-xs font-bold text-brand-orange hover:underline">
                                    <?php esc_html_e( 'View Complete Catalog &rarr;', 'pactiva-energy' ); ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Action CTAs (Request Quote + WhatsApp + Cart + Mobile Menu Toggle) -->
            <div class="flex items-center gap-2 sm:gap-3 shrink-0">
                <!-- Request Quote Modal Trigger (Desktop) -->
                <button type="button" 
                        onclick="pactivaOpenEnquiryModal('General Bulk Quotation', 'BULK-RFQ')"
                        class="hidden md:inline-flex items-center gap-2 px-4 py-2.5 text-xs font-extrabold uppercase tracking-wider text-white bg-gradient-to-r from-brand-orange to-brand-deep hover:from-brand-deep hover:to-orange-700 rounded-xl shadow-md shadow-orange-500/25 hover:shadow-orange-500/40 active:scale-98 transition-all duration-200 cursor-pointer">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    <span><?php esc_html_e( 'Request Quote', 'pactiva-energy' ); ?></span>
                </button>

                <!-- WhatsApp Header Quick Button -->
                <a href="<?php echo esc_url( $wa_url ); ?>" 
                   target="_blank" 
                   rel="noopener noreferrer" 
                   class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-emerald-50 hover:bg-emerald-100 text-[#25D366] hover:text-[#20BD5A] transition-colors border border-emerald-100 shadow-sm" 
                   title="<?php esc_attr_e( 'Direct WhatsApp Chat', 'pactiva-energy' ); ?>">
                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                </a>

                <!-- Cart / Quote Basket -->
                <a href="<?php echo esc_url( $cart_url ); ?>" 
                   class="relative inline-flex items-center justify-center w-10 h-10 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-800 transition-colors"
                   title="<?php esc_attr_e( 'View Hardware Quotation Cart', 'pactiva-energy' ); ?>">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                    <?php if ( $cart_count > 0 ) : ?>
                        <span class="absolute -top-1 -right-1 flex items-center justify-center min-w-[20px] h-5 px-1 text-[10px] font-black text-white bg-brand-orange rounded-full border-2 border-white shadow-sm">
                            <?php echo esc_html( $cart_count ); ?>
                        </span>
                    <?php endif; ?>
                </a>

                <!-- Mobile Navigation Toggle Button (visible on < lg) -->
                <button type="button" 
                        id="pactiva-mobile-nav-toggle" 
                        class="lg:hidden inline-flex items-center justify-center w-10 h-10 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-800 transition-colors focus:outline-none cursor-pointer" 
                        aria-label="<?php esc_attr_e( 'Open Navigation Menu', 'pactiva-energy' ); ?>">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
            </div>
        </div>

        <!-- 2. Dedicated Horizontal Sub-Navigation Links Bar (Active color highlight + indicator) -->
        <nav class="hidden lg:flex items-center gap-7 xl:gap-8 py-3 border-t border-slate-100 text-xs font-bold whitespace-nowrap overflow-x-auto">
            <?php foreach ( $nav_items as $item ) : ?>
                <a href="<?php echo esc_url( $item['url'] ); ?>" 
                   class="<?php echo $item['active'] 
                       ? 'text-brand-orange font-black relative py-1 after:content-[\'\'] after:absolute after:-bottom-3 after:left-0 after:right-0 after:h-[2.5px] after:bg-brand-orange after:rounded-full shrink-0' 
                       : 'text-slate-700 hover:text-brand-orange transition-colors shrink-0 py-1'; ?>">
                    <?php echo esc_html( $item['label'] ); ?>
                </a>
            <?php endforeach; ?>
        </nav>

    </div>
</header>

<!-- Mobile Navigation Drawer (100% Touch-Friendly & Clean) -->
<div id="pactiva-drawer-backdrop" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm hidden opacity-0 transition-opacity duration-300" style="z-index: 99999 !important;"></div>

<aside id="pactiva-mobile-drawer" class="fixed top-0 left-0 bottom-0 w-80 max-w-[85vw] bg-white transform -translate-x-full transition-transform duration-300 ease-in-out flex flex-col justify-between shadow-2xl" style="z-index: 999999 !important;">
    <div class="flex-1 flex flex-col overflow-hidden">
        <!-- Drawer Header -->
        <div class="flex items-center justify-between p-4 sm:p-5 border-b border-slate-100 bg-slate-900 text-white shrink-0">
            <div class="flex items-center" style="display:flex;align-items:center;height:36px;">
                <img src="<?php echo esc_url( PACTIVA_THEME_URI . '/assets/images/pactiva-logo-dark.png' ); ?>" 
                     alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" 
                     width="170"
                     height="36"
                     style="height:36px !important;max-height:36px !important;width:auto !important;max-width:170px !important;object-fit:contain !important;display:block !important;">
            </div>
            <button type="button" id="pactiva-drawer-close" class="p-1.5 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800 transition-colors cursor-pointer" aria-label="<?php esc_attr_e( 'Close menu', 'pactiva-energy' ); ?>">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <!-- Quick B2B Quotation Action in Drawer -->
        <div class="p-4 border-b border-slate-100 bg-orange-50/50 shrink-0">
            <button type="button" 
                    onclick="pactivaOpenEnquiryModal('General Energy Storage Consultation', 'BULK-RFQ')"
                    class="w-full flex items-center justify-center gap-2 py-3 px-4 bg-brand-orange hover:bg-brand-deep text-white text-xs font-bold uppercase tracking-wider rounded-xl shadow-md shadow-orange-500/20 active:scale-98 transition-all cursor-pointer">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                <span><?php esc_html_e( 'Request Technical Quote', 'pactiva-energy' ); ?></span>
            </button>
        </div>

        <!-- Drawer Navigation Links -->
        <nav class="p-4 space-y-1 text-sm font-semibold text-slate-800 overflow-y-auto flex-1">
            <?php foreach ( $nav_items as $item ) : ?>
                <a href="<?php echo esc_url( $item['url'] ); ?>" 
                   class="<?php echo $item['active'] 
                       ? 'flex items-center gap-2.5 px-3 py-2.5 rounded-xl bg-orange-50 text-brand-orange font-black border-l-4 border-brand-orange transition-colors' 
                       : 'flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-slate-700 hover:bg-slate-100 hover:text-brand-orange transition-colors'; ?>">
                    <span class="<?php echo $item['active'] ? 'text-brand-orange' : 'text-slate-400'; ?>">
                        <?php echo $item['icon']; ?>
                    </span>
                    <span><?php echo esc_html( $item['label'] ); ?></span>
                </a>
            <?php endforeach; ?>

            <!-- Core Sectors Heading -->
            <div class="pt-3 pb-1 px-3 text-[10px] font-extrabold text-slate-400 uppercase tracking-wider flex items-center justify-between">
                <span><?php esc_html_e( 'Core Sectors', 'pactiva-energy' ); ?></span>
                <span class="w-12 h-px bg-slate-200"></span>
            </div>

            <?php if ( ! empty( $product_categories ) && ! is_wp_error( $product_categories ) ) : ?>
                <?php foreach ( $product_categories as $cat ) : 
                    $is_cat_active = is_tax( 'product_cat', $cat->slug );
                ?>
                    <a href="<?php echo esc_url( get_term_link( $cat ) ); ?>" class="flex items-center justify-between px-3 py-2 rounded-lg text-xs font-medium <?php echo $is_cat_active ? 'bg-orange-50 text-brand-orange font-bold' : 'text-slate-700 hover:text-brand-orange hover:bg-orange-50/40'; ?> transition-colors">
                        <span><?php echo esc_html( $cat->name ); ?></span>
                        <span class="text-[10px] font-mono bg-slate-100 text-slate-500 px-2 py-0.5 rounded-full font-bold">
                            <?php echo esc_html( $cat->count ); ?>
                        </span>
                    </a>
                <?php endforeach; ?>
            <?php endif; ?>
        </nav>
    </div>

    <!-- Drawer Footer Actions -->
    <div class="p-4 bg-slate-50 border-t border-slate-100 shrink-0 space-y-2">
        <a href="<?php echo esc_url( $wa_url ); ?>" target="_blank" rel="noopener noreferrer" class="w-full flex items-center justify-center gap-2 py-3 bg-[#25D366] hover:bg-[#20BD5A] text-white text-xs font-bold rounded-xl shadow-sm transition-colors">
            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
            <span><?php esc_html_e( 'Instant WhatsApp Support', 'pactiva-energy' ); ?></span>
        </a>

        <a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $phone ) ); ?>" class="w-full flex items-center justify-center gap-2 py-2.5 bg-slate-200/80 hover:bg-slate-300 text-slate-800 text-xs font-bold rounded-xl transition-colors">
            <svg class="w-4 h-4 text-brand-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
            <span><?php printf( esc_html__( 'Call Direct: %s', 'pactiva-energy' ), esc_html( $phone ) ); ?></span>
        </a>
    </div>
</aside>
