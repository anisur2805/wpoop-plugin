<?php
namespace WPOOP\API\Callbacks;

use WPOOP\Base\BaseController;

class ManagerCallbacks extends BaseController {
	public function checkboxSanitize( $input ) {
		return ( isset( $input ) ? true : false );
	}

	public function adminSection() {
		echo 'Manage the Sections and Features of this Plugin by activating or deactivating the checkboxes from the below.';
	}

	public function checkboxField( $args ) {
		$name        = $args['label_for'];
		$classes     = $args['class'];
		$checkbox    = get_option( $name );

		echo '<input type="checkbox" class="' . $classes . '" name="' . $name . '" value="1"  ' . ( $checkbox ? 'checked' : '' ) . '/>';
	}
}
