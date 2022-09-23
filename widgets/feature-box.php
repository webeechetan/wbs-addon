<?php
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

class Feature_Box extends \Elementor\Widget_Base
{

	public function __construct( $data = array(), $args = null ) {
		parent::__construct( $data, $args );
		// wp_register_style( 'widget-feature-box', WBS_PLUGIN_URL . 'assets/css/widget-feature-box.min.css' );
	}

	public function get_name()
	{
		return 'feature_box_widget';
	}

	public function get_title()
	{
		return esc_html__('Feature Box', 'elementor-custom-addon');
	}

	public function get_icon()
	{
		return 'eicon-icon-box';
	}

	public function get_categories()
	{
		return ['wbs'];
	}

	public function get_keywords()
	{
		return ['feture box', 'image box', 'card'];
	}

	// public function get_style_depends() {
	// 	return ['widget-feature-box'];
	// }

	protected function register_controls()
	{

		$this->start_controls_section(
			'section_title',
			[
				'label' => esc_html__('Featue Box', 'elementor-custom-addon'),
			]
		);

		$this->add_control(
			'image',
			[
				'label' => esc_html__('Choose Image', 'plugin-name'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => 'https://www.mub.eps.manchester.ac.uk/sees/wp-content/themes/uom-theme/assets/images/default-banner.jpg',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Image_Size::get_type(),
			[
				'name' => 'image',
				'default' => 'full',
				'separator' => 'none',
			]
		);

		$this->add_control(
			'image_link',
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

		$this->add_control(
			'title',
			[
				'label' => esc_html__('Title', 'elementor-custom-addon'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => esc_html__('Enter your title', 'elementor-custom-addon'),
				'default' => esc_html__('Add Your Heading Text Here', 'elementor-custom-addon'),
				'separator' => 'before'
			]
		);

		$this->add_control(
			'title_link',
			[
				'label' => esc_html__('Title Link', 'plugin-name'),
				'type' => \Elementor\Controls_Manager::URL,
				'options' => ['url', 'is_external', 'nofollow'],
				'default' => [
					'url' => '#',
					'is_external' => false,
					'nofollow' => false,
					'custom_attributes' => '',
				],
			]
		);

		$this->add_control(
			'header_size',
			[
				'label' => esc_html__('HTML Tag', 'elementor'),
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
			'description',
			[
				'label' => 'Content',
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => 'Some example content. Start Editing Here. With media upload'
			]
		);

		$this->add_control(
			'read_more_button_text',
			[
				'label' => esc_html__('Button Text', 'elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => 'Read More'
			]
		);

		$this->add_control(
			'read_more_button_link',
			[
				'label' => esc_html__('Button Link', 'plugin-name'),
				'type' => \Elementor\Controls_Manager::URL,
				'options' => ['url', 'is_external', 'nofollow'],
				'default' => [
					'url' => '#',
					'is_external' => false,
					'nofollow' => false,
					'custom_attributes' => '',
				],
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
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				],
				'separator' => 'before'
			],
		);

		$this->end_controls_section();

		// Section style image

		$this->start_controls_section(
			'section_style_feature_box_image',
			[
				'label' => esc_html__( 'Image', 'elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'width',
			[
				'label' => esc_html__( 'Width', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'size_units' => [ '%', 'px', 'vw' ],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 1,
						'max' => 1000,
					],
					'vw' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'space',
			[
				'label' => esc_html__( 'Max Width', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'size_units' => [ '%', 'px', 'vw' ],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 1,
						'max' => 1000,
					],
					'vw' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} img' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'image_border',
				'selector' => '{{WRAPPER}} img',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'image_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Section style content

		$this->start_controls_section(
			'section_style_feature_con',
			[
				'label' => esc_html__( 'Content', 'elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'section_style_feature_box_title',
			[
				'label' => esc_html__( 'Title', 'elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'title_bottom_space',
			[
				'label' => esc_html__( 'Bottom Spacing', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-heading-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				]
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-heading-title' => 'color: {{VALUE}};',
				],
				'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
			]
		);

		$this->add_control(
			'section_style_feature_box_title_hover',
			[
				'label' => esc_html__( 'Hover', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-heading-title:hover ' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'section_style_feature_box_title_typography',
				'selector' => '{{WRAPPER}} .elementor-feature-box-content .elementor-heading-title',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title_shadow',
				'selector' => '{{WRAPPER}} .elementor-heading-title',
			]
		);

		$this->add_control(
			'heading_description',
			[
				'label' => esc_html__( 'Description', 'elementor' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' => esc_html__( 'Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-feature-box-description' => 'color: {{VALUE}};',
				],
				'global' => [
					'default' => Global_Colors::COLOR_TEXT,
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'selector' => '{{WRAPPER}} .elementor-feature-box-description',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'description_shadow',
				'selector' => '{{WRAPPER}} .elementor-feature-box-description',
			]
		);


		$this->end_controls_section();

	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$this->add_render_attribute('title', 'class', 'elementor-heading-title');
		$this->add_render_attribute('title_link', 'class', 'elementor-heading-title-link');

		if ( ! empty( $settings['header_size'] ) ) {
			$this->add_render_attribute( 'title', 'class', 'elementor-size-' . $settings['header_size'] );
		}

		$this->add_inline_editing_attributes( 'title' );

		$title = $settings['title'];

		if ( ! empty( $settings['title_link']['url'] ) ) {
			$this->add_link_attributes( 'url', $settings['title_link'] );

			$title = sprintf( '<a %1$s>%2$s</a>', $this->get_render_attribute_string( 'url' ), $title );
		}

		$title_html = sprintf( '<%1$s %2$s>%3$s</%1$s>',\Elementor\Utils::validate_html_tag( $settings['header_size'] ), $this->get_render_attribute_string( 'title' ), $title );

		$image = \Elementor\Group_Control_Image_Size::get_attachment_image_html($settings);
		if (!empty($settings['read_more_button_link']['url'])) {
			$this->add_link_attributes('read_more_button_link', $settings['read_more_button_link']);
		}

		if (!empty($settings['title_link']['url'])) {
			$this->add_link_attributes('title_link', $settings['title_link']);
		}

		if (!empty($settings['image_link']['url'])) {
			$this->add_link_attributes('image_link', $settings['image_link']);
		}

?>
		<figure class="elementor-feature-box-img">
			<?php if ($settings['image_link'] != '') { ?>
				<a <?php echo $this->get_render_attribute_string('image_link'); ?>><?php echo $image; ?></a>
			<?php } else { ?>
				<?php echo $image; ?>
			<?php } ?>
		</figure>
		<div class="elementor-feature-box-content">
			<?php
			if ($settings['title_link'] != '') {
			?>
				<?php echo $title_html; ?>
			<?php } else { ?>
				<?php echo $title_html; ?>
			<?php } ?>
			<p class="elementor-feature-box-description"><?php echo $settings['description']; ?></p>
			<?php if ($settings['read_more_button_text'] != '') { ?>
				<button><a <?php echo $this->get_render_attribute_string('read_more_button_link'); ?>><?php echo $settings['read_more_button_text'] ?></a></button>
			<?php } ?>
		</div>
<?php
	}

	
}
