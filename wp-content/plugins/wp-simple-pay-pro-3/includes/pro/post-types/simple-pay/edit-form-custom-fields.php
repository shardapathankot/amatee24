<?php
/**
 * Simple Pay: Edit form custom fields
 *
 * @package SimplePay\Pro\Post_Types\Simple_Pay\Edit_Form
 * @copyright Copyright (c) 2022, Sandhills Development, LLC
 * @license http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since 3.8.0
 */

namespace SimplePay\Pro\Post_Types\Simple_Pay\Edit_Form;

use SimplePay\Core\Utils;
use SimplePay\Core\Post_Types\Simple_Pay\Edit_Form as Core_Edit_Form;
use function SimplePay\Pro\Payment_Methods\get_payment_method;
use function SimplePay\Pro\Payment_Methods\get_payment_methods;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get custom field option group labels.
 *
 * @since 3.8.0
 *
 * @return array Group label names.
 */
function get_custom_field_type_groups() {
	return Core_Edit_Form\get_custom_field_type_groups();
}

/**
 * Get the available custom field types.
 *
 * @since 3.8.0
 *
 * @return array $fields Custom fields.
 */
function get_custom_field_types() {
	return Core_Edit_Form\get_custom_field_types();
}

/**
 * Get a grouped list of custom field options.
 *
 * @since 3.8.0
 *
 * @param array $options Flat list of options.
 * @return array $options Grouped list of options.
 */
function get_custom_fields_grouped( $options = array() ) {
	return Core_Edit_Form\get_custom_fields_grouped();
}

/**
 * Adds "Custom Fields" Payment Form settings tab content.
 *
 * @since 3.8.0
 *
 * @param int $post_id Current Payment Form ID.
 */
function add_custom_fields( $post_id ) {
	$field_groups = get_custom_fields_grouped();
	$field_types  = get_custom_field_types();

	if ( empty( $field_groups ) ) {
		return;
	}

	$fields = simpay_get_payment_form_setting(
		$post_id,
		'fields',
		array(
			array(
				'type'  => 'email',
				'label' => 'Email Address',
			),
			array(
				'type'  => 'plan_select',
				'label' => 'Price Options',
			),
			array(
				'type'  => 'card',
				'label' => 'Payment Method',
			),
			array(
				'type' => 'checkout_button',
			),
		),
		__unstable_simpay_get_payment_form_template_from_url()
	);

	wp_nonce_field( 'simpay_custom_fields_nonce', 'simpay_custom_fields_nonce' );
	?>

<table>
	<tbody class="simpay-panel-section">
		<tr class="simpay-panel-field">
			<th>
				<label for="custom-field-select">
					<?php esc_html_e( 'Form Fields', 'simple-pay' ); ?>
				</label>
			</th>
			<td style="border-bottom: 0;">
				<div class="toolbar toolbar-top">
					<select name="simpay_field_select" id="custom-field-select" class="simpay-field-select">
						<option value=""><?php esc_html_e( 'Choose a field&hellip;', 'simple-pay' ); ?></option>
							<?php foreach ( $field_groups as $group => $options ) : ?>
								<optgroup label="<?php echo esc_attr( $group ); ?>">
									<?php
									foreach ( $options as $option ) :
										if ( ! isset( $option['active'] ) || ! $option['active'] ) :
											continue;
										endif;

										$disabled   = ! isset( $option['repeatable'] ) || ( isset( $fields[ $option['type'] ] ) && ! $option['repeatable'] );
										$repeatable = isset( $option['repeatable'] ) && true === $option['repeatable'];
										?>
										<option
											value="<?php echo esc_attr( $option['type'] ); ?>"
											data-repeatable="<?php echo esc_attr( $repeatable ? 'true' : 'false' ); ?>"
											<?php disabled( true, $disabled ); ?>
										>
											<?php echo esc_html( $option['label'] ); ?>
										</option>
									<?php endforeach; ?>
								</optgroup>
							<?php endforeach; ?>
						</optgroup>
					</select>

					<button type="button" class="button add-field">
						<?php esc_html_e( 'Add Field', 'simple-pay' ); ?>
					</button>
				</div>
			</td>
		</tr>
		<tr class="simpay-panel-field">
			<td>
				<div id="simpay-custom-fields-wrap" class="panel simpay-metaboxes-wrapper">
					<div class="simpay-custom-fields simpay-metaboxes ui-sortable">
						<?php
						foreach ( $fields as $k => $field ) :
							// Don't render settings for custom field types that don't exist,
							// possibly from an upgrade or downgrade.
							if ( ! isset( $field_types[ $field['type'] ] ) ) :
								continue;
							endif;

							$counter = $k + 1;

							echo get_custom_field( $field['type'], $counter, $field, $post_id ); // WPCS: XSS okay.
						endforeach;
						?>
					</div>
				</div>
			</td>
		</tr>
	</tbody>
</table>

	<?php
	/** This filter is documented in includes/core/post-types/simple-pay/edit-form-custom-fields.php */
	do_action( 'simpay_admin_after_custom_fields' );

	/**
	 * Allows further output after "Custom Fields" Payment Form
	 * settings tab content.
	 *
	 * @since 3.0.0
	 */
	do_action( 'simpay_custom_field_panel' );
}
add_action(
	'simpay_form_settings_meta_form_display_panel',
	__NAMESPACE__ . '\\add_custom_fields'
);

