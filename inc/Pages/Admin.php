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

	public function set_settings() {
		$args = array(
			array(
				'option_group' => 'wpoop_plugin_options_group',
				'option_name'  => 'text_example',
				'callback'     => array( $this->admin_callback, 'wpoop_plugin_group' ),
			),
		);

		$this->settings->set_settings( $args );
	}

	public function set_sections() {
		$args = array(
			array(
				'id'       => 'wpoop_plugin_options_group',
				'title'    => 'WPOOP Plugin Settings',
				'callback' => array( $this->admin_callback, 'wpoop_plugin_section' ),
				'page'     => 'wpoop-plugin',
				'section'  => 'wpoop_plugin',
			),
		);

		$this->settings->set_sections( $args );
	}

	public function set_fields() {
		$args = array(
			array(
				'id'       => 'text_example',
				'title'    => 'Text Example',
				'callback' => array( $this->admin_callback, 'wpoop_plugin_text' ),
				'page'     => 'wpoop-plugin',
				'section'  => 'wpoop_plugin',
				'args'     => array(
					'label_for'   => 'text_example',
					'class'       => 'example-class',
					'option_name' => 'text_example',
				),
			),
		);

		$this->settings->set_fields( $args );
	}
}
