<?php
/**
 * PACTIVA ENERGY - Custom WooCommerce Success Notice Template
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
	<div class="woocommerce-message flex items-start sm:items-center justify-between gap-3 sm:gap-4 p-4 sm:p-5 mb-3 last:mb-0 bg-emerald-50/95 border border-emerald-200 text-emerald-950 rounded-2xl shadow-sm text-xs sm:text-sm font-semibold backdrop-blur-sm transition-all duration-300"<?php echo wc_get_notice_data_attr( $notice ); ?> role="alert">
		<div class="w-8 h-8 rounded-xl bg-emerald-600 text-white flex items-center justify-center shrink-0 shadow-md shadow-emerald-500/20 mt-0.5 sm:mt-0">
			<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
		</div>
		<div class="flex-1 min-w-0 leading-relaxed text-emerald-900">
			<?php echo wc_kses_notice( $notice['notice'] ); ?>
		</div>
	</div>
<?php endforeach; ?>
