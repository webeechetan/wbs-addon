<?php
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

class CaseStudy extends \Elementor\Widget_Base
{

    public function __construct($data = array(), $args = null)
    {
        parent::__construct($data, $args);
        wp_register_style('template-one-css', WBS_PLUGIN_URL . 'assets/css/service_template_one.css');
        wp_register_style('template-two-css', WBS_PLUGIN_URL . 'assets/css/service_template_two.css');
        wp_register_style('template-three-css', WBS_PLUGIN_URL . 'assets/css/service_template_three.css');
    }

    public function get_name()
    {
        return 'Case Study';
    }

    public function get_title()
    {
        return esc_html__('Case Study', 'essential-elementor-widget');
    }

    public function get_icon()
    {
        return 'eicon-slider-device';
    }

    public function get_categories()
    {
        return ['wbs'];
    }

    public function get_keywords()
    {
        return ['case-study', 'case-studies', 'wbs'];
    }

    public function get_style_depends()
    {
        return ['template-one-css','template-two-css','template-three-css'];
    }

    protected function register_controls()
    {
        $this->start_controls_section( 
            'section_posts_query',
            [
                'label' => esc_html__('Query', 'wbs-elementor'),
            ]
        );

        $this->add_control( 
                'posts_per_page',
                [
                    'label' => esc_html__( 'Posts Per Page', 'wbs-elementor' ),
                    'type' => \Elementor\Controls_Manager::NUMBER,
                    'default' => '6',
                ]
            );

            $this->add_control( 
                'order_by',
                [
                    'label' => esc_html__( 'Order By', 'wbs-elementor' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => 'date',
                    'options' => [						
                        'date' => 'Date',
                        'ID' => 'Post ID',			            
                        'title' => 'Title',
                    ],
                ]
            );

            $this->add_control( 
                'order',
                [
                    'label' => esc_html__( 'Order', 'wbs-elementor' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => 'desc',
                    'options' => [						
                        'desc' => 'Descending',
                        'asc' => 'Ascending',	
                    ],
                ]
            );

            // $this->add_control( 
            //     'posts_categories',
            //     [
            //         'label' => esc_html__( 'Categories', 'wbs-elementor' ),
            //         'type' => \Elementor\Controls_Manager::SELECT2,
            //         'options' => '',
            //         'label_block' => true,
            //         'multiple' => true,
            //     ]
            // );

            $this->add_control( 
                'exclude',
                [
                    'label' => esc_html__( 'Exclude', 'wbs-elementor' ),
                    'type'	=> \Elementor\Controls_Manager::TEXT,	
                    'description' => esc_html__( 'Post Ids Will Be Inorged. Ex: 1,2,3', 'themesflat-elementor' ),
                    'default' => '',
                    'label_block' => true,				
                ]
            );

            $this->add_control( 
                'sort_by_id',
                [
                    'label' => esc_html__( 'Sort By ID', 'wbs-elementor' ),
                    'type'	=> \Elementor\Controls_Manager::TEXT,	
                    'description' => esc_html__( 'Post Ids Will Be Sort. Ex: 1,2,3', 'themesflat-elementor' ),
                    'default' => '',
                    'label_block' => true,				
                ]
            );

            $this->add_group_control( 
                \Elementor\Group_Control_Image_Size::get_type(),
                [
                    'name' => 'thumbnail',
                    'default' => 'full',
                ]
            );

            $this->add_control( 
                'excerpt_lenght',
                [
                    'label' => esc_html__( 'Excerpt Length', 'wbs-elementor' ),
                    'type' => \Elementor\Controls_Manager::NUMBER,
                    'min' => 0,
                    'max' => 500,
                    'step' => 1,
                    'default' => 20,
                ]
            );

            $this->add_control( 
                'layout',
                [
                    'label' => esc_html__( 'Columns', 'wbs-elementor' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => 'column-3',
                    'options' => [
                        'column-1' => esc_html__( '1', 'wbs-elementor' ),
                        'column-2' => esc_html__( '2', 'wbs-elementor' ),
                        'column-3' => esc_html__( '3', 'wbs-elementor' ),
                        'column-4' => esc_html__( '4', 'wbs-elementor' ),
                    ],
                ]
            );	

            $this->add_control( 
                'style',
                [
                    'label' => esc_html__( 'Styles', 'wbs-elementor' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => 'style1',
                    'options' => [
                        'style1' => esc_html__( 'Template 1', 'wbs-elementor' ),
                        'style2' => esc_html__( 'Template 2', 'wbs-elementor' ),
                        'style3' => esc_html__( 'Template 3', 'wbs-elementor' ),
                    ],
                ]
            );	

            $this->add_control(
                'readmore',
                [
                    'label' => esc_html__( 'Text Read More', 'wbs-elementor' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => esc_html__( 'Read More', 'wbs-elementor' ),
                ]
            );	
        
        $this->end_controls_section();
    }


    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $style = $settings['style'];
		$query_args['orderby'] = $settings['order_by'];
		$query_args['order'] = $settings['order'];
        $query_args = array(
            'post_type' => 'case_study',
            'posts_per_page' => $settings['posts_per_page'],
        );

		if ( $settings['sort_by_id'] != '' ) {	
			$sort_by_id = array_map( 'trim', explode( ',', $settings['sort_by_id'] ) );
			$query_args['post__in'] = $sort_by_id;
			$query_args['orderby'] = 'post__in';
		}

		$query = new WP_Query( $query_args );
        if ( $query->have_posts() ) : ?>
            <div>
                <div class="wrap-services-post row <?php echo esc_attr($settings['layout']);?> <?php echo $style;?>">
                    <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                        <div class="item">
                            <?php if ($settings['style'] == 'style1') : ?>
                                <div class="services-post services-post-<?php the_ID(); ?>">
                                    <?php if ( has_post_thumbnail() ): ?>
                                    <div class="featured-post">
                                        <a href="<?php echo get_the_permalink(); ?>">
                                        <?php 
                                        $get_id_post_thumbnail = get_post_thumbnail_id();
                                        echo sprintf('<img src="%s" alt="image">', \Elementor\Group_Control_Image_Size::get_attachment_image_src( $get_id_post_thumbnail, 'thumbnail', $settings ));
                                        ?>
                                        </a>
                                    </div>
                                    <?php endif; ?>
                                    <div class="content"> 
                                        <h2 class="title">
                                            <a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a>
                                        </h2>
                                        <div class="desc"><?php echo wp_trim_words( get_the_content(), $settings['excerpt_lenght'], '' ); ?></div>                                                
                                        <div class="tf-button-container">
                                            <a href="<?php echo esc_url( get_permalink() ); ?>" class="btn tf-button bt_icon_after"><?php echo esc_attr($settings['readmore']); ?> <i class="carenow-icon-arrow-right-small"></i></a>
                                        </div>                               
                                    </div>
                                </div>
                            <?php elseif ($settings['style'] == 'style2') : ?>
                                <div class="services-post services-post-<?php the_ID(); ?>">
                                    <?php if ( has_post_thumbnail() ): ?>
                                    <div class="featured-post">
                                        <a href="<?php echo get_the_permalink(); ?>">
                                        <?php 
                                        $get_id_post_thumbnail = get_post_thumbnail_id();
                                        echo sprintf('<img src="%s" alt="image">', \Elementor\Group_Control_Image_Size::get_attachment_image_src( $get_id_post_thumbnail, 'thumbnail', $settings ));
                                        ?>
                                        </a>
                                    </div>
                                    <?php endif; ?>
                                    <div class="content">
                                        <div class="inner-content">
                                            <h2 class="title">
                                                <?php 
                                                $services_post_icon  = \Elementor\Addon_Elementor_Icon_manager_carenow::render_icon( themesflat_get_opt_elementor('services_post_icon'), [ 'aria-hidden' => 'true' ] );
                                                if ($services_post_icon) {
                                                    echo '<span class="post-icon">'.$services_post_icon.'</span>';
                                                }
                                                ?>
                                                <a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a>
                                            </h2>
                                            <div class="desc"><?php echo wp_trim_words( get_the_content(), $settings['excerpt_lenght'], '' ); ?></div>
                                        </div>
                                    </div>
                                </div>
                            <?php elseif ($settings['style'] == 'style3') : ?>
                                <div class="services-post services-post-<?php the_ID(); ?>">
                                    <?php if ( has_post_thumbnail() ): ?>
                                    <div class="featured-post">
                                        <a href="<?php echo get_the_permalink(); ?>">
                                        <?php 
                                        $get_id_post_thumbnail = get_post_thumbnail_id();
                                        echo sprintf('<img src="%s" alt="image">', \Elementor\Group_Control_Image_Size::get_attachment_image_src( $get_id_post_thumbnail, 'thumbnail', $settings ));
                                        ?>
                                        </a>
                                    </div>
                                    <?php endif; ?>
                                    <div class="content">                               	
                                        <h2 class="title">
                                            <a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a>
                                        </h2>
                                        <div class="desc"><?php echo wp_trim_words( get_the_content(), $settings['excerpt_lenght'], '' ); ?></div>                       
                                    </div>
                                    <div class="wbs-button-container">
                                        <a href="<?php echo esc_url( get_permalink() ); ?>" class="btn tf-button bt_icon_after"><?php echo esc_attr($settings['readmore']); ?> <i class="carenow-icon-arrow-right-small"></i></a>
                                    </div> 
                                </div>
                            <?php endif; ?>
                        </div> 
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                </div>
            </div>
            <?php
            else:
                esc_html_e('No posts found', 'wbs-elementor');
            endif; 
    }
}

?>
