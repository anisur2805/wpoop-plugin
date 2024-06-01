<?php
namespace WPOOP\API\Callbacks;

class CptCallbacks {

	public function cta_manager() {
		echo 'Hellow orld';
	}

	public function cptSectionManager() {
		echo 'Manage the Post Types of this Plugin by activating or deactivating the checkboxes from the below.';
	}

	public function cptSanitize( $input ) {
		return $input;
	}

	public function textField( $args ) {
		$name        = $args['label_for'];
		$option_name = $args['option_name'];
		$input       = get_option( $option_name );
		$value       = $input[ $name ];
		$placeholder = $args['placeholder'];

		echo '<input type="text" id="' . $name . '" value="' . $value . '" id="post_type" name="' . $option_name . '[' . $name . ']" class="regular-text" placeholder="' . $placeholder . '"/>';
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
	// public function checkboxSanitize( $input ) {
	//  $output = array();

	//  foreach ( $this->managers as $key => $value ) {
	//      $output[ $key ] = isset( $input[ $key ] ) ? true : false;
	//  }

	//  return $output;
	// }

	// public function adminSection() {
	//  echo 'Manage the Sections and Features of this Plugin by activating or deactivating the checkboxes from the below.';
	// }

	// public function checkboxField( $args ) {
	//  $name        = $args['label_for'];
	//  $classes     = $args['class'];
	//  $option_name = $args['option_name'];
	//  $checkbox    = get_option( $option_name );
	//  $is_checked  = $checkbox[ $name ] ? true : false;
	//  $checked     = isset( $checkbox[ $name ] ) ? $is_checked : false;

	//  echo '<div class="' . $classes . '"><input type="checkbox" name="' . $option_name . '[' . $name . ']" id="' . $name . '" class="" value="1"  ' . ( $checked ? 'checked' : '' ) . '/><label for="' . $name . '"><div></div></label></div>';
	// }
}
