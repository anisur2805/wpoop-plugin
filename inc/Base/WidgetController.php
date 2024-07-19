<?php

namespace WPOOP\Base;

use WPOOP\Base\BaseController;
use WPOOP\API\Widgets\MediaWidget;

class WidgetController extends BaseController {

	public function register() {
		if ( ! $this->activate_key( 'media_widget_manager' ) ) {
			return;
		}

		$media_widget = new MediaWidget();
		$media_widget->register();
	}
}
