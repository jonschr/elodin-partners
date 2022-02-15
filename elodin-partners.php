<?php
/*
    Plugin Name: Elodin Partners
    Plugin URI: https://github.com/jonschr/elodin-partners
    GitHub Plugin URI: https://github.com/jonschr/elodin-partners
    Description: Just another Partners theme
    Version: 1.5.0
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
define ( 'ELODIN_PARTNERS_VERSION', '1.5.0' );

// Register post types
include_once 'lib/post_type.php';

// Register taxonomy
include_once 'lib/taxonomy.php';

// Register custom fields
include_once 'lib/custom_fields.php';

// Admin columns
// include_once 'lib/admin_columns.php';

// Register shortcodes
include_once 'layout/grid.php';
include_once 'layout/slider.php';

// Documentation sidebar link
include_once 'lib/documentation_sidebar_link.php';

// Enqueue Scripts and Styles.
add_action( 'wp_enqueue_scripts', 'elodinpartners_enqueue_everything' );
function elodinpartners_enqueue_everything() {
    
    //* Core styles
    wp_register_style( 
        'elodin-partners-style', 
        ELODIN_PARTNERS_DIRECTORY . 'css/elodin-partners.css',
        array(),
        ELODIN_PARTNERS_VERSION, 
        'screen'
    );
    
    wp_register_style( 
        'elodin-partners-fontello', 
        ELODIN_PARTNERS_DIRECTORY . 'vendor/fontello/css/fontello.css',
        array(),
        ELODIN_PARTNERS_VERSION, 
        'screen'
    );

    //* Featherlight
    wp_register_style( 
        'elodin-partners-featherlight-style', 
        ELODIN_PARTNERS_DIRECTORY . 'vendor/featherlight/src/featherlight.css',
        array(),
        ELODIN_PARTNERS_VERSION, 
        'screen'
    );
    
    wp_register_script( 
        'elodin-partners-featherlight-script', 
        ELODIN_PARTNERS_DIRECTORY . 'vendor/featherlight/src/featherlight.js', 
        array( 'jquery' ),
        ELODIN_PARTNERS_VERSION, 
        true    
    );
    
    //* Slick
    wp_register_style( 
        'elodin-partners-slick-style', 
        ELODIN_PARTNERS_DIRECTORY . 'vendor/slick/slick.css', 
        array(),
        ELODIN_PARTNERS_VERSION, 
        'screen'
    );
    
    wp_register_style( 
        'elodin-partners-slick-theme', 
        ELODIN_PARTNERS_DIRECTORY . 'vendor/slick/slick-theme.css', 
        array(),
        ELODIN_PARTNERS_VERSION, 
        'screen'
    );
    
    wp_register_script( 
        'elodin-partners-slick-script', 
        ELODIN_PARTNERS_DIRECTORY . 'vendor/slick/slick.js', 
        array( 'jquery' ),
        ELODIN_PARTNERS_VERSION, 
        true    
    );
    
     wp_register_script( 
        'elodin-partners-slick-init', 
        ELODIN_PARTNERS_DIRECTORY . 'js/slider-init.js', 
        array( 'elodin-partners-slick-script' ),
        ELODIN_PARTNERS_VERSION, 
        true    
    );

}

///////////////////////
// ADMIN COLUMNS PRO //
///////////////////////

use AC\ListScreenRepository\Storage\ListScreenRepositoryFactory;
use AC\ListScreenRepository\Rules;
use AC\ListScreenRepository\Rule;
add_filter( 'acp/storage/repositories', function( array $repositories, ListScreenRepositoryFactory $factory ) {
    
    //! Change $writable to true to allow changes to columns for the content types below
    $writable = false;
    
    // 2. Add rules to target individual list tables.
    // Defaults to Rules::MATCH_ANY added here for clarity, other option is Rules::MATCH_ALL
    $rules = new Rules( Rules::MATCH_ANY );
    $rules->add_rule( new Rule\EqualType( 'partners' ) );
    
    // 3. Register your repository to the stack
    $repositories['elodin-partners'] = $factory->create(
        RENTFETCH_DIR . '/acp-settings',
        $writable,
        $rules
    );
    
    return $repositories;
    
}, 10, 2 );

// Updater
require 'vendor/plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/jonschr/elodin-partners',
	__FILE__,
	'elodin-partners'
);

// Optional: Set the branch that contains the stable release.
$myUpdateChecker->setBranch('master');
