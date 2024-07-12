<?php
/*
 * Elementor Loveme About Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Loveme_About extends Widget_Base
{

	/**
	 * Retrieve the widget name.
	 */
	public function get_name()
	{
		return 'wpo-loveme_about';
	}

	/**
	 * Retrieve the widget title.
	 */
	public function get_title()
	{
		return esc_html__('About', 'loveme-core');
	}

	/**
	 * Retrieve the widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-site-identity';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 */
	public function get_categories()
	{
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Loveme About widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	 */
	public function get_script_depends()
	{
		return ['wpo-loveme_about'];
	}

	/**
	 * Register Loveme About widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 */
	protected function register_controls()
	{

		$this->start_controls_section(
			'section_about',
			[
				'label' => esc_html__('About Options', 'loveme-core'),
			]
		);
		$this->add_control(
			'about_style',
			[
				'label' => esc_html__('About Style', 'finco-core'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'style-one' => esc_html__('Style One', 'finco-core'),
					'style-two' => esc_html__('Style Two', 'finco-core'),
				],
				'default' => 'style-one',
				'description' => esc_html__('Select your about style.', 'finco-core'),
			]
		);
		$this->add_control(
			'title_shape',
			[
				'label' => esc_html__('Title Shape Image', 'loveme-core'),
				'type' => Controls_Manager::MEDIA,
				'frontend_available' => true,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'description' => esc_html__('Set your image.', 'loveme-core'),
			]
		);
		$this->add_control(
			'about_title',
			[
				'label' => esc_html__('Title Text', 'loveme-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('About Our Company', 'loveme-core'),
				'placeholder' => esc_html__('Sub Type title text here', 'loveme-core'),
				'label_block' => true,
			]
		);
		$this->add_control(
			'about_content',
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
		$this->add_control(
			'about_shape',
			[
				'label' => esc_html__('About Shape', 'loveme-core'),
				'type' => Controls_Manager::MEDIA,
				'frontend_available' => true,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'description' => esc_html__('Set your image.', 'loveme-core'),
			]
		);
		$this->add_control(
			'about_image',
			[
				'label' => esc_html__('About Image', 'loveme-core'),
				'type' => Controls_Manager::MEDIA,
				'frontend_available' => true,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'description' => esc_html__('Set your image.', 'loveme-core'),
			]
		);
		$this->add_control(
			'about_image2',
			[
				'label' => esc_html__('About Image 2', 'loveme-core'),
				'type' => Controls_Manager::MEDIA,
				'frontend_available' => true,
				'condition' => [
					'about_style' => array('style-one'),
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'description' => esc_html__('Set your signeture image.', 'loveme-core'),
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
				'selector' => '{{WRAPPER}} .wpo-about-section .wpo-about-text .wpo-about-icon-content h2, .wpo-about-section-s2 .wpo-about-text .wpo-about-icon-content h2',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-about-section .wpo-about-text .wpo-about-icon-content h2, .wpo-about-section-s2 .wpo-about-text .wpo-about-icon-content h2' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'title_padding',
			[
				'label' => esc_html__('Title Padding', 'loveme-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .wpo-about-section .wpo-about-text .wpo-about-icon-content h2, .wpo-about-section-s2 .wpo-about-text .wpo-about-icon-content h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .wpo-about-section .wpo-about-text .wpo-about-icon-content p, .wpo-about-section-s2 .wpo-about-text .wpo-about-icon-content p',
			]
		);
		$this->add_control(
			'content_color',
			[
				'label' => esc_html__('Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-about-section .wpo-about-text .wpo-about-icon-content p, .wpo-about-section-s2 .wpo-about-text .wpo-about-icon-content p, .wpo-about-section-s2 .wpo-about-text .wpo-about-icon-content ul li' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'content_list_color',
			[
				'label' => esc_html__('List Bullet', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-about-section-s2 .wpo-about-icon-content ul li:before' => 'background-color: {{VALUE}};',
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
					'{{WRAPPER}} .wpo-about-section .wpo-about-text .wpo-about-icon-content p, .wpo-about-section-s2 .wpo-about-text .wpo-about-icon-content p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Button
		$this->start_controls_section(
			'section_bout_btn_style',
			[
				'label' => esc_html__('Button', 'loveme-core'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'about_style' => array('style-one'),
				],
			]
		);
		$this->add_control(
			'button_color',
			[
				'label' => esc_html__('Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-about-section .wpo-about-text .theme-btn-s3, .wpo-about-section-s2 .wpo-about-text .theme-btn-s3' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_br_color',
			[
				'label' => esc_html__('Border Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .theme-btn.theme-btn-s3:after, .theme-btn-s3.theme-btn-s3:after, .theme-btn-s4.theme-btn-s3:after' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_bg_color',
			[
				'label' => esc_html__('Background Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-about-section .wpo-about-text .theme-btn-s3, .wpo-about-section-s2 .wpo-about-text .theme-btn-s3' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_hover_color',
			[
				'label' => esc_html__('Hover Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-about-section .wpo-about-text .theme-btn-s3:hover, .wpo-about-section-s2 .wpo-about-text .theme-btn-s3:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_bg_color',
			[
				'label' => esc_html__('Hover BG Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-about-section .wpo-about-text .theme-btn-s3:hover, .wpo-about-section-s2 .wpo-about-text .theme-btn-s3:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section(); // end: Section


	}

	/**
	 * Render About widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$about_style = !empty($settings['about_style']) ? $settings['about_style'] : '';
		$bg_shape = !empty($settings['title_shape']['id']) ? $settings['title_shape']['id'] : '';
		$about_title = !empty($settings['about_title']) ? $settings['about_title'] : '';
		$about_content = !empty($settings['about_content']) ? $settings['about_content'] : '';
		$bg_image = !empty($settings['about_image']['id']) ? $settings['about_image']['id'] : '';
		$bg_image2 = !empty($settings['about_image2']['id']) ? $settings['about_image2']['id'] : '';
		$shape_image = !empty($settings['about_shape']['id']) ? $settings['about_shape']['id'] : '';

		// Image
		$image_url = wp_get_attachment_url($bg_image);
		$image_alt = get_post_meta($bg_image, '_wp_attachment_image_alt', true);

		// Image
		$image2_url = wp_get_attachment_url($bg_image2);
		$image2_alt = get_post_meta($bg_image2, '_wp_attachment_image_alt', true);

		// Image
		$shape_url = wp_get_attachment_url($shape_image);
		$shape_alt = get_post_meta($shape_image, '_wp_attachment_image_alt', true);

		// Image
		$title_shape_url = wp_get_attachment_url($bg_shape);
		$title_shape_alt = get_post_meta($bg_shape, '_wp_attachment_image_alt', true);

		$btn_text = !empty($settings['btn_text']) ? $settings['btn_text'] : '';
		$btn_paragraph = !empty($settings['btn_paragraph']) ? $settings['btn_paragraph'] : '';
		$btn_icon = !empty($settings['btn_icon']) ? $settings['btn_icon'] : '';

		$btn_link = !empty($settings['btn_link']['url']) ? $settings['btn_link']['url'] : '';
		$btn_external = !empty($settings['btn_link']['is_external']) ? 'target="_blank"' : '';
		$btn_nofollow = !empty($settings['btn_link']['nofollow']) ? 'rel="nofollow"' : '';
		$btn_link_attr = !empty($btn_link) ?  $btn_external . ' ' . $btn_nofollow : '';

		$button = $btn_link ? '<a href="' . esc_url($btn_link) . '" ' . esc_attr($btn_link_attr) . ' class="theme-btn-s3" >' . esc_html($btn_text) . '</a>' : '';

		if ($about_style ==  'style-one') {
			$about_wrap = 'wpo-about-section';
			$about_col = 'col-lg-5 col-md-12 col-12';
			$about_col2 = 'col-lg-7 col-md-12 col-12';
		} else {
			$about_wrap = 'wpo-about-section-s2';
			$about_col = 'col-lg-6 col-md-12 col-12';
			$about_col2 = 'col-lg-6 col-md-12 col-12';
		}

		// Turn output buffer on
		ob_start(); ?>
		<div class="<?php echo esc_attr($about_wrap) ?>">
			<div class="container">
				<div class="row align-items-center">
					<div class="<?php echo esc_attr($about_col) ?>">
						<div class="wpo-about-wrap">
							<div class="wpo-about-item">
								<?php if ($image_url) {
									echo '<div class="wpo-about-img"><img src="' . esc_url($image_url) . '" alt="' . esc_attr($image_alt) . '"></div>';
								} ?>
							</div>
							<div class="about-single-item">
								<?php if ($image2_url) {
									echo '<div class="wpo-about-item-s2 wow rollIn" data-wow-duration="2s"><div class="wpo-about-img"><img src="' . esc_url($image2_url) . '" alt="' . esc_attr($image2_alt) . '"></div></div>';
								} ?>
							</div>
							<?php if ($shape_url) {
								echo ' <div class="ab-shape"><img src="' . esc_url($shape_url) . '" alt="' . esc_attr($shape_alt) . '"></div>';
							} ?>
						</div>
					</div>
					<div class="<?php echo esc_attr($about_col2) ?>">
						<div class="wpo-about-text">
							<div class="wpo-about-icon">
								<div class="icon">
									<?php if ($title_shape_url) {
										echo '<img src="' . esc_url($title_shape_url) . '" alt="' . esc_attr($title_shape_alt) . '">';
									} ?>
								</div>
							</div>
							<div class="wpo-about-icon-content">
								<?php
								if ($about_title) {
									echo '<h2>' . esc_html($about_title) . '</h2>';
								}
								if ($about_content) {
									echo wp_kses_post($about_content);
								}
								echo $button;
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php
		echo ob_get_clean();
	}
	/**
	 * Render About widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 */

	//protected function _content_template(){}

}
Plugin::instance()->widgets_manager->register_widget_type(new Loveme_About());
