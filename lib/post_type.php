<?php
/**
 * Post Types
 *
 * This file registers any custom post types
 *
 * @package      Core_Functionality
 * @since        1.0.0
 * @author       Jon Schroeder <jon@redblue.us>
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

function redbluepartners_register_post_types() {

	//* Staff members
	$labels = array(
		'name' => 'Partners',
		'singular_name' => 'Partner',
		'add_new' => 'Add new',
		'add_new_item' => 'Add new Partner',
		'edit_item' => 'Edit Partner',
		'new_item' => 'New Partner',
		'view_item' => 'View Partner',
		'search_items' => 'Search Partners',
		'not_found' =>  'No Partners found',
		'not_found_in_trash' => 'No Partners found in trash',
		'parent_item_colon' => '',
		'menu_name' => 'Partners'
	);

	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'rewrite' => array( 'slug' => 'partners' ),
		'has_archive' => false,
		'hierarchical' => false,
		'menu_position' => 4,
		'menu_icon' => 'dashicons-networking',
		'supports' => array( 'title', 'thumbnail', 'editor' )
	);

	register_post_type( 'partners', $args );

}

add_action( 'init', 'redbluepartners_register_post_types' );

//* Redirect the single posts to the custom archive page
add_action( 'template_redirect', 'redbluepartners_redirect_single_partners' );
function redbluepartners_redirect_single_partners() {
    if ( !is_singular( 'partners' ) )
        return;

    wp_redirect( home_url() . '/partners/', 301 );

    exit;
}