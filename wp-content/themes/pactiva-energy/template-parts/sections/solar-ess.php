<?php
/**
 * Solar & ESS Solutions Section
 *
 * @package Pactiva_Energy
 */

defined( 'ABSPATH' ) || exit;
?>
<section class="py-16 bg-white border-b border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-3xl mx-auto mb-14">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-black uppercase tracking-wider bg-orange-100 text-brand-orange mb-2">
                <?php esc_html_e( 'Renewable Storage & Inverters', 'pactiva-energy' ); ?>
            </span>
            <h2 class="text-3xl sm:text-4xl font-black font-heading text-slate-950 tracking-tight">
                <?php esc_html_e( 'Solar Energy Storage & Wall-Mounted Systems', 'pactiva-energy' ); ?>
            </h2>
            <p class="text-sm text-slate-500 mt-2">
                <?php esc_html_e( 'Seamless integration between solar PV arrays, hybrid inverters, and high-capacity LiFePO4 battery banks. Eliminate diesel generator reliance.', 'pactiva-energy' ); ?>
            </p>
        </div>

        <?php
        // Dynamically fetch products from Solar, ESS and Inverter categories
        $ess_products = function_exists( 'wc_get_products' ) ? wc_get_products( array(
            'category' => array( 'solar-ess-systems', 'wall-mounted-inverters', 'wall-mounted-powerwalls', 'server-rack-modules' ),
            'limit'    => 3,
            'status'   => 'publish',
        ) ) : array();

        if ( empty( $ess_products ) && function_exists( 'wc_get_products' ) ) {
            $ess_products = wc_get_products( array( 'limit' => 3, 'status' => 'publish' ) );
        }
        ?>

        <?php if ( ! empty( $ess_products ) ) : ?>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <?php foreach ( $ess_products as $prod ) : ?>
                    <?php pactiva_render_product_card( $prod ); ?>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <div class="text-center py-8 text-slate-400 text-xs">
                <?php esc_html_e( 'Products will appear automatically when imported into Solar & ESS categories.', 'pactiva-energy' ); ?>
            </div>
        <?php endif; ?>

    </div>
</section>

