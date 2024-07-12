<?php
/*
 * Elementor Loveme Testimonial Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Loveme_Testimonial extends Widget_Base
{

	/**
	 * Retrieve the widget name.
	 */
	public function get_name()
	{
		return 'wpo-loveme_testimonial';
	}

	/**
	 * Retrieve the widget title.
	 */
	public function get_title()
	{
		return esc_html__('Testimonial', 'loveme-core');
	}

	/**
	 * Retrieve the widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-testimonial-carousel';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 */
	public function get_categories()
	{
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Loveme Testimonial widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	 */
	public function get_script_depends()
	{
		return ['wpo-loveme_testimonial'];
	}

	/**
	 * Register Loveme Testimonial widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 */
	protected function register_controls()
	{

		$this->start_controls_section(
			'section_testimonial',
			[
				'label' => esc_html__('Testimonial Options', 'loveme-core'),
			]
		);
		$this->add_control(
			'testi_shape',
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
			'testi_couple',
			[
				'label' => esc_html__('Couple Image', 'loveme-core'),
				'type' => Controls_Manager::MEDIA,
				'frontend_available' => true,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'description' => esc_html__('Set your image.', 'loveme-core'),
			]
		);
		$this->add_control(
			'testi_shape2',
			[
				'label' => esc_html__('Shape Image 2', 'loveme-core'),
				'type' => Controls_Manager::MEDIA,
				'frontend_available' => true,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'description' => esc_html__('Set your image.', 'loveme-core'),
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
		$repeater = new Repeater();
		$repeater->add_control(
			'testimonial_title',
			[
				'label' => esc_html__('Testimonial Title Text', 'loveme-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Title Text', 'loveme-core'),
				'placeholder' => esc_html__('Type title text here', 'loveme-core'),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'testimonial_subtitle',
			[
				'label' => esc_html__('Testimonial Sub Title', 'loveme-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Testimonial Sub Title', 'loveme-core'),
				'placeholder' => esc_html__('Type testimonial Sub title here', 'loveme-core'),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'testimonial_content',
			[
				'label' => esc_html__('Testimonial Content', 'loveme-core'),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__('Testimonial Content', 'loveme-core'),
				'placeholder' => esc_html__('Type testimonial Content here', 'loveme-core'),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'bg_image',
			[
				'label' => esc_html__('Testimonial Image', 'loveme-core'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],

			]
		);
		$this->add_control(
			'testimonialItems_groups',
			[
				'label' => esc_html__('Testimonial Items', 'loveme-core'),
				'type' => Controls_Manager::REPEATER,
				'default' => [
					[
						'testimonial_title' => esc_html__('Testimonial', 'loveme-core'),
					],

				],
				'fields' =>  $repeater->get_controls(),
				'title_field' => '{{{ testimonial_title }}}',
			]
		);
		$this->end_controls_section(); // end: Section


		// Testimonial Content Style 
		$this->start_controls_section(
			'testimonials_loveme_section_title_style',
			[
				'label' => esc_html__('Section Title', 'loveme-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'loveme-core'),
				'name' => 'testimonials_loveme_section_title_typography',
				'selector' => '{{WRAPPER}} .wpo-testimonials-section .wpo-testimonials-wrap h2',
			]
		);
		$this->add_control(
			'testimonials_section_title_color',
			[
				'label' => esc_html__('Title Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-testimonials-section .wpo-testimonials-wrap h2' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'testimonials_section_title_line_color',
			[
				'label' => esc_html__('Title Line Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-testimonials-section .wpo-testimonials-wrap h2:before' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section


		// Testimonial Name Style 
		$this->start_controls_section(
			'testimonials_section_name_style',
			[
				'label' => esc_html__('Name', 'loveme-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'loveme-core'),
				'name' => 'testimonials_loveme_name_typography',
				'selector' => '{{WRAPPER}} .wpo-testimonials-section .wpo-testimonials-wrap .wpo-testimonials-active .wpo-testimonial-info .wpo-testimonial-info-text h5',
			]
		);
		$this->add_control(
			'testimonials_name_color',
			[
				'label' => esc_html__('Name Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-testimonials-section .wpo-testimonials-wrap .wpo-testimonials-active .wpo-testimonial-info .wpo-testimonial-info-text h5' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Testimonial Title Style 
		$this->start_controls_section(
			'testimonials_section_title_style',
			[
				'label' => esc_html__('Title', 'loveme-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'loveme-core'),
				'name' => 'testimonials_loveme_title_typography',
				'selector' => '{{WRAPPER}} .wpo-testimonials-section .wpo-testimonials-wrap .wpo-testimonials-active .wpo-testimonial-info .wpo-testimonial-info-text span',
			]
		);
		$this->add_control(
			'testimonials_title_color',
			[
				'label' => esc_html__('Name Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-testimonials-section .wpo-testimonials-wrap .wpo-testimonials-active .wpo-testimonial-info .wpo-testimonial-info-text span' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'testimonials_title_br_color',
			[
				'label' => esc_html__('Image Border Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-testimonials-section .wpo-testimonials-wrap .wpo-testimonials-active .wpo-testimonial-info .wpo-testimonial-info-img:before' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Testimonial Content Style 
		$this->start_controls_section(
			'testimonials_section_content_style',
			[
				'label' => esc_html__('Content', 'loveme-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'loveme-core'),
				'name' => 'testimonials_loveme_section_content_typography',
				'selector' => '{{WRAPPER}} .wpo-testimonials-section .wpo-testimonials-wrap .wpo-testimonials-active p',
			]
		);
		$this->add_control(
			'testimonials_section_content_color',
			[
				'label' => esc_html__('Title Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-testimonials-section .wpo-testimonials-wrap .wpo-testimonials-active p' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Dot Color
		$this->start_controls_section(
			'section_dot_style',
			[
				'label' => esc_html__('Dot', 'loveme-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'dot_bg_color',
			[
				'label' => esc_html__('Background Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-testimonials-section .wpo-testimonials-wrap .wpo-testimonials-active .owl-dots button' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'dot_active_color',
			[
				'label' => esc_html__('Active Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-testimonials-section .wpo-testimonials-wrap .wpo-testimonials-active .owl-dots .owl-dot.active' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Quote Color
		$this->start_controls_section(
			'section_quote_style',
			[
				'label' => esc_html__('Quote', 'loveme-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'quote_color',
			[
				'label' => esc_html__('Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-testimonials-section .wpo-testimonials-wrap h2:before' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'quote_line_color',
			[
				'label' => esc_html__('Line Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-testimonials-section .wpo-testimonials-wrap h2:after' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

	}

	/**
	 * Render Testimonial widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$testimonialItems_groups = !empty($settings['testimonialItems_groups']) ? $settings['testimonialItems_groups'] : [];
		$section_title = !empty($settings['section_title']) ? $settings['section_title'] : '';
		$bg_shape = !empty($settings['testi_shape']['id']) ? $settings['testi_shape']['id'] : '';
		$bg_shape2 = !empty($settings['testi_shape2']['id']) ? $settings['testi_shape2']['id'] : '';
		$bg_couple = !empty($settings['testi_couple']['id']) ? $settings['testi_couple']['id'] : '';

		// Image
		$shape_url = wp_get_attachment_url($bg_shape);
		$shape_alt = get_post_meta($bg_shape, '_wp_attachment_image_alt', true);

		// Image
		$shape2_url = wp_get_attachment_url($bg_shape2);
		$shape2_alt = get_post_meta($bg_shape2, '_wp_attachment_image_alt', true);

		// Image
		$couple_url = wp_get_attachment_url($bg_couple);
		$couple_alt = get_post_meta($bg_couple, '_wp_attachment_image_alt', true);

		// Turn output buffer on
		ob_start(); ?>
		<div class="wpo-testimonials-section">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-lg-4 col-12">
						<div class="wpo-testimonials-img">
							<?php if ($couple_url) {
								echo '<img src="' . esc_url($couple_url) . '" alt="' . esc_attr($couple_alt) . '">';
							} ?>
							<div class="wpo-testimonials-img-shape">
								<?php if ($shape_url) {
									echo '<img src="' . esc_url($shape_url) . '" alt="' . esc_attr($shape_alt) . '">';
								} ?>
							</div>
						</div>
					</div>
					<div class="col-lg-7 offset-lg-1 col-12">
						<div class="wpo-testimonials-wrap">
							<?php if ($section_title) {
								echo '<h2>' . esc_html($section_title) . '</h2>';
							} ?>
							<div class="wpo-testimonials-active owl-carousel">
								<?php 	// Group Param Output
								if (is_array($testimonialItems_groups) && !empty($testimonialItems_groups)) {
									foreach ($testimonialItems_groups as $each_items) {

										$testimonial_title = !empty($each_items['testimonial_title']) ? $each_items['testimonial_title'] : '';
										$testimonial_subtitle = !empty($each_items['testimonial_subtitle']) ? $each_items['testimonial_subtitle'] : '';
										$testimonial_content = !empty($each_items['testimonial_content']) ? $each_items['testimonial_content'] : '';

										$image_url = wp_get_attachment_url($each_items['bg_image']['id']);
										$image_alt = get_post_meta($each_items['bg_image']['id'], '_wp_attachment_image_alt', true);
								?>
										<div class="wpo-testimonials-item">
											<?php
											if ($testimonial_content) {
												echo '<p>' . esc_html($testimonial_content) . '</p>';
											}
											?>
											<div class="wpo-testimonial-info">
												<div class="wpo-testimonial-info-img">
													<?php if ($image_url) {
														echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($image_alt) . '">';
													} ?>
												</div>
												<div class="wpo-testimonial-info-text">
													<?php
													if ($testimonial_title) {
														echo '<h5>' . esc_html($testimonial_title) . '</h5>';
													}
													if ($testimonial_subtitle) {
														echo '<span>' . esc_html($testimonial_subtitle) . '</span>';
													}
													?>
												</div>
											</div>
										</div>
								<?php }
								} ?>
							</div>
						</div>
					</div>
				</div>
			</div> <!-- end container -->
			<div class="wpo-testimonials-shape">
				<?php if ($shape2_url) {
					echo '<img src="' . esc_url($shape2_url) . '" alt="' . esc_attr($shape2_alt) . '">';
				} ?>
			</div>
		</div>
<?php
		// Return outbut buffer
		echo ob_get_clean();
	}
	/**
	 * Render Testimonial widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 */

	//protected function _content_template(){}

}
Plugin::instance()->widgets_manager->register_widget_type(new Loveme_Testimonial());
