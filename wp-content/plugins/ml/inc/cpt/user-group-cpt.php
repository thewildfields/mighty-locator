<?php

add_action( 'init' , '___mlp__register_user_group_cpt' );

function ___mlp__register_user_group_cpt(){

    register_post_type( 'user-group', [
		'label'  => 'User Group',
		'description'            => '',
		'public'                 => true,
		'show_in_menu'           => true,
        'show_in_rest'        => true,
        'rest_base'           => null,
        'menu_position'       => null,
		'menu_icon'           => null,
        'hierarchical'        => false,
		'supports'            => [ 'title', 'author' ],
        'taxonomies'          => [],
		'has_archive'         => true,
		'rewrite'             => true,
		'query_var'           => true,
	] );

}