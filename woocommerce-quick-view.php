<?php
/**
 * Plugin Name: WooCommerce Quick View
 * Plugin URI:  
 * Description: Adds quick view button to WooCommerce products listing.
 * Version:     1.0.
 * Author:      Duan Dinh
 * Text Domain: woocommerce-quick-view
 * License:     GPL-3.0+no
 * Domain Path: /languages
 *
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'Woo_Quick_View' ) ) {

	/**
	 * Define Woo_Quick_View class
	 */
	class Woo_Quick_View {

		/**
		 * A reference to an instance of this class.
		 *
		 * @since 1.0.0
		 * @var   object
		 */
		private static $instance = null;

		/**
		 * Holder for base plugin URL
		 *
		 * @since  1.0.0
		 * @access private
		 * @var    string
		 */
		private $plugin_url = null;

		/**
		 * Holder for base plugin path
		 *
		 * @since  1.0.0
		 * @access private
		 * @var    string
		 */
		private $plugin_path = null;

		/**
		 * Trigger checks is WooCoomerce active or not
		 *
		 * @since 1.0.0
		 * @var   bool
		 */
		private $has_woocommerce = null;

		/**
		 * Constructor for the class
		 */
		function __construct() {

			if ( ! $this->has_woocommerce() ) {
				add_action( 'admin_notices', array( $this, 'woo_disabled_notice' ) );
				return false;
			}

			add_action( 'init', array( $this, 'init' ) );

		}

		/**
		 * Include and initalize required files
		 *
		 * @return void
		 */
		public function init() {

			if ( is_admin() ) {
				require_once $this->plugin_path( 'admin/includes/class-woo-quick-view-settings.php' );
			}

			require_once $this->plugin_path( 'public/includes/class-woo-quick-view-render.php' );
			require_once $this->plugin_path( 'public/includes/class-woo-quick-view-assets.php' );
			require_once $this->plugin_path( 'public/includes/class-woo-quick-view-handlers.php' );

		}

		/**
		 * Show notice in admin area if WooCommerce is disabled.
		 *
		 * @return void
		 */
		public function woo_disabled_notice() {
			echo '<div class="notice notice-warning is-dismissible">';
				echo '<p>';
				esc_html_e( 'WooCommerce Quick View is enabled but not effective. It requires WooCommerce plugin in order to work. Please install and activate it.', 'woocommerce-quick-view' );
				echo '</p>';
			echo '</div>';
		}

		/**
		 * Returns path to file or dir inside plugin folder
		 *
		 * @param  string $path Path inside plugin dir.
		 * @return string
		 */
		public function plugin_path( $path = null ) {

			if ( ! $this->plugin_path ) {
				$this->plugin_path = trailingslashit( plugin_dir_path( __FILE__ ) );
			}

			return $this->plugin_path . $path;
		}
		/**
		 * Returns url to file or dir inside plugin folder
		 *
		 * @param  string $path Path inside plugin dir.
		 * @return string
		 */
		public function plugin_url( $path = null ) {

			if ( ! $this->plugin_url ) {
				$this->plugin_url = trailingslashit( plugin_dir_url( __FILE__ ) );
			}

			return $this->plugin_url . $path;
		}

		/**
		 * Check if WooCommerce is active
		 *
		 * @since  1.0.0
		 * @return bool
		 */
		public function has_woocommerce() {

			if ( null == $this->has_woocommerce ) {

				$this->has_woocommerce = in_array(
					'woocommerce/woocommerce.php',
					apply_filters( 'active_plugins', get_option( 'active_plugins' ) )
				);
			}
			return $this->has_woocommerce;
		}

		/**
		 * Returns the instance.
		 *
		 * @since  1.0.0
		 * @return object
		 */
		public static function get_instance() {

			// If the single instance hasn't been set, set it now.
			if ( null == self::$instance ) {
				self::$instance = new self;
			}
			return self::$instance;
		}
	}

}

/**
 * Returns instance of Woo_Quick_View
 *
 * @return object
 */
function woo_quick_view() {
	return Woo_Quick_View::get_instance();
}

woo_quick_view();
