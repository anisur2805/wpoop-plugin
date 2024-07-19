<?php

namespace WPOOP\API\Callbacks;

use WPOOP\Base\BaseController;

class TestimonialCallback extends BaseController {
	public function shortcode_page_callback() {
		require_once "$this->plugin_path/templates/testimonials.php";
	}
}
