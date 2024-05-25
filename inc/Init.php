<?php
namespace WPOOP;
final class Init {

    public function __construct() {}

    /**
     * Get all of the service classes for the plugin
     * 
     * @return array
     */
    public static function get_services() {
        return [
            Pages\Admin::class,
            Base\Enqueue::class,
        ];
    }

    /**
     * Loop through the classes, initialize them, and call the register() method if it exists
     * 
     * @return void
     */
    public static function register_services() {
        foreach ( self::get_services() as $class ) {
            $service = self::instantiate( $class );
            if( method_exists( $service, 'register' ) ) {
                $service->register();
            }
        }
    }

    /**
     * Instantiate the class
     * @param string $class class from the service array
     * @return class instance new instance of the class
     */
    private static function instantiate( $class ) {
        $service = new $class();
        return $service;
    }

}


/* 

class WPOOP_Plugin {
    public $plugin;
    public function __construct() {
        $this->plugin = plugin_basename( __FILE__ );
        add_action( 'init', array( $this, 'custom_post_type' ) );
    }

    public function register() {
        add_action('admin_enqueue_scripts', array( $this, 'enqueue' ) );

        add_action('admin_menu', array( $this, 'admin_menu' ) );

        add_filter( 'plugin_action_links_' . $this->plugin, array( $this, 'plugin_action_links' ) );
    }

    public function plugin_action_links( $links ) {        
        $links[] = '<a href="admin.php?page=wpoop-plugin">Settings</a>';
        return $links;
    }

    public function admin_menu() {
        add_menu_page( 'WP OOP Plugin', 'WP OOP Plugin', 'manage_options', 'wpoop-plugin', array( $this, 'admin_page' ), 'dashicons-store', 110 );
    }

    public function admin_page() {
        require_once( plugin_dir_path( __FILE__ ) . 'templates/admin-page.php' );
    }

    public function enqueue() {
        wp_enqueue_style( 'wpoop-plugin-style', plugins_url( '/assets/css/wpoop-plugin.css', __FILE__ ) );
        wp_enqueue_script( 'wpoop-plugin-script', plugins_url( '/assets/js/wpoop-plugin.js', __FILE__ ) );
    }

    public function custom_post_type() {
        register_post_type( 'wpoop', array(
            'labels' => array(
                'name' => 'WP OOP',
                'singular_name' => 'WPOOP'
            ),
            'public' => true,
            'has_archive' => true
        ));
    }
}

if ( class_exists( 'WPOOP_Plugin' ) ) {
    $wpoop_plugin = new WPOOP_Plugin();
    $wpoop_plugin->register();
}


register_activation_hook( __FILE__, array( 'WPOOP\Activate', 'active' ) );
register_deactivation_hook( __FILE__, array( 'WPOOP\Deactivate', 'deactivated' ) );
*/