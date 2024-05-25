<?php
/**
 * Plugin Name: WPOOP Plugin
 * Description: Awesome Desc...
 * Plugin URI:  #
 * Version:     1.0.0
 * Author:      #
 * Author URI:  http://github.com/anisur2805/wpoop-plugin
 * Text Domain: wpoop-plugin
 * License:     GPL v2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * 
 * @package WPoopPlugin
 */

if ( !defined( 'ABSPATH' ) ) {
 exit;
}

if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
    require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

define( 'WPOOP_PLUGIN_VERSION', '1.0.0' );
define( 'WPOOP_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'WPOOP_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'WPOOP_PLUGIN', plugin_basename( __FILE__ ) );

register_activation_hook( __FILE__, array( 'WPOOP\\Base\\Activate', 'active' ) );
register_deactivation_hook( __FILE__, array( 'WPOOP\\Base\\Deactivate', 'deactivated' ) );

if ( class_exists( 'WPOOP\\Init' ) ) {
    WPOOP\Init::register_services();
}
