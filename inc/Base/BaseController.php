<?php
namespace WPOOP\Base;

/**
 * BaseController plugin
 *
 * @package WPoopPlugin
 * @subpackage BaseController
 * @since 1.0.0
 */

class BaseController {
	public $plugin_version;
	public $plugin_path;
	public $plugin_url;
	public $plugin;

	public $managers;

	public function __construct() {

		$this->plugin_version = '1.0.0';
		$this->plugin_path    = plugin_dir_path( dirname( __DIR__, 1 ) );
		$this->plugin_url     = plugin_dir_url( dirname( __DIR__, 1 ) );
		$this->plugin         = plugin_basename( dirname( __DIR__, 2 ) ) . '/wpoop-plugin.php';

		$this->managers = array(
			'cpt_manager'          => 'Active CPT Manager',
			'taxonomy_manager'     => 'Active Taxonomy Manager',
			'media_widget_manager' => 'Active Media Widget Manager',
			'gallery_manager'      => 'Active Gallery Widget Manager',
			'testimonial_manager'  => 'Active Testimonial Manager',
			'login_manager'        => 'Active Login Manager',
			'membership_manager'   => 'Active Membership Manager',
			'chat_manager'         => 'Active Chat Manager',
		);
	}
}
