<?php
/**
 * Featured Categories & Product Sectors Component
 *
 * @package Pactiva_Energy
 */

defined( 'ABSPATH' ) || exit;

// Dynamically fetch top WooCommerce product categories
$categories = get_terms( array(
    'taxonomy'   => 'product_cat',
    'hide_empty' => false,
    'number'     => 12,
    'orderby'    => 'count',
    'order'      => 'DESC',
) );

$shop_url = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/shop/' );
?>
<section class="py-16 bg-slate-50 border-b border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Section Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-4">
            <div>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-black uppercase tracking-wider bg-orange-100 text-brand-orange mb-2">
                    <?php esc_html_e( 'B2B Catalog Structure', 'pactiva-energy' ); ?>
                </span>
                <h2 class="text-2xl sm:text-3xl font-black font-heading text-slate-950 tracking-tight">
                    <?php esc_html_e( 'Explore Energy Categories & Hardware', 'pactiva-energy' ); ?>
                </h2>
                <p class="text-sm text-slate-500 mt-1">
                    <?php esc_html_e( 'High-density cells, active balancing BMS, solar storage, EV powertrains, and hardware consumables.', 'pactiva-energy' ); ?>
                </p>
            </div>

            <a href="<?php echo esc_url( $shop_url ); ?>" class="text-xs font-bold text-brand-orange hover:text-brand-deep inline-flex items-center gap-1 group">
                <span><?php esc_html_e( 'View All Categories & Products', 'pactiva-energy' ); ?></span>
                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
        </div>

        <!-- Category Grid -->
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
            <?php if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) : ?>
                <?php foreach ( $categories as $cat ) : 
                    $cat_link = get_term_link( $cat );
                    $thumb_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
                    $thumb_url = $thumb_id ? wp_get_attachment_thumb_url( $thumb_id ) : '';
                ?>
                    <a href="<?php echo esc_url( $cat_link ); ?>" class="group bg-white p-4 rounded-2xl border border-slate-200/80 hover:border-brand-orange/50 hover:shadow-lg transition-all duration-300 flex flex-col items-center text-center">
                        <div class="w-14 h-14 rounded-xl bg-orange-50 group-hover:bg-brand-orange text-brand-orange group-hover:text-white flex items-center justify-center transition-colors duration-300 mb-3 shadow-sm">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        </div>
                        <h3 class="text-xs font-bold text-slate-900 group-hover:text-brand-orange transition-colors truncate w-full">
                            <?php echo esc_html( $cat->name ); ?>
                        </h3>
                        <span class="text-[11px] font-mono text-slate-400 mt-1">
                            <?php echo esc_html( sprintf( _n( '%s Item', '%s Items', $cat->count, 'pactiva-energy' ), $cat->count ) ); ?>
                        </span>
                    </a>
                <?php endforeach; ?>
            <?php else : ?>
                <!-- Default Placeholder Categories if database is empty -->
                <?php 
                $defaults = array(
                    'Lithium Cells (LFP/NMC)',
                    'Smart BMS & Balancers',
                    'EV Battery Packs',
                    'Solar Energy Storage',
                    'Wall-Mounted Inverters',
                    'Battery Accessories'
                );
                foreach ( $defaults as $title ) :
                ?>
                    <div class="bg-white p-4 rounded-2xl border border-slate-200 flex flex-col items-center text-center">
                        <div class="w-12 h-12 rounded-xl bg-slate-100 flex items-center justify-center text-slate-400 mb-2">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        </div>
                        <span class="text-xs font-bold text-slate-800"><?php echo esc_html( $title ); ?></span>
                        <span class="text-[10px] text-slate-400 mt-0.5">Catalog Active</span>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

    </div>
</section>
