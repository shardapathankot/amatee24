<?php
/*
 * Elementor Loveme SHOPCTA Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Loveme_SHOPCTA extends Widget_Base
{

	/**
	 * Retrieve the widget name.
	 */
	public function get_name()
	{
		return 'wpo-loveme_shopcta';
	}

	/**
	 * Retrieve the widget title.
	 */
	public function get_title()
	{
		return esc_html__('Shop Offer', 'loveme-core');
	}

	/**
	 * Retrieve the widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-posts-ticker';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 */
	public function get_categories()
	{
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Loveme SHOPCTA widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	 */
	/*
	public function get_script_depends() {
		return ['wpo-loveme_shopcta'];
	}
	*/

	/**
	 * Register Loveme SHOPCTA widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 */
	protected function register_controls()
	{

		$this->start_controls_section(
			'section_SHOPCTA',
			[
				'label' => esc_html__('SHOPCTA Options', 'loveme-core'),
			]
		);
		$this->add_control(
			'shopcta_title',
			[
				'label' => esc_html__('Title Text', 'loveme-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Title Text', 'loveme-core'),
				'placeholder' => esc_html__('Type title text here', 'loveme-core'),
				'label_block' => true,
			]
		);
		$this->add_control(
			'shopcta_content',
			[
				'label' => esc_html__('Content Text', 'loveme-core'),
				'type' => Controls_Manager::WYSIWYG,
				'default' => esc_html__('Content Text', 'loveme-core'),
				'placeholder' => esc_html__('Type Content text here', 'loveme-core'),
				'label_block' => true,
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
				'name' => 'loveme_title_typography',
				'selector' => '{{WRAPPER}} .wpo-offer-banner-section .offer-banner-text h3',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-offer-banner-section .offer-banner-text h3' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'title_padding',
			[
				'label' => esc_html__('Title Padding', 'loveme-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .wpo-offer-banner-section .offer-banner-text h3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .wpo-offer-banner-section .offer-banner-text h2',
			]
		);
		$this->add_control(
			'content_color',
			[
				'label' => esc_html__('Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-offer-banner-section .offer-banner-text h2, .wpo-offer-banner-section .offer-banner-text h2 span' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section
	}

	/**
	 * Render SHOPCTA widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();

		$shopcta_title = !empty($settings['shopcta_title']) ? $settings['shopcta_title'] : '';
		$shopcta_content = !empty($settings['shopcta_content']) ? $settings['shopcta_content'] : '';

		// Turn output buffer on
		ob_start(); ?>
		<div class="wpo-offer-banner-section">
			<div class="container">
				<div class="row">
					<div class="col col-lg-6 offset-lg-6">
						<div class="offer-banner-text">
							<?php
							if ($shopcta_title) {
								echo '<h3>' . esc_html($shopcta_title) . '</h3>';
							}
							if ($shopcta_content) {
								echo '<h2>' . wp_kses_post($shopcta_content) . '</h2>';
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php // Return outbut buffer
		echo ob_get_clean();
	}
	/**
	 * Render SHOPCTA widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 */

	//protected function _content_template(){}

}
Plugin::instance()->widgets_manager->register_widget_type(new Loveme_SHOPCTA());
