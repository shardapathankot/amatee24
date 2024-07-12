<?php
/**
 * REST API
 *
 * @package SimplePay\Pro\REST_API
 * @copyright Copyright (c) 2022, Sandhills Development, LLC
 * @license http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since 3.5.0
 */

namespace SimplePay\Pro\REST_API;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Add additional Pro-only routes.
 *
 * @since 3.6.0
 *
 * @param array $controllers REST API controllers.
 * @return array
 */
function rest_api_controllers( $controllers ) {
	$controllers[] = '\SimplePay\Pro\REST_API\v1\Webhook_Receiver_Controller';

	if ( simpay_is_upe() ) {
		return $controllers;
	}

	$controllers[] = '\SimplePay\Core\REST_API\v2\Customer_Controller';
	$controllers[] = '\SimplePay\Core\REST_API\v2\PaymentIntent_Controller';
	$controllers[] = '\SimplePay\Pro\REST_API\v1\Webhooks_Controller';
	$controllers[] = '\SimplePay\Pro\REST_API\v2\Subscription_Controller';
	$controllers[] = '\SimplePay\Pro\REST_API\v2\SetupIntent_Controller';
	$controllers[] = '\SimplePay\Pro\REST_API\v2\Order_Controller';

	return $controllers;
}
add_filter( 'simpay_rest_api_controllers', __NAMESPACE__ . '\\rest_api_controllers' );