remove_action(
	'simpay_form_settings_meta_form_display_panel',
	'SimplePay\Core\Post_Types\Simple_Pay\Edit_Form\__unstable_add_custom_fields'
);

/**
 * Retrieves the markup for a custom field.
 *
 * @since 3.8.0
 * @since 4.6.0 Added $post_id parameter.
 *
 * @param int   $type    Custom field type.
 * @param int   $counter Custom field counter.
 * @param array $field   Custom field arguments.
 * @param int   $post_id Payment form ID.
 * @return string Custom field markup.
 */
function get_custom_field( $type, $counter, $field, $post_id ) {
	$field_types = get_custom_field_types();

	// Generate a label.
	$accordion_label = '';

	if ( isset( $field['label'] ) && ! empty( $field['label'] ) ) {
		$accordion_label = $field['label'];
	} elseif ( isset( $field['placeholder'] ) && ! empty( $field['placeholder'] ) ) {
		$accordion_label = $field['placeholder'];
	} else {
		$accordion_label = $field_types[ $type ]['label'];
	}

	switch ( $type ) {
		case 'total_amount':
			$accordion_label = esc_html__( 'Amount Breakdown', 'simple-pay' );
			break;
		case 'card':
			$accordion_label_base = $accordion_label;
			$accordion_label     .= sprintf(
				'<div class="simpay-field-icons">%s</div>',
				__unstable_get_payment_methods_accordion_label_icons()
			);
			break;
		case 'payment_request_button':
			$accordion_label_base = __( '1-Click Payment Button', 'simple-pay' );
			$accordion_label      = $accordion_label_base;
			break;
		default:
			$accordion_label = $accordion_label;
	}

	// Find the template.
	$admin_field_template = SIMPLE_PAY_INC . 'pro/post-types/simple-pay/edit-form-custom-fields/custom-fields-' . simpay_dashify( $type ) . '-html.php';

	/**
	 * Filters the template for outputting a Payment Form's custom field.
	 *
	 * @since 3.0.0
	 *
	 * @param string $admin_field_template Field path.
	 */
	$admin_field_template = apply_filters( 'simpay_admin_' . esc_attr( $type ) . '_field_template', $admin_field_template );

	$uid = isset( $field['uid'] ) ? $field['uid'] : $counter;

	switch ( $type ) {
		case 'payment_request_button':
			$type_label = sprintf(
				'<div class="simpay-field-icons">%s</div>',
				__unstable_get_payment_request_button_accordion_label_icons()
			);

			break;
		default:
			$type_label = $field_types[ $type ]['label'];
	}

	ob_start();
	?>

	<div
		id="simpay-custom-field-<?php echo esc_attr( simpay_dashify( $type ) . $counter ); ?>-postbox"
		class="postbox closed simpay-field-metabox simpay-metabox simpay-custom-field-<?php echo simpay_dashify( $type ); ?>"
		data-type="<?php echo esc_attr( $type ); ?>"
		aria-expanded="false"
	>
		<button type="button" class="simpay-handlediv">
			<span class="screen-reader-text">
				<?php
				printf(
					/* translators: %s Custom field label */
					__( 'Toggle custom field: %s', 'simple-pay' ),
					strip_tags( $accordion_label )
				);
				?>
			</span>
			<span class="toggle-indicator" aria-hidden="true"></span>
		</button>

		<h2 class="simpay-hndle ui-sortable-handle">
			<span class="custom-field-dashicon dashicons <?php echo 'payment_button' !== $type ? 'dashicons-menu-alt2" style="cursor: move;' : ''; ?>"></span>

			<strong>
				<?php if ( 'payment_request_button' === $type ) : ?>
					<span
						class="dashicons dashicons-warning simpay-show-if"
						data-if="_tax_status"
						data-is="automatic"
						style="margin-right: 5px;"
					></span>
				<?php endif; ?>

				<?php echo $accordion_label; ?>
			</strong>

			<?php
			if (
				( 'card' !== $type && $type_label !== $accordion_label ) ||
				( 'card' === $type && $accordion_label_base !== $type_label )
			) :
				?>
			<div class="simpay-field-type">
				<?php echo $type_label; ?>
			</div>
			<?php endif; ?>
			<?php if ( 'payment_request_button' === $type ) : ?>
				<div
					class="simpay-field-type simpay-show-if"
					data-if="_tax_status"
					data-is="automatic"
					style="display: flex; align-items: center;"
				>
					<?php
					esc_html_e(
						'Incompatible with automatic taxes',
						'simple-pay'
					);
					?>
				</div>
			<?php endif; ?>
		</h2>

		<div class="simpay-field-data simpay-metabox-content inside">
			<table>
				<?php
				if ( file_exists( $admin_field_template ) ) :
					simpay_print_field(
						array(
							'type'    => 'standard',
							'subtype' => 'hidden',
							'name'    => '_simpay_custom_field[' . $type . '][' . $counter . '][id]',
							'id'      => 'simpay-' . $type . '-' . $counter . '-id',
							'value'   => ! empty( $field['id'] ) ? $field['id'] : $uid,
						)
					);

					simpay_print_field(
						array(
							'type'    => 'standard',
							'subtype' => 'hidden',
							'id'      => 'simpay-' . $type . '-' . $counter . '-uid',
							'class'   => array( 'field-uid' ),
							'name'    => '_simpay_custom_field[' . $type . '][' . $counter . '][uid]',
							'value'   => $uid,
						)
					);

					simpay_print_field(
						array(
							'type'    => 'standard',
							'subtype' => 'hidden',
							'id'      => 'simpay-' . $type . '-' . $counter . '-order',
							'class'   => array( 'field-order' ),
							'name'    => '_simpay_custom_field[' . $type . '][' . $counter . '][order]',
							'value'   => isset( $field['order'] ) ? $field['order'] : $counter,
						)
					);

					include $admin_field_template;

					/**
					 * Allows further output after a specific custom field type.
					 *
					 * @since 3.0.0
					 */
					do_action( 'simpay_after_' . $type . '_meta' );
				endif;
				?>
			</table>

			<div class="simpay-metabox-content-actions">
				<?php if ( 'plan_select' !== $type ) : ?>
				<button type="button" class="button-link simpay-remove-field-link">
					<?php esc_html_e( 'Remove', 'simple-pay' ); ?>
				</button>
				<?php else : ?>
					<div></div>
				<?php endif; ?>

				<div class="simpay-metabox-content-actions__field-id">
					<label for="<?php echo esc_attr( 'simpay-' . $type . '-' . $counter . '-' . $uid ); ?>">
						<?php esc_html_e( 'Field ID', 'simple-pay' ); ?>:
					</label>

					<input type="text" value="<?php echo absint( $uid ); ?>" id="<?php echo esc_attr( 'simpay-' . $type . '-' . $counter . '-' . $uid ); ?>" readonly />

					<a href="<?php echo esc_url( simpay_docs_link( 'Find out more about the field ID.', 'custom-form-fields#field-id', 'payment-form-field-settings', true ) ); ?>" class="simpay-docs-icon" target="_blank" rel="noopener noreferrer">
						<span class="dashicons dashicons-editor-help"></span>
						<span class="screen-reader-text"><?php esc_html_e( 'Find out more about the field ID.', 'simple-pay' ); ?></span>
					</a>
				</div>
			</div>
		</div>
	</div>

	<?php
	return ob_get_clean();
}

