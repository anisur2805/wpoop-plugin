<?php
namespace WPOOP\API\Callbacks;

class TaxonomyCallbacks {

	public function taxSectionManager() {
		echo 'Manage the Taxonomy of this Plugin by activating or deactivating the checkboxes from the below.';
	}

	public function taxSanitize( $input ) {
		$output = get_option( 'wpoop_plugin_tax' );

		if ( isset( $_POST['remove'] ) ) {
			unset( $output[ $_POST['remove'] ] );

			return $output;
		}

		if ( count( $output ) == 0 ) {
			$output[ $input['taxonomy'] ] = $input;

			return $output;
		}

		foreach ( $output as $key => $value ) {
			if ( $input['taxonomy'] === $key ) {
				$output[ $key ] = $input;
			} else {
				$output[ $input['taxonomy'] ] = $input;
			}
		}

		return $output;
	}

	public function text_field( $args ) {
		$name        = $args['label_for'];
		$option_name = $args['option_name'];
		$placeholder = $args['placeholder'];
		$value       = '';
		$readonly    = '';

		if ( isset( $_POST['edit_taxonomy'] ) ) {
			$input    = get_option( $option_name );
			$value    = $input[ $_POST['edit_taxonomy'] ][ $name ];
			$readonly = ( 'taxonomy' === $name ) ? 'readonly' : '';
		}

		echo '<input type="text" ' . $readonly . ' id="' . $name . '" value="' . $value . '" id="post_type" name="' . $option_name . '[' . $name . ']" class="regular-text" placeholder="' . $placeholder . '" required/>';
	}

	public function checkbox_field( $args ) {
		$name        = $args['label_for'];
		$classes     = $args['class'];
		$option_name = $args['option_name'];
		$checked     = false;

		if ( isset( $_POST['edit_taxonomy'] ) ) {
			$checked = get_option( $option_name );
			$checked = isset( $checked[ $_POST['edit_taxonomy'] ][ $name ] ) ?: false;
		}

		echo '<div class="' . $classes . '"><input type="checkbox" name="' . $option_name . '[' . $name . ']" id="' . $name . '" ' . ( $checked ? 'checked' : '' ) . ' class="" value="1" /><label for="' . $name . '"><div></div></label></div>';
	}
}
