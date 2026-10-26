<?php
/**
 * EV Battery Solutions Section
 *
 * @package Pactiva_Energy
 */

defined( 'ABSPATH' ) || exit;

$wa_url = pactiva_build_whatsapp_general_url( 'Inquiry for Electric Vehicle (EV) Battery Packs' );
?>
<section class="py-16 bg-slate-900 text-white relative overflow-hidden">
    <div class="absolute inset-0 opacity-10 pointer-events-none" style="background-image: radial-gradient(#FF8A00 1px, transparent 1px); background-size: 24px 24px;"></div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            <div class="lg:col-span-6 space-y-6">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-black uppercase tracking-wider bg-orange-500/20 text-brand-orange border border-orange-500/30">
                    <?php esc_html_e( 'Electric Mobility Engineering', 'pactiva-energy' ); ?>
                </span>
                
                <h2 class="text-3xl sm:text-4xl font-black font-heading tracking-tight leading-tight">
                    High-Performance <br>
                    <span class="text-brand-orange"><?php esc_html_e( 'EV Battery Pack Solutions', 'pactiva-energy' ); ?></span>
                </h2>

                <p class="text-sm text-slate-300 leading-relaxed">
                    <?php esc_html_e( 'Engineered for India’s extreme operating temperatures and road conditions. PACTIVA manufactures high-drain, thermally stabilized LiFePO4 & NMC battery packs for electric 2-wheelers, e-rickshaws, and custom industrial powertrains.', 'pactiva-energy' ); ?>
                </p>

                <!-- EV Tech Checklist -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                    <div class="flex items-start gap-3">
                        <div class="w-6 h-6 rounded-full bg-brand-orange/20 text-brand-orange flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <div>
                            <h4 class="text-xs font-bold text-white"><?php esc_html_e( 'AIS-156 Phase 2 Ready', 'pactiva-energy' ); ?></h4>
                            <p class="text-[11px] text-slate-400"><?php esc_html_e( 'Compliant enclosure, thermal runaway protection.', 'pactiva-energy' ); ?></p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="w-6 h-6 rounded-full bg-brand-orange/20 text-brand-orange flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <div>
                            <h4 class="text-xs font-bold text-white"><?php esc_html_e( 'CAN-Bus Telemetry', 'pactiva-energy' ); ?></h4>
                            <p class="text-[11px] text-slate-400"><?php esc_html_e( 'Real-time SoC, SoH & cell temperature data.', 'pactiva-energy' ); ?></p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="w-6 h-6 rounded-full bg-brand-orange/20 text-brand-orange flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <div>
                            <h4 class="text-xs font-bold text-white"><?php esc_html_e( 'High-Discharge C-Rating', 'pactiva-energy' ); ?></h4>
                            <p class="text-[11px] text-slate-400"><?php esc_html_e( 'Instant torque for uphill gradients & heavy loads.', 'pactiva-energy' ); ?></p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="w-6 h-6 rounded-full bg-brand-orange/20 text-brand-orange flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <div>
                            <h4 class="text-xs font-bold text-white"><?php esc_html_e( 'IP67 Waterproof Casing', 'pactiva-energy' ); ?></h4>
                            <p class="text-[11px] text-slate-400"><?php esc_html_e( 'Laser-welded busbars and vibration-damped framing.', 'pactiva-energy' ); ?></p>
                        </div>
                    </div>
                </div>

                <div class="pt-4 flex items-center gap-4">
                    <button type="button" 
                            onclick="pactivaOpenEnquiryModal('Custom EV Battery Pack (48V / 60V / 72V)', 'EV-PACK-CUSTOM')"
                            class="btn-primary text-xs font-bold">
                        <span><?php esc_html_e( 'Request EV Pack Specs', 'pactiva-energy' ); ?></span>
                    </button>
                    <a href="<?php echo esc_url( $wa_url ); ?>" target="_blank" rel="noopener noreferrer" class="text-xs font-bold text-emerald-400 hover:text-emerald-300 flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        <?php esc_html_e( 'Consult EV Engineer on WhatsApp', 'pactiva-energy' ); ?>
                    </a>
                </div>
            </div>

            <!-- Right Showcase Grid of EV Platforms (100% Dynamic WooCommerce Products) -->
            <div class="lg:col-span-6 grid grid-cols-1 sm:grid-cols-2 gap-4">
                <?php 
                // Fetch dynamic products from EV categories
                $ev_products = function_exists( 'wc_get_products' ) ? wc_get_products( array(
                    'category' => array( 'ev-battery-solutions', '2-wheeler-packs', '3-wheeler-commercial-packs' ),
                    'limit'    => 4,
                    'status'   => 'publish',
                ) ) : array();

                if ( empty( $ev_products ) && function_exists( 'wc_get_products' ) ) {
                    $ev_products = wc_get_products( array( 'limit' => 4, 'status' => 'publish' ) );
                }

                if ( ! empty( $ev_products ) ) :
                    foreach ( $ev_products as $ev_prod ) :
                        $ev_data = pactiva_get_product_card_data( $ev_prod );
                        if ( ! $ev_data ) continue;
                ?>
                    <div class="bg-slate-800/90 hover:bg-slate-800 p-5 rounded-2xl border border-white/10 hover:border-brand-orange/50 transition-all flex flex-col justify-between group">
                        <div>
                            <div class="flex items-center justify-between mb-2.5">
                                <span class="text-[10px] font-mono text-brand-orange font-bold uppercase tracking-wider">
                                    <?php echo esc_html( $ev_data['sku'] ); ?>
                                </span>
                                <span class="text-[10px] font-medium text-emerald-400 bg-emerald-500/10 px-2 py-0.5 rounded-full border border-emerald-500/20">
                                    <?php echo $ev_data['is_in_stock'] ? esc_html__( 'In Stock', 'pactiva-energy' ) : esc_html__( 'Custom Build', 'pactiva-energy' ); ?>
                                </span>
                            </div>

                            <?php if ( ! empty( $ev_data['image_url'] ) ) : ?>
                                <div class="w-full h-24 mb-3 flex items-center justify-center bg-slate-900/60 rounded-xl overflow-hidden p-2">
                                    <img src="<?php echo esc_url( $ev_data['image_url'] ); ?>" alt="<?php echo esc_attr( $ev_data['name'] ); ?>" class="max-h-full max-w-full object-contain group-hover:scale-105 transition-transform duration-300">
                                </div>
                            <?php endif; ?>

                            <h3 class="text-sm font-bold text-white group-hover:text-brand-orange transition-colors line-clamp-2 mb-2 leading-snug">
                                <a href="<?php echo esc_url( $ev_data['permalink'] ); ?>">
                                    <?php echo esc_html( $ev_data['name'] ); ?>
                                </a>
                            </h3>

                            <div class="text-sm font-black text-white font-heading mb-4">
                                <?php echo ! empty( $ev_data['price_html'] ) ? wp_kses_post( $ev_data['price_html'] ) : esc_html__( 'Quotation Basis', 'pactiva-energy' ); ?>
                            </div>
                        </div>

                        <div class="pt-3 border-t border-white/10 flex items-center justify-between gap-2">
                            <a href="<?php echo esc_url( $ev_data['wa_url'] ); ?>" target="_blank" rel="noopener noreferrer" class="text-xs font-bold text-[#25D366] hover:text-[#20BD5A] flex items-center gap-1">
                                <span>WhatsApp &rarr;</span>
                            </a>
                            <a href="<?php echo esc_url( $ev_data['permalink'] ); ?>" class="text-xs font-bold text-brand-orange hover:underline">
                                <?php esc_html_e( 'View Details', 'pactiva-energy' ); ?>
                            </a>
                        </div>
                    </div>
                <?php 
                    endforeach;
                endif; 
                ?>
            </div>

        </div>
    </div>
</section>

