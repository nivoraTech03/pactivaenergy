<?php
/**
 * Product quantity inputs with Plus & Minus Steppers
 *
 * @package Pactiva_Energy
 * @version 10.1.0
 */

defined( 'ABSPATH' ) || exit;

/* translators: %s: Quantity. */
$label = ! empty( $args['product_name'] ) ? sprintf( esc_html__( '%s quantity', 'pactiva-energy' ), wp_strip_all_tags( $args['product_name'] ) ) : esc_html__( 'Quantity', 'pactiva-energy' );

$min = ! empty( $min_value ) ? $min_value : 1;
$max = ! empty( $max_value ) ? $max_value : '';
$step_val = ! empty( $step ) ? $step : 1;
$current_val = ! empty( $input_value ) ? $input_value : $min;
?>
<div class="quantity pactiva-quantity-group flex items-center border border-slate-200 rounded-xl overflow-hidden bg-white shadow-sm hover:border-brand-orange transition-colors">
    <?php do_action( 'woocommerce_before_quantity_input_field' ); ?>
    
    <label class="screen-reader-text" for="<?php echo esc_attr( $input_id ); ?>"><?php echo esc_attr( $label ); ?></label>

    <!-- Minus Button -->
    <button type="button" 
            class="pactiva-qty-btn pactiva-qty-minus w-10 h-10 flex items-center justify-center bg-slate-50 hover:bg-orange-50 text-slate-700 hover:text-brand-orange text-lg font-bold transition-all border-r border-slate-200 select-none cursor-pointer active:scale-95 shrink-0" 
            aria-label="<?php esc_attr_e( 'Decrease quantity', 'pactiva-energy' ); ?>">
        &minus;
    </button>

    <!-- Numeric Input -->
    <input
        type="number"
        <?php echo $readonly ? 'readonly="readonly"' : ''; ?>
        id="<?php echo esc_attr( $input_id ); ?>"
        class="input-text qty text pactiva-qty-field w-14 sm:w-16 h-10 text-center font-bold text-slate-900 bg-white border-0 outline-none text-sm [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
        name="<?php echo esc_attr( $input_name ); ?>"
        value="<?php echo esc_attr( $current_val ); ?>"
        aria-label="<?php esc_attr_e( 'Product quantity', 'pactiva-energy' ); ?>"
        min="<?php echo esc_attr( $min ); ?>"
        <?php if ( ! empty( $max ) ) : ?>
            max="<?php echo esc_attr( $max ); ?>"
        <?php endif; ?>
        step="<?php echo esc_attr( $step_val ); ?>"
        placeholder="<?php echo esc_attr( $placeholder ); ?>"
        inputmode="<?php echo esc_attr( $inputmode ); ?>"
        autocomplete="<?php echo esc_attr( isset( $autocomplete ) ? $autocomplete : 'on' ); ?>"
    />

    <!-- Plus Button -->
    <button type="button" 
            class="pactiva-qty-btn pactiva-qty-plus w-10 h-10 flex items-center justify-center bg-slate-50 hover:bg-orange-50 text-slate-700 hover:text-brand-orange text-lg font-bold transition-all border-l border-slate-200 select-none cursor-pointer active:scale-95 shrink-0" 
            aria-label="<?php esc_attr_e( 'Increase quantity', 'pactiva-energy' ); ?>">
        &plus;
    </button>

    <?php do_action( 'woocommerce_after_quantity_input_field' ); ?>
</div>
