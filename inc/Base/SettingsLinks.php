<?php

namespace WPOOP\Base;

class SettingsLinks {
  
    public function register() {
        add_filter( 'plugin_action_links_' . WPOOP_PLUGIN, array( $this, 'plugin_action_links' ) );
    }

    public function plugin_action_links( $links ) {        
        $links[] = '<a href="admin.php?page=wpoop-plugin">Settings</a>';
        return $links;
    }

}
