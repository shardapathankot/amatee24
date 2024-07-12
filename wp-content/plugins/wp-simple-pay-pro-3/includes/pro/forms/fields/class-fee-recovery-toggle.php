<?php
/**
 * Forms field: Fee Recovery Toggle
 *
 * @package SimplePay\Pro\Forms\Fields
 * @copyright Copyright (c) 2022, Sandhills Development, LLC
 * @license http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since 4.6.6
 */

namespace SimplePay\Pro\Forms\Fields;

use SimplePay\Core\Abstracts\Custom_Field;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Fee_Recovery_Toggle class.
 *
 * @since 4.6.5
 */
class Fee_Recovery_Toggle extends Custom_Field {

	/**
	 * Prints HTML for field on frontend.
	 *
	 * @since 4.6.5
	 *
	 * @param array $settings Field settings.
	 * @return string
	 */
	public static function print_html( $settings ) {
		ob_start();
		?>

		<div class="simpay-form-control simpay-fee-recovery-toggle-container">
			<div class="simpay-checkbox-wrap simpay-field-wrap">
				<input
					type="checkbox"
					name="fee_recovery_toggle"
					id="<?php echo esc_attr( self::get_id_attr() ); ?>"
					class="simpay-fee-recovery-toggle"
					<?php checked( true, isset( $settings['on_by_default'] ) ); ?>
				/>
				<?php echo self::get_label(); // WPCS: XSS okay. ?>
			</div>
		</div>

		<?php
		return ob_get_clean();
	}

}
