<?php
/*
 * Elementor Loveme Slider Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Loveme_Slider extends Widget_Base
{

	/**
	 * Retrieve the widget name.
	 */
	public function get_name()
	{
		return 'wpo-loveme_slider';
	}

	/**
	 * Retrieve the widget title.
	 */
	public function get_title()
	{
		return esc_html__('Slider', 'loveme-core');
	}

	/**
	 * Retrieve the widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-slides';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 */
	public function get_categories()
	{
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Loveme Slider widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	 */

	public function get_script_depends()
	{
		return ['wpo-loveme_slider'];
	}


	/**
	 * Register Loveme Slider widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 */
	protected function register_controls()
	{

		$this->start_controls_section(
			'section_slider',
			[
				'label' => __('Slider Options', 'loveme-core'),
			]
		);
		$this->add_control(
			'slide_style',
			[
				'label' => esc_html__('Slide Style', 'finco-core'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'style-one' => esc_html__('Style One', 'finco-core'),
					'style-two' => esc_html__('Style Two', 'finco-core'),
					'style-three' => esc_html__('Style Three', 'finco-core'),
				],
				'default' => 'style-one',
				'description' => esc_html__('Select your slide style.', 'finco-core'),
			]
		);
		$repeater = new Repeater();
		$repeater->add_control(
			'slide_color',
			[
				'label' => esc_html__('Slide background Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'default' => '#bbbbbb',
				'selectors' => [
					'{{WRAPPER}} .wpo-hero-slider' => 'background-color: {{VALUE}};',
				],
			]
		);
		$repeater->add_control(
			'slider_title',
			[
				'label' => esc_html__('Slider title', 'loveme-core'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => 'We Fight For Your Justice As Like A Friend.',
				'placeholder' => esc_html__('Type slide title here', 'loveme-core'),
			]
		);
		$repeater->add_control(
			'slider_content',
			[
				'label' => esc_html__('Slider content', 'loveme-core'),
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'default' => 'Slider Details content',
				'placeholder' => esc_html__('Type slide content here', 'loveme-core'),
			]
		);
		$repeater->add_control(
			'btn_txt',
			[
				'label' => esc_html__('Button Text', 'loveme-core'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => 'Explore more',
				'placeholder' => esc_html__('Type your button text here', 'loveme-core'),
			]
		);
		$repeater->add_control(
			'button_link',
			[
				'label' => esc_html__('Button Link', 'loveme-core'),
				'type' => Controls_Manager::URL,
				'placeholder' => __('https://your-link.com', 'loveme-core'),
				'show_external' => true,
				'default' => [
					'url' => '#',
				],
			]
		);
		$repeater->add_control(
			'slider_image',
			[
				'label' => esc_html__('Slider Image', 'loveme-core'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		$repeater->add_control(
			'slider_shape',
			[
				'label' => esc_html__('Slider Shape', 'loveme-core'),
				'type' => Controls_Manager::MEDIA,
				'condition' => [
					'slide_style' => array('style-two'),
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		$repeater->add_control(
			'slider_shape2',
			[
				'label' => esc_html__('Slider Shape 2', 'loveme-core'),
				'type' => Controls_Manager::MEDIA,
				'condition' => [
					'slide_style' => array('style-two'),
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'swipeSliders_groups',
			[
				'label' => esc_html__('Slider Items', 'loveme-core'),
				'type' => Controls_Manager::REPEATER,
				'default' => [
					[
						'slider_title' => esc_html__('Item #1', 'loveme-core'),
					],

				],
				'fields' =>  $repeater->get_controls(),
				'title_field' => '{{{ slider_title }}}',
			]
		);
		$this->end_controls_section(); // end: Section

		$this->start_controls_section(
			'section_shape_slider',
			[
				'label' => __('Slider Shape', 'loveme-core'),
				'condition' => [
					'slide_style' => array('style-two'),
				],
			]
		);

		$this->add_control(
			'slider_shape',
			[
				'label' => esc_html__('Slider Shape', 'loveme-core'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'slider_shape2',
			[
				'label' => esc_html__('Slider Shape 2', 'loveme-core'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->end_controls_section(); // end: Section

		$this->start_controls_section(
			'section_carousel',
			[
				'label' => esc_html__('Carousel Options', 'loveme-core'),
			]
		);
		$this->add_control(
			'carousel_nav',
			[
				'label' => esc_html__('Navigation', 'loveme-core'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'loveme-core'),
				'label_off' => esc_html__('No', 'loveme-core'),
				'return_value' => 'true',
				'description' => esc_html__('If you want Carousel Navigation, enable it.', 'loveme-core'),
			]
		);

		$this->end_controls_section(); // end: Section


		// Shape
		$this->start_controls_section(
			'section_slide_sahpe_option_style',
			[
				'label' => esc_html__('Slide Shape', 'loveme-core'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'slide_style' => array('style-one'),
				],
			]
		);
		$this->add_control(
			'shape_before',
			[
				'label' => esc_html__('Before Shape', 'loveme-core'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'shape_after',
			[
				'label' => esc_html__('After Shape', 'loveme-core'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Slide
		$this->start_controls_section(
			'section_slide_option_style',
			[
				'label' => esc_html__('Slide', 'loveme-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'slide_padding',
			[
				'label' => __('Content Padding', 'loveme-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .wpo-hero-slider .slide-inner .slide-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'slide_height',
			[
				'label' => __('Height', 'loveme-core'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 900,
				],
				'selectors' => [
					'{{WRAPPER}} .wpo-hero-slider' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section


		// Title
		$this->start_controls_section(
			'section_title_style',
			[
				'label' => esc_html__('Title', 'loveme-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .wpo-hero-slider .slide-title h2',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-hero-slider .slide-title h2,  .wpo-hero-slider .slide-title h2 span' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'title_padding',
			[
				'label' => esc_html__('Title Padding', 'loveme-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .wpo-hero-slider .slide-title h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'name' => 'slider_content_typography',
				'selector' => '{{WRAPPER}} .wpo-hero-slider .slide-text p',
			]
		);
		$this->add_control(
			'slider_content_color',
			[
				'label' => esc_html__('Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-hero-slider .slide-text p' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'slider_content_bg_color',
			[
				'label' => esc_html__('Background Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-hero-slider .slide-inner .slide-content' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'slider_content_br_color',
			[
				'label' => esc_html__('Border Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-hero-slider .slide-inner .slide-content .border-1,.wpo-hero-slider .slide-inner .slide-content .border-2,.wpo-hero-slider .slide-inner .slide-content .border-3,.wpo-hero-slider .slide-inner .slide-content .border-4' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .wpo-hero-slider-s3 .slide-inner .slide-content .site-border' => 'border-color: {{VALUE}};',
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
					'{{WRAPPER}} .wpo-hero-slider .slide-text p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section


		// Navigation
		$this->start_controls_section(
			'section_navigation_style',
			[
				'label' => esc_html__('Navigation', 'loveme-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'slider_nav_color',
			[
				'label' => esc_html__('Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-hero-slider .swiper-button-prev:before,.wpo-hero-slider .swiper-button-next:before' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'slider_nav_bg_color',
			[
				'label' => esc_html__('Background Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-hero-slider .swiper-button-prev, .wpo-hero-slider .swiper-button-next' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'slider_nav_br_color',
			[
				'label' => esc_html__('Border Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-hero-slider .swiper-button-prev, .wpo-hero-slider .swiper-button-next' => 'border-color: {{VALUE}};',
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
				'selector' => '{{WRAPPER}} .wpo-hero-slider .slide-btns .theme-btn',
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
					'{{WRAPPER}} .wpo-hero-slider .slide-btns .theme-btn' => 'min-width: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .wpo-hero-slider .slide-btns .theme-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .wpo-hero-slider .slide-btns .theme-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .wpo-hero-slider .slide-btns .theme-btn' => 'color: {{VALUE}};',
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
				'selector' => '{{WRAPPER}} .wpo-hero-slider .slide-btns .theme-btn',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'button_border',
				'label' => esc_html__('Border', 'loveme-core'),
				'selector' => '{{WRAPPER}} .wpo-hero-slider .slide-btns .theme-btn:after',
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
					'{{WRAPPER}} .wpo-hero-slider .slide-btns .theme-btn:hover' => 'color: {{VALUE}};',
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
				'selector' => '{{WRAPPER}} .loveme-hero .btns .theme-btn:hover',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'button_hover_border',
				'label' => esc_html__('Border', 'loveme-core'),
				'selector' => '{{WRAPPER}} .wpo-hero-slider .slide-btns .theme-btn:hover',
			]
		);
		$this->end_controls_tab();  // end:Hover tab
		$this->end_controls_tabs(); // end tabs

		$this->end_controls_section(); // end: Section



	}

	/**
	 * Render Blog widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$slide_style = !empty($settings['slide_style']) ? $settings['slide_style'] : '';
		// Carousel Options
		$swipeSliders_groups = !empty($settings['swipeSliders_groups']) ? $settings['swipeSliders_groups'] : [];
		$carousel_nav  = (isset($settings['carousel_nav']) && ('true' == $settings['carousel_nav'])) ? true : false;

		$shape_before_url = !empty($settings['shape_before']['id']) ? $settings['shape_before']['id'] : '';
		$shape_after_url = !empty($settings['shape_after']['id']) ? $settings['shape_after']['id'] : '';

		// Image
		$slide_shape_before = wp_get_attachment_url($shape_before_url);
		$slide_shape_after = wp_get_attachment_url($shape_after_url);

		if ($slide_style == 'style-one') {
			$slide_wrapper = '';
			$slide_container = 'container-fluid';
		} elseif ($slide_style == 'style-two') {
			$slide_wrapper = 'wpo-hero-slider-s2';
			$slide_container = 'container-fluid';
		} else {
			$slide_wrapper = 'wpo-hero-slider-s3';
			$slide_container = 'container';
		}

		$e_uniqid        = uniqid();
		$inline_style  = '';

		if ($slide_shape_before) {
			$inline_style .= '.wpo-hero-slider-' . $e_uniqid . '.wpo-hero-slider .slide-inner .slide-content:before {';
			$inline_style .= ($slide_shape_before) ? 'background-image:url(' . $slide_shape_before . ');' : '';
			$inline_style .= '}';
		}
		if ($slide_shape_after) {
			$inline_style .= '.wpo-hero-slider-' . $e_uniqid . '.wpo-hero-slider .slide-inner .slide-content:after {';
			$inline_style .= ($slide_shape_after) ? 'background-image:url(' . $slide_shape_after . ');' : '';
			$inline_style .= '}';
		}
		// add inline style
		loveme_add_inline_style($inline_style);
		$styled_class  = ' wpo-hero-slider-' . $e_uniqid;

		// Turn output buffer on
		ob_start();

?>
		<div class="wpo-hero-slider <?php echo esc_attr($slide_wrapper . $styled_class); ?>">
			<div class="swiper-container">
				<div class="swiper-wrapper">
					<?php
					if (is_array($swipeSliders_groups) && !empty($swipeSliders_groups)) {
						foreach ($swipeSliders_groups as $each_item) {
							$bg_image = !empty($each_item['slider_image']['id']) ? $each_item['slider_image']['id'] : '';

							$image_url = wp_get_attachment_url($bg_image);

							$bg_shape = !empty($settings['slider_shape']['id']) ? $settings['slider_shape']['id'] : '';
							$bg_shape2 = !empty($settings['slider_shape2']['id']) ? $settings['slider_shape2']['id'] : '';

							$shape_url = wp_get_attachment_url($bg_shape);
							$shape2_url = wp_get_attachment_url($bg_shape2);

							$shape_alt = get_post_meta($bg_shape, '_wp_attachment_image_alt', true);
							$shape2_alt = get_post_meta($bg_shape2, '_wp_attachment_image_alt', true);

							$slider_title = !empty($each_item['slider_title']) ? $each_item['slider_title'] : '';
							$slider_content = !empty($each_item['slider_content']) ? $each_item['slider_content'] : '';

							$button_text = !empty($each_item['btn_txt']) ? $each_item['btn_txt'] : '';
							$button_link = !empty($each_item['button_link']['url']) ? $each_item['button_link']['url'] : '';
							$button_link_external = !empty($each_item['button_link']['is_external']) ? 'target="_blank"' : '';
							$button_link_nofollow = !empty($each_item['button_link']['nofollow']) ? 'rel="nofollow"' : '';
							$button_link_attr = !empty($button_link) ?  $button_link_external . ' ' . $button_link_nofollow : '';

							if ($slide_style == 'style-three') {
								$button_one = $button_link ? '<a href="' . esc_url($button_link) . '" ' . $button_link_attr . ' class="theme-btn-s4" >' . $button_text . '</a>' : '';
							} else {
								$button_one = $button_link ? '<a href="' . esc_url($button_link) . '" ' . $button_link_attr . ' class="theme-btn" >' . $button_text . '</a>' : '';
							}

							$button_actual = ($button_one) ? '<div data-swiper-parallax="500" class="slide-btns">' . $button_one . '</div>' : '';
					?>
							<div class="swiper-slide">
								<div class="slide-inner slide-bg-image" data-background="<?php echo esc_url($image_url); ?>">
									<div class="<?php echo esc_attr($slide_container); ?>">
										<div class="slide-content">
											<div data-swiper-parallax="300" class="slide-title">
												<?php if ($slider_title) {
													echo '<h2>' . esc_html($slider_title) . '</h2>';
												} ?>
											</div>
											<div data-swiper-parallax="400" class="slide-text">
												<?php if ($slider_content) {
													echo '<p>' . esc_html($slider_content) . '</p>';
												} ?>
											</div>
											<div class="clearfix"></div>
											<?php
											if ($slide_style == 'style-one' || $slide_style == 'style-three') {
												echo $button_actual;
											}

											if ($slide_style == 'style-two') { ?>
												<div class="border-1"></div>
												<div class="border-2"></div>
												<div class="border-3"></div>
												<div class="border-4"></div>
												<div class="s-img-1">
													<?php if ($shape_url) {
														echo '<img src="' . esc_url($shape_url) . '" alt="' . esc_attr($shape_alt) . '">';
													} ?>
												</div>
												<div class="s-img-2">
													<?php if ($shape2_url) {
														echo '<img src="' . esc_url($shape2_url) . '" alt="' . esc_attr($shape2_alt) . '">';
													} ?>
												</div>
											<?php }
											if ($slide_style == 'style-three') {
												echo '<div class="site-border"></div>';
											}
											?>
										</div>
									</div>
								</div> <!-- end slide-inner -->
							</div> <!-- end swiper-slide -->
					<?php }
					} ?>
				</div>
				<!-- swipper controls -->
				<?php if ($carousel_nav) { ?>
					<div class="swiper-pagination"></div>
					<div class="swiper-button-next"></div>
					<div class="swiper-button-prev"></div>
				<?php } ?>
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
Plugin::instance()->widgets_manager->register_widget_type(new Loveme_Slider());
