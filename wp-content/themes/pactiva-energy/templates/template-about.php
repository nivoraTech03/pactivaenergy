<?php
/**
 * Template Name: About Us — Company & Infrastructure
 *
 * @package Pactiva_Energy
 */

defined( 'ABSPATH' ) || exit;

get_header();

$phone   = get_option( 'pactiva_support_phone', '+91 9818280807' );
$email   = get_option( 'pactiva_business_email', 'info@pactivaenergy.com' );
$address = get_option( 'pactiva_corporate_address', 'C-111, Sector -65, NOIDA - 201301' );
?>

<div class="bg-brand-black text-white py-16 lg:py-24 border-b border-white/10 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center max-w-3xl">
        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-black uppercase tracking-wider bg-brand-orange text-white mb-3">
            <?php esc_html_e( 'About PACTIVA Energy Tech India', 'pactiva-energy' ); ?>
        </span>
        <h1 class="text-4xl sm:text-5xl text-slate-200 font-black font-heading tracking-tight">
            Lithium Power. <br>
            <span class="text-brand-orange"><?php esc_html_e( 'Limitless Future.', 'pactiva-energy' ); ?></span>
        </h1>
        <p class="text-sm sm:text-base text-slate-300 mt-4 leading-relaxed font-normal">
            <?php esc_html_e( 'Pactiva Energy Tech India Pvt Ltd is a leading and fast-growing company of Lithium-ion batteries in India. We produce premium batteries for electric vehicles (EVs), Solar Systems, Telecom batteries, wall-mounted inverters & Energy Storage Systems (ESS) under our brand name of “PACTIVA ENERGY & PACTIVA POWER”.', 'pactiva-energy' ); ?>
        </p>
    </div>
</div>

