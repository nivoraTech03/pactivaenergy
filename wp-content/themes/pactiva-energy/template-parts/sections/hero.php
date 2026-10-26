<?php
/**
 * Hero Banner Section
 *
 * @package Pactiva_Energy
 */

defined( 'ABSPATH' ) || exit;

$shop_url = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/shop/' );
$wa_url   = pactiva_build_whatsapp_general_url( 'Direct Inquiry from Homepage Hero' );
?>
<section class="relative bg-brand-black text-white overflow-hidden py-16 lg:py-24 border-b border-white/10">
    <!-- Background Technical Grid & Glow Effects -->
    <div class="absolute inset-0 opacity-15 pointer-events-none" style="background-image: radial-gradient(#FF8A00 1px, transparent 1px); background-size: 32px 32px;"></div>
    <div class="absolute -top-40 -right-40 w-96 h-96 bg-brand-orange/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-brand-deep/15 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            <!-- Left Headline & CTAs -->
            <div class="lg:col-span-7 space-y-6">
                <!-- High-Voltage Technology Pill -->
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/5 border border-white/10 backdrop-blur-md">
                    <span class="w-2 h-2 rounded-full bg-brand-orange animate-ping"></span>
                    <span class="text-xs font-black uppercase tracking-wider text-orange-400">
                        <?php esc_html_e( 'PACTIVA ENERGY & PACTIVA POWER', 'pactiva-energy' ); ?>
                    </span>
                    <span class="text-white/20">|</span>
                    <span class="text-xs text-slate-300 font-medium">
                        <?php esc_html_e( 'Pactiva Energy Tech India Pvt Ltd', 'pactiva-energy' ); ?>
                    </span>
                </div>

                <!-- Primary Headline -->
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black font-heading tracking-tight leading-tight text-white">
                    Powering Progress. <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-orange via-orange-400 to-amber-300">
                        Energizing Tomorrow.
                    </span>
                </h1>

                <!-- Supporting Description -->
                <p class="text-base sm:text-lg text-slate-300 max-w-2xl leading-relaxed">
                    <?php esc_html_e( 'India’s leading manufacturer of high-performance Lithium-ion batteries for electric vehicles (EVs), solar systems, telecom racks, wall-mounted inverters & Energy Storage Systems (ESS).', 'pactiva-energy' ); ?>
                </p>

                <!-- High-Impact Key Metrics -->
                <div class="grid grid-cols-3 gap-4 pt-2 pb-2 border-t border-b border-white/10 max-w-xl">
                    <div>
                        <div class="text-2xl sm:text-3xl font-black text-brand-orange font-heading">6000+</div>
                        <div class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider"><?php esc_html_e( 'Deep Cycles (LFP)', 'pactiva-energy' ); ?></div>
                    </div>
                    <div>
                        <div class="text-2xl sm:text-3xl font-black text-white font-heading">99.4%</div>
                        <div class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider"><?php esc_html_e( 'BMS Balancing Efficiency', 'pactiva-energy' ); ?></div>
                    </div>
                    <div>
                        <div class="text-2xl sm:text-3xl font-black text-brand-orange font-heading">Pan-India</div>
                        <div class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider"><?php esc_html_e( 'OEM Logistics Network', 'pactiva-energy' ); ?></div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-wrap items-center gap-4 pt-2">
                    <a href="<?php echo esc_url( $shop_url ); ?>" class="btn-primary text-sm font-bold">
                        <span><?php esc_html_e( 'Explore Catalog', 'pactiva-energy' ); ?></span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>

                    <button type="button" 
                            onclick="pactivaOpenEnquiryModal('General Energy Storage Consultation', 'HERO-RFQ')"
                            class="btn-secondary text-sm font-bold">
                        <svg class="w-4 h-4 text-brand-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        <span><?php esc_html_e( 'Request a Quote', 'pactiva-energy' ); ?></span>
                    </button>

                    <a href="<?php echo esc_url( $wa_url ); ?>" target="_blank" rel="noopener noreferrer" class="btn-whatsapp text-sm font-bold">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                        <span><?php esc_html_e( 'WhatsApp RFQ', 'pactiva-energy' ); ?></span>
                    </a>
                </div>
            </div>

            <!-- Right Featured Hardware Graphic / Display Showcase -->
            <div class="lg:col-span-5">
                <div class="relative bg-gradient-to-b from-slate-900 to-brand-charcoal p-8 rounded-3xl border border-white/10 shadow-2xl overflow-hidden group">
                    <!-- Glow Behind Showcase -->
                    <div class="absolute -top-24 -left-24 w-60 h-60 bg-brand-orange/20 rounded-full blur-2xl"></div>

                    <!-- Tech Badge Header -->
                    <div class="flex items-center justify-between pb-4 border-b border-white/10 relative z-10">
                        <div class="flex items-center gap-2">
                            <span class="w-3 h-3 rounded-full bg-emerald-400 animate-pulse"></span>
                            <span class="text-xs font-mono font-bold text-white uppercase tracking-wider">PACTIVA ESS MATRIX</span>
                        </div>
                        <span class="text-[10px] font-mono px-2 py-0.5 rounded bg-brand-orange/20 text-brand-orange border border-brand-orange/30">
                            GEN-4 LFP
                        </span>
                    </div>

                    <!-- Visual Graphic Representation of Battery Pack & BMS -->
                    <div class="my-6 py-6 text-center relative z-10">
                        <div class="inline-block p-6 bg-slate-950/80 rounded-2xl border border-white/10 shadow-inner group-hover:scale-105 transition-transform duration-500">
                            <div class="flex items-center justify-center gap-3 mb-4">
                                <div class="w-12 h-20 bg-gradient-to-t from-orange-600 to-brand-orange rounded-lg border border-white/20 flex flex-col justify-between p-1.5 text-center shadow-lg">
                                    <div class="w-3 h-1 bg-white mx-auto rounded-full"></div>
                                    <span class="text-[9px] font-mono font-bold text-white leading-none">3.2V</span>
                                </div>
                                <div class="w-12 h-20 bg-gradient-to-t from-orange-600 to-brand-orange rounded-lg border border-white/20 flex flex-col justify-between p-1.5 text-center shadow-lg">
                                    <div class="w-3 h-1 bg-white mx-auto rounded-full"></div>
                                    <span class="text-[9px] font-mono font-bold text-white leading-none">3.2V</span>
                                </div>
                                <div class="w-12 h-20 bg-gradient-to-t from-orange-600 to-brand-orange rounded-lg border border-white/20 flex flex-col justify-between p-1.5 text-center shadow-lg">
                                    <div class="w-3 h-1 bg-white mx-auto rounded-full"></div>
                                    <span class="text-[9px] font-mono font-bold text-white leading-none">3.2V</span>
                                </div>
                                <div class="w-12 h-20 bg-gradient-to-t from-orange-600 to-brand-orange rounded-lg border border-white/20 flex flex-col justify-between p-1.5 text-center shadow-lg">
                                    <div class="w-3 h-1 bg-white mx-auto rounded-full"></div>
                                    <span class="text-[9px] font-mono font-bold text-white leading-none">3.2V</span>
                                </div>
                            </div>
                            <span class="text-xs font-mono text-slate-300 font-bold">16S 48V 100Ah High-Current ESS Pack</span>
                        </div>
                    </div>

                    <!-- Live Telemetry / Spec Points -->
                    <div class="grid grid-cols-2 gap-3 text-xs text-slate-300 relative z-10">
                        <div class="p-3 bg-white/5 rounded-xl border border-white/5">
                            <div class="text-[10px] text-slate-400 uppercase tracking-wider">CAN / RS485</div>
                            <div class="font-bold text-white mt-0.5">Smart BMS Active Balancer</div>
                        </div>
                        <div class="p-3 bg-white/5 rounded-xl border border-white/5">
                            <div class="text-[10px] text-slate-400 uppercase tracking-wider">Continuous Output</div>
                            <div class="font-bold text-white mt-0.5">150A Peak Discharge</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
