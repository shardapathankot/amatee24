<?php
/*
 * Elementor Loveme ProjectItem Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Loveme_ProjectItem extends Widget_Base
{

	/**
	 * Retrieve the widget name.
	 */
	public function get_name()
	{
		return 'wpo-loveme_projectitem';
	}

	/**
	 * Retrieve the widget title.
	 */
	public function get_title()
	{
		return esc_html__('Portfolio Single', 'loveme-core');
	}

	/**
	 * Retrieve the widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-single-post';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 */
	public function get_categories()
	{
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Loveme ProjectItem widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	 */
	/*
	public function get_script_depends() {
		return ['wpo-loveme_projectitem'];
	}
	*/

	/**
	 * Register Loveme ProjectItem widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 */
	protected function register_controls()
	{

		$this->start_controls_section(
			'section_ProjectItem',
			[
				'label' => esc_html__('Portfolio Single', 'loveme-core'),
			]
		);
		$this->add_control(
			'section_title',
			[
				'label' => esc_html__('Title Text', 'loveme-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Title Text', 'loveme-core'),
				'placeholder' => esc_html__('Type title text here', 'loveme-core'),
				'label_block' => true,
			]
		);
		$this->add_control(
			'section_subtitle',
			[
				'label' => esc_html__('Sub Title Text', 'loveme-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Sub Title Text', 'loveme-core'),
				'placeholder' => esc_html__('Type subtitle text here', 'loveme-core'),
				'label_block' => true,
			]
		);
		$this->add_control(
			'section_content',
			[
				'label' => esc_html__('Content', 'loveme-core'),
				'default' => esc_html__('your content text', 'loveme-core'),
				'placeholder' => esc_html__('Type your content here', 'loveme-core'),
				'type' => Controls_Manager::WYSIWYG,
				'label_block' => true,
			]
		);
		$this->add_control(
			'portfolio_image',
			[
				'label' => esc_html__('Portfolio Image', 'loveme-core'),
				'type' => Controls_Manager::MEDIA,
				'frontend_available' => true,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'description' => esc_html__('Set your image.', 'loveme-core'),
			]
		);
		$repeater = new Repeater();
		$repeater->add_control(
			'feature_title',
			[
				'label' => esc_html__('Title Text', 'loveme-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Title Text', 'loveme-core'),
				'placeholder' => esc_html__('Type title text here', 'loveme-core'),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'feature_content',
			[
				'label' => esc_html__('Content', 'loveme-core'),
				'default' => esc_html__('your content text', 'loveme-core'),
				'placeholder' => esc_html__('Type your content here', 'loveme-core'),
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,
			]
		);

		$this->add_control(
			'single_portfolio_groups',
			[
				'label' => esc_html__('Feature Icons', 'loveme-core'),
				'type' => Controls_Manager::REPEATER,
				'default' => [
					[
						'single_feature_title' => esc_html__('Feature', 'loveme-core'),
					],

				],
				'fields' =>  $repeater->get_controls(),
				'title_field' => '{{{ single_feature_title }}}',
			]
		);
		$this->end_controls_section(); // end: Section

		// Title
		$this->start_controls_section(
			'single_service_section_title_style',
			[
				'label' => esc_html__('Title', 'loveme-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'loveme-core'),
				'name' => 'sasban_title_typography',
				'selector' => '{{WRAPPER}} .portfolio-single-wrap .portfolio-single-text h2',
			]
		);
		$this->add_control(
			'single_service_title_color',
			[
				'label' => esc_html__('Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portfolio-single-wrap .portfolio-single-text h2' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'single_service_title_padding',
			[
				'label' => esc_html__('Title Padding', 'loveme-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .portfolio-single-wrap .portfolio-single-text h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Subtitle
		$this->start_controls_section(
			'section_subtitle_style',
			[
				'label' => esc_html__('Sub Title', 'loveme-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'loveme-core'),
				'name' => 'section_subtitle_typography',
				'selector' => '{{WRAPPER}} .portfolio-single-wrap .portfolio-single-text span',
			]
		);
		$this->add_control(
			'subtitle_color',
			[
				'label' => esc_html__('Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portfolio-single-wrap .portfolio-single-text span' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Content
		$this->start_controls_section(
			'single_service_section_content_style',
			[
				'label' => esc_html__('Content', 'loveme-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'loveme-core'),
				'name' => 'single_service_content_typography',
				'selector' => '{{WRAPPER}} .portfolio-single-wrap .portfolio-single-text p',
			]
		);
		$this->add_control(
			'single_service_content_color',
			[
				'label' => esc_html__('Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portfolio-single-wrap .portfolio-single-text p' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'single_service_content_padding',
			[
				'label' => esc_html__('Title Padding', 'loveme-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .portfolio-single-wrap .portfolio-single-text p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// List
		$this->start_controls_section(
			'single_service_section_list_style',
			[
				'label' => esc_html__('List Item', 'loveme-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'loveme-core'),
				'name' => 'single_service_list_typography',
				'selector' => '{{WRAPPER}} .portfolio-single-wrap .wpo-portfolio-single-content-des ul li',
			]
		);
		$this->add_control(
			'single_service_list_color',
			[
				'label' => esc_html__('Title Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portfolio-single-wrap .wpo-portfolio-single-content-des ul li' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'single_service_list_desc_color',
			[
				'label' => esc_html__('Content Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portfolio-single-wrap .wpo-portfolio-single-content-des ul li span' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'single_service_list_padding',
			[
				'label' => esc_html__('Title Padding', 'loveme-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .portfolio-single-wrap .wpo-portfolio-single-content-des ul li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

	}

	/**
	 * Render ProjectItem widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$single_portfolio_groups = !empty($settings['single_portfolio_groups']) ? $settings['single_portfolio_groups'] : [];
		$section_subtitle = !empty($settings['section_subtitle']) ? $settings['section_subtitle'] : '';
		$section_title = !empty($settings['section_title']) ? $settings['section_title'] : '';
		$section_content = !empty($settings['section_content']) ? $settings['section_content'] : '';
		$bg_image = !empty($settings['portfolio_image']['id']) ? $settings['portfolio_image']['id'] : '';

		// Image
		$image_url = wp_get_attachment_url($bg_image);
		$image_alt = get_post_meta($bg_image, '_wp_attachment_image_alt', true);

		// Turn output buffer on
		ob_start(); ?>
		<div class="portfolio-single-wrap">
			<div class="row align-items-center">
				<div class="col-lg-6 col-12">
					<div class="portfolio-single-img">
						<?php if ($image_url) {
							echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($image_alt) . '">';
						} ?>
					</div>
				</div>
				<div class="col-lg-6 col-12">
					<div class="portfolio-single-text">
						<?php
						if ($section_title) {
							echo '<h2>' . esc_html($section_title) . '</h2>';
						}
						if ($section_subtitle) {
							echo '<span>' . esc_html($section_subtitle) . '</span>';
						}
						if ($section_content) {
							echo wp_kses_post($section_content);
						}
						?>
						<div class="wpo-portfolio-single-content-des">
							<ul>
								<?php
								// Group Param Output
								if (is_array($single_portfolio_groups) && !empty($single_portfolio_groups)) {
									foreach ($single_portfolio_groups as $each_item) {

										$feature_title = !empty($each_item['feature_title']) ? $each_item['feature_title'] : '';
										$feature_content = !empty($each_item['feature_content']) ? $each_item['feature_content'] : '';

										if ($feature_title) {
											echo '<li>' . esc_html($feature_title) . '<span>' . esc_html($feature_content) . '</span></li>';
										}
									}
								}
								?>
							</ul>
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
	 * Render ProjectItem widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 */

	//protected function _content_template(){}

}
Plugin::instance()->widgets_manager->register_widget_type(new Loveme_ProjectItem());
