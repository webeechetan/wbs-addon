<?php
function register_case_study(){
	$args = [
		'labels' =>[
			'name' => 'Case Studies',
			'singular_name' => 'Case Study'
		],
		'hierarchical' => false,
		'public' => true,
		'has_archive' => false,
		'supports' => [
			'title',
			'editor',
			'thumbnail',
		],
		'menu_icon' => 'dashicons-book',
		'show_in_rest' => true,
	];
	register_post_type('case_study',$args);
}