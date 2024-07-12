<?php
/**
 * Forms field: Total Amount
 *
 * @package SimplePay\Pro\Forms\Fields
 * @copyright Copyright (c) 2022, Sandhills Development, LLC
 * @license http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since 3.0.0
 */

namespace SimplePay\Pro\Forms\Fields;

use SimplePay\Pro\Payment_Methods;
use SimplePay\Core\Abstracts\Custom_Field;
use function SimplePay\Pro\Post_Types\Simple_Pay\Util\get_custom_fields;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Total_Amount class.
 *
 * @since 3.0.0
 */
class Total_Amount extends Custom_Field {

	/**
	 * Prints HTML for field on frontend.
	 *
	 * @since 3.0.0
	 *
	 * @param array                          $settings Field settings.
	 * @param string                         $type Field type.
	 * @param \SimplePay\Core\Abstracts\Form $form Payment form.
	 * @return string
	 */
	public static function print_html( $settings, $type, $form ) {
		$prices    = simpay_get_payment_form_prices( self::$form );
		$recurring = simpay_payment_form_prices_has_subscription_price( $prices );

		ob_start();

		echo '<div class="simpay-form-control simpay-amounts-container">';

		// Subtotal.
		self::print_subtotal_amount( $settings );

		// Coupons.
		self::print_coupon( $settings );

		// Taxes.
		$tax_status = get_post_meta( self::$form->id, '_tax_status', true );
		$tax_rates  = simpay_get_payment_form_tax_rates( self::$form );

		// Fixed rates (or unsaved setting).
		if (
			( empty( $tax_status ) && ! empty( $tax_rates ) ) ||
			'fixed-global' === $tax_status && ! empty( $tax_rates )
		) {
			self::print_tax_amount_label( $settings );
		} elseif ( 'automatic' === $tax_status ) {
			self::print_automatic_tax_label( $settings );
		}

		// Fee recovery.
		self::print_fee_recovery_label( $settings );

		// Total.
		self::print_total_amount_label( $settings );

		// Recurring.
		if ( true === $recurring ) {
			self::print_recurring_total_label( $settings );
		}

		echo '</div>';

		return ob_get_clean();
	}

	/**
	 * HTML for the subtotal amount.
	 *
	 * @since 4.1.0
	 *
	 * @param array $settings Field settings.
	 */
	public static function print_subtotal_amount( $settings ) {
		$label = isset( $settings['subtotal_label'] ) && ! empty( $settings['subtotal_label'] )
			? $settings['subtotal_label']
			: esc_html__( 'Subtotal', 'simple-pay' );

		$prices = simpay_get_payment_form_prices( self::$form );
		$price  = simpay_payment_form_get_default_price( $prices );
		?>

		<div class="simpay-subtotal-amount-container">
			<p class="simpay-subtotal-amount-label simpay-label-wrap">
				<span>
					<?php echo esc_html( $label ); ?>
				</span>
				<span class="simpay-subtotal-amount-value">
					<?php
					echo simpay_format_currency(
						$price->unit_amount,
						$price->currency
					);
					?>
				</span>
			</p>
		</div>

		<?php
	}

	/**
	 * HTML for the coupon amount.
	 *
	 * @since 4.1.0
	 *
	 * @param array $settings Field settings.
	 */
	public static function print_coupon( $settings ) {
		?>

		<div
			class="simpay-coupon-amount-container"
			style="display: none;"
		>
			<p class="simpay-coupon-amount-label simpay-label-wrap">
				<span class="simpay-coupon-amount-name"></span>
				<span class="simpay-coupon-amount-value"></span>
			</p>
		</div>

		<?php
	}

	/**
	 * HTML for the total amount label.
	 *
	 * @since 3.0.0
	 *
	 * @param array $settings Field settings.
	 */
	public static function print_total_amount_label( $settings ) {
		$label = isset( $settings['label'] ) && ! empty( $settings['label'] )
			? $settings['label']
			: esc_html__( 'Total Amount:', 'simple-pay' );

		$prices = simpay_get_payment_form_prices( self::$form );
		$price  = simpay_payment_form_get_default_price( $prices );
		?>

		<div class="simpay-total-amount-container">
			<p class="simpay-total-amount-label simpay-label-wrap">
				<?php echo esc_html( $label ); ?>
				<span class="simpay-total-amount-value">
					<?php
					echo simpay_format_currency(
						$price->unit_amount,
						$price->currency
					);
					?>
				</span>
			</p>
		</div>

		<?php
	}

	/**
	 * HTML for the recurring total label
	 *
	 * @since 3.0.0
	 *
	 * @param array $settings Field settings.
	 */
	public static function print_recurring_total_label( $settings ) {
		$label = isset( $settings['recurring_total_label'] ) &&
			! empty( $settings['recurring_total_label'] )
				? $settings['recurring_total_label']
				: esc_html__( 'Recurring payment', 'simple-pay' );

		$prices = simpay_get_payment_form_prices( self::$form );
		$price  = simpay_payment_form_get_default_price( $prices );

		$intervals = simpay_get_recurring_intervals();
		?>

		<div
			class="simpay-total-amount-recurring-container"
			<?php if ( null === $price->recurring ) : ?>
				style="display: none;"
			<?php endif; ?>
		>
			<p class="simpay-total-amount-recurring-label simpay-label-wrap">
				<?php echo esc_html( $label ); ?>

				<span class="simpay-total-amount-recurring-value">
					<?php
					echo esc_html(
						$price->get_generated_label(
							array(
								'include_trial'      => false,
								'include_line_items' => false,
							)
						)
					);
					?>
				</span>
			</p>
		</div>

		<?php
	}

