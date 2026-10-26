<?php
/**
 * FAQs Section with Interactive Toggles
 *
 * @package Pactiva_Energy
 */

defined( 'ABSPATH' ) || exit;

$faqs = array(
    array(
        'q' => __( 'What battery chemistries does PACTIVA ENERGY specialize in?', 'pactiva-energy' ),
        'a' => __( 'PACTIVA specializes in Lithium Iron Phosphate (LiFePO4 / LFP) for superior cycle life (4000-6000 cycles) and maximum thermal safety, as well as Nickel Manganese Cobalt (NMC) for ultra-compact, high-energy-density EV mobility packs.', 'pactiva-energy' ),
    ),
    array(
        'q' => __( 'Are your battery packs and BMS compatible with leading hybrid inverters?', 'pactiva-energy' ),
        'a' => __( 'Yes. Our smart BMS hardware supports pre-configured CAN-Bus and RS485 communication protocols compatible with major global and Indian inverters including Deye, Growatt, GoodWe, Solis, Victron, and Schneider.', 'pactiva-energy' ),
    ),
    array(
        'q' => __( 'Can PACTIVA customize battery packs for electric 2W/3W OEMs?', 'pactiva-energy' ),
        'a' => __( 'Absolutely. We offer complete turnkey OEM services including custom prismatic or cylindrical cell configuration, internal copper laser-welded busbars, precision sheet metal or aluminium IP67 enclosures, and custom firmware parameterization.', 'pactiva-energy' ),
    ),
    array(
        'q' => __( 'How does the WhatsApp and B2B Quotation workflow function?', 'pactiva-energy' ),
        'a' => __( 'Because industrial battery and BMS configurations often require specific voltage ratings, discharge C-rates, and volume tiered pricing, clicking "WhatsApp" or "Get Quote" allows our engineering desk to review your exact technical requirements and provide competitive wholesale pricing within hours.', 'pactiva-energy' ),
    ),
    array(
        'q' => __( 'How are products dispatched across India?', 'pactiva-energy' ),
        'a' => __( 'All lithium products are classified as Class 9 hazardous goods for transport. We work with certified hazardous material (Hazmat) logistics partners providing insured surface transport with door-to-door tracking across all Indian states and union territories.', 'pactiva-energy' ),
    ),
);
?>
<section class="py-16 bg-slate-50 border-b border-slate-200/80">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center mb-12">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-black uppercase tracking-wider bg-orange-100 text-brand-orange mb-2">
                <?php esc_html_e( 'Technical Clarifications', 'pactiva-energy' ); ?>
            </span>
            <h2 class="text-3xl font-black font-heading text-slate-950 tracking-tight">
                <?php esc_html_e( 'Frequently Asked Questions', 'pactiva-energy' ); ?>
            </h2>
            <p class="text-sm text-slate-500 mt-2">
                <?php esc_html_e( 'Common questions regarding battery specifications, custom pack assembly, and order fulfillment.', 'pactiva-energy' ); ?>
            </p>
        </div>

        <div class="space-y-3">
            <?php foreach ( $faqs as $i => $faq ) : ?>
                <details class="group bg-white rounded-2xl border border-slate-200/80 p-5 shadow-sm transition-all duration-200 [&_summary::-webkit-details-marker]:hidden">
                    <summary class="flex items-center justify-between cursor-pointer font-bold text-slate-900 text-sm select-none gap-4">
                        <span><?php echo esc_html( $faq['q'] ); ?></span>
                        <span class="w-6 h-6 rounded-full bg-slate-100 group-open:bg-brand-orange group-open:text-white flex items-center justify-center shrink-0 text-slate-500 transition-colors">
                            <svg class="w-3.5 h-3.5 group-open:rotate-180 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
                        </span>
                    </summary>
                    <p class="text-xs text-slate-600 leading-relaxed mt-3 pt-3 border-t border-slate-100">
                        <?php echo esc_html( $faq['a'] ); ?>
                    </p>
                </details>
            <?php endforeach; ?>
        </div>

    </div>
</section>
