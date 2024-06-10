<?php

add_action( 'init', '___mlp__register_listings_cpt' );

function ___mlp__register_listings_cpt(){

	register_post_type( 'listing', [
		'label'  => null,
		'labels' => [
			'name'               => 'Listings',
            'singular_name'      => 'Listing',
            'menu_name'          => 'Listings',
        ],
		'description'            => '',
		'public'                 => true,
		'show_in_menu'           => true,
        'show_in_rest'        => true,
		'menu_position'       => 15,
		'menu_icon'           => null,
        'hierarchical'        => false,
		'supports'            => [ 'title', 'editor', 'thumbnail', 'author' ], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
		'taxonomies'          => ['post_tag'],
		'has_archive'         => true,
		'rewrite'             => true,
		'query_var'           => true,
	] );

}