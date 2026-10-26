<?php
/**
 * PACTIVA ENERGY WooCommerce Archive Product Template
 *
 * @package Pactiva_Energy
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

// Retrieve categories for top horizontal pill navigation
$categories = get_terms( array(
    'taxonomy'   => 'product_cat',
    'hide_empty' => false,
    'number'     => 14,
    'orderby'    => 'count',
    'order'      => 'DESC',
) );

$current_cat = is_product_category() ? get_queried_object() : null;
$shop_page_url = wc_get_page_permalink( 'shop' );
?>

<!-- Shop Header Banner -->
<div class="bg-brand-black text-white py-10 lg:py-14 border-b border-white/10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <nav class="text-[11px] font-mono text-slate-400 uppercase tracking-wider mb-2">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hover:text-brand-orange"><?php esc_html_e( 'Home', 'pactiva-energy' ); ?></a>
                    <span class="mx-2">&rsaquo;</span>
                    <span class="text-brand-orange">
                        <?php if ( $current_cat ) : ?>
                            <?php echo esc_html( $current_cat->name ); ?>
                        <?php else : ?>
                            <?php esc_html_e( 'All Products', 'pactiva-energy' ); ?>
                        <?php endif; ?>
                    </span>
                </nav>
                <h1 class="text-3xl sm:text-4xl font-black font-heading tracking-tight text-white">
                    <?php if ( $current_cat ) : ?>
                        <?php echo esc_html( $current_cat->name ); ?>
                    <?php else : ?>
                        <?php esc_html_e( 'PACTIVA Energy Hardware Catalog', 'pactiva-energy' ); ?>
                    <?php endif; ?>
                </h1>
                <p class="text-xs sm:text-sm text-slate-400 mt-1 max-w-2xl">
                    <?php 
                    if ( $current_cat && ! empty( $current_cat->description ) ) {
                        echo esc_html( $current_cat->description );
                    } else {
                        esc_html_e( 'Explore lithium cells, smart active-balancing BMS, modular solar ESS, and EV powertrain batteries.', 'pactiva-energy' );
                    }
                    ?>
                </p>
            </div>

            <!-- Total Products Count Badge -->
            <div class="bg-white/5 border border-white/10 rounded-2xl p-4 text-center shrink-0">
                <span class="text-[10px] font-mono text-slate-400 uppercase tracking-wider block"><?php esc_html_e( 'Catalog Total', 'pactiva-energy' ); ?></span>
                <span class="text-2xl font-black text-brand-orange font-heading">
                    <?php 
                    $total = wc_get_products( array( 'status' => 'publish', 'return' => 'ids', 'limit' => -1 ) );
                    echo esc_html( count( $total ) );
                    ?>
                </span>
                <span class="text-[11px] text-slate-300 block"><?php esc_html_e( 'Certified Items', 'pactiva-energy' ); ?></span>
            </div>
        </div>
    </div>
</div>

<!-- Horizontal Category Pills Bar -->
<div class="bg-white border-b border-slate-200/80 sticky top-20 z-30 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
        <div class="flex items-center gap-2 overflow-x-auto no-scrollbar py-1">
            <!-- All Products Pill -->
            <a href="<?php echo esc_url( $shop_page_url ); ?>" 
               class="shrink-0 px-4 py-2 rounded-xl text-xs font-bold transition-all duration-200 flex items-center gap-2 <?php echo ! $current_cat ? 'bg-brand-orange text-white shadow-sm' : 'bg-slate-100 text-slate-700 hover:bg-slate-200'; ?>">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/></svg>
                <?php esc_html_e( 'All Products', 'pactiva-energy' ); ?>
            </a>

            <?php if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) : ?>
                <?php foreach ( $categories as $cat ) : 
                    $is_active = ( $current_cat && $current_cat->term_id === $cat->term_id );
                ?>
                    <a href="<?php echo esc_url( get_term_link( $cat ) ); ?>" 
                       class="shrink-0 px-3.5 py-2 rounded-xl text-xs font-bold transition-all duration-200 flex items-center gap-2 <?php echo $is_active ? 'bg-brand-orange text-white shadow-sm' : 'bg-slate-100 text-slate-700 hover:bg-slate-200'; ?>">
                        <span><?php echo esc_html( $cat->name ); ?></span>
                        <span class="text-[10px] px-1.5 py-0.5 rounded-full <?php echo $is_active ? 'bg-white/20 text-white' : 'bg-white text-slate-500'; ?>">
                            <?php echo esc_html( $cat->count ); ?>
                        </span>
                    </a>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Main Catalog Container -->
<div class="py-10 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Toolbar: Results Count & WooCommerce Sorting -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-sm flex flex-col sm:flex-row items-center justify-between gap-4 mb-8">
            <div class="text-xs text-slate-500 font-medium">
                <?php woocommerce_result_count(); ?>
            </div>

            <div class="flex items-center gap-3">
                <div class="text-xs font-bold text-slate-700 uppercase tracking-wider"><?php esc_html_e( 'Sort By:', 'pactiva-energy' ); ?></div>
                <div class="pactiva-ordering-wrapper">
                    <?php woocommerce_catalog_ordering(); ?>
                </div>
            </div>
        </div>

        <!-- Products Loop -->
        <?php if ( woocommerce_product_loop() ) : ?>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <?php
                while ( have_posts() ) :
                    the_post();
                    global $product;
                    pactiva_render_product_card( $product );
                endwhile;
                ?>
            </div>

            <!-- Pagination -->
            <div class="mt-12 flex justify-center">
                <?php woocommerce_pagination(); ?>
            </div>

        <?php else : ?>
            <div class="bg-white rounded-3xl p-12 text-center border border-slate-200 max-w-xl mx-auto">
                <div class="w-16 h-16 rounded-2xl bg-orange-100 text-brand-orange mx-auto flex items-center justify-center mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2"><?php esc_html_e( 'No products found in this category', 'pactiva-energy' ); ?></h3>
                <p class="text-xs text-slate-500 mb-6"><?php esc_html_e( 'Try clearing your filters or search terms, or contact our engineering desk directly.', 'pactiva-energy' ); ?></p>
                <a href="<?php echo esc_url( $shop_page_url ); ?>" class="btn-primary text-xs font-bold">
                    <?php esc_html_e( 'Back to All Products', 'pactiva-energy' ); ?>
                </a>
            </div>
        <?php endif; ?>

    </div>
</div>

<?php
get_footer( 'shop' );
