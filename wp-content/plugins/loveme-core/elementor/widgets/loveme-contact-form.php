<?php
/*
 * Elementor Loveme Contact Form 7 Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Loveme_Contact_Form extends Widget_Base
{

	/**
	 * Retrieve the widget name.
	 */
	public function get_name()
	{
		return 'wpo-loveme_contact_form';
	}

	/**
	 * Retrieve the widget title.
	 */
	public function get_title()
	{
		return esc_html__('Contact Form', 'loveme-core');
	}

	/**
	 * Retrieve the widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-form-horizontal';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 */
	public function get_categories()
	{
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Loveme Contact Form widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	 */
	/*
	public function get_script_depends() {
		return ['wpo-loveme_contact_form'];
	}
	 */

	/**
	 * Register Loveme Contact Form widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 */
	protected function register_controls()
	{

		$this->start_controls_section(
			'section_contact_form',
			[
				'label' => esc_html__('Form Options', 'loveme-core'),
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
			'shape_image',
			[
				'label' => esc_html__('Shape Image', 'loveme-core'),
				'type' => Controls_Manager::MEDIA,
				'frontend_available' => true,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'description' => esc_html__('Set your image.', 'loveme-core'),
			]
		);
		$this->add_control(
			'left_shape',
			[
				'label' => esc_html__('Left Shape', 'loveme-core'),
				'type' => Controls_Manager::MEDIA,
				'frontend_available' => true,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'description' => esc_html__('Set your image.', 'loveme-core'),
			]
		);
		$this->add_control(
			'right_shape',
			[
				'label' => esc_html__('Right Shape', 'loveme-core'),
				'type' => Controls_Manager::MEDIA,
				'frontend_available' => true,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'description' => esc_html__('Set your image.', 'loveme-core'),
			]
		);
		$this->add_control(
			'form_id',
			[
				'label' => esc_html__('Select contact form', 'loveme-core'),
				'type' => Controls_Manager::SELECT,
				'options' => Controls_Helper_Output::get_posts('wpcf7_contact_form'),
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
				'selector' => '{{WRAPPER}} .wpo-contact-form-area .wpo-section-title span',
			]
		);
		$this->add_control(
			'subtitle_color',
			[
				'label' => esc_html__('Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-contact-form-area .wpo-section-title span' => 'color: {{VALUE}};',
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
				'name' => 'loveme_title_typography',
				'selector' => '{{WRAPPER}} .wpo-contact-form-area .wpo-section-title h2',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-contact-form-area .wpo-section-title h2' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'title_line_color',
			[
				'label' => esc_html__('Line Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-contact-form-area .wpo-section-title .section-title-img::before, .wpo-contact-form-area .wpo-section-title .section-title-img::after' => 'background-color: {{VALUE}};',
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
					'{{WRAPPER}} .wpo-contact-form-area .wpo-section-title h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Form Box
		$this->start_controls_section(
			'section_form_box_style',
			[
				'label' => esc_html__('Form Box', 'loveme-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'form_box_border',
			[
				'label' => esc_html__('Box Border Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-contact-section .wpo-contact-section-wrapper .wpo-contact-form-area' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		$this->start_controls_section(
			'section_form_style',
			[
				'label' => esc_html__('Form', 'loveme-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'form_typography',
				'selector' => '{{WRAPPER}} .wpo-contact-form-area .form-area input[type="text"], 
				{{WRAPPER}} .wpo-contact-form-area .form-area input[type="email"], 
				{{WRAPPER}} .wpo-contact-form-area .form-area input[type="date"], 
				{{WRAPPER}} .wpo-contact-form-area .form-area input[type="time"], 
				{{WRAPPER}} .wpo-contact-form-area .form-area input[type="number"], 
				{{WRAPPER}} .wpo-contact-form-area .form-area textarea, 
				{{WRAPPER}} .wpo-contact-form-area .form-area select, 
				{{WRAPPER}} .wpo-contact-form-area .form-area .form-control, 
				{{WRAPPER}} .track-contact .track-trace select, 
				{{WRAPPER}} .track-contact .track-trace input',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'form_border',
				'label' => esc_html__('Border', 'loveme-core'),
				'selector' => '{{WRAPPER}} .wpo-contact-form-area .form-area input[type="text"], 
				{{WRAPPER}} .wpo-contact-form-area .form-area input[type="email"], 
				{{WRAPPER}} .wpo-contact-form-area .form-areainput[type="date"], 
				{{WRAPPER}} .wpo-contact-form-area .form-area input[type="time"], 
				{{WRAPPER}} .wpo-contact-form-area .form-area input[type="number"], 
				{{WRAPPER}} .wpo-contact-form-area .form-area textarea, 
				{{WRAPPER}} .wpo-contact-form-area .form-area select, 
				{{WRAPPER}} .wpo-contact-form-area .form-area .form-control, 
				{{WRAPPER}} .wpo-contact-form-area .form-area .nice-select,
				{{WRAPPER}} .track-contact .track-trace select, 
				{{WRAPPER}} .track-contact .track-trace input',

			]
		);
		$this->add_control(
			'placeholder_text_color',
			[
				'label' => __('Placeholder Text Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-contact-form-area .form-area input:not([type="submit"])::-webkit-input-placeholder' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .wpo-contact-form-area .form-area input:not([type="submit"])::-moz-placeholder' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .wpo-contact-form-area .form-area input:not([type="submit"])::-ms-input-placeholder' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .wpo-contact-form-area .form-area input:not([type="submit"])::-o-placeholder' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .wpo-contact-form-area .form-area textarea::-webkit-input-placeholder' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .wpo-contact-form-area .form-area textarea::-moz-placeholder' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .wpo-contact-form-area .form-area textarea::-ms-input-placeholder' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .wpo-contact-form-area .form-area textarea::-o-placeholder' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .track-contact .track-trace input::-webkit-input-placeholder' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .track-contact .track-trace select::-webkit-input-placeholder' => 'color: {{VALUE}} !important;',
				],
			]
		);
		$this->add_control(
			'label_color',
			[
				'label' => __('Label Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-contact-form-area .form-area label' => 'color: {{VALUE}} !important;',
				],
			]
		);
		$this->add_control(
			'text_color',
			[
				'label' => __('Text Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-contact-form-area .form-area input[type="text"], 
					{{WRAPPER}} .wpo-contact-form-area .form-area input[type="email"], 
					{{WRAPPER}} .wpo-contact-form-area .form-area input[type="date"], 
					{{WRAPPER}} .wpo-contact-form-area .form-area input[type="time"], 
					{{WRAPPER}} .wpo-contact-form-area .form-area input[type="number"], 
					{{WRAPPER}} .wpo-contact-form-area .form-area textarea, 
					{{WRAPPER}} .wpo-contact-form-area .form-area select, 
					{{WRAPPER}} .wpo-contact-form-area .form-area .form-control, 
					{{WRAPPER}} .track-contact .track-trace input, 
					{{WRAPPER}} .wpo-contact-form-area .form-area .nice-select' => 'color: {{VALUE}} !important;',
				],
			]
		);
		$this->end_controls_section(); // end: Section

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
				'selector' => '{{WRAPPER}} .wpo-contact-form-area .form-area .wpcf7-form-control.wpcf7-submit',
			]
		);
		$this->add_responsive_control(
			'btn_width',
			[
				'label' => esc_html__('Width', 'loveme-core'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
				],
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .wpo-contact-form-area .form-area .wpcf7-form-control.wpcf7-submit' => 'min-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'btn_margin',
			[
				'label' => __('Margin', 'loveme-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .wpo-contact-form-area .form-area .wpcf7-form-control.wpcf7-submit' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .wpo-contact-form-area .form-area .wpcf7-form-control.wpcf7-submit' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .wpo-contact-form-area .form-area .wpcf7-form-control.wpcf7-submit' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_bg_color',
			[
				'label' => esc_html__('Background Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-contact-form-area .form-area .wpcf7-form-control.wpcf7-submit' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'button_border',
				'label' => esc_html__('Border', 'loveme-core'),
				'selector' => '{{WRAPPER}} .wpo-contact-form-area .form-area .wpcf7-form-control.wpcf7-submit',
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
					'{{WRAPPER}} .wpo-contact-form-area .form-area .wpcf7-form-control.wpcf7-submit:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_bg_hover_color',
			[
				'label' => esc_html__('Background Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-contact-form-area .form-area .wpcf7-form-control.wpcf7-submit:hover' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'button_hover_border',
				'label' => esc_html__('Border', 'loveme-core'),
				'selector' => '{{WRAPPER}} .wpo-contact-form-area .form-area .wpcf7-form-control.wpcf7-submit:hover',
			]
		);
		$this->end_controls_tab();  // end:Hover tab
		$this->end_controls_tabs(); // end tabs

		$this->end_controls_section(); // end: Section

	}

	/**
	 * Render Contact Form widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$form_id = !empty($settings['form_id']) ? $settings['form_id'] : '';
		$section_subtitle = !empty($settings['section_subtitle']) ? $settings['section_subtitle'] : '';
		$section_title = !empty($settings['section_title']) ? $settings['section_title'] : '';

		$bg_image = !empty($settings['shape_image']['id']) ? $settings['shape_image']['id'] : '';
		$bg_shape = !empty($settings['left_shape']['id']) ? $settings['left_shape']['id'] : '';
		$bg_shape2 = !empty($settings['right_shape']['id']) ? $settings['right_shape']['id'] : '';

		// Image
		$image_url = wp_get_attachment_url($bg_image);
		$image_alt = get_post_meta($bg_image, '_wp_attachment_image_alt', true);

		// Image
		$shape_url = wp_get_attachment_url($bg_shape);
		$shape_alt = get_post_meta($bg_shape, '_wp_attachment_image_alt', true);
		// Image

		$shape2_url = wp_get_attachment_url($bg_shape2);
		$shape2_alt = get_post_meta($bg_shape2, '_wp_attachment_image_alt', true);

		// Turn output buffer on
		ob_start(); ?>
		<div class="wpo-contact-section">
			<div class="container">
				<div class="wpo-contact-section-wrapper">
					<div class="wpo-contact-form-area">
						<div class="wpo-section-title">
							<?php
							if ($section_subtitle) {
								echo '<span>' . esc_html($section_subtitle) . '</span>';
							}
							if ($section_title) {
								echo '<h2>' . esc_html($section_title) . '</h2>';
							}
							?>
							<div class="section-title-img">
								<?php if ($image_url) {
									echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($image_alt) . '">';
								} ?>
							</div>
						</div>
						<div class="form-area">
							<?php echo do_shortcode('[contact-form-7 id="' . $form_id . '"]'); ?>
						</div>
						<div class="border-style"></div>
					</div>
					<div class="vector-1">
						<?php if ($shape_url) {
							echo '<img src="' . esc_url($shape_url) . '" alt="' . esc_attr($shape_alt) . '">';
						} ?>
					</div>
					<div class="vector-2">
						<?php if ($shape2_url) {
							echo '<img src="' . esc_url($shape2_url) . '" alt="' . esc_attr($shape2_alt) . '">';
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
	 * Render Contact Form widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 */

	//protected function _content_template(){}

}
Plugin::instance()->widgets_manager->register_widget_type(new Loveme_Contact_Form());
