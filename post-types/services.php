<?php
function register_services(){
	$args = [
		'labels' =>[
			'name' => 'Services',
			'singular_name' => 'Services'
		],
		'hierarchical' => false,
		'public' => true,
		'has_archive' => false,
		'supports' => [
			'title',
			'editor',
			'thumbnail',
		],
		'menu_icon' => 'dashicons-hammer',
		'show_in_rest' => true,
	];
	register_post_type('services',$args);
}