<?php
/**
 * Uninstall plugin
 *
 * @package WPoopPlugin
 * @subpackage Uninstall
 * @since 1.0.0
 */


if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit;
}


/**
 * Delete all wpoop posts method 1
 */
$wpoops = get_posts( array( 'post_type' => 'wpoop', 'numberposts' => -1, 'post_status' => 'any' ) );
foreach ( $wpoops as $wpoop ) {
    wp_delete_post( $wpoop->ID, true );
}

/**
 * Delete all wpoop posts method 2
 */
// global $wpdb;
// $wpdb->query( "DELETE FROM $wpdb->posts WHERE post_type = 'wpoop'" );
// $wpdb->query( "DELETE FROM $wpdb->postmeta WHERE post_id NOT IN (SELECT id FROM $wpdb->posts)" );
// $wpdb->query( "DELETE FROM $wpdb->term_relationships WHERE object_id NOT IN (SELECT id FROM $wpdb->posts)" );
