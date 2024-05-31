<?php

namespace WPOOP\Base;

use WPOOP\Base\BaseController;

class SettingsLinks extends BaseController {

	public function register() {
		add_filter( 'plugin_action_links_' . $this->plugin, array( $this, 'plugin_action_links' ) );
	}

	public function plugin_action_links( $links ) {
		$links[] = '<a href="admin.php?page=wpoop_plugin">Settings</a>';
		return $links;
	}
}
