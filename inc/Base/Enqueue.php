<?php

namespace WPOOP\Base;

class Enqueue {
  
    public function register() {
        add_action('admin_enqueue_scripts', array( $this, 'enqueue' ) );
    }

    public function enqueue() {
        wp_enqueue_style( 'wpoop-plugin-style', WPOOP_PLUGIN_URL . 'assets/css/wpoop-plugin.css' );
        wp_enqueue_script( 'wpoop-plugin-script', WPOOP_PLUGIN_URL . 'assets/js/wpoop-plugin.js' );
    }

}
