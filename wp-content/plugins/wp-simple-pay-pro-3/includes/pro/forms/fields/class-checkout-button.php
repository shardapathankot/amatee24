<?php
/**
 * Forms field: Checkout Button
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
 * Checkout_Button class.
 *
 * @since 3.0.0
 */
class Checkout_Button extends Custom_Field {

	/**
	 * Prints HTML for field on frontend.
	 *
	 * @since 3.0.0
	 *
	 * @param array $settings Field settings.
	 * @return string
	 */
	public static function print_html( $settings ) {
		$id          = self::get_id_attr();
		$button_text = self::print_button_text( $settings );
		$style       = isset( $settings['style'] ) ? $settings['style'] : 'none';

		$button_classes = array(
			'simpay-btn',
			'simpay-checkout-btn',
		);

		if ( 'stripe' === $style ) {
			$button_classes[] = 'stripe-button-el';
		}

		$captcha_type = simpay_get_setting( 'captcha_type', '' );

		ob_start();

		switch ( $captcha_type ) {
			case 'hcaptcha':
				printf(
					'<div class="simpay-form-control h-captcha" data-sitekey="%s"></div>',
					esc_attr( simpay_get_setting( 'hcaptcha_site_key', '' ) )
				);
				break;
			case 'cloudflare-turnstile':
				printf(
					'<div class="simpay-form-control cf-turnstile" data-sitekey="%s" data-action="simpay-form-%d"></div>',
					esc_attr( simpay_get_setting( 'cloudflare_turnstile_site_key', '' ) ),
					self::$form->id
				);
				break;
		}
		?>

		<div
			class="simpay-form-control simpay-checkout-btn-container"
		>
			<button
				id="<?php echo esc_attr( $id ); ?>"
				class="<?php echo esc_attr( implode( ' ', $button_classes ) ); ?>"
				type="submit"
				disabled
			>
				<span>
					<?php echo $button_text; ?>
				</span>
			</button>
		</div>
		<?php

		return ob_get_clean();
	}

	/**
	 * HTML for the button text including total amount.
	 *
	 * @since 3.0.0
	 *
	 * @param array $settings Field settings.
	 * @return string
	 */
	public static function print_button_text( $settings ) {
		return isset( $settings['processing_text'] ) && ! empty( $settings['processing_text'] )
			? $settings['processing_text']
			: esc_html__( 'Please Wait...', 'simple-pay' );
	}

}
