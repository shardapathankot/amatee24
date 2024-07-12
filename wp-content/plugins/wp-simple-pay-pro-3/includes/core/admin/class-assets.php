<?php
/**
 * Admin assets
 *
 * @package SimplePay\Core\Admin
 * @copyright Copyright (c) 2022, Sandhills Development, LLC
 * @license http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since 3.0.0
 */

namespace SimplePay\Core\Admin;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Assets class
 *
 * @since 3.0.0
 */
class Assets {

	/**
	 * All scripts.
	 *
	 * @var array
	 */
	private $scripts = array();

	/**
	 * All styles.
	 *
	 * @var array
	 */
	public $styles = array();

	/**
	 * Assets constructor.
	 */
	public function __construct() {
		$this->setup();

		add_action( 'admin_enqueue_scripts', array( $this, 'register' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );

		// Load admin scripts & styles on all admin pages.
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_on_all_admin_pages' ) );
	}

	/**
	 * Enqueue JS & CSS file to run on all admin pages (in our own settings or not).
	 * Admin bar, inline plugin update message, etc.
	 */
	public function enqueue_on_all_admin_pages() {

		// CSS.
		$src = SIMPLE_PAY_INC_URL . 'core/assets/css/simpay-admin-all-pages.min.css';
		wp_enqueue_style( 'simpay-admin-all-pages', $src, array(), SIMPLE_PAY_VERSION, 'all' );

		// Notices.
		wp_enqueue_script(
			'simpay-notices',
			SIMPLE_PAY_INC_URL . 'core/assets/js/simpay-admin-notices.min.js',
			array( 'wp-util', 'jquery' ),
			SIMPLE_PAY_VERSION,
			true
		);
	}

	/**
	 * Setup arrays for both styles and scripts
	 */
	public function setup() {
		$this->scripts = array(
			'simpay-chosen'     => array(
				'src'    => SIMPLE_PAY_INC_URL . 'core/assets/js/vendor/chosen.jquery.min.js',
				'deps'   => array( 'jquery', 'jquery-ui-dialog', 'jquery-ui-sortable' ),
				'ver'    => SIMPLE_PAY_VERSION,
				'footer' => false,
			),
			'simpay-accounting' => array(
				'src'    => SIMPLE_PAY_INC_URL . 'core/assets/js/vendor/accounting.min.js',
				'deps'   => array(),
				'ver'    => SIMPLE_PAY_VERSION,
				'footer' => false,
			),
			'simpay-shared'     => array(
				'src'    => SIMPLE_PAY_INC_URL . 'core/assets/js/simpay-public-shared.min.js',
				'deps'   => array( 'jquery', 'simpay-accounting' ),
				'ver'    => SIMPLE_PAY_VERSION,
				'footer' => false,
			),
			'simpay-admin'      => array(
				'src'    => SIMPLE_PAY_INC_URL . 'core/assets/js/simpay-admin.min.js',
				'deps'   => array(
					'jquery',
					'simpay-chosen',
					'simpay-accounting',
					'simpay-shared',
					'wp-util',
					'clipboard',
				),
				'ver'    => SIMPLE_PAY_VERSION,
				'footer' => false,
			),
		);

		$this->styles = array(
			'simpay-chosen' => array(
				'src'   => SIMPLE_PAY_INC_URL . 'core/assets/css/vendor/chosen/chosen.min.css',
				'deps'  => array(),
				'ver'   => SIMPLE_PAY_VERSION,
				'media' => 'all',
			),
			'simpay-admin'  => array(
				'src'   => SIMPLE_PAY_INC_URL . 'core/assets/css/simpay-admin.min.css',
				'deps'  => array( 'simpay-chosen', 'wp-jquery-ui-dialog' ),
				'ver'   => SIMPLE_PAY_VERSION,
				'media' => 'all',
			),
		);
	}

	/**
	 * Register scripte ad stlyes
	 */
	public function register() {
		/**
		 * Filters the styles before they are registered in the admin.
		 *
		 * @since 3.0.0
		 * @since 3.7.0 $min Always '.min'
		 *
		 * @param array  $styles List of styles to register.
		 * @param string $min Suffix for minification.
		 */
		$this->styles = apply_filters( 'simpay_before_register_admin_styles', $this->styles, '.min' );

		/**
		 * Filters the scripts before they are registered in the admin.
		 *
		 * @since 3.0.0
		 * @since 3.7.0 $min Always '.min'
		 *
		 * @param array  $styles List of scripts to register.
		 * @param string $min Suffix for minification.
		 */
		$this->scripts = apply_filters( 'simpay_before_register_admin_scripts', $this->scripts, '.min' );

		if ( ! empty( $this->styles ) && is_array( $this->styles ) ) {
			foreach ( $this->styles as $style => $values ) {
				wp_register_style( $style, $values['src'], $values['deps'], $values['ver'], $values['media'] );
			}
		}

		if ( ! empty( $this->scripts ) && is_array( $this->scripts ) ) {
			foreach ( $this->scripts as $script => $values ) {
				if ( is_array( $values ) ) {
					wp_register_script( $script, $values['src'], $values['deps'], $values['ver'], $values['footer'] );
				}
			}

			if ( isset( $this->scripts['simpay-admin'] ) ) {
				wp_localize_script(
					'simpay-admin',
					'simpayAdmin',
					array(
						'siteTitle'         => get_bloginfo( 'name' ),
						'ajaxUrl'           => admin_url( 'admin-ajax.php' ),
						'nonce'             => wp_create_nonce( 'simpay-admin' ),
						'licenseLevel'      => simpay_get_license()->get_level(),
						'currency'          => simpay_get_setting( 'currency', 'USD' ),
						'currencySymbol'    => html_entity_decode(
							simpay_get_saved_currency_symbol()
						),
						'currencyPosition'  => simpay_get_currency_position(),
						'decimalSeparator'  => simpay_get_decimal_separator(),
						'thousandSeparator' => simpay_get_thousand_separator(),
						'decimalPlaces'     => simpay_get_decimal_places(),
						'minAmount'         => simpay_global_minimum_amount(),
						'isUpe'             => simpay_is_upe(),
						'i18n'              => array(
							'dateFormat'            => simpay_get_date_format(),
							'mediaTitle'            => esc_html__(
								'Insert Media',
								'simple-pay'
							),
							'mediaButtonText'       => esc_html__(
								'Use Image',
								'simple-pay'
							),
							'leavePageConfirm'      => esc_html__(
								'The changes you made will be lost if you navigate away from this page.',
								'simple-pay'
							),
							'disconnectConfirm'     => esc_html__(
								'Disconnect',
								'simple-pay'
							),
							'disconnectCancel'      => esc_html__(
								'Cancel',
								'simple-pay'
							),
							'addonActivate'         => esc_html__(
								'Activate',
								'simple-pay'
							),
							'addonActivated'        => esc_html__(
								'Activated',
								'simple-pay'
							),
							'addonActive'           => esc_html__(
								'Active',
								'simple-pay'
							),
							'addonDeactivate'       => esc_html__(
								'Deactivate',
								'simple-pay'
							),
							'addonInactive'         => esc_html__(
								'Inactive',
								'simple-pay'
							),
							'addonInstall'          => esc_html__(
								'Install Addon',
								'simple-pay'
							),
							'addonError'            => esc_html__(
								'Could not install the addon. Please download it from wpforms.com and install it manually.',
								'simple-pay'
							),
							'pluginError'           => esc_html__(
								'Could not install the plugin automatically. Please download and install it manually.',
								'simple-pay'
							),
							'pluginInstallActivate' => esc_html__(
								'Install and Activate',
								'simple-pay'
							),
							'pluginActivate'        => esc_html__(
								'Activate',
								'simple-pay'
							),
							'trashFormConfirm'      => esc_html__(
								'Warning: Removing a payment form will prevent active subscriptions from sending upcoming invoice and invoice receipt emails. It is recommended to leave payment forms that have accepted Live Mode payments published.',
								'simple-pay'
							),
							/* translators: Minimum payment amount. */
							'customAmountLabel' => esc_html__( 'starting at %s', 'simple-pay' ),
							'recurringIntervals' => simpay_get_recurring_intervals(),
							/* translators: %1$s Recurring amount. %2$s Recurring interval count. %3$s Recurring interval. */
							'recurringIntervalDisplay' => esc_html_x(
								'%1$s every %2$s %3$s',
								'recurring interval',
								'simple-pay'
							),
						),
					)
				);
			}
		}
	}


	/**
	 * Enqueue registered styles and scripts
	 */
	public function enqueue() {
		if ( false === simpay_is_admin_screen() ) {
			return;
		}

		if ( ! empty( $this->styles ) && is_array( $this->styles ) ) {
			foreach ( $this->styles as $style => $value ) {
				wp_enqueue_style( $style );
			}
		}

		if ( ! empty( $this->scripts ) && is_array( $this->scripts ) ) {
			foreach ( $this->scripts as $script => $value ) {
				wp_enqueue_script( $script );
			}
		}

		simpay_shared_script_variables();

		wp_enqueue_media();
	}
}
