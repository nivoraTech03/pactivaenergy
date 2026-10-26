<?php
/**
 * Template Name: Contact Us & Corporate Inquiries
 *
 * @package Pactiva_Energy
 */

defined( 'ABSPATH' ) || exit;

get_header();

$phone          = get_option( 'pactiva_support_phone', '+91 9818280807' );
$email_info     = get_option( 'pactiva_business_email', 'info@pactivaenergy.com' );
$email_direct   = get_option( 'pactiva_direct_email', 'shivanshu@pactivaenergy.com' );
$email_sales    = get_option( 'pactiva_enquiry_recipient_email', 'sales1@pactivaenergy.com' );
$address        = get_option( 'pactiva_corporate_address', 'C-111, Sector -65, NOIDA - 201301' );
$contact_person = get_option( 'pactiva_contact_person', 'Hanshika (PACTIVA ENERGY)' );
$wa_url         = pactiva_build_whatsapp_general_url( 'Inquiry from Contact Page' );
?>

<div class="bg-brand-black text-white py-16 lg:py-20 border-b border-white/10 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center max-w-3xl">
        <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full text-[11px] font-black uppercase tracking-wider bg-brand-orange text-white mb-3 shadow-md shadow-orange-500/20">
            <?php esc_html_e( 'Direct Manufacturer Support', 'pactiva-energy' ); ?>
        </span>
        <h1 class="text-4xl sm:text-5xl font-black font-heading tracking-tight text-slate-200">
            <?php esc_html_e( 'Contact PACTIVA Energy', 'pactiva-energy' ); ?>
        </h1>
        <p class="text-sm text-slate-300 mt-3 max-w-xl mx-auto leading-relaxed">
            <?php esc_html_e( 'Speak directly with our technical team regarding bulk cell procurement, custom EV battery architecture, or solar ESS installations.', 'pactiva-energy' ); ?>
        </p>
    </div>
</div>