	/**
	 * HTML for the tax amount label
	 *
	 * @since 3.0.0
	 *
	 * @param array $settings Field settings.
	 */
	public static function print_tax_amount_label( $settings ) {
		$tax_rates = simpay_get_payment_form_tax_rates( self::$form );

		$prices = simpay_get_payment_form_prices( self::$form );
		$price  = simpay_payment_form_get_default_price( $prices );
		?>

		<div class="simpay-tax-amount-container">
			<?php
			foreach ( $tax_rates as $tax_rate ) :

				$wrapper_classnames = array(
					'simpay-tax-rate-' . $tax_rate->id,
					'simpay-tax-rate-' . $tax_rate->calculation,
					'simpay-total-amount-tax-label',
					'simpay-label-wrap',
				);

				$value_classnames = array(
					'simpay-tax-amount-value',
					'simpay-tax-amount-value-' . $tax_rate->id,
				);
				?>
			<p class="<?php echo esc_attr( implode( ' ', $wrapper_classnames ) ); ?>">
				<span>
					<?php echo esc_html( $tax_rate->get_display_label() ); ?>
				</span>
				<span class="<?php echo esc_attr( implode( ' ', $value_classnames ) ); ?>">
					<?php
					echo simpay_format_currency(
						$price->unit_amount * ( $tax_rate->percentage / 100 ),
						$price->currency
					);
					?>
				</span>
			</p>
			<?php endforeach; ?>
		</div>

		<?php
	}

	/**
	 * HTML for the automatic tax amount label.
	 *
	 * @since 3.0.0
	 *
	 * @param array $settings Field settings.
	 * @return void
	 */
	public static function print_automatic_tax_label( $settings ) {
		?>

		<div class="simpay-tax-amount-container">
			<p class="simpay-total-amount-tax-label simpay-automatic-tax-label simpay-label-wrap">
				<span class="simpay-tax-amount-label">
					<?php
					echo esc_html(
						_x( 'Tax', 'automatic tax amount label', 'simple-pay' )
					);
					?>
				</span>
				<span class="simpay-tax-amount-value">
					<?php
					if ( 'stripe_checkout' === self::$form->get_display_type() ) :
						esc_html_e(
							'Calculated at checkout',
							'simple-pay'
						);
					else :
						esc_html_e(
							'Enter address to calculate',
							'simple-pay'
						);
					endif;
					?>
				</span>
			</p>
		</div>

		<?php
	}

	/**
	 * HTML for the fee recovery label/value.
	 *
	 * @since 4.6.5
	 *
	 * @param array<string, mixed> $settings Field settings.
	 * @return void
	 */
	public static function print_fee_recovery_label( $settings ) {
		$payment_methods = array_map(
			function( $payment_method ) {
				return $payment_method->get_data_for_payment_form();
			},
			Payment_Methods\get_form_payment_methods( self::$form )
		);

		$current_payment_method        = current( $payment_methods );
		$current_payment_method_config = $current_payment_method->config;

		$prices = simpay_get_payment_form_prices( self::$form );
		$price  = simpay_get_payment_form_default_price( $prices );

		// Determine if we have fee recovery for the default payment method.
		$has_fee_recovery = (
			isset(
				$current_payment_method_config['fee_recovery'],
				$current_payment_method_config['fee_recovery']['enabled']
			) &&
			'yes' === $current_payment_method_config['fee_recovery']['enabled']
		);

		// If there is a Fee Recovery Toggle field, check if it is enabled by default.
		$fee_recovery_toggle = array_filter(
			get_custom_fields( self::$form->id ),
			function( $field ) {
				return 'fee_recovery_toggle' === $field['type'];
			}
		);

		if ( ! empty( $fee_recovery_toggle ) ) {
			$fee_recovery_toggle = current( $fee_recovery_toggle );

			$has_fee_recovery = (
				$has_fee_recovery &&
				isset( $fee_recovery_toggle['on_by_default'] )
			);
		}

		$fee_recovery_total = 0;

		if ( ! simpay_is_upe() ) {
			if ( $has_fee_recovery ) {
				$fee_recovery_total = Payment_Methods\get_form_payment_method_fee_recovery_amount(
					self::$form,
					$current_payment_method->id,
					$price->unit_amount
				);
			}
		}

		$fee_recovery_total = simpay_format_currency(
			$fee_recovery_total,
			$price->currency
		);

		$label = isset( $settings['fee_recovery_label'] ) &&
			! empty( $settings['fee_recovery_label'] )
				? $settings['fee_recovery_label']
				: esc_html__( 'Processing fee', 'simple-pay' );
		?>

		<div
			class="simpay-fee-recovery-container"
			<?php if ( false === $has_fee_recovery ) : ?>
				style="display: none;"
			<?php endif; ?>
		>
			<p class="simpay-total-amount-fee-recovery-label simpay-fee-recovery-label simpay-label-wrap">
				<span class="simpay-fee-recovery-amount-label">
					<?php echo esc_html( $label ); ?>
				</span>
				<span class="simpay-fee-recovery-amount-value">
					<?php echo esc_html( $fee_recovery_total ); ?>
				</span>
			</p>
		</div>

		<?php
	}
}
