<?php
/*
 * Elementor Loveme Funfact Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Loveme_Funfact extends Widget_Base
{

	/**
	 * Retrieve the widget name.
	 */
	public function get_name()
	{
		return 'wpo-loveme_funfact';
	}

	/**
	 * Retrieve the widget title.
	 */
	public function get_title()
	{
		return esc_html__('Funfact', 'loveme-core');
	}

	/**
	 * Retrieve the widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-counter';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 */
	public function get_categories()
	{
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Loveme Funfact widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	 */
	public function get_script_depends()
	{
		return ['wpo-loveme_funfact'];
	}

	/**
	 * Register Loveme Funfact widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 */
	protected function register_controls()
	{

		$this->start_controls_section(
			'section_funfact',
			[
				'label' => esc_html__('Funfact Options', 'loveme-core'),
			]
		);
		$this->add_control(
			'funfact_style',
			[
				'label' => esc_html__('funfact Style', 'loveme-core'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'style-one' => esc_html__('Style One', 'loveme-core'),
					'style-two' => esc_html__('Style Two', 'loveme-core'),
				],
				'default' => 'style-one',
				'description' => esc_html__('Select your funfact style.', 'loveme-core'),
			]
		);
		$this->add_control(
			'funfact_shape',
			[
				'label' => esc_html__('Funfact Shape', 'loveme-core'),
				'type' => Controls_Manager::MEDIA,
				'condition' => [
					'funfact_style' => array('style-one'),
				],
				'frontend_available' => true,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'description' => esc_html__('Set your image.', 'loveme-core'),
			]
		);
		$this->add_control(
			'funfact_shape2',
			[
				'label' => esc_html__('Funfact Shape 2', 'loveme-core'),
				'type' => Controls_Manager::MEDIA,
				'condition' => [
					'funfact_style' => array('style-one'),
				],
				'frontend_available' => true,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'description' => esc_html__('Set your image.', 'loveme-core'),
			]
		);
		$repeater = new Repeater();
		$repeater->add_control(
			'funfact_title',
			[
				'label' => esc_html__('Title Text', 'loveme-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Title Text', 'loveme-core'),
				'placeholder' => esc_html__('Type title text here', 'loveme-core'),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'funfact_number',
			[
				'label' => esc_html__('Funfact Number', 'loveme-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('250', 'loveme-core'),
				'placeholder' => esc_html__('Type funfact Number here', 'loveme-core'),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'funfact_plus',
			[
				'label' => esc_html__('Funfact Plus/Percentage', 'loveme-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('+', 'loveme-core'),
				'placeholder' => esc_html__('Type funfact Plus/Percentage here', 'loveme-core'),
				'label_block' => true,
			]
		);
		$this->add_control(
			'funfactItems_groups',
			[
				'label' => esc_html__('Funfact Items', 'loveme-core'),
				'type' => Controls_Manager::REPEATER,
				'default' => [
					[
						'funfact_title' => esc_html__('Funfact', 'loveme-core'),
					],

				],
				'fields' =>  $repeater->get_controls(),
				'title_field' => '{{{ funfact_title }}}',
			]
		);
		$this->end_controls_section(); // end: Section


		// Funfact Number
		$this->start_controls_section(
			'funfact_number_style',
			[
				'label' => esc_html__('Number', 'loveme-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'loveme-core'),
				'name' => 'loveme_number_typography',
				'selector' => '{{WRAPPER}} .wpo-fun-fact-section .grid h3, .wpo-fun-fact-section-s2 .grid h3',
			]
		);
		$this->add_control(
			'funfact_item_number_color',
			[
				'label' => esc_html__('Number Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-fun-fact-section .grid h3, .wpo-fun-fact-section-s2 .grid h3' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'funfact_item_br_color',
			[
				'label' => esc_html__('Border Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-fun-fact-section .wpo-fun-fact-grids, .wpo-fun-fact-section-s2 .wpo-fun-fact-grids' => ' border-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'funfact_item_line_color',
			[
				'label' => esc_html__('Line Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-fun-fact-section-s2 .wpo-fun-fact-grids .grid:before' => ' background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'number_padding',
			[
				'label' => __('Number Padding', 'loveme-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .wpo-fun-fact-section .wpo-fun-fact-grids, .wpo-fun-fact-section-s2 .wpo-fun-fact-grids' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Funfact Title
		$this->start_controls_section(
			'funfact_title_style',
			[
				'label' => esc_html__('Funfact Title', 'loveme-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'loveme-core'),
				'name' => 'ntrsvt_funfact_title_typography',
				'selector' => '{{WRAPPER}} .wpo-fun-fact-section .grid h3 + p, .wpo-fun-fact-section-s2 .grid h3 + p',
			]
		);
		$this->add_control(
			'funfact_title',
			[
				'label' => esc_html__('Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-fun-fact-section .grid h3 + p, .wpo-fun-fact-section-s2 .grid h3 + p' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'funfact_title_padding',
			[
				'label' => __('Number Padding', 'loveme-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .wpo-fun-fact-section .grid h3 + p, .wpo-fun-fact-section-s2 .grid h3 + p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section


	}

	/**
	 * Render Funfact widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$funfactItems_groups = !empty($settings['funfactItems_groups']) ? $settings['funfactItems_groups'] : [];
		$funfact_style = !empty($settings['funfact_style']) ? $settings['funfact_style'] : '';
		$bg_image = !empty($settings['funfact_shape']['id']) ? $settings['funfact_shape']['id'] : '';
		$bg_image2 = !empty($settings['funfact_shape2']['id']) ? $settings['funfact_shape2']['id'] : '';

		// Image
		$image_url = wp_get_attachment_url($bg_image);
		$image_alt = get_post_meta($bg_image, '_wp_attachment_image_alt', true);

		// Image
		$image2_url = wp_get_attachment_url($bg_image2);
		$image2_alt = get_post_meta($bg_image2, '_wp_attachment_image_alt', true);

		if ($funfact_style == 'style-one') {
			$funfact_class = 'wpo-fun-fact-section';
		} else {
			$funfact_class = 'wpo-fun-fact-section-s2';
		}

		// Turn output buffer on
		ob_start(); ?>
		<div class="<?php echo esc_attr($funfact_class); ?>">
			<div class="container">
				<div class="row">
					<div class="col col-xs-12">
						<div class="wpo-fun-fact-grids clearfix">
							<?php 	// Group Param Output
							if (is_array($funfactItems_groups) && !empty($funfactItems_groups)) {
								foreach ($funfactItems_groups as $each_item) {
									$funfact_title = !empty($each_item['funfact_title']) ? $each_item['funfact_title'] : '';
									$funfact_number = !empty($each_item['funfact_number']) ? $each_item['funfact_number'] : '';
									$funfact_plus = !empty($each_item['funfact_plus']) ? $each_item['funfact_plus'] : '';
							?>
									<div class="grid">
										<div class="info">
											<?php
											if ($funfact_number) {
												echo '<h3><span class="odometer" data-count="' . esc_attr($funfact_number) . '">' . esc_html__('00', 'loveme-core') . '</span>' . esc_html($funfact_plus) . '</h3>';
											}
											if ($funfact_title) {
												echo '<p>' . esc_html__($funfact_title) . '</p>';
											}
											?>
										</div>
									</div>
							<?php }
							} ?>
						</div>
					</div>
				</div>
				<?php if ($funfact_style == 'style-one') { ?>
					<div class="f-shape-1">
						<?php if ($image_url) {
							echo '<div class="wpo-about-img"><img src="' . esc_url($image_url) . '" alt="' . esc_attr($image_alt) . '"></div>';
						} ?>
					</div>
					<div class="f-shape-2">
						<?php if ($image2_url) {
							echo '<div class="wpo-about-img"><img src="' . esc_url($image2_url) . '" alt="' . esc_attr($image2_alt) . '"></div>';
						} ?>
					</div>
				<?php } ?>
			</div>
		</div>
<?php
		// Return outbut buffer
		echo ob_get_clean();
	}
	/**
	 * Render Funfact widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 */

	//protected function _content_template(){}

}
Plugin::instance()->widgets_manager->register_widget_type(new Loveme_Funfact());
