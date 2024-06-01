<?php
namespace WPOOP\API\Callbacks;

use WPOOP\Base\BaseController;

class ManagerCallbacks extends BaseController {
	public function checkboxSanitize( $input ) {
		$output = array();

		foreach ( $this->managers as $key => $value ) {
			$output[ $key ] = isset( $input[ $key ] ) ? true : false;
		}

		return $output;
	}

	public function adminSection() {
		echo 'Manage the Sections and Features of this Plugin by activating or deactivating the checkboxes from the below.';
	}

	public function checkboxField( $args ) {
		$name        = $args['label_for'];
		$classes     = $args['class'];
		$option_name = $args['option_name'];
		$checkbox    = get_option( $option_name );
		$is_checked  = $checkbox[ $name ] ? true : false;
		$checked     = isset( $checkbox[ $name ] ) ? $is_checked : false;

		echo '<div class="' . $classes . '"><input type="checkbox" name="' . $option_name . '[' . $name . ']" id="' . $name . '" class="" value="1"  ' . ( $checked ? 'checked' : '' ) . '/><label for="' . $name . '"><div></div></label></div>';
	}
}
