<?php 
/**
 * Plugin Name: WBS Addon
 * Description: WBS Addon plugin can add custom addons in elementor and add custom post types and texonomies 
 * Plugin URI: https://webeesocial.com
 * Author: Webeesocial.com
 * Version: 1.0.0
 * Author URI: webeesocial.com
 * Text Domain: webeesocial
 */

define( 'WBS_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

require_once(__DIR__ .'/post-types/case-study.php');
require_once(__DIR__ .'/post-types/services.php');

function register_custom_widget($widgets_master)
{
    require_once(__DIR__.'/widgets/slider.php');
    require_once(__DIR__.'/widgets/case-study.php');
    require_once(__DIR__.'/widgets/feature-box.php');
    require_once(__DIR__.'/widgets/services.php');
    $widgets_master->register(new \Slider() );
    $widgets_master->register(new \Feature_Box() );
    $widgets_master->register(new \Services() );
    $widgets_master->register(new \CaseStudy() );
}

function add_elementor_widget_categories( $elements_manager ) {

	$elements_manager->add_category(
		'wbs',
		[
			'title' => esc_html__( 'WBS', 'plugin-name' ),
			'icon' => 'fa fa-plug',
		]
	);

}

add_action( 'elementor/elements/categories_registered', 'add_elementor_widget_categories' );

add_action('elementor/widgets/register','register_custom_widget');


// Registering Custom Post Types

add_action( 'init', 'register_case_study' );
add_action( 'init', 'register_services' );


// Registering Custom Taxonomies

add_action( 'init', 'add_services_taxonomies');

// Registering Custom Tags

add_action( 'init', 'add_services_tags');
add_action( 'init', 'add_case_study_tags');


?>
