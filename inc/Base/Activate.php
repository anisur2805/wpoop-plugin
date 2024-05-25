<?php
namespace WPOOP\Base;

class Activate {
     /**
      * Activate plugin
      *
      * @since 1.0.0
      */
    public static function active() {
        flush_rewrite_rules();
    }
}

