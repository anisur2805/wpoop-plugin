<?php

namespace WPOOP\Pages;

use WPOOP\Base\BaseController;

class Admin extends BaseController {
  
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
        require_once( $this->plugin_path . 'templates/admin-page.php' );
    }
}
