<?php

namespace WPOOP\Base;

use WPOOP\API\SettingsAPI;
use WPOOP\Base\BaseController;
use WPOOP\API\Callbacks\TestimonialCallback;

class PageTemplateController extends BaseController {

	public $templates;

	public function register() {
		if ( ! $this->activate_key( 'custom_tmp_manager' ) ) {
			return;
		}

		$this->templates = array(
			'page-templates/two-columns-tmp.php' => 'Two Columns Template',
		);

		add_filter( 'theme_page_templates', array( $this, 'page_template_cb' ) );
		add_filter( 'template_include', array( $this, 'template_include_cb' ) );
	}

	public function page_template_cb( $templates ) {
		$templates = array_merge( $templates, $this->templates );

		return $templates;
	}

	public function template_include_cb( $template ) {
		global $post;

		if ( ! $post ) {
			return $template;
		}

		$template_name = get_post_meta( $post->ID, '_wp_page_template', true );

		if ( ! isset( $this->templates[ $template_name ] ) ) {
			return $template;
		}

		$file = $this->plugin_path . $template_name;

		if ( file_exists( $file ) ) {
			return $file;
		}

		return $template;
	}
}
