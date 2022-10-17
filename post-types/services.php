<?php
function register_services(){
	$args = [
		'labels'=>[
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
		'taxonomies'   => array( 'services_taxonomy' )
	];
	register_post_type('services',$args);
}

function add_services_taxonomies() {
	$args = array(
		'hierarchical' => true,
		'labels' => array(
		  'name' => _x( 'Services', 'taxonomy general name' ),
		  'singular_name' => _x( 'Service', 'taxonomy singular name' ),
		  'search_items' =>  __( 'Search Category' ),
		  'all_items' => __( 'All Category' ),
		  'parent_item' => __( 'Parent Category' ),
		  'parent_item_colon' => __( 'Parent Category:' ),
		  'edit_item' => __( 'Edit Category' ),
		  'update_item' => __( 'Update Category' ),
		  'add_new_item' => __( 'Add New Category' ),
		  'new_item_name' => __( 'New Category Name' ),
		  'menu_name' => __( 'Category' ),
		),
		'show_in_rest' => true,
	);
	register_taxonomy('services_taxonomy', ['services'], $args);
  }

  function add_services_tags() {
	$args = array(
		'hierarchical' => false,
		'labels' => array(
		  'name' => _x( 'Tags', 'taxonomy general name' ),
		  'singular_name' => _x( 'Tag', 'taxonomy singular name' ),
		  'search_items' =>  __( 'Search Tags' ),
		  'all_items' => __( 'All Tags' ),
		  'parent_item' => __( 'Parent Tag' ),
		  'parent_item_colon' => __( 'Parent Tag:' ),
		  'edit_item' => __( 'Edit Tag' ),
		  'update_item' => __( 'Update Tag' ),
		  'add_new_item' => __( 'Add New Tag' ),
		  'new_item_name' => __( 'New Category Tag' ),
		  'menu_name' => __( 'Tag' ),
		),
		'show_in_rest'      => true,
	);
	register_taxonomy('services_tags', ['services'], $args);
  }
  