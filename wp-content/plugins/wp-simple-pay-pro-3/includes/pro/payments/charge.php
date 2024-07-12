<?php
/**
 * Payments: Charge
 *
 * @package SimplePay\Pro\Payments\Charge
 * @copyright Copyright (c) 2022, Sandhills Development, LLC
 * @license http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since 3.9.0
 */

namespace SimplePay\Pro\Payments\Charge;

use SimplePay\Core\API\Charges;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Retrieves a Charge.
 *
 * @since 3.9.0
 *
 * @param string $charge Charge ID.
 * @param array  $api_request_args {
 *   Additional request arguments to send to the Stripe API when making a request.
 *
 *   @type string $api_key API Secret Key to use.
 * }
 * @return \SimplePay\Vendor\Stripe\Charge
 */
function retrieve( $charge, $api_request_args = array() ) {
	_deprecated_function(
		__FUNCTION__,
		'4.7.0',
		'\SimplePay\Core\API\Charges\retrieve'
	);

	return Charges\retrieve( $charge, $api_request_args );
}

/**
 * Retrieves Charges.
 *
 * @since 3.9.0
 *
 * @param array $charges Optional arguments used when listing Charges.
 * @param array $api_request_args {
 *   Additional request arguments to send to the Stripe API when making a request.
 *
 *   @type string $api_key API Secret Key to use.
 * }
 * @return \SimplePay\Vendor\Stripe\Charge[]
 */
function all( $charges = array(), $api_request_args = array() ) {
	_deprecated_function(
		__FUNCTION__,
		'4.7.0',
		'\SimplePay\Core\API\Charges\all'
	);

	return Charges\all( $charges, $api_request_args );
}

/**
 * Creates a Charge.
 *
 * @since 3.9.0
 *
 * @param array $charge_args Arguments used to create a Charge.
 * @param array $api_request_args {
 *   Additional request arguments to send to the Stripe API when making a request.
 *
 *   @type string $api_key API Secret Key to use.
 * }
 * @return \SimplePay\Vendor\Stripe\Charge
 */
function create( $charge_args, $api_request_args = array() ) {
	_deprecated_function(
		__FUNCTION__,
		'4.7.0',
		'\SimplePay\Core\API\Charges\cerate'
	);

	return Charges\all( $charge_args, $api_request_args );
}
