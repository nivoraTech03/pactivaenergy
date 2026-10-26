<?php
/**
 * Top Announcement & Fast Contact Bar
 *
 * @package Pactiva_Energy
 */

defined( 'ABSPATH' ) || exit;

$show_bar = get_option( 'pactiva_announcement_enabled', '1' );
if ( ! $show_bar ) {
    return;
}

$text     = get_option( 'pactiva_announcement_text', '⚡ High-Grade LiFePO4 & Lithium-Ion Battery Technology | Pan-India B2B Dispatch & Technical Support' );
$phone    = get_option( 'pactiva_support_phone', '+91 9818280807' );
$email    = get_option( 'pactiva_business_email', 'info@pactivaenergy.com' );
$wa_url   = pactiva_build_whatsapp_general_url( 'B2B Quick Query from Topbar' );
?>
<div class="bg-brand-black text-slate-300 text-xs py-2 px-4 border-b border-white/10 hidden md:block">
    <div class="max-w-7xl mx-auto flex items-center justify-between">
        
        <!-- Announcement Text -->
        <div class="flex items-center gap-2 overflow-hidden whitespace-nowrap">
            <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-black uppercase tracking-wider bg-brand-orange text-white">
                <?php esc_html_e( 'B2B Direct', 'pactiva-energy' ); ?>
            </span>
            <span class="text-slate-200 font-medium truncate"><?php echo esc_html( $text ); ?></span>
        </div>

        <!-- Quick Contacts -->
        <div class="flex items-center gap-6 text-[11px] font-medium shrink-0">
            <!-- Email -->
            <a href="mailto:<?php echo esc_attr( $email ); ?>" class="hover:text-brand-orange flex items-center gap-1.5 transition-colors">
                <svg class="w-3.5 h-3.5 text-brand-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                <span><?php echo esc_html( $email ); ?></span>
            </a>

            <!-- Phone -->
            <a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $phone ) ); ?>" class="hover:text-brand-orange flex items-center gap-1.5 transition-colors">
                <svg class="w-3.5 h-3.5 text-brand-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                <span><?php echo esc_html( $phone ); ?></span>
            </a>

            <!-- WhatsApp Fast Direct -->
            <a href="<?php echo esc_url( $wa_url ); ?>" target="_blank" rel="noopener noreferrer" class="text-emerald-400 hover:text-emerald-300 font-bold flex items-center gap-1 transition-colors">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-ping"></span>
                <?php esc_html_e( 'WhatsApp Online', 'pactiva-energy' ); ?>
            </a>
        </div>
    </div>
</div>
