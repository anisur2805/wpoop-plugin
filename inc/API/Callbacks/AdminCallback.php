<?php
namespace WPOOP\API\Callbacks;

use WPOOP\Base\BaseController;

class AdminCallback extends BaseController {

	public function admin_dashboard() {
		return load_template( $this->plugin_path . 'templates/admin-page.php' );
	}

	public function cta_manager() {
		return load_template( $this->plugin_path . 'templates/cta-page.php' );
	}

	public function taxonomies_manager() {
		return load_template( $this->plugin_path . 'templates/taxonomies-page.php' );
	}

	public function widgets_manager() {
		return load_template( $this->plugin_path . 'templates/widgets-page.php' );
	}

	public function optionsGroup( $input ) {
		return $input;
	}

	public function adminSection() {
		echo 'WPOOP Plugin Section';
	}

	public function wpoop_plugin_text() {
		$example_text = esc_attr( get_option( 'text_example' ) );
		echo '<input type="text" class="regular-text" name="text_example" value="' . $example_text . '" />';
	}

	public function wpoop_plugin_first_name() {
		$first_name = esc_attr( get_option( 'first_name' ) );
		echo '<input type="text" class="regular-text" name="first_name" value="' . $first_name . '" />';
	}
}