/**
 * Ensures Payment Forms have required fields and remove unnecessary fields.
 *
 * @since 3.8.0
 *
 * @param array  $fields Payment Form custom fields.
 * @param int    $form_id Payment Form ID.
 * @param string $form_display_type Payment Form display type.
 * @return array
 */
function add_missing_custom_fields( $fields, $form_id, $form_display_type = 'embedded' ) {
	return simpay_payment_form_add_missing_custom_fields(
		$fields,
		$form_id,
		$form_display_type
	);
}

/**
 * Generate a label for the "Payment Methods" custom field based on the enabled
 * Payment Methods.
 *
 * @since 4.4.4
 *
 * @return string
 */
function __unstable_get_payment_methods_accordion_label_icons() {
	global $post;

	$saved_payment_methods = simpay_get_payment_form_setting(
		$post->ID,
		'payment_methods',
		array(),
		__unstable_simpay_get_payment_form_template_from_url()
	);

	$payment_methods = get_payment_methods();

	foreach ( $payment_methods as $payment_method ) {
		$icons[] = sprintf(
			'<span class="simpay-payment-method-title-icon-%s" style="display: %s; align-items: center;">%s</span>',
			$payment_method->id,
			in_array(
				$payment_method->id,
				array_keys( $saved_payment_methods ),
				true
			)
				? 'block'
				: 'none',
			$payment_method->icon_sm
		);
	}

	return implode( '', $icons );
}