<div class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">
        
        <!-- Company Vision & Mission Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <div class="space-y-4">
                <span class="text-xs font-mono font-bold text-brand-orange uppercase"><?php esc_html_e( 'Mission & Environmental Leadership', 'pactiva-energy' ); ?></span>
                <h2 class="text-2xl sm:text-3xl font-black text-slate-900 font-heading">
                    <?php esc_html_e( 'Leading Environmental Protection with Clean Energy Options', 'pactiva-energy' ); ?>
                </h2>
                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                    <?php esc_html_e( 'Our business is making steady progress toward its goal of a greener environment. With the help of high-efficiency clean energy options, PACTIVA hopes to become a leader in environmental protection, achieve global brand recognition, and most importantly, satisfy every single customer with uncompromised engineering and zero-failure reliability.', 'pactiva-energy' ); ?>
                </p>
                <p class="text-xs text-slate-600 leading-relaxed">
                    <?php esc_html_e( 'From customized electric 2-wheeler and 3-wheeler mobility battery packs to 5.12kWh wall-mounted residential solar powerwalls, hybrid inverters, and high-drain BMS hardware, our solutions power India’s clean energy transition under the dual brand identity of PACTIVA ENERGY & PACTIVA POWER.', 'pactiva-energy' ); ?>
                </p>
            </div>

            <!-- Stats Showcase -->
            <div class="grid grid-cols-2 gap-4 bg-slate-50 p-6 rounded-3xl border border-slate-200">
                <div class="p-4 bg-white rounded-2xl shadow-sm border border-slate-100">
                    <div class="text-3xl font-black text-brand-orange font-heading">100%</div>
                    <div class="text-xs font-bold text-slate-800 mt-1"><?php esc_html_e( 'Grade-A Cells', 'pactiva-energy' ); ?></div>
                    <div class="text-[11px] text-slate-400 mt-0.5"><?php esc_html_e( 'Zero graded B-grade or used cells.', 'pactiva-energy' ); ?></div>
                </div>
                <div class="p-4 bg-white rounded-2xl shadow-sm border border-slate-100">
                    <div class="text-3xl font-black text-slate-900 font-heading">6000+</div>
                    <div class="text-xs font-bold text-slate-800 mt-1"><?php esc_html_e( 'LFP Cycle Life', 'pactiva-energy' ); ?></div>
                    <div class="text-[11px] text-slate-400 mt-0.5"><?php esc_html_e( '10+ year design lifespan.', 'pactiva-energy' ); ?></div>
                </div>
                <div class="p-4 bg-white rounded-2xl shadow-sm border border-slate-100">
                    <div class="text-3xl font-black text-slate-900 font-heading">Pan-India</div>
                    <div class="text-xs font-bold text-slate-800 mt-1"><?php esc_html_e( 'B2B Logistics', 'pactiva-energy' ); ?></div>
                    <div class="text-[11px] text-slate-400 mt-0.5"><?php esc_html_e( 'Insured dangerous goods dispatch.', 'pactiva-energy' ); ?></div>
                </div>
                <div class="p-4 bg-white rounded-2xl shadow-sm border border-slate-100">
                    <div class="text-3xl font-black text-brand-orange font-heading">ISO 9001</div>
                    <div class="text-xs font-bold text-slate-800 mt-1"><?php esc_html_e( 'Quality Standard', 'pactiva-energy' ); ?></div>
                    <div class="text-[11px] text-slate-400 mt-0.5"><?php esc_html_e( 'Standardized testing protocol.', 'pactiva-energy' ); ?></div>
                </div>
            </div>
        </div>

        <!-- Infrastructure & Quality Testing Standards -->
        <div>
            <div class="text-center max-w-2xl mx-auto mb-10">
                <span class="text-xs font-mono font-bold text-brand-orange uppercase"><?php esc_html_e( 'Testing Infrastructure', 'pactiva-energy' ); ?></span>
                <h3 class="text-2xl font-black text-slate-900 font-heading mt-1">
                    <?php esc_html_e( 'Rigorous 4-Stage Verification', 'pactiva-energy' ); ?>
                </h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="p-5 bg-slate-50 rounded-2xl border border-slate-200">
                    <span class="w-8 h-8 rounded-lg bg-orange-100 text-brand-orange font-black flex items-center justify-center text-xs mb-3">01</span>
                    <h4 class="text-sm font-bold text-slate-900"><?php esc_html_e( 'Cell Grading & IR Check', 'pactiva-energy' ); ?></h4>
                    <p class="text-xs text-slate-500 mt-1"><?php esc_html_e( 'Internal resistance measured at 1kHz AC to match cells within +/- 0.05mΩ.', 'pactiva-energy' ); ?></p>
                </div>

                <div class="p-5 bg-slate-50 rounded-2xl border border-slate-200">
                    <span class="w-8 h-8 rounded-lg bg-orange-100 text-brand-orange font-black flex items-center justify-center text-xs mb-3">02</span>
                    <h4 class="text-sm font-bold text-slate-900"><?php esc_html_e( 'Laser Busbar Welding', 'pactiva-energy' ); ?></h4>
                    <p class="text-xs text-slate-500 mt-1"><?php esc_html_e( 'Precision automated laser welding prevents thermal damage to cell seals.', 'pactiva-energy' ); ?></p>
                </div>

                <div class="p-5 bg-slate-50 rounded-2xl border border-slate-200">
                    <span class="w-8 h-8 rounded-lg bg-orange-100 text-brand-orange font-black flex items-center justify-center text-xs mb-3">03</span>
                    <h4 class="text-sm font-bold text-slate-900"><?php esc_html_e( 'Active BMS Balancing', 'pactiva-energy' ); ?></h4>
                    <p class="text-xs text-slate-500 mt-1"><?php esc_html_e( 'Calibrated over-current, over-voltage, and multi-point temperature sensors.', 'pactiva-energy' ); ?></p>
                </div>

                <div class="p-5 bg-slate-50 rounded-2xl border border-slate-200">
                    <span class="w-8 h-8 rounded-lg bg-orange-100 text-brand-orange font-black flex items-center justify-center text-xs mb-3">04</span>
                    <h4 class="text-sm font-bold text-slate-900"><?php esc_html_e( 'Full Load Bank Cycling', 'pactiva-energy' ); ?></h4>
                    <p class="text-xs text-slate-500 mt-1"><?php esc_html_e( '100% full charge/discharge cycle test before packaging and shipping.', 'pactiva-energy' ); ?></p>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Bulk CTA inclusion -->
<?php get_template_part( 'template-parts/sections/bulk-cta' ); ?>

<?php
get_footer();
