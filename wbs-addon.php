<?php 

/*Plugin name: Webeesocial Addon For Elementor
Description: Fetaure Box, Slider
Version: 1.0.0
Author: Webeesocial
Text Domain: essential-elementor-widget
*/
define( 'WBS_PLUGIN_URL', plugin_dir_url( __FILE__ ) );


function register_custom_widget($widgets_master)
{
    // require_once(__DIR__.'/widgets/slider.php');
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

?>
