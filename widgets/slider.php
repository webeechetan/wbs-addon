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

          //To control the image description

            $repeater->add_control(
                'img-desc',
                [
                    'label' => 'Image Description',
                    'type' => \Elementor\Controls_Manager::WYSIWYG,
                    'default' => 'Some example content. Start Editing Here. With media upload'
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'description_typography',
                    'selector' => '{{WRAPPER}} .img_description',
                    'global' => [
                        'default' => Global_Typography::TYPOGRAPHY_TEXT,
                    ],
                ]
            );


        //   $this->add_control(
        //     'img-desc',
        //     [
        //         'label' => 'Image Description',
        //         'type' => \Elementor\Controls_Manager::WYSIWYG,
        //         'default' => 'Some example content. Start Editing Here. With media upload'
        //     ]
        // );


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
                'default' => '2',
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
            'slide_direction',
            [

                'label' => esc_html__('Slide Direction','plugin-name'),
                'type' => \Elementor\Controls_Manager::SELECT,

				'options' => [
					'left' => 'Left',
					'right' => 'Right',
					'default' => 'Default',
				],
				'default' => 'left',
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


            /////////Slider pause on hover/////
            
            
        $this->add_control(
            'Slide-hover',
            [
                'label' => esc_html__('Pause on Hover', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                 'label_on' => esc_html__('Yes', 'your-plugin'),
                 'label_off' => esc_html__('No', 'your-plugin'),
                 'return_value' => 'yes',
                 'default' => 'yes',
             ]
        );

            /////////Slider pause on hover/////


            //To control the size of the image via dropdown
            $this->add_group_control(
                \Elementor\Group_Control_Image_Size::get_type(),
                [
                    'name' => 'image',
                    'default' => 'full',
                    'separator' => 'none',
                ]
            );

            //To control the Title size 
            $this->add_control(
                'title_size',
                [
                    'label' => esc_html__('Title HTML Tag', 'elementor'),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'options' => [
                        'h1' => 'H1',
                        'h2' => 'H2',
                        'h3' => 'H3',
                        'h4' => 'H4',
                        'h5' => 'H5',
                        'h6' => 'H6',
                        'div' => 'div',
                        'span' => 'span',
                        'p' => 'p',
                    ],
                    'default' => 'h4',
                    'separator' => 'after'
                ]
            );

            $this->add_control(
                'previous_icon',
                [
                    'label' => esc_html__( 'Previous Icon', 'textdomain' ),
                    'type' => \Elementor\Controls_Manager::ICONS,
                    'default' => [
                        'value' => 'fas fa-circle',
                        'library' => 'fa-solid',
                    ],
                    'recommended' => [
                        'fa-solid' => [
                            'circle',
                            'dot-circle',
                            'square-full',
                        ],
                        'fa-regular' => [
                            'circle',
                            'dot-circle',
                            'square-full',
                        ],
                    ],
                ]
            );

            $this->add_control(
                'next_icon',
                [
                    'label' => esc_html__( 'Next Icon', 'textdomain' ),
                    'type' => \Elementor\Controls_Manager::ICONS,
                    'default' => [
                        'value' => 'fas fa-circle',
                        'library' => 'fa-solid',
                    ],
                    'recommended' => [
                        'fa-solid' => [
                            'circle',
                            'dot-circle',
                            'square-full',
                        ],
                        'fa-regular' => [
                            'circle',
                            'dot-circle',
                            'square-full',
                        ],
                    ],
                ]
            );
    

           // Workig To give the border to the image
            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name'=> 'img_border',
                    'selector' => '{{WRAPPER}} img',
                    'separator' => 'before',

                ]
            );

            //Working To give the radius to the image border

            $this->add_responsive_control(
                'image_border_radius',
                [
                    'label' => esc_html__( 'Image Border Radius', 'elementor' ),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );


            //Working this is to change the color of image description
            $this->add_control(
                'description_color',
                [
                    'label' => esc_html__( 'Description Color', 'elementor' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .img_description' => 'color: {{VALUE}};',
                    ],
                    'global' => [
                        'default' => Global_Colors::COLOR_TEXT,
                    ],
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


        ////////////Edited again/////////////////
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

        //Footer 

        
		$this->add_responsive_control(
			'height',
			[
				'label' => esc_html__( 'Footer Height', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'default' => [
					'unit' => 'px',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'size_units' => ['px', 'vw', '%' ],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 40,
						'max' => 250,
					],
					'vw' => [
						'min' => 10,
						'max' => 40,
					],
				],
				'selectors' => [
					'{{WRAPPER}} figcaption' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
        //Footer 
     
        $this->end_controls_section();
    }


    protected function render()
    {
        $settings = $this->get_settings_for_display();

        //echo "<pre>";
       // echo $settings['img-desc'];
       
        //exit();
        //print_r ($settings); 
        //exit();
?>
        <button class="slide_previous"><?php print_r($settings['next_icon'])?></button>
        <div class="story-slideshow">
            <?php
            foreach ($settings['list'] as  $value) {
            ?>
                <div class="story-slide">

                    <figure>
                        <div class="slide-ratio">

                        <img src="<?php echo $value['slide_image']['url'] ?>" />

                            <?php if ($settings['show_title_on_slide'] == 'yes') { ?>
                                <span class="story-slide-overlay">
                                    <h6><?php echo $value['slide_title'] ?></h6>
                                    <p class="img_description"><?php echo $value['img-desc']?></p>

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
        <button class="slide_next">Next</button>
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
