<?php
/**
 * Footer Content Component
 *
 * @package Pactiva_Energy
 */

defined( 'ABSPATH' ) || exit;

$home_url   = home_url( '/' );
$shop_url   = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/shop/' );
$email_info     = get_option( 'pactiva_business_email', 'info@pactivaenergy.com' );
$email_direct   = get_option( 'pactiva_direct_email', 'shivanshu@pactivaenergy.com' );
$phone          = get_option( 'pactiva_support_phone', '+91 9818280807' );
$address        = get_option( 'pactiva_corporate_address', 'C-111, Sector -65, NOIDA - 201301' );
$contact_person = get_option( 'pactiva_contact_person', 'Hanshika (PACTIVA ENERGY)' );
$wa_url         = pactiva_build_whatsapp_general_url( 'Direct Contact from Footer' );

$categories = get_terms( array(
    'taxonomy'   => 'product_cat',
    'hide_empty' => false,
    'number'     => 6,
) );
?>
<footer class="bg-brand-black text-slate-300 pt-16 pb-8 border-t border-white/10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Top Trust Stats Bar -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 pb-12 mb-12 border-b border-white/10">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-orange-500/10 border border-orange-500/20 flex items-center justify-center text-brand-orange shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
                <div>
                    <h4 class="text-sm font-black text-white"><?php esc_html_e( 'Grade-A Cells', 'pactiva-energy' ); ?></h4>
                    <p class="text-xs text-slate-400"><?php esc_html_e( 'Direct Tier-1 LFP & NMC', 'pactiva-energy' ); ?></p>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center text-emerald-400 shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>
                <div>
                    <h4 class="text-sm font-black text-white"><?php esc_html_e( 'Smart BMS Hardware', 'pactiva-energy' ); ?></h4>
                    <p class="text-xs text-slate-400"><?php esc_html_e( 'Tested Active Balancing', 'pactiva-energy' ); ?></p>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-blue-500/10 border border-blue-500/20 flex items-center justify-center text-blue-400 shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
                </div>
                <div>
                    <h4 class="text-sm font-black text-white"><?php esc_html_e( 'Pan-India Logistics', 'pactiva-energy' ); ?></h4>
                    <p class="text-xs text-slate-400"><?php esc_html_e( 'Express Secure Dispatch', 'pactiva-energy' ); ?></p>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-purple-500/10 border border-purple-500/20 flex items-center justify-center text-purple-400 shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                </div>
                <div>
                    <h4 class="text-sm font-black text-white"><?php esc_html_e( 'B2B Engineering Desk', 'pactiva-energy' ); ?></h4>
                    <p class="text-xs text-slate-400"><?php esc_html_e( 'Custom Battery Packs & ESS', 'pactiva-energy' ); ?></p>
                </div>
            </div>
        </div>

        <!-- Main Footer Links Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10 pb-12">
            
            <!-- Col 1: Brand Info -->
            <div class="lg:col-span-2 space-y-4">
                <a href="<?php echo esc_url( $home_url ); ?>" class="inline-block group" style="display:inline-block;text-decoration:none;">
                    <img src="<?php echo esc_url( PACTIVA_THEME_URI . '/assets/images/pactiva-logo-dark.png' ); ?>" 
                         alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" 
                         width="200"
                         height="42"
                         class="rounded-xl border border-white/10 shadow-lg group-hover:border-brand-orange/40 transition-all duration-300"
                         style="height:42px !important;max-height:42px !important;width:auto !important;max-width:200px !important;object-fit:contain !important;display:block !important;">
                </a>
                <p class="text-xs font-black uppercase tracking-wider text-brand-orange">
                    <?php esc_html_e( 'PACTIVA ENERGY & PACTIVA POWER', 'pactiva-energy' ); ?>
                </p>
                <p class="text-xs text-slate-400 leading-relaxed max-w-sm">
                    <?php esc_html_e( 'Pactiva Energy Tech India Pvt Ltd is a leading and fast-growing company of Lithium-ion batteries in India. We produce premium batteries for electric vehicles (EVs), Solar Systems, Telecom batteries, wall-mounted inverters & Energy Storage Systems (ESS) under our brand name of “PACTIVA ENERGY & PACTIVA POWER”. Our business is making progress toward its goal of a greener environment.', 'pactiva-energy' ); ?>
                </p>

                <!-- WhatsApp & Call Fast Connect -->
                <div class="flex items-center gap-3 pt-2">
                    <a href="<?php echo esc_url( $wa_url ); ?>" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 px-3.5 py-2 bg-[#25D366] hover:bg-[#20BD5A] text-white text-xs font-bold rounded-lg shadow-sm transition-all duration-200">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                        <span><?php esc_html_e( 'WhatsApp Us', 'pactiva-energy' ); ?></span>
                    </a>
                    <a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $phone ) ); ?>" class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-slate-800 hover:bg-slate-700 text-white text-xs font-bold rounded-lg border border-white/10 transition-colors">
                        <svg class="w-4 h-4 text-brand-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        <span><?php esc_html_e( 'Call Sales Desk', 'pactiva-energy' ); ?></span>
                    </a>
                </div>
            </div>

            <!-- Col 2: Core Sectors -->
            <div>
                <h4 class="text-xs font-black text-white uppercase tracking-wider mb-4 border-l-2 border-brand-orange pl-2.5">
                    <?php esc_html_e( 'Products & Sectors', 'pactiva-energy' ); ?>
                </h4>
                <ul class="space-y-2 text-xs text-slate-400 font-medium">
                    <?php if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) : ?>
                        <?php foreach ( $categories as $cat ) : ?>
                            <li>
                                <a href="<?php echo esc_url( get_term_link( $cat ) ); ?>" class="hover:text-brand-orange transition-colors">
                                    <?php echo esc_html( $cat->name ); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <li><a href="<?php echo esc_url( $shop_url ); ?>" class="hover:text-brand-orange">Lithium Battery Packs</a></li>
                        <li><a href="<?php echo esc_url( $shop_url ); ?>" class="hover:text-brand-orange">EV Battery Solutions</a></li>
                        <li><a href="<?php echo esc_url( $shop_url ); ?>" class="hover:text-brand-orange">Solar ESS & Storage</a></li>
                        <li><a href="<?php echo esc_url( $shop_url ); ?>" class="hover:text-brand-orange">Smart BMS & Balancers</a></li>
                        <li><a href="<?php echo esc_url( $shop_url ); ?>" class="hover:text-brand-orange">Wall-Mounted Inverters</a></li>
                    <?php endif; ?>
                </ul>
            </div>

            <!-- Col 3: Quick Navigation -->
            <div>
                <h4 class="text-xs font-black text-white uppercase tracking-wider mb-4 border-l-2 border-brand-orange pl-2.5">
                    <?php esc_html_e( 'Corporate Links', 'pactiva-energy' ); ?>
                </h4>
                <ul class="space-y-2 text-xs text-slate-400 font-medium">
                    <li><a href="<?php echo esc_url( home_url( '/about-us/' ) ); ?>" class="hover:text-brand-orange transition-colors"><?php esc_html_e( 'About PACTIVA Energy', 'pactiva-energy' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/bulk-orders/' ) ); ?>" class="hover:text-brand-orange transition-colors"><?php esc_html_e( 'Bulk Inquiries & RFQ', 'pactiva-energy' ); ?></a></li>
                    <li><a href="<?php echo esc_url( $shop_url ); ?>" class="hover:text-brand-orange transition-colors"><?php esc_html_e( 'Full Catalog', 'pactiva-energy' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/contact-us/' ) ); ?>" class="hover:text-brand-orange transition-colors"><?php esc_html_e( 'Contact & Factory Support', 'pactiva-energy' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/terms-conditions/' ) ); ?>" class="hover:text-brand-orange transition-colors"><?php esc_html_e( 'Terms & Conditions', 'pactiva-energy' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>" class="hover:text-brand-orange transition-colors"><?php esc_html_e( 'Privacy Policy', 'pactiva-energy' ); ?></a></li>
                </ul>
            </div>

            <!-- Col 4: Factory & Corporate Contact -->
            <div>
                <h4 class="text-xs font-black text-white uppercase tracking-wider mb-4 border-l-2 border-brand-orange pl-2.5">
                    <?php esc_html_e( 'Headquarters', 'pactiva-energy' ); ?>
                </h4>
                <div class="space-y-3 text-xs text-slate-400 leading-relaxed">
                    <p class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-brand-orange shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        <span class="text-white font-semibold"><?php echo esc_html( $contact_person ); ?></span>
                    </p>
                    <p class="flex items-start gap-2">
                        <svg class="w-4 h-4 text-brand-orange shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <span><?php echo esc_html( $address ); ?></span>
                    </p>
                    <p class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-brand-orange shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        <a href="mailto:<?php echo esc_attr( $email_info ); ?>" class="hover:text-white"><?php echo esc_html( $email_info ); ?></a>
                    </p>
                    <p class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-brand-orange shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/></svg>
                        <a href="mailto:<?php echo esc_attr( $email_direct ); ?>" class="hover:text-white"><?php echo esc_html( $email_direct ); ?></a>
                    </p>
                    <p class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-brand-orange shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        <a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $phone ) ); ?>" class="hover:text-white"><?php echo esc_html( $phone ); ?></a>
                    </p>
                </div>
            </div>
        </div>

        <!-- Local SEO & B2B Distribution Hubs -->
        <div class="my-8 pt-6 border-t border-white/10">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-3 mb-3">
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-brand-orange animate-ping"></span>
                    <h5 class="text-xs font-bold text-white uppercase tracking-wider">
                        <?php esc_html_e( 'Local B2B Supply & Direct Factory Dispatch Hubs', 'pactiva-energy' ); ?>
                    </h5>
                </div>
                <span class="text-[11px] text-slate-400 font-medium"><?php esc_html_e( '24-48 Hour Express Cargo Delivery Across Northern & Central India', 'pactiva-energy' ); ?></span>
            </div>

            <div class="flex flex-wrap items-center gap-1.5 text-[11px] text-slate-400">
                <span class="text-white font-semibold mr-1"><?php esc_html_e( 'Primary Manufacturing Hub (Delhi NCR):', 'pactiva-energy' ); ?></span>
                <span class="px-2 py-0.5 rounded bg-white/5 border border-white/10 hover:border-brand-orange hover:text-white transition-colors">Noida Sector 65 (HQ)</span>
                <span class="px-2 py-0.5 rounded bg-white/5 border border-white/10 hover:border-brand-orange hover:text-white transition-colors">Delhi</span>
                <span class="px-2 py-0.5 rounded bg-white/5 border border-white/10 hover:border-brand-orange hover:text-white transition-colors">New Delhi</span>
                <span class="px-2 py-0.5 rounded bg-white/5 border border-white/10 hover:border-brand-orange hover:text-white transition-colors">Gurgaon / Gurugram</span>
                <span class="px-2 py-0.5 rounded bg-white/5 border border-white/10 hover:border-brand-orange hover:text-white transition-colors">Faridabad</span>
                <span class="px-2 py-0.5 rounded bg-white/5 border border-white/10 hover:border-brand-orange hover:text-white transition-colors">Ghaziabad</span>
                <span class="px-2 py-0.5 rounded bg-white/5 border border-white/10 hover:border-brand-orange hover:text-white transition-colors">Sonipat &amp; Haryana</span>
                <span class="px-2 py-0.5 rounded bg-white/5 border border-white/10 hover:border-brand-orange hover:text-white transition-colors">Manesar</span>
                <span class="mx-1 text-slate-600">•</span>
                <span class="text-white font-semibold mr-1"><?php esc_html_e( 'Regional Supply & Service Corridors:', 'pactiva-energy' ); ?></span>
                <span class="px-2 py-0.5 rounded bg-white/5 border border-white/10 hover:border-brand-orange hover:text-white transition-colors">Mathura</span>
                <span class="px-2 py-0.5 rounded bg-white/5 border border-white/10 hover:border-brand-orange hover:text-white transition-colors">Agra</span>
                <span class="px-2 py-0.5 rounded bg-white/5 border border-white/10 hover:border-brand-orange hover:text-white transition-colors">Meerut</span>
                <span class="px-2 py-0.5 rounded bg-white/5 border border-white/10 hover:border-brand-orange hover:text-white transition-colors">Indore</span>
                <span class="px-2 py-0.5 rounded bg-white/5 border border-white/10 hover:border-brand-orange hover:text-white transition-colors">Bhopal</span>
                <span class="px-2 py-0.5 rounded bg-white/5 border border-white/10 hover:border-brand-orange hover:text-white transition-colors">Madhya Pradesh (MP)</span>
                <span class="px-2 py-0.5 rounded bg-white/5 border border-white/10 hover:border-brand-orange hover:text-white transition-colors">Jaipur</span>
                <span class="px-2 py-0.5 rounded bg-orange-500/10 text-brand-orange border border-orange-500/30 font-bold">Pan-India Insured Dispatch</span>
            </div>
        </div>

        <!-- Bottom Copyright & Legal Strip -->
        <div class="pt-8 border-t border-white/10 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-500">
            <p>
                &copy; <?php echo esc_html( date( 'Y' ) ); ?>
                <span class="text-white font-bold">PACTIVA ENERGY TECH INDIA PVT LTD</span>.
                <?php esc_html_e( 'All Rights Reserved.', 'pactiva-energy' ); ?>
            </p>

            <div class="flex items-center gap-4">
                <span>ISO 9001:2015 Certified</span>
                <span>&bull;</span>
                <span>CE &amp; RoHS Compliant Hardware</span>
            </div>

            <p>
                Website developed by <a href="https://nexnify.in/"
                target="_blank"
                rel="noopener noreferrer"
                class="text-white font-bold hover:text-blue-400 transition-colors">
                    Nexnify Tech
                </a>
            </p>
        </div>

    </div>
</footer>
