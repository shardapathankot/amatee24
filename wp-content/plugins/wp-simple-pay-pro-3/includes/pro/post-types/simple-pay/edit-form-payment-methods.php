<?php
/**
 * Simple Pay: Edit form Payment Methods
 *
 * @package SimplePay\Pro\Post_Types\Simple_Pay\Edit_Form
 * @copyright Copyright (c) 2022, Sandhills Development, LLC
 * @license http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since 3.8.0
 *
 * @var int                             $post_id The ID of the payment form.
 * @var array                           $payment_methods List of enabled Payment Methods and configuration.
 * @var array<string, mixed>            $custom_fields List of custom fields.
 * @var array                           $available_payment_methods List of available Payment Methods.
 * @var string                          $form_type Payment form type.
 * @var string                          $account_country Stripe account country.
 * @var \SimplePay\Core\License\License $license License.
 * @var \SimplePay\Core\Abstracts\Form  $form Payment form object.
 */

namespace SimplePay\Pro\Admin\Metaboxes\Views\Partials;

use SimplePay\Core\i18n;
use SimplePay\Core\Settings;
use SimplePay\Core\Utils;
use function SimplePay\Pro\Post_Types\Simple_Pay\Util\get_custom_fields;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<tr class="simpay-panel-field">
	<th>
		<div style="display: flex; align-items: center;">
			<strong>
				<?php esc_html_e( 'Payment Methods', 'simple-pay' ); ?>
			</strong>
			<select
				class="simpay-panel-field-payment-method-filter"
				style="font-size: 12px; min-height: 26px; margin-left: 10px; font-weight: normal;"
			>
				<option value="popular">
					<?php esc_html_e( 'Popular', 'simple-pay' ); ?>
				</option>
				<option value="all">
					<?php esc_html_e( 'All', 'simple-pay' ); ?>
				</option>
			</select>
		</div>
	</th>
	<td>
		<div class="simpay-payment-methods">
		<?php
		foreach ( $available_payment_methods as $payment_method ) :
			if ( ! is_a( $payment_method, 'SimplePay\Pro\Payment_Methods\Payment_Method' ) ) {
				continue;
			}

			$disabled = false === $payment_method->is_available();

			// Disable Payment Methods that do not support automatic tax.
			$automatic_tax_restricted_payment_methods = array(
				'ach-debit',
				'fpx',
			);

			if (
				! simpay_is_upe() &&
				(
					in_array( $payment_method->id, $automatic_tax_restricted_payment_methods, true ) &&
					'automatic' === $tax_status &&
					'stripe_checkout' !== $form_type
				)
			) {
				$disabled = true;
			}

			$checked = (
				! $disabled &&
				isset(
					$payment_methods[ $payment_method->id ],
					$payment_methods[ $payment_method->id ]['id']
				)
			);

			$id = sprintf(
				'simpay-payment-method-%s',
				$payment_method->id
			);

			$currency_limitations = count( i18n\get_stripe_currencies() ) !==
				count( $payment_method->currencies );

			$is_popular = 'popular' === $payment_method->scope;

			$configure_title = sprintf(
				/* translators: Payment Method name */
				__( 'Configure "%s" Payment Method', 'simple-pay' ),
				esc_html( $payment_method->nicename )
			);

			$fee_recovery_enabled = (
				isset( $payment_methods[ $payment_method->id ]['fee_recovery'] ) &&
				'yes' === $payment_methods[ $payment_method->id ]['fee_recovery']['enabled']
			);

			$has_zero_decimal_price = array_filter(
				simpay_get_payment_form_prices( $form ),
				function( $price ) {
					return simpay_is_zero_decimal( $price->currency );
				}
			);
			$has_zero_decimal_price = ! empty( $has_zero_decimal_price );

			$fee_recovery_percent = $fee_recovery_enabled
				? $payment_methods[ $payment_method->id ]['fee_recovery']['percent']
				: '';

			$fee_recovery_amount = $fee_recovery_enabled
				? (
					$has_zero_decimal_price
						? $payment_methods[ $payment_method->id ]['fee_recovery']['amount']
						: simpay_convert_amount_to_dollars(
							$payment_methods[ $payment_method->id ]['fee_recovery']['amount']
						)
				)
				: '';

			$upgrade_title = sprintf(
				/* translators: %s Payment Method name. */
				esc_html__(
					'Unlock the "%s" Payment Method',
					'simple-pay'
				),
				$payment_method->name
			);

			$upgrade_description = sprintf(
				/* translators: %1$s Payment method name. %2$s Payment method license requirement. */
				__(
					'We\'re sorry, the %1$s payment method is not available on your plan. Please upgrade to the %2$s plan to unlock this and other awesome features.',
					'simple-pay'
				),
				$payment_method->name,
				(
					'<strong>' .
					ucfirst( current( $payment_method->licenses ) ) .
					'</strong>'
				)
			);

			$upgrade_url = simpay_pro_upgrade_url(
				'form-payment-method-settings',
				sprintf( '%s Payment Method', $payment_method->name )
			);

			$upgrade_purchased_url = simpay_docs_link(
				sprintf( '%s Payment Method (already purchased)', $payment_method->name ),
				$license->is_lite()
					? 'upgrading-wp-simple-pay-lite-to-pro'
					: 'activate-wp-simple-pay-pro-license',
				'form-payment-method-settings',
				true
			);

			$upgrade_fee_recovery = 'card' === $payment_method->id
				? 'yes'
				: $license->is_pro( 'plus', '>=' );

			$upgrade_fee_recovery_title = sprintf(
				/* translators: %s Payment Method name. */
				esc_html__(
					'Unlock "Fee Recovery" for %s',
					'simple-pay'
				),
				$payment_method->name
			);

			$upgrade_fee_recovery_description = sprintf(
				/* translators: %1$s Payment method name. %2$s Payment method license requirement. */
				__(
					'We\'re sorry, recovering Stripe processing fees with the %1$s payment method is not available on your plan. Please upgrade to the %2$s plan to unlock this and other awesome features.',
					'simple-pay'
				),
				$payment_method->name,
				'<strong>' . __( 'Professional', 'simple-pay' ) . '</strong>'
			);

			$upgrade_fee_recovery_url = simpay_pro_upgrade_url(
				'form-payment-method-settings',
				sprintf( 'Fee Recovery - %s Payment Method', $payment_method->name )
			);

			$upgrade_fee_recovery_purchased_url = simpay_docs_link(
				sprintf(
					'Fee Recovery - %s Payment Method Payment Method (already purchased)',
					$payment_method->name
				),
				$license->is_lite()
					? 'upgrading-wp-simple-pay-lite-to-pro'
					: 'activate-wp-simple-pay-pro-license',
				'form-payment-method-settings',
				true
			);
			?>
			<div
				class="simpay-panel-field-payment-method"
				data-payment-method='<?php echo wp_json_encode( $payment_method->to_array_json(), JSON_HEX_QUOT | JSON_HEX_APOS ); ?>'
				style="display: <?php echo esc_attr( $is_popular || $checked ? 'block' : 'none' ); ?>"
			>
				<label for="<?php echo esc_attr( $id ); ?>">
					<div class="simpay-panel-field-payment-method__enable">
						<span
							class="dashicons dashicons-menu-alt2 simpay-panel-field-payment-method__move simpay-show-if"
							style="margin: 1px 4px 0 5px; cursor: move;"
							data-if="_form_type"
							data-is="on-site"
						></span>

						<div class="simpay-panel-field-payment-method__icon">
							<?php echo $payment_method->icon; // WPCS: XSS ok. ?>
						</div>

						<input
							name="_simpay_payment_methods[<?php echo esc_attr( $payment_method->id ); ?>][id]"
							type="checkbox"
							value="<?php echo esc_attr( $payment_method->id ); ?>"
							id="<?php echo esc_attr( $id ); ?>"
							class="simpay-field simpay-field-checkbox simpay-field simpay-field-checkboxes simpay-payment-method"
							<?php checked( true, $checked && $payment_method->is_country_supported() ); ?>
							<?php disabled( true, $disabled ); ?>
							data-available="no"
							data-payment-method="<?php echo esc_attr( $id ); ?>"
							<?php if ( false === $payment_method->is_available() ) : ?>
							data-disabled
							<?php endif; ?>
							<?php if ( true === $payment_method->recurring ) : ?>
							data-recurring
							<?php endif; ?>
							data-upgrade-title="<?php echo esc_attr( $upgrade_title ); ?>"
							data-upgrade-description="<?php echo esc_attr( $upgrade_description ); ?>"
							data-upgrade-url="<?php echo esc_url( $upgrade_url ); ?>"
							data-upgrade-purchased-url="<?php echo esc_url( $upgrade_purchased_url ); ?>"
						>

						<?php if ( false === $payment_method->is_country_supported() ) : ?>
							<span>
							<?php
							echo wp_kses(
								sprintf(
									/* translators: %1$s Payment Method name. %2$s Opening anchor tag, do not translate. %3$s Closing anchor tag, do not translate. */
									__(
										'%1$s is not available in your %2$sStripe account\'s country%3$s',
										'simple-pay'
									),
									$payment_method->nicename,
									sprintf(
										'<a href="%s" target="_blank" rel="noopener noreferrer">',
										Settings\get_url(
											array(
												'section' => 'stripe',
												'subsection' => 'account',
												'setting' => 'account_country',
											)
										)
									),
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
							</span>
						<?php else : ?>
							<?php echo esc_html( $payment_method->name ); ?>
						<?php endif; ?>

						<div style="display: flex; align-items: center; margin-left: auto;">
							<?php if ( true === $payment_method->is_available() ) : ?>
							<button
								data-payment-method="<?php echo esc_attr( $payment_method->id ); ?>"
								class="simpay-panel-field-payment-method__configure button button-link button-small"
								data-available="<?php echo esc_attr( $upgrade_fee_recovery ? 'yes' : 'no' ); ?>"
								data-upgrade-title="<?php echo esc_attr( $upgrade_fee_recovery_title ); ?>"
								data-upgrade-description="<?php echo esc_attr( $upgrade_fee_recovery_description ); ?>"
								data-upgrade-url="<?php echo esc_url( $upgrade_fee_recovery_url ); ?>"
								data-upgrade-purchased-url="<?php echo esc_url( $upgrade_fee_recovery_purchased_url ); ?>"
								style="text-decoration: none;"
							>
								<span style="margin-right: 4px;">
									<?php esc_html_e( 'Configure', 'simple-pay' ); ?>
								</span>

								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="20" height="20"><path fill-rule="evenodd" d="M11.828 2.25c-.916 0-1.699.663-1.85 1.567l-.091.549a.798.798 0 0 1-.517.608 7.45 7.45 0 0 0-.478.198.798.798 0 0 1-.796-.064l-.453-.324a1.875 1.875 0 0 0-2.416.2l-.243.243a1.875 1.875 0 0 0-.2 2.416l.324.453a.798.798 0 0 1 .064.796 7.448 7.448 0 0 0-.198.478.798.798 0 0 1-.608.517l-.55.092a1.875 1.875 0 0 0-1.566 1.849v.344c0 .916.663 1.699 1.567 1.85l.549.091c.281.047.508.25.608.517.06.162.127.321.198.478a.798.798 0 0 1-.064.796l-.324.453a1.875 1.875 0 0 0 .2 2.416l.243.243c.648.648 1.67.733 2.416.2l.453-.324a.798.798 0 0 1 .796-.064c.157.071.316.137.478.198.267.1.47.327.517.608l.092.55c.15.903.932 1.566 1.849 1.566h.344c.916 0 1.699-.663 1.85-1.567l.091-.549a.798.798 0 0 1 .517-.608 7.52 7.52 0 0 0 .478-.198.798.798 0 0 1 .796.064l.453.324a1.875 1.875 0 0 0 2.416-.2l.243-.243c.648-.648.733-1.67.2-2.416l-.324-.453a.798.798 0 0 1-.064-.796c.071-.157.137-.316.198-.478.1-.267.327-.47.608-.517l.55-.091a1.875 1.875 0 0 0 1.566-1.85v-.344c0-.916-.663-1.699-1.567-1.85l-.549-.091a.798.798 0 0 1-.608-.517 7.507 7.507 0 0 0-.198-.478.798.798 0 0 1 .064-.796l.324-.453a1.875 1.875 0 0 0-.2-2.416l-.243-.243a1.875 1.875 0 0 0-2.416-.2l-.453.324a.798.798 0 0 1-.796.064 7.462 7.462 0 0 0-.478-.198.798.798 0 0 1-.517-.608l-.091-.55a1.875 1.875 0 0 0-1.85-1.566h-.344zM12 15.75a3.75 3.75 0 1 0 0-7.5 3.75 3.75 0 0 0 0 7.5z" clip-rule="evenodd"/></svg>
							</button>
							<?php endif; ?>
						</div>
					</div>
					<div
						class="simpay-panel-field-payment-method__restrictions"
						style="display: <?php echo esc_attr( $checked ? 'block' : 'none' ); ?>"
					>
						<?php if ( true === $currency_limitations ) : ?>
						<p class="description">
							<?php
							echo esc_html(
								sprintf(
									/* translators: Currency code list. */
									__( 'Currencies: %s', 'simple-pay' ),
									implode(
										', ',
										array_map(
											'strtoupper',
											$payment_method->currencies
										)
									)
								)
							);
							?>
						</p>
						<?php endif; ?>

						<?php if ( false === $payment_method->recurring ) : ?>
						<p class="description">
							<?php
							if ( false === $payment_method->bnpl ) :
								esc_html_e(
									'Payment type: One time',
									'simple-pay'
								);
							else :
								esc_html_e(
									'Payment type: Buy now, pay later',
									'simple-pay'
								);
							endif;
							?>
						</p>
						<?php endif; ?>
					</div>
					<?php
					if (
						! simpay_is_upe() &&
						in_array(
							$payment_method->id,
							$automatic_tax_restricted_payment_methods,
							true
						)
					) : ?>
					<div
						class="simpay-panel-field-payment-method__restrictions-ach simpay-show-if"
						data-if="_form_type"
						data-is="on-site"
					>
						<div
							class="simpay-show-if"
							data-if="_tax_status"
							data-is="automatic"
						>
							<p class="description">
								<?php
								echo wp_kses(
									sprintf(
										__(
											'Sorry, %s is not compatible with automatic taxes.',
											'simple-pay'
										),
										$payment_method->name
									),
									array()
								);
								?>
							</p>
						</div>
					</div>
					<?php endif; ?>
				</label>

				<div
					title="<?php echo esc_attr( $configure_title ); ?>"
					id="simpay-payment-method-configure-<?php echo esc_attr( $payment_method->id ); ?>"
					style="display: none;"
				>

					<?php if ( ! simpay_is_upe() && 'card' === $payment_method->id ) : ?>
						<div class="simpay-payment-method-option">
							<label for="simpay-card-hide-postal-code">
								<?php
								// Super hacky way to get the legacy value of the card configuration.
								$custom_fields = get_custom_fields( $post_id );
								$cards         = array_filter(
									$custom_fields,
									function( $field ) {
										return 'card' === $field['type'];
									}
								);
								$card          = current( $cards );
								$checked       = (
									isset( $payment_methods['card']['hide_postal_code'] ) ||
									isset( $card['postal_code'] )
								);
								?>

								<input
									id="simpay-card-hide-postal-code"
									name="_simpay_payment_methods[<?php echo esc_attr( $payment_method->id ); ?>][hide_postal_code]"
									type="checkbox"
									<?php checked( true, $checked ); ?>
									value="yes"
								/>

								<?php esc_html_e( 'Hide postal code field', 'simple-pay' ); ?>
							</label>
						</div>
					<?php elseif ( simpay_is_upe() && 'card' === $payment_method->id ) : ?>
						<div style="margin-bottom: 8px;">
							<strong>
								<?php esc_html_e( 'Mobile Wallets', 'simple-pay' ); ?>
							</strong>
						</div>

						<div class="simpay-payment-method-option">
							<label for="simpay-card-wallets">
								<input
									id="simpay-card-wallets"
									name="_simpay_payment_methods[<?php echo esc_attr( $payment_method->id ); ?>][wallets][enabled]"
									type="checkbox"
									<?php
									checked(
										true,
										(
											isset( $payment_methods['card']['wallets']['enabled'] ) &&
											'yes' === $payment_methods['card']['wallets']['enabled']
										) || isset( $custom_fields['payment_request_button'] )
									);
									?>
									value="yes"
								/>

								<?php
								esc_html_e(
									'Enable Apple Pay, Google Pay, and Microsoft Pay mobile wallets.',
									'simple-pay'
								);
								?>
							</label>
						</div>
					<?php endif; ?>

					<div class="simpay-form-builder-fee-recovery">
						<div style="margin-bottom: 8px;">
							<strong>
								<?php esc_html_e( 'Fee Recovery', 'simple-pay' ); ?>
							</strong>
						</div>

						<div
							class="simpay-show-if"
							data-if="_form_type"
							data-is="off-site"
						>
							<div class="notice notice-warning inline"><p>
							<?php
							echo wp_kses_post(
								sprintf(
									/* translators: %1$s Opening anchor tag, do not translate. %2$s Closing anchor tag, do not translate. */
									__(
										'Sorry, fee recovery is only available for on-site payment forms. %1$sUpdate the form type%2$s to "On-site" to recover processing fees.',
										'simple-pay'
									),
									'<a href="#form-display-options-settings-panel" data-show-tab="simpay-form_display_options" class="simpay-tab-link">',
									'</a>'
								)
							);
							?>
							</div>
						</div>

						<div
							class="simpay-show-if"
							data-if="_tax_status"
							data-is="fixed-global automatic"
						>
							<div class="notice notice-warning inline"><p>
							<?php
							echo wp_kses_post(
								sprintf(
									/* translators: %1$s Opening anchor tag, do not translate. %2$s Closing anchor tag, do not translate. */
									__(
										'Sorry, fee recovery is not available with tax collection. %1$sDisable tax collection%2$s to to recover processing fees.',
										'simple-pay'
									),
									'<a href="#form-payment-options-settings-panel" data-show-tab="simpay-form_payment_options" class="simpay-tab-link">',
									'</a>'
								)
							);
							?>
							</div>
						</div>

						<div
							class="simpay-show-if"
							data-if="_tax_status"
							data-is="none"
						>
							<div
								class="simpay-show-if"
								data-if="_form_type"
								data-is="on-site"
							>
								<label>
									<input
										name="_simpay_payment_methods[<?php echo esc_attr( $payment_method->id ); ?>][fee_recovery][enabled]"
										class="simpay-payment-method-fee-recovery-enable"
										data-pm="<?php echo esc_attr( $payment_method->id ); ?>"
										value="yes"
										type="checkbox"
										<?php checked( true, $fee_recovery_enabled ); ?>
									/>
									<?php
									esc_html_e(
										'Add an additional fee to payments made with this payment method',
										'simple-pay'
									);
									?>
								</label>

								<div
									class="simpay-form-builder-inset-settings simpay-form-builder-fee-recovery__amounts"
									<?php if ( false === $fee_recovery_enabled ) : ?>
										style="display: none;"
									<?php endif; ?>
								>
									<div class="simpay-form-builder-fee-percent-control">
										<label for="simpay-payment-method-fee-recovery-<?php echo esc_attr( $payment_method->id ); ?>-percent" class="screen-reader-text">
											<?php esc_html_e( 'Percentage amount', 'simple-pay' ); ?>
										</label>

										<input
											type="number"
											min="0"
											step="0.1"
											placeholder="2.9"
											value="<?php echo esc_attr( $fee_recovery_percent ); ?>"
											name="_simpay_payment_methods[<?php echo esc_attr( $payment_method->id ); ?>][fee_recovery][percent]"
											id="simpay-payment-method-fee-recovery-<?php echo esc_attr( $payment_method->id ); ?>-percent"
										/>

										<span class="simpay-form-builder-fee-percent-control__suffix">
											%
										</span>
									</div>

									&nbsp;+&nbsp;

									<div class="simpay-form-builder-fee-percent-control">
										<label for="simpay-payment-method-fee-recovery-<?php echo esc_attr( $payment_method->id ); ?>-amount" class="screen-reader-text">
											<?php esc_html_e( 'Fixed amount', 'simple-pay' ); ?>
										</label>

										<input
											type="number"
											min="0"
											step="0.1"
											placeholder="0.30"
											value="<?php echo esc_attr( $fee_recovery_amount ); ?>"
											name="_simpay_payment_methods[<?php echo esc_attr( $payment_method->id ); ?>][fee_recovery][amount]"
											id="simpay-payment-method-fee-recovery-<?php echo esc_attr( $payment_method->id ); ?>-amount"
										/>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="simpay-payment-method-close">
						<div>
							<?php if ( ! empty( $payment_method->internal_docs ) ) : ?>
							<a
								href="<?php echo esc_url( $payment_method->internal_docs ); ?>"
								target="_blank"
								rel="noopener noreferrer"
								class="simpay-panel-field-payment-method__help"
							>
								<span class="dashicons dashicons-editor-help"></span>
								<?php
									echo esc_html(
										sprintf(
											/* translators: %s Payment method name. */
											__( 'Learn more about %s payments', 'simple-pay' ),
											$payment_method->nicename
										)
									);
								?>
							</a>
							<?php endif; ?>
						</div>
						<button class="button button-primary update">
							<?php esc_html_e( 'Update', 'simple-pay' ); ?>
						</button>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
		</div>
	</td>
</tr>
