<?php
function register_case_study(){
	$args = [
		'labels' =>[
			'name' => 'Case Studies',
			'singular_name' => 'Case Study'
		],
		'hierarchical' => true,
		'public' => true,
		'has_archive' => true,
		'supports' => [
			'title',
			'editor',
			'thumbnail',
		],
		'menu_icon' => 'dashicons-book'
	];
	register_post_type('case_study',$args);
}