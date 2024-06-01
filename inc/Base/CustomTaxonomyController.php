<?php

namespace WPOOP\Base;

use WPOOP\API\SettingsAPI;
use WPOOP\Base\BaseController;
use WPOOP\API\Callbacks\AdminCallback;

class CustomTaxonomyController extends BaseController {

	public $admin_callback;
	public $subpages;
	public $settings;


	public function register() {
		$checkbox = get_option( 'wpoop_plugin' );
		$checked  = isset( $checkbox['cpt_manager'] ) ? $checkbox['cpt_manager'] : false;

		if ( ! $checked ) {
			return;
		}

		$this->settings = new SettingsAPI();

		$this->admin_callback = new AdminCallback();

		$this->set_subpages();

		$this->settings->add_sub_pages( $this->subpages )->register();

		add_action( 'init', array( $this, 'activate' ) );
	}

	public function activate() {
		register_post_type(
			'wpoop_product',
			array(
				'labels'      => array(
					'name'          => 'Products',
					'singular_name' => 'Product',
				),
				'public'      => true,
				'has_archive' => true,
			)
		);
	}

	public function set_subpages() {
		$this->subpages = array(
			array(
				'parent_slug' => 'wpoop_plugin',
				'page_title'  => 'CPT Manager',
				'menu_title'  => 'CPT Manager',
				'capability'  => 'manage_options',
				'menu_slug'   => 'wpoop_cpt',
				'callback'    => array( $this->admin_callback, 'cta_manager' ),
			),
		);
	}
}
