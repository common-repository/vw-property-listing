<?php
/**
 * Plugin Name:       VW Property Listing
 * Plugin URI:        https://www.vwthemes.com/free-plugin/vw-property-listing/
 * Description:       This plugin adds the functionality to add listing and assign agents to listing.
 * Version:           1.3
 * Author:            VowelWeb
 * Author URI:        https://www.vowelweb.com
 * Text Domain:       vw-property-listing
 * Domain Path:       /languages/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

//Include functionality to add properties
require_once('listing-options.php');

//Include functionality to add agent role and attach it to properties
require_once('agent-options.php');

//show property listing with shortcode
require_once('show-listing.php');

//show property listing with shortcode
require_once('add-tabs.php');

function vw_property_listing_admin_stylesheet() {
    wp_enqueue_style( 'info', rtrim(plugins_url( 'css/admin-info.css', __FILE__ )) );
}

add_action('admin_enqueue_scripts', 'vw_property_listing_admin_stylesheet');


?>