<?php

add_action( 'init' , '___mlp__register_skip_cpt' );

function ___mlp__register_skip_cpt(){

    register_post_type( 'search', [
		'label'  => 'Search',
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

register_rest_field( 'search', 'meta', array(
    'get_callback' => function ( $data ) {
        return get_post_meta( $data['id'], '', '' );
    }
));

// function register_custom_post_meta_field() {
//     register_post_meta(
//         'post',
//         'custom_post_meta',
//         [
//             'type'         => 'string',
//             'show_in_rest' => true,
//             'single'       => true,
//         ]
//     );
// }
// add_action( 'init', 'register_custom_post_meta_field' );