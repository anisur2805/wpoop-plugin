<?php

namespace WPOOP\Pages;

use WPOOP\API\SettingsAPI;
use WPOOP\Base\BaseController;
use WPOOP\API\Callbacks\AdminCallback;
use WPOOP\API\Callbacks\ManagerCallbacks;

class Admin extends BaseController {

	public $settings;

	public $admin_callback;

	public $callback_mngr;

	public $pages = array();

	public $subpages = array();

	public function register() {
		$this->settings = new SettingsAPI();

		$this->admin_callback = new AdminCallback();

		$this->callback_mngr = new ManagerCallbacks();

		$this->set_pages();

		$this->set_subpages();

		$this->set_settings();

		$this->set_sections();

		$this->set_fields();

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
		$args = array();

		foreach ( $this->managers as $key => $manager ) {
			$args[] = array(
				'option_group' => 'wpoop_plugin_options_settings',
				'option_name'  => $key,
				'callback'     => array( $this->callback_mngr, 'checkboxSanitize' ),
			);
		}

		$this->settings->set_settings( $args );
	}

	public function set_sections() {
		$args = array(
			array(
				'id'       => 'wpoop_admin_index',
				'title'    => 'WPOOP Plugin Settings',
				'callback' => array( $this->callback_mngr, 'adminSection' ),
				'page'     => 'wpoop-plugin',
			),
		);

		$this->settings->set_sections( $args );
	}

	public function set_fields() {
		$args = array();
		foreach ( $this->managers as $key => $value ) {
			$args[] = array(
				'id'       => $key,
				'title'    => $value,
				'callback' => array( $this->callback_mngr, 'checkboxField' ),
				'page'     => 'wpoop-plugin',
				'section'  => 'wpoop_admin_index',
				'args'     => array(
					'label_for' => $key,
					'class'     => 'ui-toggle',
				),
			);
		}

		$this->settings->set_fields( $args );
	}
}
