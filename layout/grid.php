<?php

add_action( 'before_loop_layout_partners', 'elodin_partners_grid_scripts_styles' );
function elodin_partners_grid_scripts_styles() {
	wp_enqueue_style( 'elodin-partners-style' );
    wp_enqueue_style( 'elodin-partners-fontello' );

    wp_enqueue_style( 'elodin-partners-featherlight-style' );
    wp_enqueue_script( 'elodin-partners-featherlight-script' );
	
	wp_enqueue_script( 'elodin-partners-background-images' );
}


//* Add a layout for each individual partner
add_action( 'add_loop_layout_partners', 'elodin_partners_grid_layout' );
function elodin_partners_grid_layout() {

	global $post;

	$background = get_the_post_thumbnail_url( get_the_ID(), 'medium' );
	$content = apply_filters( 'the_content', get_the_content() );
	$url = get_post_meta( get_the_ID(), 'partner_url', true );
	$title = get_the_title();

	edit_post_link( 'Edit this partner', '', '', get_the_ID(), 'partner-edit-link' );

	//* Output the featured image
	if ( has_post_thumbnail() )
	    printf( '<div class="featured-image" style="background-image:url( %s )"></div>', $background );
	
	//* If there's no thumb, let's output the name
	if ( !has_post_thumbnail() )
		printf( '<div class="no-thumb"><h3>%s</h3></div>', $title );

	echo '<div class="overlay"><div class="overlay-inner">';

		printf( '<h3>%s</h3>', $title );

		if ( $url )
			printf( '<a class="partners-link icon-link" target="_blank" href="%s"></a>', $url );

		if ( $content )
			printf( '<a href="#" data-featherlight="#partner-%s" class="partners-link icon-info"></a>', get_the_ID() );

		if ( $content )
			printf( '<div id="partner-%s" class="partner-content"><h2>%s</h2>%s</div>', get_the_ID(), $title, $content );


	echo '</div></div>';

	

}