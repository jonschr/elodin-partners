<?php
/*
    Plugin Name: Elodin Partners
    Plugin URI: https://github.com/jonschr/elodin-partners
    GitHub Plugin URI: https://github.com/jonschr/elodin-partners
    Description: Just another Partners theme
    Version: 1.4.1
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
define( 'ELODIN_PARTNERS_DIRECTORY', plugin_dir_url( __FILE__ ) );

// Define the version of the plugin
define ( 'ELODIN_PARTNERS_VERSION', '1.4.1' );

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

// Documentation sidebar link
include_once 'lib/documentation_sidebar_link.php';

// Enqueue Scripts and Styles.
add_action( 'wp_enqueue_scripts', 'elodinpartners_enqueue_everything' );
function elodinpartners_enqueue_everything() {
    
    //* Core styles
    wp_register_style( 'elodin-partners-style', ELODIN_PARTNERS_DIRECTORY . 'css/elodin-partners.css' );
    wp_register_style( 'elodin-partners-fontello', ELODIN_PARTNERS_DIRECTORY . 'fontello/css/fontello.css' );

    //* Featherlight
    wp_register_style( 'elodin-partners-featherlight-style', ELODIN_PARTNERS_DIRECTORY . 'featherlight/src/featherlight.css' );
    wp_register_script( 'elodin-partners-featherlight-script', ELODIN_PARTNERS_DIRECTORY . 'featherlight/src/featherlight.js', 'jquery' );

}

//* Admin columns pro
// add_filter( 'acp/storage/file/directory/writable', '__return_true' );
// add_filter( 'acp/storage/file/directory', function() {
//     // Use a writable path, directory will be created for you
//     return plugin_dir_url( __FILE__ ) . 'acp-settings';
// } );

// Updater
require 'vendor/plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/jonschr/elodin-partners',
	__FILE__,
	'elodin-partners'
);

// Optional: Set the branch that contains the stable release.
$myUpdateChecker->setBranch('master');
