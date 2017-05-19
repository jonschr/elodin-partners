<?php

add_action( 'add_loop_layout_partners', 'rb_partners_layout' );
function rb_partners_layout() {

	global $post;

	$background = get_the_post_thumbnail_url( get_the_ID(), 'medium' );
	$url = get_post_meta( get_the_ID(), 'partner_url', true );
	$title = get_the_title();

	edit_post_link( 'Edit this partner', '', '', get_the_ID(), 'partner-edit-link' );

	//* Output the featured image
    printf( '<div class="featured-image" style="background-image:url( %s )"></div>', $background );

	echo '<div class="overlay"><div class="overlay-inner">';

		printf( '<h3>%s</h3>', $title );

		if ( $url )
			printf( '<a class="partners-link icon-link" target="_blank" href="%s"></a>', $url );

		if ( $content )
			printf( '<a class="partners-link icon-info" target="_blank" href="%s"></a>', $url );


	echo '</div></div>';

	

}