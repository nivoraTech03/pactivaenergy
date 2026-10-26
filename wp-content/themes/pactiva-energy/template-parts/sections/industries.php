<?php
/**
 * Application Industries Section
 *
 * @package Pactiva_Energy
 */

defined( 'ABSPATH' ) || exit;
?>
<section class="py-16 bg-white border-b border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-3xl mx-auto mb-12">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-black uppercase tracking-wider bg-orange-100 text-brand-orange mb-2">
                <?php esc_html_e( 'B2B Sectors & Applications', 'pactiva-energy' ); ?>
            </span>
            <h2 class="text-3xl sm:text-4xl font-black font-heading text-slate-950 tracking-tight">
                <?php esc_html_e( 'Industries Powered by PACTIVA', 'pactiva-energy' ); ?>
            </h2>
            <p class="text-sm text-slate-500 mt-2">
                <?php esc_html_e( 'Providing mission-critical lithium energy architecture across diversified commercial and industrial domains.', 'pactiva-energy' ); ?>
            </p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
            <!-- 1. Electric Vehicles -->
            <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 text-center flex flex-col items-center">
                <div class="w-12 h-12 rounded-xl bg-orange-100 text-brand-orange flex items-center justify-center mb-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
                <h3 class="text-xs font-bold text-slate-900"><?php esc_html_e( 'Electric Mobility', 'pactiva-energy' ); ?></h3>
                <p class="text-[11px] text-slate-500 mt-1"><?php esc_html_e( '2W, 3W, E-Rickshaws & Commercial EV Fleets', 'pactiva-energy' ); ?></p>
            </div>

            <!-- 2. Solar & Microgrids -->
            <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 text-center flex flex-col items-center">
                <div class="w-12 h-12 rounded-xl bg-amber-100 text-amber-600 flex items-center justify-center mb-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                </div>
                <h3 class="text-xs font-bold text-slate-900"><?php esc_html_e( 'Solar Microgrids', 'pactiva-energy' ); ?></h3>
                <p class="text-[11px] text-slate-500 mt-1"><?php esc_html_e( 'Rooftop Solar, Hybrid Inverters & ESS', 'pactiva-energy' ); ?></p>
            </div>

            <!-- 3. Telecom Towers -->
            <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 text-center flex flex-col items-center">
                <div class="w-12 h-12 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center mb-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0"/></svg>
                </div>
                <h3 class="text-xs font-bold text-slate-900"><?php esc_html_e( 'Telecom Towers', 'pactiva-energy' ); ?></h3>
                <p class="text-[11px] text-slate-500 mt-1"><?php esc_html_e( '48V Deep-Cycle Rack Modules', 'pactiva-energy' ); ?></p>
            </div>

            <!-- 4. Industrial Robotics -->
            <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 text-center flex flex-col items-center">
                <div class="w-12 h-12 rounded-xl bg-purple-100 text-purple-600 flex items-center justify-center mb-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/></svg>
                </div>
                <h3 class="text-xs font-bold text-slate-900"><?php esc_html_e( 'Warehouse Robotics', 'pactiva-energy' ); ?></h3>
                <p class="text-[11px] text-slate-500 mt-1"><?php esc_html_e( 'Forklifts, AGVs & Material Handling', 'pactiva-energy' ); ?></p>
            </div>

            <!-- 5. Commercial ESS -->
            <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 text-center flex flex-col items-center col-span-2 md:col-span-1">
                <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center mb-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                </div>
                <h3 class="text-xs font-bold text-slate-900"><?php esc_html_e( 'Commercial Backup', 'pactiva-energy' ); ?></h3>
                <p class="text-[11px] text-slate-500 mt-1"><?php esc_html_e( 'Data Centers, Hospitals & Factories', 'pactiva-energy' ); ?></p>
            </div>
        </div>

    </div>
</section>
