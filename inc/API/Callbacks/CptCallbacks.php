<?php
namespace WPOOP\API\Callbacks;

class CptCallbacks {

	public function cptSectionManager() {
		echo 'Manage the Post Types of this Plugin by activating or deactivating the checkboxes from the below.';
	}

	public function cptSanitize( $input ) {
		$output = get_option( 'wpoop_plugin_cpt' );

		if ( count( $output ) === 0 ) {
			$output[ $input['post_type'] ] = $input;
		}

		foreach ( $output as $key => $value ) {
			if ( $input['post_type'] === $key ) {
				$output[ $key ] = $input;
			} else {
				$output[ $input['post_type'] ] = $input;
			}
		}

		return $output;
	}

	public function text_field( $args ) {
		$name        = $args['label_for'];
		$option_name = $args['option_name'];
		$placeholder = $args['placeholder'];

		echo '<input type="text" id="' . $name . '" value="" id="post_type" name="' . $option_name . '[' . $name . ']" class="regular-text" placeholder="' . $placeholder . '" required/>';
	}

	public function checkbox_field( $args ) {
		$name        = $args['label_for'];
		$classes     = $args['class'];
		$option_name = $args['option_name'];

		echo '<div class="' . $classes . '"><input type="checkbox" name="' . $option_name . '[' . $name . ']" id="' . $name . '" class="" value="1" /><label for="' . $name . '"><div></div></label></div>';
	}
}
