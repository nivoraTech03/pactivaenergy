<?php
/**
 * PACTIVA ENERGY - Custom WooCommerce Info Notice Template
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

<?php foreach ( $notices as $notice ) : ?>
	<div class="woocommerce-info flex items-start sm:items-center gap-3 sm:gap-4 p-4 sm:p-5 mb-3 last:mb-0 bg-sky-50/95 border border-sky-200 text-sky-950 rounded-2xl shadow-sm text-xs sm:text-sm font-semibold backdrop-blur-sm"<?php echo wc_get_notice_data_attr( $notice ); ?> role="alert">
		<div class="w-8 h-8 rounded-xl bg-sky-600 text-white flex items-center justify-center shrink-0 shadow-md shadow-sky-500/20 mt-0.5 sm:mt-0">
			<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
		</div>
		<div class="flex-1 leading-relaxed text-sky-900">
			<?php echo wc_kses_notice( $notice['notice'] ); ?>
		</div>
	</div>
<?php endforeach; ?>
