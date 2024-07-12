<?php
/*
 * Elementor Loveme ServiceItem Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Loveme_ServiceItem extends Widget_Base
{

	/**
	 * Retrieve the widget name.
	 */
	public function get_name()
	{
		return 'wpo-loveme_serviceitem';
	}

	/**
	 * Retrieve the widget title.
	 */
	public function get_title()
	{
		return esc_html__('Service Item', 'loveme-core');
	}

	/**
	 * Retrieve the widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-checkbox';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 */
	public function get_categories()
	{
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Loveme ServiceItem widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	 */
	/*
	public function get_script_depends() {
		return ['wpo-loveme_serviceitem'];
	}
	*/

	/**
	 * Register Loveme ServiceItem widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 */
	protected function register_controls()
	{

		$this->start_controls_section(
			'section_ServiceItem',
			[
				'label' => esc_html__('ServiceItem Options', 'loveme-core'),
			]
		);
		$repeater = new Repeater();
		$repeater->add_control(
			'single_feature_icon',
			[
				'label' => __('Icon', 'loveme-core'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fi flaticon-dove',
					'library' => 'solid',
				],
			]
		);
		$repeater->add_control(
			'single_feature_title',
			[
				'label' => esc_html__('Title Text', 'loveme-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Title Text', 'loveme-core'),
				'placeholder' => esc_html__('Type title text here', 'loveme-core'),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'single_feature_content',
			[
				'label' => esc_html__('Content', 'loveme-core'),
				'default' => esc_html__('your content text', 'loveme-core'),
				'placeholder' => esc_html__('Type your content here', 'loveme-core'),
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,
			]
		);

		$this->add_control(
			'single_featureItems_groups',
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

		// Icons
		$this->start_controls_section(
			'single_section_icon_style',
			[
				'label' => esc_html__('Icon', 'loveme-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'single_service_icon_color',
			[
				'label' => esc_html__('Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-p-details-section .process-wrap .process-item .process-icon .fi:before' => 'color: {{VALUE}};',
				],
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
				'selector' => '{{WRAPPER}} .wpo-p-details-section .process-wrap .process-item h3',
			]
		);
		$this->add_control(
			'single_service_title_color',
			[
				'label' => esc_html__('Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-p-details-section .process-wrap .process-item h3' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'single_service_title_padding',
			[
				'label' => __('Title Padding', 'loveme-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .wpo-p-details-section .process-wrap .process-item h3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .wpo-p-details-section .process-wrap .process-item p',
			]
		);
		$this->add_control(
			'single_service_content_color',
			[
				'label' => esc_html__('Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-p-details-section .process-wrap .process-item p' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'single_service_content_padding',
			[
				'label' => __('Title Padding', 'loveme-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .wpo-p-details-section .process-wrap .process-item p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

	}

	/**
	 * Render ServiceItem widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$single_featureItems_groups = !empty($settings['single_featureItems_groups']) ? $settings['single_featureItems_groups'] : [];

		// Turn output buffer on
		ob_start(); ?>
		<div class="wpo-p-details-section">
			<div class="process-wrap">
				<div class="row">
					<?php
					// Group Param Output
					if (is_array($single_featureItems_groups) && !empty($single_featureItems_groups)) {
						foreach ($single_featureItems_groups as $each_item) {

							$single_feature_title = !empty($each_item['single_feature_title']) ? $each_item['single_feature_title'] : '';
							$single_feature_content = !empty($each_item['single_feature_content']) ? $each_item['single_feature_content'] : '';
							$single_feature_icon = !empty($each_item['single_feature_icon']['value']) ? $each_item['single_feature_icon']['value'] : '';
							$feature_svg_url = !empty($each_item['single_feature_icon']['value']['url']) ? $each_item['single_feature_icon']['value']['url'] : '';
							$svg_alt = get_post_meta($feature_svg_url, '_wp_attachment_image_alt', true);
					?>
							<div class="col-lg-4 col-md-6 col-12">
								<div class="process-item">
									<div class="process-icon">
										<?php
										if ($feature_svg_url) {
											echo '<img src="' . esc_url($feature_svg_url) . '" alt="' . esc_url($svg_alt) . '">';
										} else {
											echo '<i class="' . esc_attr($single_feature_icon) . '"></i>';
										} ?>
									</div>
									<div class="process-text">
										<?php
										if ($single_feature_title) {
											echo '<h3>' . esc_html($single_feature_title) . '</h3>';
										}
										if ($single_feature_content) {
											echo '<p>' . esc_html($single_feature_content) . '<p>';
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
<?php
		// Return outbut buffer
		echo ob_get_clean();
	}
	/**
	 * Render ServiceItem widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 */

	//protected function _content_template(){}

}
Plugin::instance()->widgets_manager->register_widget_type(new Loveme_ServiceItem());
