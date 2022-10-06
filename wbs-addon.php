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
    require_once(__DIR__.'/widgets/feature-box.php');
    $widgets_master->register(new \Slider() );
    $widgets_master->register(new \Feature_Box() );
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


// Adding Custom Post Types

add_action( 'init', 'register_case_study' );
add_action( 'init', 'register_services' );

?>
