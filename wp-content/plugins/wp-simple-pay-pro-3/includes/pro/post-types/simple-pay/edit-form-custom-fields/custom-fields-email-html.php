<?php
/**
 * Custom Field: Customer Name
 *
 * @package SimplePay\Pro\Post_Types\Simple_Pay\Edit_Form\Custom_Fields
 * @copyright Copyright (c) 2022, Sandhills Development, LLC
 * @license http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since 3.9.0
 */

use SimplePay\Core\Utils;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Do intval on counter here so we don't have to run it each time we use it below. Saves some function calls.
$counter = absint( $counter );

$type = simpay_get_payment_form_setting(
	$post_id,
	'type',
	'stripe_checkout',
	__unstable_simpay_get_payment_form_template_from_url()
);

$link_enabled = (
	isset( $field['link']['enabled'] ) &&
	'yes' === $field['link']['enabled']
) && 'stripe_checkout' !== $type;

?>

<?php if ( simpay_is_upe() ) : ?>
<tr class="simpay-panel-field simpay-email-setting enable-link">
	<th>
		<label for="<?php echo 'simpay-customer-name-link-' . $counter; ?>">
			<?php esc_html_e( 'Offer Saved Payment Methods', 'simple-pay' ); ?>
		</label>
	</th>
	<td>
		<?php
		simpay_print_field(
			array(
				'type'  => 'checkbox',
				'name'  => '_simpay_custom_field[email][' . $counter . '][link][enabled]',
				'id'    => 'simpay-email-link-' . $counter,
				'class' => array(
					'simpay-email-link-enabled',
				),
				'value' => $link_enabled ? 'yes' : 'no',
				'text'  => wp_kses(
					sprintf(
						/* translators: %1$s Opening anchor tag, do not translate. %2$s Closing anchor tag, do not translate. */
						__(
							'Boost conversions by offering previously saved payment methods %1$sStripe Link%2$s',
							'simple-pay'
						),
						'<a href="https://stripe.com/link" target="_blank" rel="noopener noreferrer" class="simpay-external-link">',
						Utils\get_external_link_markup() . '</a>'
					),
					array(
						'a'    => array(
							'href'   => array(),
							'target' => array(),
							'rel'    => array(),
							'class'  => array(
								'simpay-external-link',
							),
						),
						'span' => array(
							'class' => array(
								'screen-reader-text',
							),
						),
					)
				),
			)
		);
		?>
		<div
			class="simpay-panel-field notice inline notice-info simpay-show-if"
			data-if=".simpay-email-link-enabled"
			data-is="yes"
			style="margin-top: 10px;"
		>
			<p>
				<?php
				esc_html_e(
					'The Link authentication field will automatically display a localized email field.',
					'simple-pay'
				);
				?>
			</p>
		</div>
	</td>
</tr>
<?php endif; ?>

<tr
	class="simpay-panel-field simpay-email-setting <?php if ( simpay_is_upe() ) : ?>
		simpay-show-if disable-link
	<?php endif; ?>"
	<?php if ( simpay_is_upe() ) : ?>
	data-if=".simpay-email-link-enabled"
	data-is="no"
	<?php else : ?>
		style="display: block !important;"
	<?php endif; ?>
>
	<th>
		<label for="<?php echo 'simpay-email-label-' . $counter; ?>"><?php esc_html_e( 'Label', 'simple-pay' ); ?></label>
	</th>
	<td>
		<?php

		simpay_print_field(
			array(
				'type'        => 'standard',
				'subtype'     => 'text',
				'name'        => '_simpay_custom_field[email][' . $counter . '][label]',
				'id'          => 'simpay-email-label-' . $counter,
				'value'       => isset( $field['label'] ) ? $field['label'] : 'Email Address',
				'class'       => array(
					'simpay-field-text',
					'simpay-label-input',
				),
				'attributes'  => array(
					'data-field-key' => $counter,
				),
				'description' => simpay_form_field_label_description(),
			)
		);

		?>
	</td>
</tr>

<tr
	class="simpay-panel-field simpay-email-setting<?php if ( simpay_is_upe() ) : ?>
		simpay-show-if disable-link
	<?php endif; ?>"
	<?php if ( simpay_is_upe() ) : ?>
	data-if=".simpay-email-link-enabled"
	data-is="no"
	<?php else : ?>
		style="display: block !important;"
	<?php endif; ?>
>
	<th>
		<label for="<?php echo 'simpay-email-placeholder-' . $counter; ?>"><?php esc_html_e( 'Placeholder', 'simple-pay' ); ?></label>
	</th>
	<td>
		<?php

		simpay_print_field(
			array(
				'type'        => 'standard',
				'subtype'     => 'text',
				'name'        => '_simpay_custom_field[email][' . $counter . '][placeholder]',
				'id'          => 'simpay-email-placeholder-' . $counter,
				'value'       => isset( $field['placeholder'] ) ? $field['placeholder'] : '',
				'class'       => array(
					'simpay-field-text',
				),
				'attributes'  => array(
					'data-field-key' => $counter,
				),
				'description' => simpay_placeholder_description(),
			)
		);

		?>
	</td>
</tr>

<tr class="simpay-panel-field">
	<th>
		<label for="<?php echo 'simpay-customer-name-required-' . $counter; ?>"><?php esc_html_e( 'Required', 'simple-pay' ); ?></label>
	</th>
	<td>
		<?php

		simpay_print_field(
			array(
				'type'        => 'checkbox',
				'name'        => '_simpay_custom_field[email][' . $counter . '][required]',
				'id'          => 'simpay-email-required-' . $counter,
				'value'       => 'yes',
				'attributes'  => array(
					'disabled' => true,
				),
				'description' => esc_html__( 'Email address is required when used.', 'simple-pay' ),
			)
		);

		?>
	</td>
</tr>