/**
 * Generate a label for the "1-Click Payment Button" custom field including icons.
 *
 * @since 4.6.5
 *
 * @return string
 */
function __unstable_get_payment_request_button_accordion_label_icons() {
	$icons = array(
		'<svg width="27" height="16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 4.14c0-1.0608 0-1.5912.132-2.0224.14399-.46769.400202-.89305.746295-1.239005C1.22439.532642 1.64986.276602 2.1176.1328 2.5488 0 3.0792 0 4.14 0h18.4696c1.0608 0 1.5912 0 2.0224.1328.4676.143914.8929.400004 1.2388.745951.346.345949.6021.771249.746 1.238849.1328.432.1328.9616.1328 2.0224v7.72c0 1.0608 0 1.5912-.1328 2.0224-.1439.4676-.4.8929-.746 1.2388-.3459.346-.7712.6021-1.2388.746C24.2 16 23.6704 16 22.6096 16H4.14c-1.0608 0-1.592 0-2.0224-.1328-.46774-.1438-.89321-.3998-1.239305-.7458-.346093-.3459-.602305-.7713-.746295-1.239C0 13.4504 0 12.9208 0 11.86V4.14Z" fill="#635BFF"/><path d="M6.568 4.0936c0-.4648.3744-.8432.8432-.8432.4656 0 .84.3784.844.8432-.00947.21748-.10253.42292-.25977.57346-.15725.15055-.36654.23458-.58423.23458-.21769 0-.42698-.08403-.58422-.23458-.15725-.15054-.25031-.35598-.25978-.57346h.0008Zm-2.9016-.7528h1.5064v9.1064H3.6664V3.3408Zm20.3544 2.6088c-.8688 1.856-1.84 3.2016-1.84 3.2016l2.0616 3.296h-1.7776l-1.2672-2.0288c-1.276 1.4528-2.5392 2.1648-3.7568 2.1648-1.4864 0-2.0912-1.0616-2.0912-2.2672l.0024-.4576v-.0016l.0016-.4008c0-1.5928-.168-2.0456-.704-1.9712-1.028.14-2.596 2.4856-3.616 4.9624h-1.416V5.9496h1.5056v3.2432c.86-1.4488 1.6424-2.688 2.9096-3.1688.7368-.28 1.3584-.1608 1.6792-.0168 1.1648.5144 1.1648 1.7736 1.148 3.4568l-.0016.3328v.0008c-.0016.1232-.0024.2504-.0024.3824 0 .6136.168.88.584.9216.404.0416.712-.156.712-.156V3.3408h1.5024v6.5224s1.3088-1.1936 2.6872-3.9136h1.6792Zm-15.856 0H6.6584v6.4976h1.5064V5.9496Z" fill="#fff"/></svg>',
		'<svg width="16" height="16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15.7089 8.18342c0-.54534-.0606-1.09068-.1212-1.63603H8.0135v3.09028h4.3021c-.1817.96953-.7271 1.87843-1.5754 2.42373v1.9996h2.6055c1.5149-1.3937 2.3632-3.4538 2.3632-5.87758Z" fill="#4285F4"/><path d="M8.0135 16c2.1814 0 3.9992-.7271 5.3322-1.939l-2.6055-1.9996c-.7271.4848-1.63602.7877-2.7267.7877-2.06018 0-3.87799-1.3936-4.48393-3.33262H.863457v2.06022C2.25711 14.3034 4.98382 16 8.0135 16Z" fill="#34A853"/><path d="M3.52958 9.51648c-.36357-.9695-.36357-2.06018 0-3.09027V4.36603H.863459c-1.151279 2.24196-1.151279 4.90808 0 7.21067L3.52958 9.51648Z" fill="#FBBC04"/><path d="M8.0135 3.15413c1.15128 0 2.242.42415 3.0903 1.21187l2.3025-2.30256C11.9521.730383 10.0131-.0573336 8.07409.00326002 5.04441.00326002 2.25711 1.69988.924049 4.42659L3.59017 6.48677c.54534-1.93899 2.36315-3.33264 4.42333-3.33264Z" fill="#EA4335"/></svg>',
		'<svg width="14" height="16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6.47043 3.6899c.90828.07569 1.81657-.45414 2.38425-1.12589.55821-.69068.9272-1.617882.83259-2.56401-.80421.0378451-1.79765.529832-2.36532 1.22051-.52037.59606-.96505 1.56111-.85152 2.46939ZM6.61235 4.61711c.62445 0 1.75034-.82313 3.06546-.74744.51089.03784 1.98689.18922 2.93299 1.58949-.0757.05677-1.7503 1.02182-1.7314 3.04654.0189 2.4221 2.1193 3.2263 2.1382 3.2452-.0189.0568-.3311 1.1448-1.0975 2.2613-.6717.9839-1.3624 1.949-2.4599 1.9679-1.05967.0189-1.40973-.6339-2.63024-.6339-1.21104 0-1.60842.615-2.61131.6528-1.05967.0379-1.86388-1.0407-2.53563-2.0247C.311136 11.9874-.739066 8.37324.680126 5.93223 1.3708 4.71172 2.62915 3.94536 3.98211 3.92643c1.04074-.01892 1.99634.69068 2.63024.69068Z" fill="#000"/></svg>',
	);

	return implode( '', $icons );
}
