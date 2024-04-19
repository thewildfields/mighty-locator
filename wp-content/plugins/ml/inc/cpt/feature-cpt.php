<?php

add_action( 'init' , '___mlp__register_feature_cpt' );

function ___mlp__register_feature_cpt(){

    register_post_type( 'feature', [
		'label'  => 'Feature',
		'description'            => '',
		'public'                 => true,
		'show_in_menu'           => true,
        'show_in_rest'        => true,
        'rest_base'           => null,
        'menu_position'       => null,
		'menu_icon'           => null,
        'hierarchical'        => false,
		'supports'            => [ 'title' ],
        'taxonomies'          => [],
		'has_archive'         => false,
		'rewrite'             => true,
		'query_var'           => true,
	] );

}