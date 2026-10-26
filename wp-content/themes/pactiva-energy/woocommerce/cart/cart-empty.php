<?php
/**
 * PACTIVA ENERGY - Custom Empty Cart Template
 *
 * @package Pactiva_Energy
 */

defined( 'ABSPATH' ) || exit;

$shop_url = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/shop/' );
?>
<div class="py-16 lg:py-24 bg-slate-50 min-h-[70vh] flex items-center justify-center">
    <div class="max-w-xl mx-auto px-4 text-center">
        
        <div class="w-20 h-20 rounded-3xl bg-orange-100 text-brand-orange mx-auto flex items-center justify-center mb-6 shadow-sm">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
            </svg>
        </div>

        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10.5px] font-black uppercase tracking-wider bg-orange-100 text-brand-orange mb-3">
            <?php esc_html_e( 'Quotation Cart', 'pactiva-energy' ); ?>
        </span>

        <h1 class="text-2xl sm:text-3xl font-black font-heading text-slate-950 tracking-tight mb-3">
            <?php esc_html_e( 'Your Hardware Cart is Currently Empty', 'pactiva-energy' ); ?>
        </h1>

        <p class="text-xs sm:text-sm text-slate-500 leading-relaxed max-w-md mx-auto mb-8">
            <?php esc_html_e( 'Explore our certified lithium iron phosphate (LiFePO4) cells, smart active-balancing BMS, modular solar ESS, and EV powertrain battery packs.', 'pactiva-energy' ); ?>
        </p>

        <a href="<?php echo esc_url( $shop_url ); ?>" class="btn-primary text-xs font-bold py-4 px-8 inline-flex items-center gap-2 shadow-xl shadow-orange-500/30">
            <span><?php esc_html_e( 'Explore Hardware Catalog &rarr;', 'pactiva-energy' ); ?></span>
        </a>

    </div>
</div>
