<?php
/**
 * Webhooks: Base
 *
 * @package SimplePay\Pro\Webhooks
 * @copyright Copyright (c) 2022, Sandhills Development, LLC
 * @license http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since 3.5.0
 */

namespace SimplePay\Pro\Webhooks;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Webhook class.
 *
 * @since 3.5.0
 */
abstract class Webhook_Base {

	/**
	 * Event to handle.
	 *
	 * @var \SimplePay\Vendor\Stripe\Event
	 * @since 3.5.0
	 */
	protected $event;

	/**
	 * Webhook setup.
	 *
	 * @since 3.5.0
	 *
	 * @param \SimplePay\Vendor\Stripe\Event $event Stripe event.
	 */
	public function __construct( \SimplePay\Vendor\Stripe\Event $event ) {
		$this->event = $event;
	}

}
