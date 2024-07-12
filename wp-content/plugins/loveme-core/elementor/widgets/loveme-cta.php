<?php
/*
 * Elementor Loveme CTA Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Loveme_CTA extends Widget_Base
{

	/**
	 * Retrieve the widget name.
	 */
	public function get_name()
	{
		return 'wpo-loveme_cta';
	}

	/**
	 * Retrieve the widget title.
	 */
	public function get_title()
	{
		return esc_html__('CTA', 'loveme-core');
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
	 * Retrieve the list of scripts the Loveme CTA widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	 */
	/*
	public function get_script_depends() {
		return ['wpo-loveme_cta'];
	}
	*/

	/**
	 * Register Loveme CTA widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 */
	protected function register_controls()
	{

		$this->start_controls_section(
			'section_CTA',
			[
				'label' => esc_html__('CTA Options', 'loveme-core'),
			]
		);
		$this->add_control(
			'cta_image',
			[
				'label' => esc_html__('Title Shape', 'loveme-core'),
				'type' => Controls_Manager::MEDIA,
				'frontend_available' => true,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'description' => esc_html__('Set your image.', 'loveme-core'),
			]
		);
		$this->add_control(
			'cta_title',
			[
				'label' => esc_html__('Title Text', 'loveme-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Title Text', 'loveme-core'),
				'placeholder' => esc_html__('Type title text here', 'loveme-core'),
				'label_block' => true,
			]
		);
		$this->add_control(
			'cta_content',
			[
				'label' => esc_html__('Content Text', 'loveme-core'),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__('Content Text', 'loveme-core'),
				'placeholder' => esc_html__('Type Content text here', 'loveme-core'),
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
		$this->end_controls_section(); // end: Section

		// Section
		$this->start_controls_section(
			'section_cta_style',
			[
				'label' => esc_html__('Section', 'loveme-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'cta_section_padding',
			[
				'label' => esc_html__('Section Padding', 'loveme-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .wpo-cta-section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .wpo-cta-section .wpo-cta-item h2',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-cta-section .wpo-cta-item h2' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .wpo-cta-section .wpo-cta-item h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .wpo-cta-section .wpo-cta-item p',
			]
		);
		$this->add_control(
			'content_color',
			[
				'label' => esc_html__('Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-cta-section .wpo-cta-item p' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .wpo-cta-section .wpo-cta-item p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section


		// Button
		$this->start_controls_section(
			'section_button_style',
			[
				'label' => esc_html__('Button', 'loveme-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'cta_button_color',
			[
				'label' => esc_html__('Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-cta-section .wpo-cta-item .theme-btn-s2' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'cta_button_bg_color',
			[
				'label' => esc_html__('Background Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-cta-section .wpo-cta-item .theme-btn-s2' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section
	}

	/**
	 * Render CTA widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();

		$cta_title = !empty($settings['cta_title']) ? $settings['cta_title'] : '';
		$cta_content = !empty($settings['cta_content']) ? $settings['cta_content'] : '';
		$bg_image = !empty($settings['cta_image']['id']) ? $settings['cta_image']['id'] : '';
		// Image
		$image_url = wp_get_attachment_url($bg_image);
		$image_alt = get_post_meta($bg_image, '_wp_attachment_image_alt', true);

		$btn_text = !empty($settings['btn_text']) ? $settings['btn_text'] : '';
		$btn_paragraph = !empty($settings['btn_paragraph']) ? $settings['btn_paragraph'] : '';
		$btn_icon = !empty($settings['btn_icon']) ? $settings['btn_icon'] : '';

		$btn_link = !empty($settings['btn_link']['url']) ? $settings['btn_link']['url'] : '';
		$btn_external = !empty($settings['btn_link']['is_external']) ? 'target="_blank"' : '';
		$btn_nofollow = !empty($settings['btn_link']['nofollow']) ? 'rel="nofollow"' : '';
		$btn_link_attr = !empty($btn_link) ?  $btn_external . ' ' . $btn_nofollow : '';

		$button = $btn_link ? '<a href="' . esc_url($btn_link) . '" ' . esc_attr($btn_link_attr) . ' class="theme-btn-s2" >' . esc_html($btn_text) . '</a>' : '';

		// Turn output buffer on
		ob_start(); ?>

		<div class="wpo-cta-section">
			<div class="conatiner-fluid">
				<div class="wpo-cta-item">
					<span>
						<?php if ($image_url) {
							echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($image_alt) . '">';
						} ?>
					</span>
					<?php
					if ($cta_title) {
						echo '<h2>' . esc_html($cta_title) . '</h2>';
					}
					if ($cta_content) {
						echo '<p>' . esc_html($cta_content) . '</p>';
					}
					echo $button;
					?>
				</div>
			</div>
		</div>
<?php // Return outbut buffer
		echo ob_get_clean();
	}
	/**
	 * Render CTA widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 */

	//protected function _content_template(){}

}
Plugin::instance()->widgets_manager->register_widget_type(new Loveme_CTA());
