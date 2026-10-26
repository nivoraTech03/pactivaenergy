<?php
/**
 * Template Name: Bulk Order & B2B Quotation
 *
 * @package Pactiva_Energy
 */

defined( 'ABSPATH' ) || exit;

get_header();

$wa_url = pactiva_build_whatsapp_general_url( 'B2B Bulk Volume Procurement RFP' );
?>

<div class="bg-brand-black text-white py-16 lg:py-24 border-b border-white/10 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center max-w-3xl">
        <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full text-[11px] font-black uppercase tracking-wider bg-brand-orange text-white mb-3 shadow-md shadow-orange-500/20">
            <?php esc_html_e( 'B2B Wholesale Procurement', 'pactiva-energy' ); ?>
        </span>
        <h1 class="text-4xl text-slate-200 sm:text-5xl font-black font-heading tracking-tight">
            <?php esc_html_e( 'Direct Factory Bulk Supply & RFQ', 'pactiva-energy' ); ?>
        </h1>
        <p class="text-sm text-slate-300 mt-3 max-w-xl mx-auto leading-relaxed">
            <?php esc_html_e( 'Tier-1 pricing, matched cell batches, and custom pack manufacturing for assemblers, EPC contractors, and automotive OEMs.', 'pactiva-energy' ); ?>
        </p>
    </div>
</div>

<div class="py-16 bg-slate-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="bg-white p-8 sm:p-12 rounded-3xl border border-slate-200/80 shadow-card">
            <div class="border-b border-slate-100 pb-6 mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <span class="text-[11px] font-mono font-bold text-brand-orange uppercase tracking-wider block mb-1"><?php esc_html_e( 'Commercial Volume Desk', 'pactiva-energy' ); ?></span>
                    <h2 class="text-2xl font-black text-slate-950 font-heading tracking-tight">
                        <?php esc_html_e( 'Request for Quotation (RFQ)', 'pactiva-energy' ); ?>
                    </h2>
                    <p class="text-xs text-slate-500 mt-1">
                        <?php esc_html_e( 'Our B2B corporate sales desk handles requests from 50 units to full container loads (FCL).', 'pactiva-energy' ); ?>
                    </p>
                </div>
                <div class="flex items-center gap-2 px-3 py-1.5 bg-orange-50 text-brand-orange border border-orange-200/60 rounded-xl text-xs font-bold shrink-0">
                    <span class="w-2 h-2 rounded-full bg-brand-orange animate-ping"></span>
                    <span><?php esc_html_e( 'Avg Response: &lt; 4 Hours', 'pactiva-energy' ); ?></span>
                </div>
            </div>

            <div id="bulk-page-status" class="hidden mb-6 p-4 rounded-2xl text-xs font-bold"></div>

            <form onsubmit="pactivaSubmitBulkForm(event, this);" class="space-y-5 text-xs">
                <!-- Anti-spam Honeypot -->
                <div class="hidden" aria-hidden="true">
                    <input type="text" name="pactiva_hp_website" tabindex="-1" autocomplete="off">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="flex items-center gap-1.5 font-bold text-slate-700 mb-1.5">
                            <svg class="w-3.5 h-3.5 text-brand-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            <span><?php esc_html_e( 'Authorized Person Name *', 'pactiva-energy' ); ?></span>
                        </label>
                        <input type="text" name="name" required class="pactiva-input" placeholder="e.g. Rajesh Kumar">
                    </div>
                    <div>
                        <label class="flex items-center gap-1.5 font-bold text-slate-700 mb-1.5">
                            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            <span><?php esc_html_e( 'Registered Company / OEM Name *', 'pactiva-energy' ); ?></span>
                        </label>
                        <input type="text" name="company" required class="pactiva-input" placeholder="e.g. Apex EV Powertrains Ltd">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="flex items-center gap-1.5 font-bold text-slate-700 mb-1.5">
                            <svg class="w-3.5 h-3.5 text-brand-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            <span><?php esc_html_e( 'Corporate Email *', 'pactiva-energy' ); ?></span>
                        </label>
                        <input type="email" name="email" required class="pactiva-input" placeholder="procurement@apexev.com">
                    </div>
                    <div>
                        <label class="flex items-center gap-1.5 font-bold text-slate-700 mb-1.5">
                            <svg class="w-3.5 h-3.5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            <span><?php esc_html_e( 'Phone / Direct WhatsApp *', 'pactiva-energy' ); ?></span>
                        </label>
                        <input type="tel" name="phone" required class="pactiva-input" placeholder="+91 98220 11223">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="flex items-center gap-1.5 font-bold text-slate-700 mb-1.5">
                            <svg class="w-3.5 h-3.5 text-brand-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                            <span><?php esc_html_e( 'Product Category *', 'pactiva-energy' ); ?></span>
                        </label>
                        <select name="product_name" class="pactiva-select">
                            <option value="Prismatic LFP Cells (100Ah - 280Ah)">Prismatic LFP Cells (EVE / CATL)</option>
                            <option value="Cylindrical Cells (21700 / 32700)">Cylindrical Cells (32700 / 21700)</option>
                            <option value="Smart BMS Hardware (DALY / JK)">Smart BMS Hardware (DALY / JK)</option>
                            <option value="Complete EV Battery Packs">Complete EV Battery Packs (48V-72V)</option>
                            <option value="Solar ESS Powerwalls">Solar ESS Powerwalls (5.12kWh - 10kWh)</option>
                            <option value="Hybrid Solar Inverters">Hybrid Solar Inverters (3kW - 10kW)</option>
                        </select>
                    </div>

                    <div>
                        <label class="flex items-center gap-1.5 font-bold text-slate-700 mb-1.5">
                            <svg class="w-3.5 h-3.5 text-brand-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                            <span><?php esc_html_e( 'Expected Volume (Units) *', 'pactiva-energy' ); ?></span>
                        </label>
                        <input type="number" name="quantity" min="10" value="50" required class="pactiva-input">
                    </div>

                    <div>
                        <label class="flex items-center gap-1.5 font-bold text-slate-700 mb-1.5">
                            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            <span><?php esc_html_e( 'GSTIN (Optional)', 'pactiva-energy' ); ?></span>
                        </label>
                        <input type="text" name="product_sku" class="pactiva-input" placeholder="07AAAAA0000A1Z5">
                    </div>
                </div>

                <div>
                    <label class="flex items-center gap-1.5 font-bold text-slate-700 mb-1.5">
                        <svg class="w-3.5 h-3.5 text-brand-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        <span><?php esc_html_e( 'Custom Technical Requirements & Delivery City/Pincode *', 'pactiva-energy' ); ?></span>
                    </label>
                    <textarea name="message" rows="4" required class="pactiva-textarea" placeholder="Mention cell voltage, nominal capacity, discharge C-rate, continuous current, communication protocol (CAN/RS485), and city/pincode for freight calculation..."></textarea>
                </div>

                <div class="flex flex-col sm:flex-row items-center gap-4 pt-3">
                    <button type="submit" class="btn-primary text-xs font-bold py-3.5 px-8 w-full sm:w-auto shadow-lg shadow-orange-500/25">
                        <span><?php esc_html_e( 'Submit Wholesale Quotation Request', 'pactiva-energy' ); ?></span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </button>
                    <a href="<?php echo esc_url( $wa_url ); ?>" target="_blank" rel="noopener noreferrer" class="btn-whatsapp text-xs font-bold py-3.5 px-6 w-full sm:w-auto justify-center">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                        <span><?php esc_html_e( 'Discuss Directly on WhatsApp', 'pactiva-energy' ); ?></span>
                    </a>
                </div>
            </form>
        </div>

    </div>
