<?php
namespace WPOOP\Base;

/**
 * Deactivate plugin
 *
 * @package WPoopPlugin
 * @subpackage Deactivate
 * @since 1.0.0
 */

class Deactivate {
     /**
      * Deactivate plugin
      *
      * @since 1.0.0
      */
    public static function deactivated() {
        flush_rewrite_rules();
    }
}
