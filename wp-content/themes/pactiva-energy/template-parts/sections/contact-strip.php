<?php
/**
 * Direct Factory Contact & Consultation Strip
 *
 * @package Pactiva_Energy
 */

defined( 'ABSPATH' ) || exit;

$email_info   = get_option( 'pactiva_business_email', 'info@pactivaenergy.com' );
$email_direct = get_option( 'pactiva_direct_email', 'shivanshu@pactivaenergy.com' );
$phone        = get_option( 'pactiva_support_phone', '+91 9818280807' );
$address      = get_option( 'pactiva_corporate_address', 'C-111, Sector -65, NOIDA - 201301' );
?>
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            <div class="lg:col-span-5 space-y-4">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[11px] font-black uppercase tracking-wider bg-orange-100 text-brand-orange">
                    <?php esc_html_e( 'Factory Direct Desk', 'pactiva-energy' ); ?>
                </span>
                <h2 class="text-3xl font-black font-heading text-slate-950 tracking-tight">
                    <?php esc_html_e( 'Connect with PACTIVA Technical Sales', 'pactiva-energy' ); ?>
                </h2>
                <p class="text-xs text-slate-500 leading-relaxed">
                    <?php esc_html_e( 'Whether you require sample cells for testing, a quote for 500+ packs, or custom enclosure dimensions, our application engineers respond with detailed documentation within 24 hours.', 'pactiva-energy' ); ?>
                </p>

                <div class="space-y-3 pt-2 text-xs text-slate-700 font-medium">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-orange-50 text-brand-orange flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        </div>
                        <div>
                            <span class="text-slate-400 block text-[10px] uppercase"><?php esc_html_e( 'Direct Calling Line', 'pactiva-energy' ); ?></span>
                            <a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $phone ) ); ?>" class="font-bold text-slate-900 hover:text-brand-orange"><?php echo esc_html( $phone ); ?></a>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-orange-50 text-brand-orange flex items-center justify-center shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <div>
                            <span class="text-slate-400 block text-[10px] uppercase"><?php esc_html_e( 'Official Contact Emails', 'pactiva-energy' ); ?></span>
                            <div class="flex flex-wrap items-center gap-x-2 gap-y-1">
                                <a href="mailto:<?php echo esc_attr( $email_info ); ?>" class="font-bold text-slate-900 hover:text-brand-orange"><?php echo esc_html( $email_info ); ?></a>
                                <span class="text-slate-300">|</span>
                                <a href="mailto:<?php echo esc_attr( $email_direct ); ?>" class="font-bold text-slate-900 hover:text-brand-orange"><?php echo esc_html( $email_direct ); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Fast Quick Message Box -->
            <div class="lg:col-span-7 bg-slate-50 p-6 sm:p-8 rounded-3xl border border-slate-200/80">
                <h3 class="text-base font-bold text-slate-900 mb-1"><?php esc_html_e( 'Send a Fast Specification Inquiry', 'pactiva-energy' ); ?></h3>
                <p class="text-xs text-slate-500 mb-4"><?php esc_html_e( 'Our engineers will review your requirement and prepare a formal quotation.', 'pactiva-energy' ); ?></p>

                <form onsubmit="event.preventDefault(); pactivaOpenEnquiryModal(this.quick_subject.value, 'FAST-STRIP');" class="space-y-3">
                    <input type="text" name="quick_subject" required class="w-full px-3.5 py-2.5 bg-white border border-slate-200 rounded-xl text-xs outline-none focus:border-brand-orange" placeholder="Enter Product or Battery Requirement (e.g. 48V 100Ah LFP Server Rack)">
                    <button type="submit" class="btn-primary text-xs font-bold py-2.5 w-full">
                        <?php esc_html_e( 'Open Quotation Form &rarr;', 'pactiva-energy' ); ?>
                    </button>
                </form>
            </div>

        </div>
    </div>
</section>
