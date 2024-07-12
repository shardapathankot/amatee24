<?php
/*
 * Elementor Loveme Couple Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Loveme_Couple_Hero extends Widget_Base
{

	/**
	 * Retrieve the widget name.
	 */
	public function get_name()
	{
		return 'wpo-loveme_couple_hero';
	}

	/**
	 * Retrieve the widget title.
	 */
	public function get_title()
	{
		return esc_html__('Couple', 'loveme-core');
	}

	/**
	 * Retrieve the widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-cogs-check';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 */
	public function get_categories()
	{
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Loveme Couple widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	 */
	public function get_script_depends()
	{
		return ['wpo-loveme_couple_hero'];
	}

	/**
	 * Register Loveme Couple widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 */
	protected function register_controls()
	{

		$this->start_controls_section(
			'couple_hero_section',
			[
				'label' => esc_html__('Couple Hero', 'loveme-core'),
			]
		);
		$this->add_control(
			'couple_style',
			[
				'label' => esc_html__('Couple Style', 'finco-core'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'style-one' => esc_html__('Style One', 'finco-core'),
					'style-two' => esc_html__('Style Two', 'finco-core'),
				],
				'default' => 'style-one',
				'description' => esc_html__('Select your couple style.', 'finco-core'),
			]
		);
		$this->add_control(
			'cuple_image',
			[
				'label' => esc_html__('Couple Image', 'edefy-core'),
				'type' => Controls_Manager::MEDIA,
				'frontend_available' => true,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'description' => esc_html__('Set Couple image here.', 'edefy-core'),
			]
		);
		$this->add_control(
			'cuple_fram',
			[
				'label' => esc_html__('Couple Fram', 'edefy-core'),
				'type' => Controls_Manager::MEDIA,
				'condition' => [
					'couple_style' => array('style-two'),
				],
				'frontend_available' => true,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'description' => esc_html__('Set Couple Fram here.', 'edefy-core'),
			]
		);
		$this->add_control(
			'left_shape',
			[
				'label' => esc_html__('Left Flower', 'edefy-core'),
				'type' => Controls_Manager::MEDIA,
				'condition' => [
					'couple_style' => array('style-one'),
				],
				'frontend_available' => true,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'description' => esc_html__('Set Shape image here.', 'edefy-core'),
			]
		);
		$this->add_control(
			'right_shape',
			[
				'label' => esc_html__('Right Flower', 'edefy-core'),
				'type' => Controls_Manager::MEDIA,
				'condition' => [
					'couple_style' => array('style-one'),
				],
				'frontend_available' => true,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'description' => esc_html__('Set Shape image here.', 'edefy-core'),
			]
		);
		$this->end_controls_section(); // end: Section

		$this->start_controls_section(
			'section_bride',
			[
				'label' => esc_html__('Bride Options', 'loveme-core'),
			]
		);
		$this->add_control(
			'bride_shape',
			[
				'label' => esc_html__('Bride Shape', 'edefy-core'),
				'type' => Controls_Manager::MEDIA,
				'frontend_available' => true,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'description' => esc_html__('Set Bride shape here.', 'edefy-core'),
			]
		);
		$this->add_control(
			'bride_title',
			[
				'label' => esc_html__('Title Text', 'loveme-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Title Text', 'loveme-core'),
				'placeholder' => esc_html__('Type title text here', 'loveme-core'),
				'label_block' => true,
			]
		);
		$this->add_control(
			'bride_content',
			[
				'label' => esc_html__('Content Text', 'loveme-core'),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__('Content Text', 'loveme-core'),
				'placeholder' => esc_html__('Type content text here', 'loveme-core'),
				'label_block' => true,
			]
		);
		$repeater = new Repeater();
		$repeater->add_control(
			'bride_social_icon',
			[
				'label' => __('Icon', 'oule-core'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'ti-twitter-alt',
					'library' => 'solid',
				],
			]
		);
		$repeater->add_control(
			'bride_social_link',
			[
				'label' => esc_html__('Social Link', 'loveme-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Social Link', 'loveme-core'),
				'placeholder' => esc_html__('Type social link here', 'loveme-core'),
				'label_block' => true,
			]
		);
		$this->add_control(
			'bride_socialItems_groups',
			[
				'label' => esc_html__('Social Item', 'loveme-core'),
				'type' => Controls_Manager::REPEATER,
				'default' => [
					[
						'bride_social_icon' => esc_html__('Social', 'loveme-core'),
					],

				],
				'fields' =>  $repeater->get_controls(),
				'title_field' => '{{{ bride_social_link }}}',
			]
		);
		$this->end_controls_section(); // end: Section

		$this->start_controls_section(
			'section_groom',
			[
				'label' => esc_html__('Groom Options', 'loveme-core'),
			]
		);
		$this->add_control(
			'groom_shape',
			[
				'label' => esc_html__('Groom Shape', 'edefy-core'),
				'type' => Controls_Manager::MEDIA,
				'frontend_available' => true,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'description' => esc_html__('Set Groom image here.', 'edefy-core'),
			]
		);
		$this->add_control(
			'groom_title',
			[
				'label' => esc_html__('Groom Title Text', 'loveme-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Title Text', 'loveme-core'),
				'placeholder' => esc_html__('Type title text here', 'loveme-core'),
				'label_block' => true,
			]
		);
		$this->add_control(
			'groom_content',
			[
				'label' => esc_html__('Groom Content Text', 'loveme-core'),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__('Content Text', 'loveme-core'),
				'placeholder' => esc_html__('Type content text here', 'loveme-core'),
				'label_block' => true,
			]
		);
		$repeater = new Repeater();
		$repeater->add_control(
			'groom_social_icon',
			[
				'label' => __('Icon', 'oule-core'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'ti-twitter-alt',
					'library' => 'solid',
				],
			]
		);
		$repeater->add_control(
			'groom_social_link',
			[
				'label' => esc_html__('Social Link', 'loveme-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Social Link', 'loveme-core'),
				'placeholder' => esc_html__('Type social link here', 'loveme-core'),
				'label_block' => true,
			]
		);
		$this->add_control(
			'groom_socialItems_groups',
			[
				'label' => esc_html__('Social Item', 'loveme-core'),
				'type' => Controls_Manager::REPEATER,
				'default' => [
					[
						'groom_social_icon' => esc_html__('Social', 'loveme-core'),
					],

				],
				'fields' =>  $repeater->get_controls(),
				'title_field' => '{{{ groom_social_link }}}',
			]
		);
		$this->end_controls_section(); // end: Section


		// Background
		$this->start_controls_section(
			'section_background_style',
			[
				'label' => esc_html__('Background', 'loveme-core'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'couple_style' => array('style-one'),
				],
			]
		);
		$this->add_control(
			'couple_hero_bg_color',
			[
				'label' => esc_html__('Background Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .static-hero-s2' => 'background-color: {{VALUE}};',
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
				'label' => esc_html__('Typography', 'loveme-core'),
				'name' => 'loveme_title_typography',
				'selector' => '{{WRAPPER}} .static-hero-s2 .text-grid h3, .couple-section .text-grid h3',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .static-hero-s2 .text-grid h3, .couple-section .text-grid h3' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .static-hero-s2 .text-grid h3, .couple-section .text-grid h3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section


		// Couple Content
		$this->start_controls_section(
			'couple_content_style',
			[
				'label' => esc_html__('Content', 'loveme-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'loveme-core'),
				'name' => 'loveme_couple_hero_content_typography',
				'selector' => '{{WRAPPER}} .static-hero-s2 .text-grid p, .couple-section .text-grid p',
			]
		);
		$this->add_control(
			'couple_content',
			[
				'label' => esc_html__('Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .static-hero-s2 .text-grid p, .couple-section .text-grid p' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'couple_content_padding',
			[
				'label' => esc_html__('Number Padding', 'loveme-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .static-hero-s2 .text-grid p, .couple-section .text-grid p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Icon
		$this->start_controls_section(
			'section_icon_style',
			[
				'label' => esc_html__('Icon', 'loveme-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'loveme-core'),
				'name' => 'sasban_icon_typography',
				'selector' => '{{WRAPPER}} .static-hero-s2 ul li a, .couple-section ul li a',
			]
		);
		$this->add_control(
			'icon_color',
			[
				'label' => esc_html__('Icon Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .static-hero-s2 ul li a, .couple-section ul li a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Icon Hover
		$this->start_controls_section(
			'section_icon_hover_style',
			[
				'label' => esc_html__('Hover', 'loveme-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'icon_hover_color',
			[
				'label' => esc_html__('Icon Hover Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .static-hero-s2 ul li a:hover, .couple-section ul li a:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section


	}

	/**
	 * Render Couple widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$couple_style = !empty($settings['couple_style']) ? $settings['couple_style'] : '';
		// Couple Image
		$couple_image = !empty($settings['cuple_image']['id']) ? $settings['cuple_image']['id'] : '';
		$couple_url = wp_get_attachment_url($couple_image);
		$couple_alt = get_post_meta($couple_image, '_wp_attachment_image_alt', true);

		// Couple Image
		$fram_image = !empty($settings['cuple_fram']['id']) ? $settings['cuple_fram']['id'] : '';
		$fram_url = wp_get_attachment_url($fram_image);
		$fram_alt = get_post_meta($fram_image, '_wp_attachment_image_alt', true);

		// BG Shape
		$left_image = !empty($settings['left_shape']['id']) ? $settings['left_shape']['id'] : '';
		$left_url = wp_get_attachment_url($left_image);
		$left_alt = get_post_meta($left_image, '_wp_attachment_image_alt', true);

		$right_image = !empty($settings['right_shape']['id']) ? $settings['right_shape']['id'] : '';
		$right_url = wp_get_attachment_url($right_image);
		$right_alt = get_post_meta($right_image, '_wp_attachment_image_alt', true);


		// bride_shape
		$bride_shape = !empty($settings['bride_shape']['id']) ? $settings['bride_shape']['id'] : '';
		$bride_url = wp_get_attachment_url($bride_shape);
		$bride_alt = get_post_meta($settings['bride_shape']['id'], '_wp_attachment_image_alt', true);

		$bride_title = !empty($settings['bride_title']) ? $settings['bride_title'] : '';
		$bride_content = !empty($settings['bride_content']) ? $settings['bride_content'] : '';
		$bride_socialItems_groups = !empty($settings['bride_socialItems_groups']) ? $settings['bride_socialItems_groups'] : '';

		// groom_shape
		$groom_shape = !empty($settings['groom_shape']['id']) ? $settings['groom_shape']['id'] : '';
		$groom_url = wp_get_attachment_url($groom_shape);
		$groom_alt = get_post_meta($settings['groom_shape']['id'], '_wp_attachment_image_alt', true);

		$groom_title = !empty($settings['groom_title']) ? $settings['groom_title'] : '';
		$groom_content = !empty($settings['groom_content']) ? $settings['groom_content'] : '';
		$groom_socialItems_groups = !empty($settings['groom_socialItems_groups']) ? $settings['groom_socialItems_groups'] : '';

		// Turn output buffer on
		ob_start();
		if ($couple_style == 'style-one') { ?>
			<div class="static-hero-s2">
				<div class="hero-container">
					<div class="hero-inner">
						<div class="container-fluid">
							<div class="row align-items-center">
								<div class="text-grid bride">
									<?php if ($groom_url) : ?>
										<div class="couple-img">
											<img src="<?php echo esc_url($groom_url); ?>" alt="<?php echo esc_attr($groom_alt); ?>">
										</div>
									<?php endif;
									if ($groom_title) {
										echo '<h3>' . esc_html($groom_title) . '</h3>';
									}
									if ($groom_content) {
										echo '<p>' . $groom_content . '</p>';
									}
									?>
									<div class="social">
										<ul>
											<?php 	// Group Param Output
											if (is_array($groom_socialItems_groups) && !empty($groom_socialItems_groups)) {
												foreach ($groom_socialItems_groups as $each_item) {

													$social_link = !empty($each_item['groom_social_link']) ? $each_item['groom_social_link'] : '';

													$groom_icon = !empty($each_item['groom_social_icon']['value']) ? $each_item['groom_social_icon']['value'] : '';
													$groom_svg_url = !empty($each_item['groom_social_icon']['value']['url']) ? $each_item['groom_social_icon']['value']['url'] : '';
													$svg_alt = get_post_meta($groom_svg_url, '_wp_attachment_image_alt', true);

											?>
													<li>
														<a href="<?php echo esc_url($social_link); ?>">
															<?php
															if ($groom_svg_url) {
																echo '<img src="' . esc_url($groom_svg_url) . '" alt="' . esc_url($svg_alt) . '">';
															} else {
																echo '<i class="' . esc_attr($groom_icon) . '"></i>';
															} ?>
														</a>
													</li>
											<?php }
											} ?>
										</ul>
									</div>
								</div>
								<div class="middle-couple-pic">
									<?php if ($couple_url) {
										echo '<img src="' . esc_url($couple_url) . '" alt="' . esc_attr($couple_alt) . '">';
									}  ?>
								</div>
								<div class="text-grid groom">
									<?php if ($bride_url) : ?>
										<div class="couple-img">
											<img src="<?php echo esc_url($bride_url); ?>" alt="<?php echo esc_attr($bride_alt); ?>">
										</div>
									<?php endif;
									if ($bride_title) {
										echo '<h3>' . esc_html($bride_title) . '</h3>';
									}
									if ($bride_content) {
										echo '<p>' . $bride_content . '</p>';
									}
									?>
									<div class="social">
										<ul>
											<?php  	// Group Param Output
											if (is_array($bride_socialItems_groups) && !empty($bride_socialItems_groups)) {
												foreach ($bride_socialItems_groups as $each_item) {

													$social_link = !empty($each_item['bride_social_link']) ? $each_item['bride_social_link'] : '';

													$bride_icon = !empty($each_item['bride_social_icon']['value']) ? $each_item['bride_social_icon']['value'] : '';
													$bride_svg_url = !empty($each_item['bride_social_icon']['value']['url']) ? $each_item['bride_social_icon']['value']['url'] : '';
													$svg_alt = get_post_meta($bride_svg_url, '_wp_attachment_image_alt', true);

											?>
													<li>
														<a href="<?php echo esc_url($social_link); ?>">
															<?php
															if ($bride_svg_url) {
																echo '<img src="' . esc_url($bride_svg_url) . '" alt="' . esc_url($svg_alt) . '">';
															} else {
																echo '<i class="' . esc_attr($bride_icon) . '"></i>';
															} ?>
														</a>
													</li>
											<?php }
											} ?>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="flower-shape-1">
					<?php if ($left_url) {
						echo '<img src="' . esc_url($left_url) . '" alt="' . esc_attr($left_alt) . '">';
					}  ?>
				</div>
				<div class="flower-shape-2">
					<?php if ($right_url) {
						echo '<img src="' . esc_url($right_url) . '" alt="' . esc_attr($right_alt) . '">';
					}  ?>
				</div>
			</div>
		<?php } else { ?>
			<div class="couple-section">
				<div class="container">
					<div class="row align-items-center">
						<div class="col col-xs-12">
							<div class="couple-area clearfix">
								<div class="text-grid bride">
									<?php if ($groom_url) : ?>
										<div class="couple-img">
											<img src="<?php echo esc_url($groom_url); ?>" alt="<?php echo esc_attr($groom_alt); ?>">
										</div>
									<?php endif;
									if ($groom_title) {
										echo '<h3>' . esc_html($groom_title) . '</h3>';
									}
									if ($groom_content) {
										echo '<p>' . $groom_content . '</p>';
									}
									?>
									<div class="social">
										<ul>
											<?php 	// Group Param Output
											if (is_array($groom_socialItems_groups) && !empty($groom_socialItems_groups)) {
												foreach ($groom_socialItems_groups as $each_item) {

													$social_link = !empty($each_item['groom_social_link']) ? $each_item['groom_social_link'] : '';

													$groom_icon = !empty($each_item['groom_social_icon']['value']) ? $each_item['groom_social_icon']['value'] : '';
													$groom_svg_url = !empty($each_item['groom_social_icon']['value']['url']) ? $each_item['groom_social_icon']['value']['url'] : '';
													$svg_alt = get_post_meta($groom_svg_url, '_wp_attachment_image_alt', true);

											?>
													<li>
														<a href="<?php echo esc_url($social_link); ?>">
															<?php
															if ($groom_svg_url) {
																echo '<img src="' . esc_url($groom_svg_url) . '" alt="' . esc_url($svg_alt) . '">';
															} else {
																echo '<i class="' . esc_attr($groom_icon) . '"></i>';
															} ?>
														</a>
													</li>
											<?php }
											} ?>
										</ul>
									</div>
								</div>
								<div class="middle-couple-pic">
									<?php if ($couple_url) {
										echo '<img src="' . esc_url($couple_url) . '" alt="' . esc_attr($couple_alt) . '">';
									}  ?>
									<div class="frame-img">
										<?php if ($fram_url) {
											echo '<img src="' . esc_url($fram_url) . '" alt="' . esc_attr($fram_alt) . '">';
										}  ?>
									</div>
								</div>
								<div class="text-grid groom">
									<?php if ($bride_url) : ?>
										<div class="couple-img">
											<img src="<?php echo esc_url($bride_url); ?>" alt="<?php echo esc_attr($bride_alt); ?>">
										</div>
									<?php endif;
									if ($bride_title) {
										echo '<h3>' . esc_html($bride_title) . '</h3>';
									}
									if ($bride_content) {
										echo '<p>' . $bride_content . '</p>';
									}
									?>
									<div class="social">
										<ul>
											<?php  	// Group Param Output
											if (is_array($bride_socialItems_groups) && !empty($bride_socialItems_groups)) {
												foreach ($bride_socialItems_groups as $each_item) {

													$social_link = !empty($each_item['bride_social_link']) ? $each_item['bride_social_link'] : '';

													$bride_icon = !empty($each_item['bride_social_icon']['value']) ? $each_item['bride_social_icon']['value'] : '';
													$bride_svg_url = !empty($each_item['bride_social_icon']['value']['url']) ? $each_item['bride_social_icon']['value']['url'] : '';
													$svg_alt = get_post_meta($bride_svg_url, '_wp_attachment_image_alt', true);

											?>
													<li>
														<a href="<?php echo esc_url($social_link); ?>">
															<?php
															if ($bride_svg_url) {
																echo '<img src="' . esc_url($bride_svg_url) . '" alt="' . esc_url($svg_alt) . '">';
															} else {
																echo '<i class="' . esc_attr($bride_icon) . '"></i>';
															} ?>
														</a>
													</li>
											<?php }
											} ?>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div> <!-- end container -->
			</div>
<?php }
		// Return outbut buffer
		echo ob_get_clean();
	}
	/**
	 * Render Couple widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 */

	//protected function _content_template(){}

}
Plugin::instance()->widgets_manager->register_widget_type(new Loveme_Couple_Hero());
