<?php

add_action( 'before_loop_layout_partners', 'rb_partner_scripts_styles' );
function rb_partner_scripts_styles() {
	wp_enqueue_style( 'redblue-partners-style' );
    wp_enqueue_style( 'redblue-partners-fontello' );

    wp_enqueue_style( 'redblue-partners-featherlight-style' );
    wp_enqueue_script( 'redblue-partners-featherlight-script' );
}


//* Add a layout for each individual partner
add_action( 'add_loop_layout_partners', 'rb_partners_layout' );
function rb_partners_layout() {

	global $post;

	$background = get_the_post_thumbnail_url( get_the_ID(), 'medium' );
	$content = apply_filters( 'the_content', get_the_content() );
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
			printf( '<a href="#" data-featherlight="#partner-%s" class="partners-link icon-info"></a>', get_the_ID() );

		if ( $content )
			printf( '<div id="partner-%s" class="partner-content"><h2>%s</h2>%s</div>', get_the_ID(), $title, $content );


	echo '</div></div>';

	

}