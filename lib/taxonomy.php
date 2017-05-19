<?php

//* Register any necessary taxonomies
function redbluepartners_register_taxonomies() {
	
	//* STAFF CATEGORY
	$labels = array(
		'name' => 'Partner categories',
		'singular_name' => 'Partner category',
		'search_items' =>  'Search Partner categories',
		'all_items' => 'All Partner categories',
		'parent_item' => 'Parent Partner category',
		'parent_item_colon' => 'Parent Partner category:',
		'edit_item' => 'Edit Partner category',
		'update_item' => 'Update Partner category',
		'add_new_item' => 'Add New Partner category',
		'new_item_name' => 'New Partner category',
		'menu_name' => 'Partner categories'
	);

	register_taxonomy( 'partnercategories', array( 'partners' ),
		array(
			'hierarchical' => true,
			'labels' => $labels,
			'show_ui' => true,
			'show_admin_column' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'partner-categories' ),
		)
	);
}
add_action( 'init', 'redbluepartners_register_taxonomies' );
