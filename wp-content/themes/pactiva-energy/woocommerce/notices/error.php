<?php
/**
 * PACTIVA ENERGY - Custom WooCommerce Error Notice Template
 *
 * @package Pactiva_Energy
 * @version 8.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! $notices ) {
	return;
}
?>

<div class="woocommerce-error p-4 sm:p-5 mb-3 last:mb-0 bg-rose-50/95 border border-rose-200 text-rose-950 rounded-2xl shadow-sm text-xs sm:text-sm backdrop-blur-sm" role="alert">
	<div class="flex items-center gap-2.5 mb-2.5 font-bold text-rose-900 pb-2 border-b border-rose-200/60">
		<div class="w-6 h-6 rounded-lg bg-rose-600 text-white flex items-center justify-center shrink-0 shadow-sm">
			<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
		</div>
		<span class="tracking-tight"><?php esc_html_e( 'Please check the following details:', 'pactiva-energy' ); ?></span>
	</div>
	<ul class="space-y-1.5 pl-1 list-none m-0">
		<?php foreach ( $notices as $notice ) : ?>
			<li class="flex items-start gap-2 text-rose-900 font-medium"<?php echo wc_get_notice_data_attr( $notice ); ?>>
				<span class="w-1.5 h-1.5 rounded-full bg-rose-500 mt-1.5 shrink-0"></span>
				<div class="flex-1 leading-relaxed"><?php echo wc_kses_notice( $notice['notice'] ); ?></div>
			</li>
		<?php endforeach; ?>
	</ul>
</div>