<div class="py-16 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
            
            <!-- Left Contact Info Cards -->
            <div class="lg:col-span-5 space-y-5">
                <!-- Card 1: WhatsApp Immediate Response -->
                <div class="bg-white p-6 rounded-3xl border border-slate-200/80 shadow-card hover:shadow-card-hover transition-all duration-300 flex items-start gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 shadow-sm">
                        <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-slate-900"><?php esc_html_e( 'Instant WhatsApp Support', 'pactiva-energy' ); ?></h3>
                        <p class="text-xs text-slate-500 mt-1"><?php esc_html_e( 'Direct line to technical sales engineers. Fast answers on pricing & specs.', 'pactiva-energy' ); ?></p>
                        <a href="<?php echo esc_url( $wa_url ); ?>" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 text-xs font-bold text-emerald-600 hover:text-emerald-700 mt-2.5">
                            <span><?php esc_html_e( 'Open WhatsApp Chat', 'pactiva-energy' ); ?></span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                    </div>
                </div>

                <!-- Card 2: Phone Calling -->
                <div class="bg-white p-6 rounded-3xl border border-slate-200/80 shadow-card hover:shadow-card-hover transition-all duration-300 flex items-start gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-orange-50 text-brand-orange flex items-center justify-center shrink-0 shadow-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-slate-900"><?php esc_html_e( 'Telephone Calling Desk', 'pactiva-energy' ); ?></h3>
                        <p class="text-xs text-slate-500 mt-1"><?php esc_html_e( 'Mon - Sat: 9:30 AM to 6:30 PM IST', 'pactiva-energy' ); ?></p>
                        <a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $phone ) ); ?>" class="text-xs font-bold text-brand-orange hover:underline mt-2 block">
                            <?php echo esc_html( $phone ); ?>
                        </a>
                    </div>
                </div>

                <!-- Card 3: Key Official Representative -->
                <div class="bg-white p-6 rounded-3xl border border-slate-200/80 shadow-card hover:shadow-card-hover transition-all duration-300 flex items-start gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center shrink-0 shadow-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-slate-900"><?php esc_html_e( 'Authorized Contact Desk', 'pactiva-energy' ); ?></h3>
                        <p class="text-xs text-brand-orange font-bold mt-1"><?php echo esc_html( $contact_person ); ?></p>
                        <p class="text-[11px] text-slate-500 mt-0.5"><?php esc_html_e( 'PACTIVA ENERGY TECH INDIA PVT LTD', 'pactiva-energy' ); ?></p>
                        <a href="mailto:<?php echo esc_attr( $email_direct ); ?>" class="text-xs text-slate-700 font-semibold hover:text-brand-orange mt-2 inline-flex items-center gap-1.5 transition-colors">
                            <svg class="w-3.5 h-3.5 text-brand-orange shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            <span><?php echo esc_html( $email_direct ); ?></span>
                        </a>
                    </div>
                </div>

                <!-- Card 4: Corporate HQ -->
                <div class="bg-white p-6 rounded-3xl border border-slate-200/80 shadow-card hover:shadow-card-hover transition-all duration-300 flex items-start gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-slate-100 text-slate-800 flex items-center justify-center shrink-0 shadow-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-slate-900"><?php esc_html_e( 'Corporate & Factory Location', 'pactiva-energy' ); ?></h3>
                        <p class="text-xs text-slate-500 mt-1 leading-relaxed"><?php echo esc_html( $address ); ?></p>
                        <div class="mt-2.5 pt-2 border-t border-slate-100 space-y-1.5 text-xs text-slate-600">
                            <p class="flex items-center gap-1.5">
                                <span class="font-bold text-slate-800"><?php esc_html_e( 'General:', 'pactiva-energy' ); ?></span>
                                <a href="mailto:<?php echo esc_attr( $email_info ); ?>" class="text-brand-orange hover:underline"><?php echo esc_html( $email_info ); ?></a>
                            </p>
                            <p class="flex items-center gap-1.5">
                                <span class="font-bold text-slate-800"><?php esc_html_e( 'Sales & RFQ:', 'pactiva-energy' ); ?></span>
                                <a href="mailto:<?php echo esc_attr( $email_sales ); ?>" class="text-brand-orange hover:underline"><?php echo esc_html( $email_sales ); ?></a>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Card 5: Regional Supply & Local Hubs -->
                <div class="bg-white p-6 rounded-3xl border border-slate-200/80 shadow-card hover:shadow-card-hover transition-all duration-300 flex items-start gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-orange-50 text-brand-orange flex items-center justify-center shrink-0 shadow-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-slate-900"><?php esc_html_e( 'Direct B2B Supply Corridors', 'pactiva-energy' ); ?></h3>
                        <p class="text-xs text-slate-500 mt-1"><?php esc_html_e( 'Direct factory logistics with 24-48h dispatch to key commercial & industrial hubs:', 'pactiva-energy' ); ?></p>
                        <div class="flex flex-wrap gap-1.5 mt-2.5">
                            <span class="px-2 py-0.5 rounded text-[11px] font-bold bg-orange-50 text-brand-orange border border-orange-200">Delhi NCR</span>
                            <span class="px-2 py-0.5 rounded text-[11px] font-medium bg-slate-100 text-slate-700">Delhi</span>
                            <span class="px-2 py-0.5 rounded text-[11px] font-medium bg-slate-100 text-slate-700">Faridabad</span>
                            <span class="px-2 py-0.5 rounded text-[11px] font-medium bg-slate-100 text-slate-700">Haryana</span>
                            <span class="px-2 py-0.5 rounded text-[11px] font-medium bg-slate-100 text-slate-700">Gurugram</span>
                            <span class="px-2 py-0.5 rounded text-[11px] font-medium bg-slate-100 text-slate-700">Mathura</span>
                            <span class="px-2 py-0.5 rounded text-[11px] font-medium bg-slate-100 text-slate-700">Indore</span>
                            <span class="px-2 py-0.5 rounded text-[11px] font-medium bg-slate-100 text-slate-700">Bhopal</span>
                            <span class="px-2 py-0.5 rounded text-[11px] font-medium bg-slate-100 text-slate-700">Sonipat</span>
                            <span class="px-2 py-0.5 rounded text-[11px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">Pan-India Cargo</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Interactive Contact Form -->
            <div class="lg:col-span-7 bg-white p-8 sm:p-10 rounded-3xl border border-slate-200/80 shadow-card">
                <span class="inline-block text-[11px] font-mono font-bold text-brand-orange uppercase tracking-wider mb-1"><?php esc_html_e( 'Direct Engineering Desk', 'pactiva-energy' ); ?></span>
                <h2 class="text-2xl font-black text-slate-950 font-heading tracking-tight mb-2">
                    <?php esc_html_e( 'Submit a Technical Inquiry', 'pactiva-energy' ); ?>
                </h2>
                <p class="text-xs text-slate-500 mb-6">
                    <?php esc_html_e( 'Fill in the form below and our engineering team will respond with datasheets and pricing.', 'pactiva-energy' ); ?>
                </p>

                <div id="contact-page-status" class="hidden mb-5 p-4 rounded-2xl text-xs font-semibold"></div>

                <form onsubmit="pactivaSubmitContactForm(event, this);" class="space-y-4 text-xs">
                    <!-- Honeypot -->
                    <div class="hidden" aria-hidden="true">
                        <input type="text" name="pactiva_hp_website" tabindex="-1" autocomplete="off">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="flex items-center gap-1.5 font-bold text-slate-700 mb-1.5">
                                <svg class="w-3.5 h-3.5 text-brand-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                <span><?php esc_html_e( 'Full Name *', 'pactiva-energy' ); ?></span>
                            </label>
                            <input type="text" name="name" required class="pactiva-input" placeholder="e.g. Vikram Singhania">
                        </div>
                        <div>
                            <label class="flex items-center gap-1.5 font-bold text-slate-700 mb-1.5">
                                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                <span><?php esc_html_e( 'Company / Organization', 'pactiva-energy' ); ?></span>
                            </label>
                            <input type="text" name="company" class="pactiva-input" placeholder="e.g. Singhania Solar Tech">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="flex items-center gap-1.5 font-bold text-slate-700 mb-1.5">
                                <svg class="w-3.5 h-3.5 text-brand-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                <span><?php esc_html_e( 'Email Address *', 'pactiva-energy' ); ?></span>
                            </label>
                            <input type="email" name="email" required class="pactiva-input" placeholder="vikram@singhaniasolar.com">
                        </div>
                        <div>
                            <label class="flex items-center gap-1.5 font-bold text-slate-700 mb-1.5">
                                <svg class="w-3.5 h-3.5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                <span><?php esc_html_e( 'Phone / WhatsApp *', 'pactiva-energy' ); ?></span>
                            </label>
                            <input type="tel" name="phone" required class="pactiva-input" placeholder="+91 98111 22334">
                        </div>
                    </div>

                    <div>
                        <label class="flex items-center gap-1.5 font-bold text-slate-700 mb-1.5">
                            <svg class="w-3.5 h-3.5 text-brand-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                            <span><?php esc_html_e( 'Product or Energy Sector', 'pactiva-energy' ); ?></span>
                        </label>
                        <select name="product_name" class="pactiva-select">
                            <option value="Lithium Cells (Prismatic / Cylindrical)"><?php esc_html_e( 'Lithium Cells (LiFePO4 / NMC)', 'pactiva-energy' ); ?></option>
                            <option value="Smart BMS & Active Balancers"><?php esc_html_e( 'Smart BMS & Active Balancers', 'pactiva-energy' ); ?></option>
                            <option value="EV Battery Packs (2W / 3W)"><?php esc_html_e( 'EV Battery Packs (2W / 3W)', 'pactiva-energy' ); ?></option>
                            <option value="Solar ESS & Inverters"><?php esc_html_e( 'Solar ESS & Inverters', 'pactiva-energy' ); ?></option>
                            <option value="Telecom Rack Batteries"><?php esc_html_e( 'Telecom Rack Batteries', 'pactiva-energy' ); ?></option>
                            <option value="General Corporate Inquiry"><?php esc_html_e( 'General Corporate Inquiry', 'pactiva-energy' ); ?></option>
                        </select>
                    </div>

                    <div>
                        <label class="flex items-center gap-1.5 font-bold text-slate-700 mb-1.5">
                            <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            <span><?php esc_html_e( 'Detailed Requirements / Specifications *', 'pactiva-energy' ); ?></span>
                        </label>
                        <textarea name="message" rows="4" required class="pactiva-textarea" placeholder="Please mention capacity, quantity, target delivery timeline, and application..."></textarea>
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="btn-primary text-xs font-bold py-3.5 px-8 w-full sm:w-auto shadow-lg shadow-orange-500/25">
                            <span><?php esc_html_e( 'Send Technical Inquiry', 'pactiva-energy' ); ?></span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<script>
function pactivaSubmitContactForm(e, form) {
    e.preventDefault();
    const btn = form.querySelector('button[type="submit"]');
    const statusBox = document.getElementById('contact-page-status');
    const orig = btn.innerHTML;

    btn.disabled = true;
    btn.innerHTML = `
        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline-block" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path></svg>
        Transmitting Inquiry...
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
            statusBox.className = 'mb-5 p-4 rounded-2xl text-xs font-bold bg-emerald-50 text-emerald-800 border border-emerald-200';
            statusBox.innerHTML = data.data.message;
            form.reset();
        } else {
            statusBox.className = 'mb-5 p-4 rounded-2xl text-xs font-bold bg-red-50 text-red-800 border border-red-200';
            statusBox.innerHTML = data.data.message || 'Error occurred.';
        }
    })
    .catch(() => {
        btn.disabled = false;
        btn.innerHTML = orig;
        statusBox.classList.remove('hidden');
        statusBox.className = 'mb-5 p-4 rounded-2xl text-xs font-bold bg-red-50 text-red-800 border border-red-200';
        statusBox.innerHTML = 'Transmission failed. Please connect via WhatsApp.';
    });
}
</script>

<?php
get_footer();
