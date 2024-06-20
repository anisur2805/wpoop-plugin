<?php

namespace WPOOP\Base;

use WPOOP\API\SettingsAPI;
use WPOOP\Base\BaseController;
use WPOOP\API\Callbacks\AdminCallback;
use WPOOP\API\Callbacks\TaxonomyCallbacks;

class CustomTaxonomyController extends BaseController {

	public $callback;
	public $settings;
	
	public $tax_callbacks;
	
	public $subpages = array();

	public $taxonomies = array();

	public function register() {
		if ( ! $this->activate_key( 'taxonomy_manager' ) ) return;

		$this->settings = new SettingsAPI();

		$this->callback = new AdminCallback();

		$this->tax_callbacks = new TaxonomyCallbacks();

		$this->set_subpages();

		$this->set_settings();

		$this->set_sections();

		$this->set_fields();

		$this->settings->add_sub_pages( $this->subpages )->register();

		$this->storeTaxonomies();

		if ( ! empty( $this->taxonomies ) ) {
			add_action( 'init', array( $this, 'register_taxonomies' ) );
		}
	}

	public function set_subpages() {
		$this->subpages = array(
			array(
				'parent_slug' => 'wpoop_plugin',
				'page_title'  => 'Taxonomy Manager',
				'menu_title'  => 'Taxonomy Manager',
				'capability'  => 'manage_options',
				'menu_slug'   => 'wpoop_taxonomy',
				'callback'    => array( $this->callback, 'taxonomy_manager' ),
			),
		);
	}

	public function set_settings() {
		$args = array(
			array(
				'option_group' => 'wpoop_plugin_tax_settings',
				'option_name'  => 'wpoop_plugin_tax',
				'callback'     => array( $this->tax_callbacks, 'taxSanitize' ),
			),
		);

		$this->settings->set_settings( $args );
	}

	public function set_sections() {
		$args = array(
			array(
				'id'       => 'wpoop_tax_index',
				'title'    => 'WPOOP Plugin Taxonomy Managers',
				'callback' => array( $this->tax_callbacks, 'taxSectionManager' ),
				'page'     => 'wpoop_tax',
			),
		);

		$this->settings->set_sections( $args );
	}

	public function set_fields() {
		$args = array(
			array(
				'id'       => 'taxonomy',
				'title'    => 'Custom Taxonomy ID',
				'callback' => array( $this->tax_callbacks, 'text_field' ),
				'page'     => 'wpoop_tax',
				'section'  => 'wpoop_tax_index',
				'args'     => array(
					'option_name' => 'wpoop_plugin_tax',
					'label_for'   => 'taxonomy',
					'placeholder' => 'eg. genre',
					'array'       => 'taxonomy',
				),
			),
			array(
				'id'       => 'singular_name',
				'title'    => 'Singular Name',
				'callback' => array( $this->tax_callbacks, 'text_field' ),
				'page'     => 'wpoop_tax',
				'section'  => 'wpoop_tax_index',
				'args'     => array(
					'option_name' => 'wpoop_plugin_tax',
					'label_for'   => 'singular_name',
					'placeholder' => 'eg. Genre',
					'array'       => 'taxonomy',
				),
			),
			array(
				'id'       => 'hierarchical',
				'title'    => 'Hierarchical',
				'callback' => array( $this->tax_callbacks, 'checkbox_field' ),
				'page'     => 'wpoop_tax',
				'section'  => 'wpoop_tax_index',
				'args'     => array(
					'option_name' => 'wpoop_plugin_tax',
					'label_for'   => 'hierarchical',
					'class'       => 'ui-toggle',
					'array'       => 'taxonomy',
				),
			),
		);
		$this->settings->set_fields( $args );
	}

	public function storeTaxonomies() {
		$options = get_option( 'wpoop_plugin_tax' ) ?: array();

		foreach( $options as $option ) {
			$labels = array(
				'name'              => $option['taxonomy'],
				'singular_name'     => $option['singular_name'],
				'search_items'      => __( 'Search ' . $option['singular_name'], 'textdomain' ),
				'all_items'         => __( 'All ' . $option['singular_name'], 'textdomain' ),
				'parent_item'       => __( 'Parent ' . $option['singular_name'], 'textdomain' ),
				'parent_item_colon' => __( 'Parent ' . $option['singular_name'] . ':', 'textdomain' ),
				'edit_item'         => __( 'Edit ' . $option['singular_name'], 'textdomain' ),
				'update_item'       => __( 'Update ' . $option['singular_name'], 'textdomain' ),
				'add_new_item'      => __( 'Add New ' . $option['singular_name'], 'textdomain' ),
				'new_item_name'     => __( 'New ' . $option['singular_name'] . 'Name', 'textdomain' ),
				'menu_name'         => __( $option['singular_name'], 'textdomain' ),
			);
		
			$this->taxonomies[] = array(
				'hierarchical'      => ( isset( $option['hierarchical'])) ? true : false,
				'labels'            => $labels,
				'show_ui'           => true,
				'show_in_rest'      => true,
				'show_admin_column' => true,
				'query_var'         => true,
				'rewrite'           => array( 'slug' => $option['taxonomy'] ),
			);
		}

		// return $this->taxonomies;
	}
	
	public function register_taxonomies() {
		foreach( $this->taxonomies as $taxonomy ) {
			// echo '<pre>';
			// 	  print_r( $taxonomy );
			// echo '</pre>';
			register_taxonomy( $taxonomy['rewrite']['slug'], array( 'post' ), $taxonomy );
		}
	}
	
}
