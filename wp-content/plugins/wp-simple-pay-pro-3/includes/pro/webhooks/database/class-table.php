<?php
/**
 * Webhooks: Database Table
 *
 * @package SimplePay\Pro\Webhooks\Database
 * @copyright Copyright (c) 2022, Sandhills Development, LLC
 * @license http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since 3.5.0
 */

namespace SimplePay\Pro\Webhooks\Database;

use SimplePay\Vendor\BerlinDB\Database\Table as Table_Base;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Table class.
 *
 * @since 3.5.0
 */
final class Table extends Table_Base {

	/**
	 * {@inheritdoc}
	 */
	protected $prefix = 'wpsp';

	/**
	 * Table name.
	 *
	 * @var string
	 */
	protected $name = 'webhooks';

	/**
	 * Database version.
	 *
	 * @var string
	 */
	protected $version = 201904010000;

	/**
	 * Table schema.
	 *
	 * @var string
	 */
	protected $schema = __NAMESPACE__ . '\\Schema';

	/**
	 * Array of upgrade versions and methods.
	 *
	 * @access protected
	 * @since 3.5.0
	 * @var array
	 */
	protected $upgrades = array();

	/**
	 * Setup the database schema.
	 *
	 * @since 3.5.0
	 */
	protected function set_schema() {
		$this->schema = "id bigint(20) unsigned NOT NULL auto_increment,
			event_id varchar(255) NOT NULL default '',
			event_type varchar(255) NOT NULL default '',
			livemode tinyint(1) NOT NULL default false,
			date_created datetime NOT NULL default '0000-00-00 00:00:00',
			PRIMARY KEY (id)";
	}
}
