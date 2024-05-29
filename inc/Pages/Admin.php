<?php

namespace WPOOP\Pages;

use WPOOP\API\SettingsAPI;
use WPOOP\Base\BaseController;
use WPOOP\API\Callbacks\AdminCallback;

class Admin extends BaseController {

	public $settings;

	public $admin_callback;

	public $pages = array();

	public $subpages = array();

	public function register() {
		$this->settings = new SettingsAPI();

		$this->admin_callback = new AdminCallback();

		$this->set_pages();

		$this->set_subpages();

		$this->settings->add_pages( $this->pages )->with_sub_page( 'Dashboard' )->add_sub_pages( $this->subpages )->register();
	}

	public function set_pages() {
		$this->pages = array(
			array(
				'page_title' => 'WPOOP Plugin',
				'menu_title' => 'WPOOP Plugin',
				'capability' => 'manage_options',
				'menu_slug'  => 'wpoop-plugin',
				'callback'   => array( $this->admin_callback, 'admin_dashboard' ),
				'icon_url'   => 'dashicons-store',
				'position'   => 110,
			),
		);
	}

	public function set_subpages() {
		$this->subpages = array(
			array(
				'parent_slug' => 'wpoop-plugin',
				'page_title'  => 'CPT Manager',
				'menu_title'  => 'CPT Manager',
				'capability'  => 'manage_options',
				'menu_slug'   => 'wpoop-cpt',
				'callback'    => array( $this->admin_callback, 'cta_manager' ),
			),
			array(
				'parent_slug' => 'wpoop-plugin',
				'page_title'  => 'Taxonomy Manager',
				'menu_title'  => 'Taxonomy Manager',
				'capability'  => 'manage_options',
				'menu_slug'   => 'wpoop-taxonomies',
				'callback'    => array( $this->admin_callback, 'taxonomies_manager' ),
			),
			array(
				'parent_slug' => 'wpoop-plugin',
				'page_title'  => 'Custom Widgets',
				'menu_title'  => 'Custom Widget',
				'capability'  => 'manage_options',
				'menu_slug'   => 'wpoop-widgets',
				'callback'    => array( $this->admin_callback, 'widgets_manager' ),
			),
		);
	}
}
