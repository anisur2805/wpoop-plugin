<?php
namespace WPOOP\Base;

class Activate {
	/**
	 * Activate plugin
	 *
	 * @since 1.0.0
	 */
	public static function active() {
		flush_rewrite_rules();

		$default = array();

		if ( ! get_option( 'wpoop_plugin' ) ) {
			update_option( 'wpoop_plugin', $default );
		}

		if ( ! get_option( 'wpoop_plugin_cpt' ) ) {
			update_option( 'wpoop_plugin_cpt', $default );
		}
	}
}
