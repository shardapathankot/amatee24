<?php
/*
 * Elementor Loveme Pricing Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Loveme_Pricing extends Widget_Base
{

	/**
	 * Retrieve the widget name.
	 */
	public function get_name()
	{
		return 'wpo-loveme_pricing';
	}

	/**
	 * Retrieve the widget title.
	 */
	public function get_title()
	{
		return esc_html__('Pricing', 'loveme-core');
	}

	/**
	 * Retrieve the widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-price-table';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 */
	public function get_categories()
	{
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Loveme Pricing widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	 */
	public function get_script_depends()
	{
		return ['wpo-loveme_pricing'];
	}

	/**
	 * Register Loveme Pricing widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 */
	protected function register_controls()
	{

		$this->start_controls_section(
			'section_pricing',
			[
				'label' => esc_html__('Pricing Options', 'loveme-core'),
			]
		);
		$repeater = new Repeater();
		$repeater->add_control(
			'price_image',
			[
				'label' => esc_html__('Price Image', 'loveme-core'),
				'type' => Controls_Manager::MEDIA,
				'frontend_available' => true,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'description' => esc_html__('Set your image.', 'loveme-core'),
			]
		);
		$repeater->add_control(
			'pricing_title',
			[
				'label' => esc_html__('Title Text', 'loveme-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Pricing Title.', 'loveme-core'),
				'placeholder' => esc_html__('Type title text here', 'loveme-core'),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'pricing_amount',
			[
				'label' => esc_html__('Amount Text', 'loveme-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('250', 'loveme-core'),
				'placeholder' => esc_html__('Type Amount text here', 'loveme-core'),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'pricing_month',
			[
				'label' => esc_html__('Month Text', 'loveme-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Monthly.', 'loveme-core'),
				'placeholder' => esc_html__('Type Month text here', 'loveme-core'),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'pricing_content',
			[
				'label' => esc_html__('Content', 'loveme-core'),
				'default' => esc_html__('your content text', 'loveme-core'),
				'placeholder' => esc_html__('Type your content here', 'loveme-core'),
				'type' => Controls_Manager::WYSIWYG,
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'button_text',
			[
				'label' => esc_html__('Button Text', 'loveme-core'),
				'default' => esc_html__('Choose Plan', 'loveme-core'),
				'placeholder' => esc_html__('Type your button text here', 'loveme-core'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'pricing_link',
			[
				'label' => esc_html__('link', 'loveme-core'),
				'default' => esc_html__('#', 'loveme-core'),
				'placeholder' => esc_html__('Type your link here', 'loveme-core'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
			]
		);
		$this->add_control(
			'pricingItems_groups',
			[
				'label' => esc_html__('Pricing Icons', 'loveme-core'),
				'type' => Controls_Manager::REPEATER,
				'default' => [
					[
						'pricing_title' => esc_html__('Pricing', 'loveme-core'),
					],

				],
				'fields' =>  $repeater->get_controls(),
				'title_field' => '{{{ pricing_title }}}',
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
				'label' => esc_html__('Typography', 'loveme-core'),
				'name' => 'loveme_title_typography',
				'selector' => '{{WRAPPER}} .wpo-pricing-section .wpo-pricing-wrap .wpo-pricing-item .wpo-pricing-top .wpo-pricing-text h4',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-pricing-section .wpo-pricing-wrap .wpo-pricing-item .wpo-pricing-top .wpo-pricing-text h4' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'title_padding',
			[
				'label' => __('Title Padding', 'loveme-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .wpo-pricings-section .wpo-pricings-item .wpo-pricings-text h4' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Price Title
		$this->start_controls_section(
			'section_price_style',
			[
				'label' => esc_html__('Price', 'loveme-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'loveme-core'),
				'name' => 'loveme_price_title_typography',
				'selector' => '{{WRAPPER}} .wpo-pricing-section .wpo-pricing-wrap .wpo-pricing-item .wpo-pricing-top .wpo-pricing-text h2',
			]
		);
		$this->add_control(
			'price_title_color',
			[
				'label' => esc_html__('Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-pricing-section .wpo-pricing-wrap .wpo-pricing-item .wpo-pricing-top .wpo-pricing-text h2' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'price_title_padding',
			[
				'label' => __('Title Padding', 'loveme-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .wpo-pricing-section .wpo-pricing-wrap .wpo-pricing-item .wpo-pricing-top .wpo-pricing-text h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Price Month
		$this->start_controls_section(
			'section_price_month_style',
			[
				'label' => esc_html__('Price', 'loveme-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'loveme-core'),
				'name' => 'loveme_month_title_typography',
				'selector' => '{{WRAPPER}} .wpo-pricing-section .wpo-pricing-wrap .wpo-pricing-item .wpo-pricing-top .wpo-pricing-text h2 span',
			]
		);
		$this->add_control(
			'month_title_color',
			[
				'label' => esc_html__('Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-pricing-section .wpo-pricing-wrap .wpo-pricing-item .wpo-pricing-top .wpo-pricing-text h2 span' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'month_title_padding',
			[
				'label' => __('Title Padding', 'loveme-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .wpo-pricing-section .wpo-pricing-wrap .wpo-pricing-item .wpo-pricing-top .wpo-pricing-text h2 span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .wpo-pricing-section .wpo-pricing-wrap .wpo-pricing-item .wpo-pricing-bottom .wpo-pricing-bottom-text ul li',
			]
		);
		$this->add_control(
			'content_color',
			[
				'label' => esc_html__('Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-pricing-section .wpo-pricing-wrap .wpo-pricing-item .wpo-pricing-bottom .wpo-pricing-bottom-text ul li' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'content_br_color',
			[
				'label' => esc_html__('Border Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-pricing-section .wpo-pricing-wrap .wpo-pricing-item .wpo-pricing-bottom .wpo-pricing-bottom-text ul li' => 'border-bottom-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// button
		$this->start_controls_section(
			'section_button_style',
			[
				'label' => esc_html__('Button', 'loveme-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'button_color',
			[
				'label' => esc_html__('Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-pricing-section .wpo-pricing-wrap .wpo-pricing-item .wpo-pricing-bottom .wpo-pricing-bottom-text a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_hover_color',
			[
				'label' => esc_html__('Hover Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-pricing-section .wpo-pricing-wrap .wpo-pricing-item .wpo-pricing-bottom .wpo-pricing-bottom-text a:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_bg_line_color',
			[
				'label' => esc_html__('Line Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-pricing-section .wpo-pricing-wrap .wpo-pricing-item .wpo-pricing-bottom .wpo-pricing-bottom-text a:before' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

	}

	/**
	 * Render Pricing widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$pricingItems_groups = !empty($settings['pricingItems_groups']) ? $settings['pricingItems_groups'] : [];
		// Turn output buffer on

		ob_start(); ?>
		<div class="wpo-pricing-section">
			<div class="container">
				<div class="wpo-pricing-wrap">
					<div class="row">
						<?php
						// Group Param Output
						if (is_array($pricingItems_groups) && !empty($pricingItems_groups)) {
							foreach ($pricingItems_groups as $each_item) {

								$pricing_title = !empty($each_item['pricing_title']) ? $each_item['pricing_title'] : '';
								$pricing_amount = !empty($each_item['pricing_amount']) ? $each_item['pricing_amount'] : '';
								$pricing_curency = !empty($each_item['pricing_curency']) ? $each_item['pricing_curency'] : '';
								$pricing_month = !empty($each_item['pricing_month']) ? $each_item['pricing_month'] : '';
								$pricing_content = !empty($each_item['pricing_content']) ? $each_item['pricing_content'] : '';
								$button_text = !empty($each_item['button_text']) ? $each_item['button_text'] : '';
								$pricing_link = !empty($each_item['pricing_link']) ? $each_item['pricing_link'] : '';
								$bg_image = !empty($each_item['price_image']['id']) ? $each_item['price_image']['id'] : '';

								// Image
								$image_url = wp_get_attachment_url($bg_image);
								$image_alt = get_post_meta($bg_image, '_wp_attachment_image_alt', true);

						?>
								<div class="col col-lg-4 col-md-6 col-12">
									<div class="wpo-pricing-item">
										<div class="wpo-pricing-top">
											<div class="wpo-pricing-img">
												<?php if ($image_url) {
													echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($image_alt) . '">';
												} ?>
											</div>
											<div class="wpo-pricing-text">
												<?php
												if ($pricing_title) {
													echo '<h4>' . esc_html($pricing_title) . '</h4>';
												}
												if ($pricing_amount) {
													echo '<h2>' . esc_html($pricing_amount) . '<span>' . esc_html($pricing_month) . '</span></h2>';
												}
												?>
											</div>
										</div>
										<div class="wpo-pricing-bottom">
											<div class="wpo-pricing-bottom-text">
												<?php
												if ($pricing_content) {
													echo wp_kses_post($pricing_content);
												}
												if ($button_text) {
													echo ' <a href="' . esc_url($pricing_link) . '">' . esc_html($button_text) . '</a>';
												}
												?>
											</div>
										</div>
									</div>
								</div>
						<?php }
						} ?>
					</div>
				</div>
			</div>
		</div>
<?php
		// Return outbut buffer
		echo ob_get_clean();
	}
	/**
	 * Render Pricing widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 */

	//protected function _content_template(){}

}
Plugin::instance()->widgets_manager->register_widget_type(new Loveme_Pricing());
