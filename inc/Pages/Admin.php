<?php

namespace WPOOP\Pages;

use WPOOP\API\SettingsAPI;
use WPOOP\Base\BaseController;

class Admin extends BaseController {

    public $settings;

    public $pages = [];

    public function __construct() {
        $this->settings = new SettingsAPI();

        $this->pages = [
            [
                'page_title' => 'WPOOP Plugin',
                'menu_title' => 'WPOOP Plugin',
                'capability' => 'manage_options',
                'menu_slug'  => 'wpoop-plugin',
                'callback'   => function() { echo 'Hello'; },
                'icon_url'   => 'dashicons-store',
                'position'   => 110
            ],
        ];
    }
  
    public function register() {
        $this->settings->add_pages( $this->pages )->register();
    }
}
