<?php

class Slider extends \Elementor\Widget_Base
{

    public function __construct($data = array(), $args = null)
    {
        parent::__construct($data, $args);
        wp_register_style('slick-slider-css', WBS_PLUGIN_URL . 'assets/css/slick.css');
        wp_register_style('slider-css', WBS_PLUGIN_URL . 'assets/css/slider-custom.css');
        wp_register_script('slider-jquery', WBS_PLUGIN_URL . 'assets/js/jquery.min.js');
        wp_register_script('slider-slick-js', WBS_PLUGIN_URL . 'assets/js/slick.min.js');
        wp_register_script('slider-js', WBS_PLUGIN_URL . 'assets/js/slider.js');
    }

    public function get_name()
    {
        return 'Slider';
    }

    public function get_title()
    {
        return esc_html__('Slider', 'essential-elementor-widget');
    }

    public function get_icon()
    {
        return 'eicon-slider-device';
    }

    public function get_custom_help_url()
    {
        return 'https://developers.elementor.com/docs/getting-started/';
    }

    public function get_categories()
    {
        return ['wbs'];
    }

    public function get_keywords()
    {
        return ['slider', 'customslider', 'myslider'];
    }

    public function get_style_depends()
    {
        return ['slick-slider-css', 'slider-css'];
    }

    public function get_script_depends()
    {
        return ['slider-jquery', 'slider-slick-js', 'slider-js'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(

            'content_section',
            [
                'label' => esc_html__('Content', 'essential-elementor-widget'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'slide_title',
            [
                'label' => esc_html__('Title', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Slide Title', 'plugin-name'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'slide_redirect_url',
            [
                'label' => esc_html__('Image Link', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::URL,
                'options' => ['url', 'is_external', 'nofollow'],
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => false,
                    'custom_attributes' => '',
                ],
            ]
        );

        $repeater->add_control(
            'slide_image',
            [
                'label' => esc_html__('Image', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::MEDIA,
            ]
        );

        $repeater->add_control(
            'btn_text',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label' => esc_html__( 'Button Text', 'plugin-name' ),
                'default' => 'Read More'
            ]
        );

        $repeater->add_control(
            'btn_link',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label' => esc_html__( 'Button Link', 'plugin-name' ),
                'default' => '#'
            ]
        );

        $this->add_control(
            'list',
            [
                'label' => esc_html__('Slides', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'slide_title' => esc_html__('Slide Title ', 'plugin-name'),
                        'slide_redirect_url' => esc_html__('https://google.com', 'plugin-name'),
                        'slide_image' => esc_html__('image_url_goes_here', 'plugin-name'),
                    ],
                ],
                'title_field' => '{{{ slide_title }}}',
            ]
        );


        $this->end_controls_section();

        /*----------------------------------
                     STYLING
        --------------------------------- **/

        $this->start_controls_section(
			'slide_title_style',
			[
				'label' => esc_html__( 'Title', 'elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);



        $this->end_controls_section();

    }


    protected function render()
    {
        $settings = $this->get_settings_for_display();
?>
        <ul class="story-slideshow">
            <?php
            foreach ($settings['list'] as  $value) {
            ?>
                <li class="story-slide">
                    <figure>
                        <div class="slide-ratio">
                            <img src="<?php echo  $value['slide_image']['url'] ?>" />
                            <span class="story-slide-overlay">
                                <h6><?php echo $value['slide_title'] ?></h6>
                            </span>
                        </div>
                        <figcaption class="slide-caption"><span><?php echo $value['slide_title'] ?></span> <a class="more-link" href="<?php echo $value['slide_redirect_url']['url']?>">more ⟶</a></figcaption>
                    </figure>
                </li>
            <?php }  ?>
        </ul>
    <?php
    }

    protected function content_template()
    {
    ?>
    <#  
        
    #>
        <# if ( settings.list.length ) { #>
            <ul class="story-slideshow">
            <# _.each( settings.list, function( item ) {  console.log('a')  #>
                <li class="story-slide">
                    <figure>
                        <div class="slide-ratio">
                            <img src="{{{ item.slide_image.url }}}">
                            <span class="story-slide-overlay">
                                <h2>{{{ item.slide_title }}}</h2>
                            </span>
                        </div>
                        <figcaption class="slide-caption"><span>{{{ item.slide_title }}}</span> <a class="more-link" href="{{{ item.slide_redirect_url.url }}}">more ⟶</a></figcaption>
                    </figure>
                </li>
            <# }); #>
            </ul>
            <# } #>
        <?php
    }
}