</div>

<script>
function pactivaSubmitBulkForm(e, form) {
    e.preventDefault();
    const btn = form.querySelector('button[type="submit"]');
    const statusBox = document.getElementById('bulk-page-status');
    const orig = btn.innerHTML;

    btn.disabled = true;
    btn.innerHTML = `
        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline-block" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path></svg>
        Submitting Volume RFQ...
    `;

    const formData = new FormData(form);
    formData.append('action', 'pactiva_submit_enquiry');
    formData.append('security', pactivaData.nonce);

    fetch(pactivaData.ajaxUrl, {
        method: 'POST',
        body: formData
    })
    .then(r => r.json())
    .then(data => {
        btn.disabled = false;
        btn.innerHTML = orig;
        statusBox.classList.remove('hidden');
        if (data.success) {
            statusBox.className = 'mb-6 p-4 rounded-2xl text-xs font-bold bg-emerald-50 text-emerald-800 border border-emerald-200';
            statusBox.innerHTML = data.data.message;
            form.reset();
        } else {
            statusBox.className = 'mb-6 p-4 rounded-2xl text-xs font-bold bg-red-50 text-red-800 border border-red-200';
            statusBox.innerHTML = data.data.message || 'Error occurred.';
        }
    })
    .catch(() => {
        btn.disabled = false;
        btn.innerHTML = orig;
        statusBox.classList.remove('hidden');
        statusBox.className = 'mb-6 p-4 rounded-2xl text-xs font-bold bg-red-50 text-red-800 border border-red-200';
        statusBox.innerHTML = 'Transmission failed. Please connect via WhatsApp.';
    });
}
</script>

<?php
get_footer();
