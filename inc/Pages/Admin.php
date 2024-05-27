<?php

namespace WPOOP\Pages;

use WPOOP\API\SettingsAPI;
use WPOOP\Base\BaseController;

class Admin extends BaseController {

    public $settings;

    public $pages = [];

    public $subpages = [];

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

        $this->subpages = [
            [
                'parent_slug' => 'wpoop-plugin',
                'page_title' => 'CPT Manager',
                'menu_title' => 'CPT Manager',
                'capability' => 'manage_options',
                'menu_slug'  => 'wpoop-cpt',
                'callback'   => function() { echo 'Hello world'; },
            ],
            [
                'parent_slug' => 'wpoop-plugin',
                'page_title' => 'Taxonomy Manager',
                'menu_title' => 'Taxonomy Manager',
                'capability' => 'manage_options',
                'menu_slug'  => 'wpoop-taxonomies',
                'callback'   => function() { echo 'Hello Taxonomies'; },
            ],
            [
                'parent_slug' => 'wpoop-plugin',
                'page_title' => 'Custom Widgets',
                'menu_title' => 'Custom Widget',
                'capability' => 'manage_options',
                'menu_slug'  => 'wpoop-widgets',
                'callback'   => function() { echo 'Hello Widgets'; },
            ],
        ];
    }
  
    public function register() {
        $this->settings->add_pages( $this->pages )->with_sub_page( 'Dashboard' )->add_sub_pages( $this->subpages )->register();
    }
}
