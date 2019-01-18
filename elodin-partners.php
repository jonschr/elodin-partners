<?php
/*
    Plugin Name: Elodin Partners
    Plugin URI: https://github.com/jonschr/elodin-partners
    GitHub Plugin URI: https://github.com/jonschr/elodin-partners
    Description: Just another Partners theme
    Version: 1.1
    Author: Jon Schroeder
    Author URI: https://elod.in

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
    GNU General Public License for more details.
*/

/////////////////
// BASIC SETUP //
/////////////////

// Plugin Directory
define( 'ELODIN_PARTNERS_DIRECTORY', dirname( __FILE__ ) );

// Define the version of the plugin
define ( 'ELODIN_PARTNERS_VERSION', '1.1' );

/**
 * Add a notification if ACF isn't installed and active
 */
add_action( 'admin_notices', 'redbluepartners_error_notice_ACF' );
function redbluepartners_error_notice_ACF() {

    if( !class_exists( 'acf' ) ) {
        echo '<div class="error notice"><p>Please install and activate the <a target="_blank" href="https://www.advancedcustomfields.com/pro/">Advanced Custom Fields Pro</a> plugin. Without it, the Red Blue Partners plugin won\'t work properly.</p></div>';
    }

    //* Testing to see whether we have the Pro version of ACF installed
    if( class_exists( 'acf' ) && !class_exists( 'acf_pro_updates' ) ) {
        echo '<div class="error notice"><p>It looks like you\'ve installed the free version of Advanced Custom Fields. To work properly, the Red Blue Partners plugin requires <a target="_blank" href="https://www.advancedcustomfields.com/pro/">the Pro version</a> instead.</p></div>';
    }
}

/**
 * Add a notification if Genesis isn't installed and active
 */
add_action( 'admin_notices', 'redbluepartners_error_notice_genesis' );
function redbluepartners_error_notice_genesis() {
    if( !function_exists( 'genesis' ) ) {
        echo '<div class="error notice"><p>Please install and activate the <a target="_blank" href="http://my.studiopress.com/themes/genesis/">Genesis Framework</a> parent theme, then install a child theme. Without the framework, the Red Blue Partners plugin won\'t work properly.</p></div>';
    }
}

//* If we don't have Genesis running, let's bail out right there
$theme = wp_get_theme(); // gets the current theme
if ( 'genesis' != $theme['Template'] )
    return;

// Register post types
include_once 'lib/post_type.php';

// Register taxonomy
include_once 'lib/taxonomy.php';

// Register custom fields
include_once 'lib/custom_fields.php';

// Admin columns
include_once 'lib/admin_columns.php';

// Register shortcode
include_once 'template/shortcode.php';

// Enqueue Scripts and Styles.
add_action( 'wp_enqueue_scripts', 'redbluepartners_enqueue_everything' );
function redbluepartners_enqueue_everything() {
    
    //* Core styles
    wp_register_style( 'elodin-partners-style', plugin_dir_url( __FILE__ ) . '/css/elodin-partners.css' );
    wp_register_style( 'elodin-partners-fontello', plugin_dir_url( __FILE__ ) . '/fontello/css/fontello.css' );

    //* Featherlight
    wp_register_style( 'elodin-partners-featherlight-style', plugin_dir_url( __FILE__ ) . '/featherlight/src/featherlight.css' );
    wp_register_script( 'elodin-partners-featherlight-script', plugin_dir_url( __FILE__ ) . '/featherlight/src/featherlight.js', 'jquery' );

}


/**
 * Backend styles and scripts
 */
add_action( 'enqueue_block_editor_assets', 'redbluepartners_enqueue_everything_gutenberg' );
function redbluepartners_enqueue_everything_gutenberg() {

    //* Core styles
    wp_enqueue_style( 'elodin-partners-style', plugin_dir_url( __FILE__ ) . '/css/elodin-partners.css' );
    wp_enqueue_style( 'elodin-partners-fontello', plugin_dir_url( __FILE__ ) . '/fontello/css/fontello.css' );

    //* Featherlight
    wp_enqueue_style( 'elodin-partners-featherlight-style', plugin_dir_url( __FILE__ ) . '/featherlight/src/featherlight.css' );
    wp_enqueue_script( 'elodin-partners-featherlight-script', plugin_dir_url( __FILE__ ) . '/featherlight/src/featherlight.js', 'jquery' );

}

