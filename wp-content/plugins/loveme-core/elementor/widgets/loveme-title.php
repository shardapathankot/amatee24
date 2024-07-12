<?php
/*
 * Elementor Loveme Title Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Loveme_Title extends Widget_Base
{

	/**
	 * Retrieve the widget name.
	 */
	public function get_name()
	{
		return 'wpo-loveme_title';
	}

	/**
	 * Retrieve the widget title.
	 */
	public function get_title()
	{
		return esc_html__('Title', 'loveme-core');
	}

	/**
	 * Retrieve the widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-heading';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 */
	public function get_categories()
	{
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Loveme Title widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	 */
	/*
	public function get_script_depends() {
		return ['wpo-loveme_title'];
	}
	*/

	/**
	 * Register Loveme Title widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 */
	protected function register_controls()
	{

		$this->start_controls_section(
			'section_Title',
			[
				'label' => esc_html__('Title Options', 'loveme-core'),
			]
		);
		$this->add_control(
			'title_style',
			[
				'label' => esc_html__('Title Style', 'finco-core'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'style-one' => esc_html__('Style One', 'finco-core'),
					'style-two' => esc_html__('Style Two', 'finco-core'),
				],
				'default' => 'style-one',
				'description' => esc_html__('Select your title style.', 'finco-core'),
			]
		);
		$this->add_control(
			'section_subtitle',
			[
				'label' => esc_html__('Sub Title Text', 'loveme-core'),
				'type' => Controls_Manager::TEXT,
				'condition' => [
					'title_style' => array('style-one'),
				],
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
		$this->add_responsive_control(
			'content_min_width',
			[
				'label' => esc_html__('Width', 'loveme-core'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 350,
						'max' => 750,
						'step' => 1,
					],
				],
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .section-title-s3 p' => 'max-width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'title_style' => array('style-one'),
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
				'selector' => '{{WRAPPER}} .wpo-section-title span',
			]
		);
		$this->add_control(
			'subtitle_color',
			[
				'label' => esc_html__('Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-section-title span' => 'color: {{VALUE}};',
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
				'selector' => '{{WRAPPER}} .wpo-section-title h2, .wpo-section-title-s2 h2',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-section-title h2, .wpo-section-title-s2 h2' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'title_line_color',
			[
				'label' => esc_html__('Line Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-section-title .section-title-img::before,.wpo-section-title .section-title-img::after, .wpo-section-title-s2 .section-title-img .round-ball, .wpo-section-title-s2 .section-title-img::before,.wpo-section-title-s2 .section-title-img::after' => 'background-color: {{VALUE}};',
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
					'{{WRAPPER}} .wpo-section-title h2, .wpo-section-title-s2 h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section





	}

	/**
	 * Render Title widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$title_style = !empty($settings['title_style']) ? $settings['title_style'] : '';
		$section_subtitle = !empty($settings['section_subtitle']) ? $settings['section_subtitle'] : '';
		$section_title = !empty($settings['section_title']) ? $settings['section_title'] : '';

		$bg_image = !empty($settings['shape_image']['id']) ? $settings['shape_image']['id'] : '';

		// Image
		$image_url = wp_get_attachment_url($bg_image);
		$image_alt = get_post_meta($bg_image, '_wp_attachment_image_alt', true);

		// Turn output buffer on

		ob_start();
		if ($title_style == 'style-one') { ?>
			<div class="wpo-section-area">
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
			</div>
		<?php } else { ?>
			<div class="wpo-section-title-s2">
				<div class="section-title-simg">
					<?php if ($image_url) {
						echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($image_alt) . '">';
					} ?>
				</div>
				<?php
				if ($section_title) {
					echo '<h2>' . esc_html($section_title) . '</h2>';
				}
				?>
				<div class="section-title-img">
					<div class="round-ball"></div>
				</div>
			</div>
<?php }

		// Return outbut buffer
		echo ob_get_clean();
	}
	/**
	 * Render Title widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 */

	//protected function _content_template(){}

}
Plugin::instance()->widgets_manager->register_widget_type(new Loveme_Title());
