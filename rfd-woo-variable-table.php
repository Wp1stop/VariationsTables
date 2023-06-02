<?php
/**
 * Plugin Name: Woo Table Variable Products
 * Plugin URI:  https://cimba.dev/
 * Description: Edit your variable products with ease using table variable products.
 * Version:     1.0.6
 * Author:      Nemanja Cimbaljevic
 * Author URI:  https://codeable.io/developers/nemanja-cimbaljevic/?ref=jjTaE
 * Text Domain: rfd-woo-variable-table
 * Domain Path: /languages
 * License:     GPL2
 * Requires at least: 5.1
 * Tested up to: 5.7
 * Requires PHP: 7.1
 *
 * @package RFD\Woo_Variable_Table
 */

namespace RFD\Woo_Variable_Table;

if ( ! defined( 'WPINC' ) ) {
    die;
}

/**
 * Current plugin version.
 */
define( 'RFD_WOO_VARIABLE_TABLE_PLUGIN', 'rfd-woo-variable-table' );
define( 'RFD_WOO_VARIABLE_TABLE_VERSION', '1.0.6' );

define( 'RFD_WOO_VARIABLE_TABLE_PLUGIN_DIR', dirname( __FILE__ ) . DIRECTORY_SEPARATOR );
define( 'RFD_WOO_VARIABLE_TABLE_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

define( 'RFD_WOO_VARIABLE_TABLE_ASSETS_URL', RFD_WOO_VARIABLE_TABLE_PLUGIN_URL . 'assets/' );
define( 'RFD_WOO_VARIABLE_TABLE_TEMPLATES_DIR', RFD_WOO_VARIABLE_TABLE_PLUGIN_DIR . 'templates' . DIRECTORY_SEPARATOR );

define( 'RFD_WOO_VARIABLE_TABLE_BLOCKS_DIR', RFD_WOO_VARIABLE_TABLE_PLUGIN_DIR . 'blocks' . DIRECTORY_SEPARATOR );
define( 'RFD_WOO_VARIABLE_TABLE_BLOCKS_URL', RFD_WOO_VARIABLE_TABLE_PLUGIN_URL . 'blocks/' );

require_once RFD_WOO_VARIABLE_TABLE_PLUGIN_DIR . '../../mu-plugins/rfd-core/rfd-core.php';
require_once RFD_WOO_VARIABLE_TABLE_PLUGIN_DIR . 'functions/functions.php';
require_once RFD_WOO_VARIABLE_TABLE_PLUGIN_DIR . 'includes/class-init.php';
require_once RFD_WOO_VARIABLE_TABLE_PLUGIN_DIR . 'includes/dokan/class-variations-table.php';
require_once RFD_WOO_VARIABLE_TABLE_PLUGIN_DIR . 'includes/meta_boxes/class-product-cat-term-meta-box.php';
require_once RFD_WOO_VARIABLE_TABLE_PLUGIN_DIR . 'includes/woo/class-variable-product.php';

/**
 * The code that runs during plugin activation.
 */
class Woo_Variable_Table_Plugin {
    private static $instance = null;
    
    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function __construct() {
        $init_plugin = new Init();

        add_action(
            'woocommerce_loaded',
            function () use ( $init_plugin ) {
                $init_plugin->prepare()->run();
            }
        );
    }
}

Woo_Variable_Table_Plugin::getInstance();
