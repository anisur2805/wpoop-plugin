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

	public function __construct() {

		$this->plugin_version = '1.0.0';
		$this->plugin_path    = plugin_dir_path( dirname( __DIR__, 1 ) );
		$this->plugin_url     = plugin_dir_url( dirname( __DIR__, 1 ) );
		$this->plugin         = plugin_basename( dirname( __DIR__, 2 ) ) . '/wpoop-plugin.php';
	}
}
