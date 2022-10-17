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

function add_case_study_tags() {
	$args = array(
		'hierarchical' => false,
		'labels' => array(
		  'name' => _x( 'Case Study', 'taxonomy general name' ),
		  'singular_name' => _x( 'Case Study', 'taxonomy singular name' ),
		  'search_items' =>  __( 'Search Tag' ),
		  'all_items' => __( 'All Tag' ),
		  'parent_item' => __( 'Tag Category' ),
		  'parent_item_colon' => __( 'Parent Tag:' ),
		  'edit_item' => __( 'Edit Tag' ),
		  'update_item' => __( 'Update Tag' ),
		  'add_new_item' => __( 'Add New Tag' ),
		  'new_item_name' => __( 'New Tag Name' ),
		  'menu_name' => __( 'Tag' ),
		),
		'show_in_rest' => true,
	);
	register_taxonomy('case_study_taxonomy', ['case_study'], $args);
  }