<?php

namespace WPOOP\Pages;

class Admin {
  
    public function register() {
        add_action('admin_menu', [$this, 'adminMenu']);
    }

    public function adminMenu()
    {
        add_menu_page(
            'WPOOP Plugin',
            'WPOOP Plugin',
            'manage_options',
            'wpoop-plugin',
            [$this, 'admin_index'],
            'dashicons-store',
            110
        );
    }

    public function admin_index()
    {
        require_once( WPOOP_PLUGIN_PATH . 'templates/admin-page.php' );
    }
}
