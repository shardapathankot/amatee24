<?php
/**
 * Custom Field: Fee Recovery Toggle
 *
 * @package SimplePay\Pro\Post_Types\Simple_Pay\Edit_Form\Custom_Fields
 * @copyright Copyright (c) 2022, Sandhills Development, LLC
 * @license http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since 4.6.6
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$counter = absint( $counter );
?>

<tr class="simpay-panel-field">
	<th>
		<label for="<?php echo 'simpay-fee-recovery-toggle-label-' . $counter; ?>">
			<?php esc_html_e( 'Label', 'simple-pay' ); ?>
		</label>
	</th>
	<td>
		<?php
		simpay_print_field(
			array(
				'type'       => 'standard',
				'subtype'    => 'text',
				'name'       => '_simpay_custom_field[fee_recovery_toggle][' . $counter . '][label]',
				'id'         => 'simpay-fee-recovery-toggle-label-' . $counter,
				'value'      => isset( $field['label'] )
					? $field['label']
					: 'I will cover the processing fee',
				'class'      => array(
					'simpay-field-text',
					'simpay-label-input',
				),
				'attributes' => array(
					'data-field-key' => $counter,
				),
			)
		);
		?>
	</td>
</tr>

<tr class="simpay-panel-field">
	<th>
		<label for="<?php echo 'simpay-fee-recovery-enabled-' . $counter; ?>">
			<?php esc_html_e( 'Checked by default', 'simple-pay' ); ?>
		</label>
	</th>
	<td>
		<?php
		simpay_print_field(
			array(
				'type'  => 'checkbox',
				'name'  => '_simpay_custom_field[fee_recovery_toggle][' . $counter . '][on_by_default]',
				'id'    => 'simpay-fee-recovery-on-by-default-' . $counter,
				'value' => isset( $field['on_by_default'] )
					? 'yes'
					: '',
			)
		);
		?>
	</td>
</tr>
