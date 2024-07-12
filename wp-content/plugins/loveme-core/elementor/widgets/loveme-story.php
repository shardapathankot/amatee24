<?php
/*
 * Elementor Loveme Story Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Loveme_Story extends Widget_Base
{

	/**
	 * Retrieve the widget name.
	 */
	public function get_name()
	{
		return 'tmx-loveme_story';
	}

	/**
	 * Retrieve the widget title.
	 */
	public function get_title()
	{
		return esc_html__('Story', 'loveme-core');
	}

	/**
	 * Retrieve the widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-time-line';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 */
	public function get_categories()
	{
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Loveme Story widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	 */
	public function get_script_depends()
	{
		return ['tmx-loveme_story'];
	}

	/**
	 * Register Loveme Story widget controls.
	 * Adds different input fields to allow the user to change and customize the widget each_item.
	 */
	protected function register_controls()
	{

		$this->start_controls_section(
			'story_section',
			[
				'label' => esc_html__('Story Options', 'loveme-core'),
			]
		);
		$this->add_control(
			'story_bottom_icon',
			[
				'label' => __('Bottom Icon', 'loveme-core'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'flaticon-heart',
					'library' => 'solid',
				],
			]
		);
		$repeater = new Repeater();
		$repeater->add_control(
			'story_title',
			[
				'label' => esc_html__('Title Text', 'loveme-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Our First Meet', 'loveme-core'),
				'placeholder' => esc_html__('Type title text here', 'loveme-core'),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'story_date',
			[
				'label' => esc_html__('Story Date', 'loveme-core'),
				'type' => Controls_Manager::DATE_TIME,
				'default' => esc_html__('Story Date', 'loveme-core'),
				'placeholder' => esc_html__('Story Date here', 'loveme-core'),
				'label_block' => true,
				'picker_options' => [
					'enableTime' => false,
					'dateFormat' => 'M/d/Y'
				]
			]
		);
		$repeater->add_control(
			'story_content',
			[
				'label' => esc_html__('Content Text', 'loveme-core'),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__('Content Text', 'loveme-core'),
				'placeholder' => esc_html__('Type content text here', 'loveme-core'),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'story_icon',
			[
				'label' => __('Icon', 'loveme-core'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'flaticon-heart',
					'library' => 'solid',
				],
			]
		);
		$repeater->add_control(
			'story_image',
			[
				'label' => esc_html__('Story Image', 'edefy-core'),
				'type' => Controls_Manager::MEDIA,
				'frontend_available' => true,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'description' => esc_html__('Set Story image here.', 'edefy-core'),
			]
		);
		$repeater->add_control(
			'story_shape',
			[
				'label' => esc_html__('Story Shape', 'edefy-core'),
				'type' => Controls_Manager::MEDIA,
				'frontend_available' => true,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'description' => esc_html__('Set Story image here.', 'edefy-core'),
			]
		);
		$this->add_control(
			'story_items_groups',
			[
				'label' => esc_html__('Story Item', 'loveme-core'),
				'type' => Controls_Manager::REPEATER,
				'default' => [
					[
						'story_title' => esc_html__('Story', 'loveme-core'),
					],

				],
				'fields' =>  $repeater->get_controls(),
				'title_field' => '{{{ story_title }}}',
			]
		);
		$this->end_controls_section(); // end: Section


		// Story
		$this->start_controls_section(
			'section_story_style',
			[
				'label' => esc_html__('Story', 'loveme-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'story_round_color',
			[
				'label' => esc_html__('Rond Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .story-section .story-timeline .round-shape:before' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'story_round_br_color',
			[
				'label' => esc_html__('Rond Border Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .story-section .story-timeline .round-shape' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'story_icon_color',
			[
				'label' => esc_html__('Icon Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .story-section .story-timeline .text-holder span:before' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'story_icon_bg_color',
			[
				'label' => esc_html__('Icon BG Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .story-section .story-timeline .text-holder .heart' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'story_border_color',
			[
				'label' => esc_html__('Border Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .story-section .story-timeline .img-holder:before, .story-section .story-timeline .img-holder' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'story_line_color',
			[
				'label' => esc_html__('Line Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .story-section .story-timeline:after' => 'background-color: {{VALUE}};',
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
				'selector' => '{{WRAPPER}} .story-section .story-timeline h3',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .story-section .story-timeline h3' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .story-section .story-timeline h3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Date
		$this->start_controls_section(
			'section_date_style',
			[
				'label' => esc_html__('Date', 'loveme-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'loveme-core'),
				'name' => 'loveme_date_typography',
				'selector' => '{{WRAPPER}} .story-section .story-timeline .date',
			]
		);
		$this->add_control(
			'date_color',
			[
				'label' => esc_html__('Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .story-section .story-timeline .date' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'date_padding',
			[
				'label' => esc_html__('Title Padding', 'loveme-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .story-section .story-timeline .date' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section


		// Story Content
		$this->start_controls_section(
			'story_content_style',
			[
				'label' => esc_html__('Content', 'loveme-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'loveme-core'),
				'name' => 'loveme_story_content_typography',
				'selector' => '{{WRAPPER}} .story-section .story-timeline p',
			]
		);
		$this->add_control(
			'story_content',
			[
				'label' => esc_html__('Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .story-section .story-timeline p' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'story_content_padding',
			[
				'label' => esc_html__('Number Padding', 'loveme-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .story-section .story-timeline p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section



	}

	/**
	 * Render Story widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$story_items_groups = !empty($settings['story_items_groups']) ? $settings['story_items_groups'] : '';

		$story_bottom_icon = !empty($settings['story_bottom_icon']['value']) ? $settings['story_bottom_icon']['value'] : '';
		$story_bottom_svg_url = !empty($settings['story_bottom_icon']['value']['url']) ? $settings['story_bottom_icon']['value']['url'] : '';
		$svg_bottom_alt = get_post_meta($story_bottom_svg_url, '_wp_attachment_image_alt', true);

		ob_start();
?>
		<div class="story-section">
			<div class="container">
				<div class="row">
					<div class="col col-xs-12">
						<div class="story-timeline">
							<div class="round-shape"></div>
							<?php 	// Group Param Output
							$story_count = 0;
							if (is_array($story_items_groups) && !empty($story_items_groups)) {
								foreach ($story_items_groups as $each_item) {
									$story_count++;
									$story_title = !empty($each_item['story_title']) ? $each_item['story_title'] : '';
									$story_content = !empty($each_item['story_content']) ? $each_item['story_content'] : '';
									$story_date = !empty($each_item['story_date']) ? $each_item['story_date'] : '';

									$story_icon = !empty($each_item['story_icon']['value']) ? $each_item['story_icon']['value'] : '';
									$story_svg_url = !empty($each_item['story_icon']['value']['url']) ? $each_item['story_icon']['value']['url'] : '';
									$svg_alt = get_post_meta($story_svg_url, '_wp_attachment_image_alt', true);

									$bg_image = !empty($each_item['story_image']['id']) ? $each_item['story_image']['id'] : '';
									$story_image = !empty($each_item['story_shape']['id']) ? $each_item['story_shape']['id'] : '';
									$image_url = wp_get_attachment_url($bg_image);
									$image_alt = get_post_meta($bg_image, '_wp_attachment_image_alt', true);

									$story_url = wp_get_attachment_url($story_image);
									$story_alt = get_post_meta($story_image, '_wp_attachment_image_alt', true);

									if ($story_count % 2 === 0) {

							?>
										<div class="row">
											<div class="col col-lg-6 col-12">
												<div class="img-holder right-align-text left-site">
													<?php if ($image_url) {
														echo '<img class="img img-responsive" src="' . esc_url($image_url) . '" alt="' . esc_attr($image_alt) . '">';
													}  ?>
													<div class="story-shape-img">
														<?php if ($story_url) {
															echo '<img src="' . esc_url($story_url) . '" alt="' . esc_attr($story_alt) . '">';
														}  ?>
													</div>
												</div>
											</div>
											<div class="col col-lg-6 col-12 text-holder">
												<span class="heart">
													<?php if ($story_svg_url) {
														echo '<img src="' . esc_url($story_svg_url) . '" alt="' . esc_url($svg_alt) . '">';
													} else {
														echo '<span class="' . esc_attr($story_icon) . '"></span>';
													} ?>
												</span>
												<div class="story-text">
													<?php
													if ($story_title) {
														echo '<h3>' . esc_html($story_title) . '</h3>';
													}
													if ($story_date) {
														echo '<span class="date">' . esc_html($story_date) . '</span>';
													}
												// 	if ($story_content) {
												// 		echo '<p>' . esc_html($story_content) . '</p>';
												// 	}
												if ($story_content) {
                                                    echo wp_kses_post($story_content);
                                                }

													?>
												</div>
											</div>
										</div>
									<?php } else {

										if ($story_count == '3') {
											$extra_class = 'text-holder right-heart';
											$extra_margin = '';
										} elseif ($story_count == '1') {
											$extra_class = '';
											$extra_margin = 'story-text-margin';
										} else {
											$extra_class = '';
											$extra_margin = '';
										}

									?>
										<div class="row">
											<div class="col col-lg-6 col-12  order-lg-1 order-2 <?php esc_attr_e($extra_class) ?>">
												<?php if ($story_count == '3') { ?>
													<span class="heart">
														<?php if ($story_svg_url) {
															echo '<img src="' . esc_url($story_svg_url) . '" alt="' . esc_url($svg_alt) . '">';
														} else {
															echo '<span class="' . esc_attr($story_icon) . '"></span>';
														}
														?>
													</span>
												<?php } ?>
												<div class="story-text right-align-text <?php esc_attr_e($extra_margin); ?>">
													<?php
													if ($story_title) {
														echo '<h3>' . esc_html($story_title) . '</h3>';
													}
													if ($story_date) {
														echo '<span class="date">' . esc_html($story_date) . '</span>';
													}
													if ($story_content) {
														echo '<p>' . esc_html($story_content) . '</p>';
													}
													?>
												</div>
											</div>
											<div class="col col-lg-6 col-12 order-lg-2 order-1">
												<div class="img-holder">
													<?php if ($image_url) {
														echo '<img class="img img-responsive" src="' . esc_url($image_url) . '" alt="' . esc_attr($image_alt) . '">';
													}  ?>
													<div class="story-shape-img">
														<?php if ($story_url) {
															echo '<img src="' . esc_url($story_url) . '" alt="' . esc_attr($story_alt) . '">';
														}  ?>
													</div>
												</div>
											</div>
										</div>
							<?php }
								}
							} ?>
							<div class="row">
								<div class="col offset-lg-6 col-lg-6 col-12 text-holder">
									<span class="heart">
										<?php if ($story_bottom_svg_url) {
											echo '<img src="' . esc_url($story_bottom_svg_url) . '" alt="' . esc_url($svg_bottom_alt) . '">';
										} else {
											echo '<span class="' . esc_attr($story_bottom_icon) . '"></span>';
										} ?>
									</span>
								</div>
							</div>
						</div>
					</div>
				</div> <!-- end row -->
			</div> <!-- end container -->
		</div>
<?php
		// Return outbut buffer
		echo ob_get_clean();
	}
	/**
	 * Render Story widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 */

	//protected function _content_template(){}

}
Plugin::instance()->widgets_manager->register_widget_type(new Loveme_Story());
