<?php
/*
 * Elementor Loveme Team Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Loveme_Team extends Widget_Base
{

	/**
	 * Retrieve the widget name.
	 */
	public function get_name()
	{
		return 'wpo-loveme_wedding_team';
	}

	/**
	 * Retrieve the widget title.
	 */
	public function get_title()
	{
		return esc_html__('Team', 'loveme-core');
	}

	/**
	 * Retrieve the widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-lock-user';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 */
	public function get_categories()
	{
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Loveme Team widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	 */
	public function get_script_depends()
	{
		return ['wpo-loveme_wedding_team'];
	}

	/**
	 * Register Loveme Team widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 */
	protected function register_controls()
	{

		$this->start_controls_section(
			'section_wedding_team',
			[
				'label' => esc_html__('Team Options', 'loveme-core'),
			]
		);
		$repeater = new Repeater();
		$repeater->add_control(
			'team_title',
			[
				'label' => esc_html__('Title Text', 'loveme-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Title Text', 'loveme-core'),
				'placeholder' => esc_html__('Type title text here', 'loveme-core'),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'team_subtitle',
			[
				'label' => esc_html__('Sub Title Text', 'loveme-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Sub Title Text', 'loveme-core'),
				'placeholder' => esc_html__('Type sub title text here', 'loveme-core'),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'bg_image',
			[
				'label' => esc_html__('Team Image', 'loveme-core'),
				'type' => Controls_Manager::MEDIA,
				'frontend_available' => true,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'description' => esc_html__('Set your image.', 'loveme-core'),
			]
		);
		$repeater->add_control(
			'facebook_icon',
			[
				'label' => esc_html__('Facebook', 'loveme-core'),
				'type' => Controls_Manager::ICON,
				'options' => Controls_Helper_Output::get_include_icons(),
				'frontend_available' => true,
				'default' => 'ti-facebook',
			]
		);
		$repeater->add_control(
			'facebook_link',
			[
				'label' => esc_html__('Facebook Link', 'loveme-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('#', 'loveme-core'),
				'placeholder' => esc_html__('Type facebook link here', 'loveme-core'),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'twitter_icon',
			[
				'label' => esc_html__('Twitter', 'loveme-core'),
				'type' => Controls_Manager::ICON,
				'options' => Controls_Helper_Output::get_include_icons(),
				'frontend_available' => true,
				'default' => 'ti-twitter-alt',
			]
		);
		$repeater->add_control(
			'twitter_link',
			[
				'label' => esc_html__('Twitter Link', 'loveme-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('#', 'loveme-core'),
				'placeholder' => esc_html__('Type twitter link here', 'loveme-core'),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'linkedin_icon',
			[
				'label' => esc_html__('Linkedin', 'tmexco-core'),
				'type' => Controls_Manager::ICON,
				'options' => Controls_Helper_Output::get_include_icons(),
				'frontend_available' => true,
				'default' => 'ti-linkedin',
			]
		);
		$repeater->add_control(
			'linkedin_link',
			[
				'label' => esc_html__('Linkedin Link', 'tmexco-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Linkedin Link', 'tmexco-core'),
				'placeholder' => esc_html__('Type linkedin link here', 'tmexco-core'),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'pinterest_icon',
			[
				'label' => esc_html__('Pinterest', 'loveme-core'),
				'type' => Controls_Manager::ICON,
				'options' => Controls_Helper_Output::get_include_icons(),
				'frontend_available' => true,
				'default' => 'ti-pinterest',
			]
		);
		$repeater->add_control(
			'pinterest_link',
			[
				'label' => esc_html__('Pinterest Link', 'loveme-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('#', 'loveme-core'),
				'placeholder' => esc_html__('Type pinterest link here', 'loveme-core'),
				'label_block' => true,
			]
		);
		$this->add_control(
			'teamItems_groups',
			[
				'label' => esc_html__('Team Items', 'loveme-core'),
				'type' => Controls_Manager::REPEATER,
				'default' => [
					[
						'team_title' => esc_html__('Team', 'loveme-core'),
					],

				],
				'fields' =>  $repeater->get_controls(),
				'title_field' => '{{{ team_title }}}',
			]
		);

		$this->end_controls_section(); // end: Section


		// Title
		$this->start_controls_section(
			'section_wedding_team_style',
			[
				'label' => esc_html__('Item', 'loveme-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'team_bg_color',
			[
				'label' => esc_html__('BG Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .loveme-member .team-info' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'team_br_color',
			[
				'label' => esc_html__('Border Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .loveme-member .team-info:before' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'team_hover_br_color',
			[
				'label' => esc_html__('Hover Border Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .loveme-member:hover .team-info:before' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'team_hover_bg_color',
			[
				'label' => esc_html__('Hover BG Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .loveme-member:hover .team-info' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'team_hover_text_color',
			[
				'label' => esc_html__('Hover Text Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .loveme-member:hover .team-info p, .loveme-member:hover .team-info h4' => 'color: {{VALUE}};',
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
				'selector' => '{{WRAPPER}} .loveme-member .team-info h4',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .loveme-member .team-info h4' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .loveme-member .team-info h4' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Sub Title
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
				'name' => 'loveme_subtitle_typography',
				'selector' => '{{WRAPPER}} .loveme-member .team-info p',
			]
		);
		$this->add_control(
			'subtitle_color',
			[
				'label' => esc_html__('Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .loveme-member .team-info p' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'subtitle_padding',
			[
				'label' => __('Title Padding', 'loveme-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .loveme-member .team-info p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section



	}

	/**
	 * Render Team widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$teamItems_groups = !empty($settings['teamItems_groups']) ? $settings['teamItems_groups'] : [];

		// Turn output buffer on
		ob_start();
?>
		<div class="wpo-team-section ">
			<div class="container">
				<div class="wpo-team-wrap">
					<div class="row">
						<?php 	// Group Param Output
						if (is_array($teamItems_groups) && !empty($teamItems_groups)) {
							foreach ($teamItems_groups as $each_items) {

								$team_title = !empty($each_items['team_title']) ? $each_items['team_title'] : '';
								$team_subtitle = !empty($each_items['team_subtitle']) ? $each_items['team_subtitle'] : '';
								$bg_image = !empty($each_items['bg_image']['id']) ? $each_items['bg_image']['id'] : '';
								$image_url = wp_get_attachment_url($each_items['bg_image']['id']);
								$image_alt = get_post_meta($each_items['bg_image']['id'], '_wp_attachment_image_alt', true);

								$facebook_icon = !empty($each_items['facebook_icon']) ? $each_items['facebook_icon'] : '';
								$facebook_link = !empty($each_items['facebook_link']) ? $each_items['facebook_link'] : '';

								$twitter_icon = !empty($each_items['twitter_icon']) ? $each_items['twitter_icon'] : '';
								$twitter_link = !empty($each_items['twitter_link']) ? $each_items['twitter_link'] : '';

								$linkedin_icon = !empty($each_items['linkedin_icon']) ? $each_items['linkedin_icon'] : '';
								$linkedin_link = !empty($each_items['linkedin_link']) ? $each_items['linkedin_link'] : '';

								$pinterest_icon = !empty($each_items['pinterest_icon']) ? $each_items['pinterest_icon'] : '';
								$pinterest_link = !empty($each_items['pinterest_link']) ? $each_items['pinterest_link'] : '';
						?>
								<div class="col-lg-3 col-md-4 col-sm-6 col-12">
									<div class="wpo-team-item">
										<div class="wpo-team-img">
											<?php if ($image_url) {
												echo '<img class="img-responlsive" src="' . esc_url($image_url) . '" alt="' . esc_attr($image_alt) . '">';
											} ?>
										</div>
										<div class="wpo-team-text">
											<?php
											if ($team_title) {
												echo '<h3>' . esc_html($team_title) . '</h3>';
											}
											if ($team_subtitle) {
												echo '<span>' . esc_html($team_subtitle) . '</span>';
											}
											?>
											<ul>
												<?php
												if ($facebook_icon) {
													echo '<li><a href="' . esc_url($facebook_link) . '"><i class="' . esc_attr($facebook_icon) . '"></i></a></li>';
												}
												if ($twitter_icon) {
													echo '<li><a href="' . esc_url($twitter_link) . '"><i class="' . esc_attr($twitter_icon) . '"></i></a></li>';
												}
												if ($linkedin_icon) {
													echo '<li><a href="' . esc_url($linkedin_link) . '"><i class="' . esc_attr($linkedin_icon) . '"></i></a></li>';
												}
												if ($pinterest_icon) {
													echo '<li><a href="' . esc_url($pinterest_link) . '"><i class="' . esc_attr($pinterest_icon) . '"></i></a></li>';
												}
												?>
											</ul>
										</div>
									</div>
								</div>
								<!--/col-->
						<?php }
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
	 * Render Team widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 */

	//protected function _content_template(){}

}
Plugin::instance()->widgets_manager->register_widget_type(new Loveme_Team());
