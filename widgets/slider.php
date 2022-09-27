<?php

use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

class Slider extends \Elementor\Widget_Base
{

    public function __construct($data = array(), $args = null)
    {
        parent::__construct($data, $args);
        wp_register_style('slick-slider-css', WBS_PLUGIN_URL . 'assets/css/slick.css');
        wp_register_style('slider-css', WBS_PLUGIN_URL . 'assets/css/slider-custom.css');
        wp_register_script('slider-jquery', WBS_PLUGIN_URL . 'assets/js/jquery.min.js');
        wp_register_script('slider-slick-js', WBS_PLUGIN_URL . 'assets/js/slick.min.js');
        wp_register_script('slider-js', WBS_PLUGIN_URL . 'assets/js/slider.js', ['elementor-frontend'], '1.0.0', true);
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
                'label' => esc_html__('Button Text', 'plugin-name'),
                'default' => 'Read More'
            ]
        );

        $repeater->add_control(
            'btn_link',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label' => esc_html__('Button Link', 'plugin-name'),
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
                     SLIDER SETTINGS 
        --------------------------------- **/

        $this->start_controls_section(

            'slide_settings',
            [
                'label' => esc_html__('Slider Settings', 'essential-elementor-widget'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'slide_to_display',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label' => esc_html__('Slide To Display', 'plugin-name'),
                'default' => '3'
            ]
        );

        $this->add_control(
            'auto_play',
            [
                'label' => esc_html__('Auto Play', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'your-plugin'),
                'label_off' => esc_html__('No', 'your-plugin'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'auto_play_speed',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label' => esc_html__('Play Speed In Milliseconds', 'plugin-name'),
                'default' => '3000'
            ]
        );

        $this->add_control(
            'show_title_on_slide',
            [
                'label' => esc_html__('Show Title On Slide', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'your-plugin'),
                'label_off' => esc_html__('No', 'your-plugin'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();

        /*----------------------------------
                     STYLING
        --------------------------------- **/

        $this->start_controls_section(
            'slide_title_style',
            [
                'label' => esc_html__('Title', 'elementor'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label' => esc_html__('Alignment', 'elementor'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'elementor'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'elementor'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'elementor'),
                        'icon' => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => esc_html__('Justified', 'elementor'),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .slide_title' => 'text-align: {{VALUE}};',
                ],
                'separator' => 'before'
            ],
        );

        $this->add_control(
            'footer_caption_color',
            [
                'label' => esc_html__('Footer Caption Color', 'elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slide-caption' => 'background: {{VALUE}};',
                ],
                'global' => [
                    'default' => Global_Colors::COLOR_PRIMARY,
                ],
            ]
        );

        $this->end_controls_section();


        ////////////Edited/////////////////
        $this->start_controls_section(
            'slide_button_style',
            [
                'label' => esc_html__('Button', 'elementor'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );



        $this->add_responsive_control(
            'align_btn',
            [
                'label' => esc_html__('Alignment', 'elementor'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'elementor'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'elementor'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'elementor'),
                        'icon' => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => esc_html__('Justified', 'elementor'),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'default' => '',
                'selectors' => [

                    '{{WRAPPER}} .more-link' => 'text-align: {{VALUE}};',

                ],
                'separator' => 'before'
            ],
        );

       
        $this->add_control(
			'Button_text_color',
			[
				'label' => esc_html__( 'Button Text Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .more-link' => 'color: {{VALUE}};',
				],
				'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
			]
		);
           
        $this->add_responsive_control(
			'Slider_bottom_space',
			[
				'label' => esc_html__( 'Footer Spacing', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} figcaption' => 'margin-top: {{SIZE}}{{UNIT}};',
				]
			]
		);

        $this->add_responsive_control(
			'Slider_top_space',
			[
				'label' => esc_html__( 'Image Top Spacing', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .story-slideshow' => 'margin-top: {{SIZE}}{{UNIT}};',
				]
			]
		);
     
        $this->end_controls_section();
    }


    protected function render()
    {
        $settings = $this->get_settings_for_display();

        // echo "<pre>";
        // print_r ($settings);
        // exit();
?>
        <div class="story-slideshow">
            <?php
            foreach ($settings['list'] as  $value) {
            ?>
                <div class="story-slide">
                    <figure>
                        <div class="slide-ratio">
                            <img src="<?php echo  $value['slide_image']['url'] ?>" />
                            <?php if ($settings['show_title_on_slide'] == 'yes') { ?>
                                <span class="story-slide-overlay">
                                    <h6><?php echo $value['slide_title'] ?></h6>
                                </span>
                            <?php } ?>
                        </div>

                        <figcaption class="slide-caption">
                            <span class="slide_title"><?php echo $value['slide_title'] ?></span>

                            <a class="more-link" href="<?php echo $value['slide_redirect_url']['url'] ?>"><?php echo $value['btn_text'] ?>⟶</a>

                        </figcaption>


                    </figure>

                </div>
            <?php }  ?>
        </div>
        <input type="hidden" id="slider_settings" value='<?php echo json_encode($settings, true); ?>'>
    <?php
    }
























    protected function content_template()
    {
    ?>
        <# if ( settings.list.length ) { #>
            <div class="story-slideshow">
                <# _.each( settings.list, function( item ) { #>
                    <div class="story-slide">
                        <figure>
                            <div class="slide-ratio">
                                <img height="200" width="200" src="{{{ item.slide_image.url }}}">
                                <span class="story-slide-overlay">
                                    <h2>{{{ item.slide_title }}}</h2>
                                </span>
                            </div>
                            <figcaption class="slide-caption"><span>{{{ item.slide_title }}}</span> <a class="more-link" href="{{{ item.slide_redirect_url.url }}}">more ⟶</a></figcaption>
                        </figure>
                    </div>
                    <# }); #>
            </div>
            <# } #>
        <?php
    }
}
