<?php
namespace WPOOP\API\Callbacks;

use WPOOP\Base\BaseController;

class AdminCallback extends BaseController {

	public function admin_dashboard() {
		return load_template( $this->plugin_path . 'templates/admin-page.php' );
	}

	public function cpt_manager() {
		return load_template( $this->plugin_path . 'templates/cta-page.php' );
	}

	public function cta_manager() {
		return load_template( $this->plugin_path . 'templates/cta-page.php' );
	}

	public function taxonomy_manager() {
		return load_template( $this->plugin_path . 'templates/taxonomies-page.php' );
	}

	public function widgets_manager() {
		return load_template( $this->plugin_path . 'templates/widgets-page.php' );
	}
}
