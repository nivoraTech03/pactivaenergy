<?php
/**
 * Featured Products Dynamic Showcase
 *
 * @package Pactiva_Energy
 */

defined( 'ABSPATH' ) || exit;

// Retrieve real WooCommerce products dynamically
$featured_products = pactiva_get_featured_products( 8 );
$shop_url = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/shop/' );
?>
<section class="py-16 bg-white border-b border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-4">
            <div>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-black uppercase tracking-wider bg-orange-100 text-brand-orange mb-2">
                    <?php esc_html_e( 'Direct Manufacturer Dispatch', 'pactiva-energy' ); ?>
                </span>
                <h2 class="text-2xl sm:text-3xl font-black font-heading text-slate-950 tracking-tight">
                    <?php esc_html_e( 'Featured Lithium & Hardware Systems', 'pactiva-energy' ); ?>
                </h2>
                <p class="text-sm text-slate-500 mt-1">
                    <?php esc_html_e( 'Real-time database catalog of certified lithium cells, active balancers, and integrated power packs.', 'pactiva-energy' ); ?>
                </p>
            </div>

            <div class="flex items-center gap-3">
                <a href="<?php echo esc_url( $shop_url ); ?>" class="btn-primary text-xs font-bold py-2.5 px-4">
                    <span><?php esc_html_e( 'View All Products', 'pactiva-energy' ); ?></span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>
        </div>

        <!-- Dynamic Product Grid -->
        <?php if ( ! empty( $featured_products ) ) : ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <?php foreach ( $featured_products as $prod ) : ?>
                    <?php pactiva_render_product_card( $prod ); ?>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <!-- Admin Guidance State when database has 0 products -->
            <div class="bg-slate-50 rounded-3xl border-2 border-dashed border-slate-200 p-12 text-center max-w-2xl mx-auto">
                <div class="w-16 h-16 rounded-2xl bg-orange-100 text-brand-orange mx-auto flex items-center justify-center mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2"><?php esc_html_e( 'Catalog Ready for Product Data', 'pactiva-energy' ); ?></h3>
                <p class="text-xs text-slate-500 leading-relaxed mb-6">
                    <?php esc_html_e( 'No hardcoded dummy products are used on PACTIVA ENERGY. Import your product catalog using the native WooCommerce CSV Importer to automatically populate this section dynamically.', 'pactiva-energy' ); ?>
                </p>
                <?php if ( current_user_can( 'manage_options' ) ) : ?>
                    <a href="<?php echo esc_url( admin_url( 'edit.php?post_type=product&page=product_importer' ) ); ?>" class="btn-primary text-xs font-bold">
                        <?php esc_html_e( 'Import Products via CSV Now', 'pactiva-energy' ); ?>
                    </a>
                <?php endif; ?>
            </div>
        <?php endif; ?>

    </div>
</section>
