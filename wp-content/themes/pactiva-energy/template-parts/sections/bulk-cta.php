<?php
/**
 * Bulk Order & B2B Inquiry CTA Strip
 *
 * @package Pactiva_Energy
 */

defined( 'ABSPATH' ) || exit;

$wa_url = pactiva_build_whatsapp_general_url( 'B2B Bulk Order Quotation Request' );
?>
<section class="py-16 bg-gradient-to-r from-brand-black via-brand-dark to-slate-900 text-white relative overflow-hidden border-b border-white/10">
    <div class="absolute -right-20 -bottom-20 w-80 h-80 bg-brand-orange/20 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="bg-white/5 border border-white/10 backdrop-blur-md rounded-3xl p-8 sm:p-12 flex flex-col lg:flex-row lg:items-center justify-between gap-8">
            
            <div class="space-y-4 max-w-2xl">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-black uppercase tracking-wider bg-brand-orange text-white">
                    <?php esc_html_e( 'Direct Factory Pricing', 'pactiva-energy' ); ?>
                </span>
                <h2 class="text-3xl sm:text-4xl text-white font-black font-heading tracking-tight leading-tight">
                    <?php esc_html_e( 'Looking for Bulk Lithium Cells, Smart BMS, or Turnkey Battery Packs?', 'pactiva-energy' ); ?>
                </h2>
                <p class="text-sm text-slate-300 leading-relaxed">
                    <?php esc_html_e( 'We supply OEM manufacturers, solar integrators, and battery pack assemblers with consistent cell binning, customized copper busbars, and factory warranty certificates.', 'pactiva-energy' ); ?>
                </p>
            </div>

            <div class="flex flex-col sm:flex-row lg:flex-col gap-3 shrink-0">
                <button type="button" 
                        onclick="pactivaOpenEnquiryModal('Bulk OEM Order Inquiry', 'BULK-RFQ-HERO')"
                        class="btn-primary text-sm font-bold justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    <span><?php esc_html_e( 'Request Volume Quotation', 'pactiva-energy' ); ?></span>
                </button>

                <a href="<?php echo esc_url( $wa_url ); ?>" target="_blank" rel="noopener noreferrer" class="btn-whatsapp text-sm font-bold justify-center">
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                    <span><?php esc_html_e( 'Direct WhatsApp Connect', 'pactiva-energy' ); ?></span>
                </a>
            </div>

        </div>
    </div>
</section>
