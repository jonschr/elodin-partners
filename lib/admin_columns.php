<?php

function ac_custom_column_settings_1188d70b() {

	ac_register_columns( 'partners', array(
		array(
			'columns' => array(
				'5bd9fac51c977' => array(
					'type' => 'column-featured_image',
					'label' => 'Image',
					'width' => '100',
					'width_unit' => 'px',
					'featured_image_display' => 'image',
					'image_size' => 'cpac-custom',
					'image_size_w' => '70',
					'image_size_h' => '40',
					'edit' => 'on',
					'sort' => 'off',
					'filter' => 'off',
					'filter_label' => '',
					'name' => '5bd9fac51c977',
					'label_type' => '',
					'search' => ''
				),
				'title' => array(
					'type' => 'title',
					'label' => 'Partner name',
					'width' => '',
					'width_unit' => '%',
					'edit' => 'on',
					'sort' => 'on',
					'name' => 'title',
					'label_type' => '',
					'search' => ''
				),
				'5bd9fac518410' => array(
					'type' => 'column-content',
					'label' => 'Content',
					'width' => '',
					'width_unit' => '%',
					'string_limit' => 'word_limit',
					'excerpt_length' => '5',
					'before' => '',
					'after' => '',
					'edit' => 'on',
					'sort' => 'off',
					'filter' => 'off',
					'filter_label' => '',
					'name' => '5bd9fac518410',
					'label_type' => '',
					'search' => ''
				),
				'5bd9fb23c89c5' => array(
					'type' => 'column-acf_field',
					'label' => 'URL',
					'width' => '',
					'width_unit' => '%',
					'field' => 'partner_url',
					'edit' => 'on',
					'sort' => 'on',
					'filter' => 'off',
					'filter_label' => '',
					'name' => '5bd9fb23c89c5',
					'label_type' => '',
					'search' => ''
				),
				'taxonomy-partnercategories' => array(
					'type' => 'taxonomy-partnercategories',
					'label' => 'Partner category',
					'width' => '',
					'width_unit' => '%',
					'edit' => 'on',
					'enable_term_creation' => 'on',
					'sort' => 'on',
					'filter' => 'off',
					'filter_label' => '',
					'name' => 'taxonomy-partnercategories',
					'label_type' => '',
					'search' => ''
				)
			),
			
		)
	) );
}
add_action( 'ac/ready', 'ac_custom_column_settings_1188d70b' );