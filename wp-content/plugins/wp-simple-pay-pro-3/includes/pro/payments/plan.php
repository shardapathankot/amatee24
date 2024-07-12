<?php
/**
 * Payments: Plan
 *
 * @package SimplePay\Pro\Payments\Plan
 * @copyright Copyright (c) 2022, Sandhills Development, LLC
 * @license http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since 3.6.0
 */

namespace SimplePay\Pro\Payments\Plan;

use SimplePay\Core\API;
use SimplePay\Pro\Payments;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Retrieves a Plan.
 *
 * @since 3.8.0
 *
 * @param string|array $plan Plan ID or {
 *   Arguments used to retrieve a Plan.
 *
 *   @type string $id Plan ID.
 * }
 * @param array        $api_request_args {
 *   Additional request arguments to send to the Stripe API when making a request.
 *
 *   @type string $api_key API Secret Key to use.
 * }
 * @return \SimplePay\Vendor\Stripe\Plan
 */
function retrieve( $plan, $api_request_args = array() ) {
	_deprecated_function(
		__FUNCTION__,
		'4.1.0',
		'\SimplePay\Core\API\Plans\retrieve'
	);

	return API\Plans\retrieve( $plan, $api_request_args );
}

/**
 * Retrieves Plans.
 *
 * @since 3.8.0
 *
 * @param array $args Optional arguments used when listing Plans.
 * @param array $api_request_args {
 *   Additional request arguments to send to the Stripe API when making a request.
 *
 *   @type string $api_key API Secret Key to use.
 * }
 * @return \SimplePay\Vendor\Stripe\Collection
 */
function all( $args = array(), $api_request_args = array() ) {
	_deprecated_function(
		__FUNCTION__,
		'4.1.0',
		'\SimplePay\Core\API\Plans\all'
	);

	return API\Plans\all( $args, $api_request_args );
}

/**
 * Creates a Plan.
 *
 * @since 3.6.0
 *
 * @param array $plan_args Optional arguments used to create a Plan.
 * @param array $api_request_args {
 *   Additional request arguments to send to the Stripe API when making a request.
 *
 *   @type string $api_key API Secret Key to use.
 * }
 * @return \SimplePay\Vendor\Stripe\Plan
 */
function create( $plan_args = array(), $api_request_args = array() ) {
	_deprecated_function(
		__FUNCTION__,
		'4.1.0',
		'\SimplePay\Core\API\Plans\create'
	);

	return API\Plans\create( $plan_args, $api_request_args );
}

/**
 * Removes a Plan.
 *
 * @since 3.6.0
 * @since 3.6.7 No longer deletes associated Product.
 *
 * @param Stripe\Plan $plan Stripe Plan.
 * @return bool If the Plan was deleted.
 */
function delete( $plan ) {
	_deprecated_function(
		__FUNCTION__,
		'4.1.0',
		'\SimplePay\Core\API\Plans\delete'
	);

	return API\Plans\delete( $plan );
}

/**
 * Removes a Plan and possible associated Product.
 *
 * @since 3.6.7
 * @since 3.8.0 Requires a $form to provide API context.
 * @since 4.1.0 No longer used. Prices are not saved until used.
 *
 * @param Stripe\Plan                   $plan           Stripe Plan.
 * @param bool                          $remove_product Remove associated parent product.
 *                                                      Only if the product has no other plans.
 *                                                      Default true.
 * @param SimplePay\Core\Abstracts\Form $form           Form instance.
 */
function delete_generated( $plan, $remove_product, $form ) {
	_deprecated_function( __FUNCTION__, '4.2.0' );

	// Not generated, leave it alone.
	if ( ! isset( $plan->metadata->simpay_is_generated_plan ) ) {
		return;
	}

	// Store reference to original product.
	$product = $plan->product;

	$plan->delete();

	if ( $plan->deleted && true === $remove_product ) {
		// Determine if there are remaining Plans.
		$remaining_plans = all(
			array(
				'product' => $product,
			),
			$form->get_api_request_args()
		);

		// Attempt to delete Product if there are no Plans.
		if ( empty( $remaining_plans->data ) ) {
			$product = API\Products\retrieve(
				$product,
				$form->get_api_request_args()
			);

			// ...only if it was automatically generated.
			if ( $product->metadata->simpay_is_generated_product ) {
				$product->delete();
			}
		}
	}
}

/**
 * Generates a Product name for a Plan.
 *
 * @since 3.6.0
 *
 * @param string $formatted_amount Formatted Subscription Plan amount.
 * @param int    $interval_count Interval count.
 * @param string $interval Interval frequency.
 * @return string
 */
function generate_product_name( $formatted_amount, $interval_count, $interval ) {
	return html_entity_decode(
		sprintf(
			/* translators: Generated recurring payment item description: %1$s payment amount, %2$s interval count, %3$s interval */
			_n(
				'"%1$s every %2$s %3$s" plan',
				'"%1$s every %2$s %3$ss" plan',
				$interval_count,
				'simple-pay'
			),
			esc_html( $formatted_amount ),
			esc_html( $interval_count ),
			esc_html( $interval )
		)
	);
}

/**
 * Determines if the Subscription needs a custom plan.
 *
 * @since 3.6.0
 *
 * @param SimplePay\Core\Abstracts\Form $form Form instance.
 * @param array                         $form_data Form data generated by the client.
 * @param array                         $form_values Values of named fields in the payment form.
 */
function payment_form_request_needs_custom_plan( $form, $form_data, $form_values ) {
	return (
		// Subscriptions enabled.
		(
			// Field is toggled in the Form editing UI.
			$form->has_subscription_custom_amount &&

			// No multi plan ID was sent.
			! isset( $form_values['simpay_multi_plan_id'] ) &&

			// A custom amount was sent.
			isset( $form_values['simpay_subscription_custom_amount'] )
		) ||
		// Recurring toggle.
		(
			Payments\Subscription\payment_form_request_has_recurring_toggle( $form, $form_data, $form_values )
		)
	);
}