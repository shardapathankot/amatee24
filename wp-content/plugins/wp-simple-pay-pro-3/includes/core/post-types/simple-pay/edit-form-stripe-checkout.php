<?php
/**
 * Simple Pay: Edit form Stripe Checkout
 *
 * @package SimplePay\Core\Post_Types\Simple_Pay\Edit_Form
 * @copyright Copyright (c) 2022, Sandhills Development, LLC
 * @license http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since 3.8.0
 */

namespace SimplePay\Core\Post_Types\Simple_Pay\Edit_Form;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Adds "Stripe Checkout" Payment Form settings tab content.
 *
 * @since 3.8.0
 *
 * @param int $post_id Current Payment Form ID.
 */
function add_stripe_checkout( $post_id ) {
	$license = simpay_get_license();
	?>
<table>
	<tbody class="simpay-panel-section">

		<?php
		/**
		 * Allows output at the top of "Stripe Checkout" Payment Form
		 * settings tab content.
		 *
		 * @since 3.4.0
		 * @since 3.8.0 Add $post_id parameter.
		 *
		 * @param int $post_id Current Payment Form ID.
		 */
		do_action( 'simpay_admin_before_stripe_checkout_rows', $post_id );
		?>

		<tr class="simpay-panel-field simpay-show-if" data-if="_subscription_type" data-is="disabled">
			<th>
				<label for="_image_url">
					<?php esc_html_e( 'Image', 'simple-pay' ); ?>
				</label>
			</th>
			<td style="border-bottom: 0; padding-bottom: 0;">
				<?php
				$image_url = simpay_get_payment_form_setting(
					$post_id,
					'_image_url',
					'',
					__unstable_simpay_get_payment_form_template_from_url()
				);

				simpay_print_field(
					array(
						'type'    => 'standard',
						'subtype' => 'url',
						'name'    => '_image_url',
						'id'      => '_image_url',
						'value'   => $image_url,
						'class'   => array(
							'simpay-field-text',
							'simpay-field-image-url',
						),
					)
				);
				?>

				<br />

				<button type="button" class="simpay-media-uploader button button-secondary" style="margin-top: 4px;"><?php esc_html_e( 'Choose Image', 'simple-pay' ); ?></button>

				<p class="description">
					<?php esc_html_e( 'Displayed conditionally based on payment form settings.', 'simple-pay' ); ?>
				</p>

				<div class="simpay-image-preview-wrap <?php echo( empty( $image_url ) ? 'simpay-panel-hidden' : '' ); ?>">
					<a href="#" class="simpay-remove-image-preview simpay-remove-icon" aria-label="<?php esc_attr_e( 'Remove image', 'simple-pay' ); ?>" title="<?php esc_attr_e( 'Remove image', 'simple-pay' ); ?>"></a>
					<img src="<?php echo esc_attr( $image_url ); ?>" class="simpay-image-preview" />
				</div>
			</td>
		</tr>

		<tr class="simpay-panel-field">
			<th>
				<label for="_checkout_submit_type">
					<?php esc_html_e( 'Submit Button Type', 'simple-pay' ); ?>
				</label>
			</th>
			<td>
				<?php
				$checkout_submit_type = simpay_get_payment_form_setting(
					$post_id,
					'_checkout_submit_type',
					'pay',
					__unstable_simpay_get_payment_form_template_from_url()
				);

				simpay_print_field(
					array(
						'type'        => 'select',
						'name'        => '_checkout_submit_type',
						'id'          => '_checkout_submit_type',
						'value'       => $checkout_submit_type,
						'options'     => array(
							'book'   => esc_html__( 'Booking', 'simple-pay' ),
							'donate' => esc_html__( 'Donate', 'simple-pay' ),
							'pay'    => esc_html__( 'Pay', 'simple-pay' ),
						),
						'description' => esc_html__(
							'Determines relevant text on the Stripe.com Checkout page, such as the submit button.',
							'simple-pay'
						),
					)
				);
				?>

				<p class="description">
					<?php
					echo wp_kses(
						sprintf(
							/* translators: %1$s Anchor opening tag, do not translate. %2$s Closing anchor tag, do not translate. */
							__( 'Adjust the submit button color in the Stripe %1$sBranding settings%2$s', 'simple-pay' ),
							'<a href="https://dashboard.stripe.com/account/branding" target="_blank" rel="noopener noreferrer">',
							'</a>'
						),
						array(
							'a' => array(
								'href'   => true,
								'target' => true,
								'rel'    => true,
							),
						)
					);
					?>
				</p>
			</td>
		</tr>

		<?php
		/**
		 * Allows output somewhere in the middle of "Stripe Checkout" Payment Form
		 * settings tab content.
		 *
		 * @since 3.0.0
		 *
		 * @param int $form_id Current Payment Form ID.
		 */
		do_action( 'simpay_after_checkout_button_text', $post_id );
		?>

		<tr class="simpay-panel-field">
			<th>
				<strong>
					<?php esc_html_e( 'Customer Information', 'simple-pay' ); ?>
				</strong>
			</th>
			<td>
				<?php
				$enable_shipping_address = simpay_get_payment_form_setting(
					$post_id,
					'_enable_shipping_address',
					'no',
					__unstable_simpay_get_payment_form_template_from_url()
				);

				simpay_print_field(
					array(
						'type'  => 'checkbox',
						'name'  => '_enable_shipping_address',
						'id'    => '_enable_shipping_address',
						'text'  => esc_html__(
							'Collect Shipping Address',
							'simple-pay'
						),
						'value' => $enable_shipping_address,
					)
				);
				?>
				<div style="height: 8px;"></div>

				<?php
				$enable_billing_address = simpay_get_payment_form_setting(
					$post_id,
					'_enable_billing_address',
					'no',
					__unstable_simpay_get_payment_form_template_from_url()
				);

				simpay_print_field(
					array(
						'type'  => 'checkbox',
						'name'  => '_enable_billing_address',
						'id'    => '_enable_billing_address',
						'text'  => esc_html__(
							'Collect Billing Address',
							'simple-pay'
						),
						'value' => $enable_billing_address,
					)
				);
				?>
				<div style="height: 8px;"></div>

				<?php
				$enable_phone = simpay_get_payment_form_setting(
					$post_id,
					'_enable_phone',
					'no',
					__unstable_simpay_get_payment_form_template_from_url()
				);

				simpay_print_field(
					array(
						'type'  => 'checkbox',
						'name'  => '_enable_phone',
						'id'    => '_enable_phone',
						'value' => $enable_phone,
						'text'  => esc_html__(
							'Collect Phone Number',
							'simple-pay'
						),
					)
				);
				?>
				<div style="height: 8px;"></div>

				<?php
				$license = simpay_get_license();

				$enable_tax_id = simpay_get_payment_form_setting(
					$post_id,
					'_enable_tax_id',
					'no',
					__unstable_simpay_get_payment_form_template_from_url()
				);

				$upgrade_title = __(
					'Unlock Customer Tax IDs',
					'simple-pay'
				);

				$upgrade_description = __(
					'We\'re sorry, collecting customer tax IDs is not available in WP Simple Pay Lite. Please upgrade to <strong>WP Simple Pay Pro</strong> to unlock this and other awesome features.',
					'simple-pay'
				);

				$upgrade_url = simpay_pro_upgrade_url(
					'form-stripe-checkout-settings',
					'Stripe Checkout tax ID'
				);

				$upgrade_purchased_url = simpay_docs_link(
					'Stripe Checkout tax ID (already purchased)',
					'upgrading-wp-simple-pay-lite-to-pro',
					'form-stripe-checkout-settings',
					true
				);
				?>

				<label for="_enable_tax_id" class="simpay-field-bool">
					<input
						name="_enable_tax_id"
						type="checkbox"
						id="_enable_tax_id"
						class="simpay-field simpay-field-checkbox simpay-field simpay-field-checkboxes"
						value="yes"
						<?php checked( true, 'yes' === $enable_tax_id ); ?>
						data-available="<?php echo $license->is_lite() ? 'no' : 'yes'; ?>"
						data-upgrade-title="<?php echo esc_attr( $upgrade_title ); ?>"
						data-upgrade-description="<?php echo esc_attr( $upgrade_description ); ?>"
						data-upgrade-url="<?php echo esc_url( $upgrade_url ); ?>"
						data-upgrade-purchased-url="<?php echo esc_url( $upgrade_purchased_url ); ?>"
					/><?php esc_html_e( 'Collect Tax ID', 'simple-pay' ); ?>
				</label>
				<p class="description">
					<?php esc_html_e( 'When enabled Stripe Checkout displays the tax ID inputs depending on your customer’s location.', 'simple-pay' ); ?> <a href="#help/stripe%20checkout"><?php esc_html_e( 'Learn more', 'simple-pay' ); ?></a>
				</p>
			</td>
		</tr>

		<tr class="simpay-panel-field">
			<th>
				<strong><?php esc_html_e( 'Other', 'simple-pay' ); ?></strong>
			</th>
			<td>
				<?php
				$enable_quantity = simpay_get_payment_form_setting(
					$post_id,
					'_enable_quantity',
					'no',
					__unstable_simpay_get_payment_form_template_from_url()
				);

				simpay_print_field(
					array(
						'type'  => 'checkbox',
						'name'  => '_enable_quantity',
						'id'    => '_enable_quantity',
						'value' => $enable_quantity,
						'text'  => esc_html__(
							'Allow quantity adjustment',
							'simple-pay'
						),
					)
				);
				?>
				<div style="height: 8px;"></div>

				<?php
				$enable_promotion_codes = simpay_get_payment_form_setting(
					$post_id,
					'_enable_promotion_codes',
					'no',
					__unstable_simpay_get_payment_form_template_from_url()
				);

				$upgrade_title = __(
					'Unlock Coupon Codes',
					'simple-pay'
				);

				$upgrade_description = __(
					'We\'re sorry, using coupons with is not available in WP Simple Pay Lite. Please upgrade to <strong>WP Simple Pay Pro</strong> to unlock this and other awesome features.',
					'simple-pay'
				);

				$upgrade_url = simpay_pro_upgrade_url(
					'form-stripe-checkout-settings',
					'Stripe Checkout coupons'
				);

				$upgrade_purchased_url = simpay_docs_link(
					'Stripe Checkout coupons (already purchased)',
					$license->is_lite()
						? 'upgrading-wp-simple-pay-lite-to-pro'
						: 'activate-wp-simple-pay-pro-license',
					'form-stripe-checkout-settings',
					true
				);
				?>

				<label for="_enable_promotion_codes" class="simpay-field-bool">
					<input
						name="_enable_promotion_codes"
						type="checkbox"
						id="_enable_promotion_codes"
						class="simpay-field simpay-field-checkbox simpay-field simpay-field-checkboxes"
						value="yes"
						<?php checked( true, 'yes' === $enable_promotion_codes ); ?>
						data-available="<?php echo $license->is_lite() ? 'no' : 'yes'; ?>"
						data-upgrade-title="<?php echo esc_attr( $upgrade_title ); ?>"
						data-upgrade-description="<?php echo esc_attr( $upgrade_description ); ?>"
						data-upgrade-url="<?php echo esc_url( $upgrade_url ); ?>"
						data-upgrade-purchased-url="<?php echo esc_url( $upgrade_purchased_url ); ?>"
					/><?php esc_html_e( 'Allow coupons', 'simple-pay' ); ?>
				</label>
			</td>
		</tr>

		<?php
		/**
		 * Allows further output at the bottom of "Stripe Checkout" Payment Form
		 * settings tab content.
		 *
		 * @since 3.4.0
		 */
		do_action( 'simpay_admin_after_stripe_checkout_rows' );
		?>

	</tbody>
</table>

	<?php
	/**
	 * Allows output at the top of "Stripe Checkout" Payment Form
	 * settings tab content.
	 *
	 * @since 3.0.0
	 */
	do_action( 'simpay_admin_after_stripe_checkout' );
}
add_action( 'simpay_form_settings_meta_stripe_checkout_panel', __NAMESPACE__ . '\\add_stripe_checkout' );
