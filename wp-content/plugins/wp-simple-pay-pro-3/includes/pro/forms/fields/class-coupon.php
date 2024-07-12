<?php
/**
 * Forms field: Coupon
 *
 * @package SimplePay\Pro\Forms\Fields
 * @copyright Copyright (c) 2022, Sandhills Development, LLC
 * @license http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since 3.0.0
 */

namespace SimplePay\Pro\Forms\Fields;

use SimplePay\Core\Abstracts\Custom_Field;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Coupon class.
 *
 * @since 3.0.0
 */
class Coupon extends Custom_Field {

	/**
	 * Prints HTML for field on frontend.
	 *
	 * @since 3.0.0
	 *
	 * @param array $settings Field settings.
	 * @return string
	 */
	public static function print_html( $settings ) {
		if ( ! simpay_is_upe() ) {
			return self::get_coupon_field( $settings );
		} else {
			return self::get_upe_coupon_field( $settings );
		}
	}

	/**
	 * Returns the markup for the "Coupon" custom field when not using the UPE.
	 *
	 * @since 4.7.0
	 *
	 * @param array<string, string> $settings The field settings.
	 * @return string
	 */
	public static function get_coupon_field( $settings ) {
		$id          = self::get_id_attr();
		$placeholder = isset( $settings['placeholder'] ) ? $settings['placeholder'] : '';
		$style       = isset( $settings['style'] )
			? $settings['style']
			: 'none';

		$loading_image = esc_url( SIMPLE_PAY_INC_URL . 'core/assets/images/loading.gif' );

		ob_start();
		?>

		<div class="simpay-form-control simpay-coupon-container">
			<?php echo self::get_label(); // WPCS: XSS okay. ?>
			<div class="simpay-coupon-wrap simpay-field-wrap">
				<input
					type="text"
					name="simpay_field[coupon]"
					id="<?php echo esc_attr( $id ); ?>"
					class="simpay-coupon-field"
					placeholder="<?php echo esc_attr( $placeholder ); ?>"
				/>

				<button
					type="button"
					class="simpay-apply-coupon simpay-btn <?php echo esc_attr( 'stripe' === $style ? 'stripe-button-el' : '' ); ?>"
				>
					<span><?php esc_html_e( 'Apply', 'simple-pay' ); ?></span>
				</button>
			</div>

			<span class="simpay-coupon-loading" style="display: none;">
				<img src="<?php echo esc_attr( $loading_image ); ?>" />
			</span>

			<span
				class="simpay-coupon-message"
				style="display: none;"
				aria-live="polite"
				aria-relevant="additions text"
				aria-atomic="true"
			></span>
			<span class="simpay-remove-coupon" style="display: none;">
				(<a href="#"><?php esc_html_e( 'remove', 'simple-pay' ); ?></a>)
			</span>

			<input type="hidden" name="simpay_coupon" class="simpay-coupon" />

			<?php
			wp_nonce_field(
				'simpay_coupon_nonce',
				sprintf( 'simpay-coupon-nonce-%s', wp_generate_uuid4() )
			);
			?>
		</div>

		<?php
		return ob_get_clean();
	}

	/**
	 * Returns the markup for the "Coupon" custom field when using the UPE.
	 *
	 * @since 4.7.0
	 *
	 * @param array<string, string> $settings The field settings.
	 * @return string
	 */
	public static function get_upe_coupon_field( $settings ) {
		$id          = self::get_id_attr();
		$placeholder = isset( $settings['placeholder'] ) ? $settings['placeholder'] : '';
		$style       = isset( $settings['style'] )
			? $settings['style']
			: 'none';

		ob_start();
		?>

		<div class="simpay-form-control simpay-coupon-container">
			<?php echo self::get_label(); // WPCS: XSS okay. ?>
			<div class="simpay-coupon-wrap simpay-field-wrap">
				<input
					type="text"
					id="<?php echo esc_attr( $id ); ?>"
					class="simpay-coupon-field"
					placeholder="<?php echo esc_attr( $placeholder ); ?>"
				/>

				<button
					type="button"
					class="simpay-apply-coupon simpay-btn <?php echo esc_attr( 'stripe' === $style ? 'stripe-button-el' : '' ); ?>"
				>
					<span><?php esc_html_e( 'Apply', 'simple-pay' ); ?></span>
				</button>
			</div>

			<div
				class="simpay-coupon-info"
				style="display: none;"
				aria-live="polite"
				aria-relevant="additions text"
				aria-atomic="true"
			>
				<span class="simpay-coupon-message"></span>
				<a href="#" class="simpay-remove-coupon">
					<span class="screen-reader-text">
						<?php esc_html_e( 'remove', 'simple-pay' ); ?>
					</span>
					&times;
				</a>
			</div>
		</div>

		<div
			class="simpay-errors simpay-coupon-error"
			aria-live="assertive"
			aria-relevant="additions text"
			aria-atomic="true"
		></div>

		<?php
		return ob_get_clean();
	}

}