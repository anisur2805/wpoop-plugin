<?php

namespace WPOOP\Base;

use WPOOP\Base\BaseController;

class Enqueue extends BaseController {

	public function register() {
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
	}

	public function enqueue() {
		wp_enqueue_script( 'media-upload' );
		wp_enqueue_media();
		wp_enqueue_style( 'wpoop-plugin-style', $this->plugin_url . 'assets/css/wpoop-plugin.css' );
		wp_enqueue_style( 'ui-toggle', $this->plugin_url . 'assets/css/ui-toggle.css' );
		wp_enqueue_script( 'wpoop-plugin-script', $this->plugin_url . 'assets/js/wpoop-plugin.js' );
		wp_enqueue_script( 'prettyprint-script', $this->plugin_url . 'assets/js/run_prettify.js' );
	}
}
