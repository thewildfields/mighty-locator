<?php

add_action( 'init' , '___mlp__register_skip_cpt' );

function ___mlp__register_skip_cpt(){

    register_post_type( 'skip', [
		'label'  => 'Skip',
		'description'            => '',
		'public'                 => true,
		'show_in_menu'           => true,
        'show_in_rest'        => true,
        'rest_base'           => null,
        'menu_position'       => null,
		'menu_icon'           => null,
        'hierarchical'        => false,
		'supports'            => [ 'title', 'author' , 'editor' ],
        'taxonomies'          => [],
		'has_archive'         => true,
		'rewrite'             => true,
		'query_var'           => true,
	] );

}