<?php
/*
 * Elementor Loveme Planner_Slider Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Loveme_Planner_Slider extends Widget_Base
{

	/**
	 * Retrieve the widget name.
	 */
	public function get_name()
	{
		return 'tmx-Loveme_planner_slider';
	}

	/**
	 * Retrieve the widget title.
	 */
	public function get_title()
	{
		return esc_html__('Planner Slider', 'Loveme-core');
	}

	/**
	 * Retrieve the widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-media-carousel';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 */
	public function get_categories()
	{
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Loveme Planner_Slider widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	 */

	public function get_script_depends()
	{
		return ['tmx-Loveme_planner_slider'];
	}


	/**
	 * Register Loveme Planner_Slider widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 */
	protected function register_controls()
	{

		$this->start_controls_section(
			'section_planner_slider',
			[
				'label' => esc_html__('Planner Slider Options', 'Loveme-core'),
			]
		);
		$this->add_control(
			'planner_title',
			[
				'label' => esc_html__('Slider title', 'Loveme-core'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => esc_html__('Type slide title here', 'Loveme-core'),
			]
		);
		$this->add_control(
			'planner_content',
			[
				'label' => esc_html__('Content', 'loveme-core'),
				'default' => esc_html__('your content text', 'loveme-core'),
				'placeholder' => esc_html__('Type your content here', 'loveme-core'),
				'type' => Controls_Manager::WYSIWYG,
				'label_block' => true,
			]
		);
		$this->add_control(
			'btn_text',
			[
				'label' => esc_html__('Button/Link Text', 'loveme-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Button Text', 'loveme-core'),
				'placeholder' => esc_html__('Type btn text here', 'loveme-core'),
				'label_block' => true,
			]
		);
		$this->add_control(
			'btn_link',
			[
				'label' => esc_html__('Button Link', 'loveme-core'),
				'type' => Controls_Manager::URL,
				'placeholder' => 'https://your-link.com',
				'default' => [
					'url' => '',
				],
				'label_block' => true,
			]
		);
		$repeater = new Repeater();
		$repeater->add_control(
			'planner_slider_image',
			[
				'label' => esc_html__('Planner Slider Image', 'Loveme-core'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'swipePlanner_Sliders_groups',
			[
				'label' => esc_html__('Planner Slider Items', 'Loveme-core'),
				'type' => Controls_Manager::REPEATER,
				'default' => [
					[
						'planner_slider_title' => esc_html__('Item #1', 'Loveme-core'),
					],

				],
				'fields' =>  $repeater->get_controls(),
				'title_field' => '{{{ planner_slider_title }}}',
			]
		);
		$this->end_controls_section(); // end: Sect

		// Slide BG
		$this->start_controls_section(
			'section_slide_bg_style',
			[
				'label' => esc_html__('Slide BG', 'Loveme-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'slide_bg_color',
			[
				'label' => esc_html__('Background Color', 'Loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .static-hero' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Title
		$this->start_controls_section(
			'section_title_style',
			[
				'label' => esc_html__('Title', 'Loveme-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .static-hero .slide-title h2',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Color', 'Loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .static-hero .slide-title h2, .static-hero .slide-title h2 span' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section


		// Content
		$this->start_controls_section(
			'section_content_style',
			[
				'label' => esc_html__('Content', 'loveme-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'loveme-core'),
				'name' => 'section_content_typography',
				'selector' => '{{WRAPPER}} .static-hero .slide-text p',
			]
		);
		$this->add_control(
			'content_color',
			[
				'label' => esc_html__('Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .static-hero .slide-text p' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'content_padding',
			[
				'label' => esc_html__('Content Padding', 'loveme-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .static-hero .slide-text p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Button Style
		$this->start_controls_section(
			'section_button_style',
			[
				'label' => esc_html__('Button', 'loveme-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'selector' => '{{WRAPPER}} .static-hero .slide-btns .theme-btn-s4',
			]
		);
		$this->add_responsive_control(
			'button_min_width',
			[
				'label' => esc_html__('Width', 'loveme-core'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 500,
						'step' => 1,
					],
				],
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .static-hero .slide-btns .theme-btn-s4' => 'min-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'button_padding',
			[
				'label' => __('Padding', 'loveme-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .static-hero .slide-btns .theme-btn-s4' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'button_border_radius',
			[
				'label' => __('Border Radius', 'loveme-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .static-hero .slide-btns .theme-btn-s4' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->start_controls_tabs('button_style');
		$this->start_controls_tab(
			'button_normal',
			[
				'label' => esc_html__('Normal', 'loveme-core'),
			]
		);
		$this->add_control(
			'button_color',
			[
				'label' => esc_html__('Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .static-hero .slide-btns .theme-btn-s4' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'button_bg_color',
				'label' => esc_html__('Background', 'loveme-core'),
				'description' => esc_html__('Button Color', 'loveme-core'),
				'types' => ['gradient'],
				'selector' => '{{WRAPPER}} .static-hero .slide-btns .theme-btn-s4',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'button_border',
				'label' => esc_html__('Border', 'loveme-core'),
				'selector' => '{{WRAPPER}} .static-hero .slide-btns .theme-btn-s4:after',
			]
		);
		$this->end_controls_tab();  // end:Normal tab

		$this->start_controls_tab(
			'button_hover',
			[
				'label' => esc_html__('Hover', 'loveme-core'),
			]
		);
		$this->add_control(
			'button_hover_color',
			[
				'label' => esc_html__('Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .static-hero .slide-btns .theme-btn-s4:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'button_bg_hover_color',
				'label' => esc_html__('Hover Background', 'loveme-core'),
				'description' => esc_html__('Hover Background Color', 'loveme-core'),
				'types' => ['gradient'],
				'selector' => '{{WRAPPER}} .static-hero .slide-btns .theme-btn-s4:hover',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'button_hover_border',
				'label' => esc_html__('Border', 'loveme-core'),
				'selector' => '{{WRAPPER}} .static-hero .slide-btns .theme-btn-s4:hover',
			]
		);
		$this->end_controls_tab();  // end:Hover tab
		$this->end_controls_tabs(); // end tabs

		$this->end_controls_section(); // end: Section

		// Navigation
		$this->start_controls_section(
			'section_navigation_style',
			[
				'label' => esc_html__('Navigation', 'Loveme-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'planner_slider_nav_color',
			[
				'label' => esc_html__('Color', 'Loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .static-hero .static-hero-slide-img .owl-nav [class*=owl-] .fi::before' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'planner_slider_nav_bg_color',
			[
				'label' => esc_html__('Background Color', 'Loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .static-hero .static-hero-slide-img .owl-nav .owl-prev, .static-hero .static-hero-slide-img .owl-nav .owl-next' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section



	}

	/**
	 * Render Blog widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();
		// Carousel Options
		$swipePlanner_Sliders_groups = !empty($settings['swipePlanner_Sliders_groups']) ? $settings['swipePlanner_Sliders_groups'] : [];

		$planner_title = !empty($settings['planner_title']) ? $settings['planner_title'] : '';
		$planner_content = !empty($settings['planner_content']) ? $settings['planner_content'] : '';

		$btn_text = !empty($settings['btn_text']) ? $settings['btn_text'] : '';
		$btn_paragraph = !empty($settings['btn_paragraph']) ? $settings['btn_paragraph'] : '';
		$btn_icon = !empty($settings['btn_icon']) ? $settings['btn_icon'] : '';

		$btn_link = !empty($settings['btn_link']['url']) ? $settings['btn_link']['url'] : '';
		$btn_external = !empty($settings['btn_link']['is_external']) ? 'target="_blank"' : '';
		$btn_nofollow = !empty($settings['btn_link']['nofollow']) ? 'rel="nofollow"' : '';
		$btn_link_attr = !empty($btn_link) ?  $btn_external . ' ' . $btn_nofollow : '';

		$button = $btn_link ? '<a href="' . esc_url($btn_link) . '" ' . esc_attr($btn_link_attr) . ' class="theme-btn-s4" >' . esc_html($btn_text) . '</a>' : '';

		// Turn output buffer on
		ob_start();

?>
		<div class="static-hero">
			<div class="hero-container">
				<div class="hero-inner">
					<div class="container-fluid">
						<div class="row align-items-center">
							<div class="col-xl-4 col-lg-6 col-md-7 col-12">
								<div class="wpo-static-hero-inner">
									<div data-swiper-parallax="300" class="slide-title">
										<?php if ($planner_title) {
											echo '<h2>' . wp_kses_post($planner_title) . '</h2>';
										} ?>
									</div>

									<div data-swiper-parallax="400" class="slide-text">
										<?php if ($planner_content) {
											echo wp_kses_post($planner_content);
										} ?>
									</div>

									<div class="clearfix"></div>
									<div data-swiper-parallax="500" class="slide-btns">
										<?php echo $button; ?>
									</div>
								</div>
							</div>
							<div class="col-xl-8 col-lg-6 col-md-5 col-12">
								<div class="static-hero-slide-img owl-carousel">
									<?php
									if (is_array($swipePlanner_Sliders_groups) && !empty($swipePlanner_Sliders_groups)) {
										foreach ($swipePlanner_Sliders_groups as $each_item) {

											$image_url = wp_get_attachment_url($each_item['planner_slider_image']['id']);
											$image_alt = get_post_meta($each_item['planner_slider_image']['id'], '_wp_attachment_image_alt', true);

											if ($image_url) {
												echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($image_alt) . '">';
											}
										}
									}
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php
		// Return outbut buffer
		echo ob_get_clean();
	}

	/**
	 * Render Blog widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 */

	//protected function _content_template(){}

}
Plugin::instance()->widgets_manager->register_widget_type(new Loveme_Planner_Slider());
