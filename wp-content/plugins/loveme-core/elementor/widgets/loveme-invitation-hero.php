<?php
/*
 * Elementor Loveme InvitationHero Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Loveme_InvitationHero extends Widget_Base
{

	/**
	 * Retrieve the widget name.
	 */
	public function get_name()
	{
		return 'wpo-loveme_invitationhero';
	}

	/**
	 * Retrieve the widget title.
	 */
	public function get_title()
	{
		return esc_html__('Invaitation Hero', 'loveme-core');
	}

	/**
	 * Retrieve the widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-post-content';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 */
	public function get_categories()
	{
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Loveme InvitationHero widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	 */
	public function get_script_depends()
	{
		return ['wpo-loveme_invitationhero'];
	}

	/**
	 * Register Loveme InvitationHero widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 */
	protected function register_controls()
	{

		$this->start_controls_section(
			'section_invitationhero',
			[
				'label' => esc_html__('Invitation Options', 'loveme-core'),
			]
		);
		$this->add_control(
			'invitation_shape',
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
			'invitation_title',
			[
				'label' => esc_html__('Title Text', 'loveme-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Sarah & Daniel', 'loveme-core'),
				'placeholder' => esc_html__('Sub Type title text here', 'loveme-core'),
				'label_block' => true,
			]
		);
		$this->add_control(
			'invitation_content',
			[
				'label' => esc_html__('Content', 'loveme-core'),
				'default' => esc_html__('We Are Getting Married Nov 22,2021', 'loveme-core'),
				'placeholder' => esc_html__('Type your content here', 'loveme-core'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
			]
		);
		$this->add_control(
			'invitation_time',
			[
				'label' => esc_html__('Invitation Time', 'loveme-core'),
				'default' => esc_html__('Invitation Time', 'loveme-core'),
				'placeholder' => esc_html__('Type your Invitation Time here', 'loveme-core'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
			]
		);
		$this->add_control(
			'invitation_address',
			[
				'label' => esc_html__('Invitation Address', 'loveme-core'),
				'default' => esc_html__('Invitation Address', 'loveme-core'),
				'placeholder' => esc_html__('Type your Invitation Address here', 'loveme-core'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
			]
		);
		$this->add_control(
			'invitation_number',
			[
				'label' => esc_html__('Invitation Number', 'loveme-core'),
				'default' => esc_html__('Phone : +12345678910', 'loveme-core'),
				'placeholder' => esc_html__('Type your Invitation Number here', 'loveme-core'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
			]
		);
		$this->add_control(
			'location_btn',
			[
				'label' => esc_html__('Location Button Text', 'loveme-core'),
				'default' => esc_html__('See Location', 'loveme-core'),
				'placeholder' => esc_html__('Type your Location Button text here', 'loveme-core'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
			]
		);
		$this->add_control(
			'location_map',
			[
				'label' => esc_html__('Location Map Embed', 'loveme-core'),
				'default' => esc_html__('https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d25211.21212385712!2d144.95275648773628!3d-37.82748510398018!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad642af0f11fd81%3A0x5045675218ce7e0!2zTWVsYm91cm5lIFZJQyAzMDA0LCDgpoXgprjgp43gpp_gp43gprDgp4fgprLgpr_gpq_gprzgpr4!5e0!3m2!1sbn!2sbd!4v1503742051881', 'loveme-core'),
				'placeholder' => esc_html__('Type your Location Map embed here', 'loveme-core'),
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,
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
				'selector' => '{{WRAPPER}} .static-hero-s3 .wpo-event-item .wpo-event-text h2',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .static-hero-s3 .wpo-event-item .wpo-event-text h2' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .static-hero-s3 .wpo-event-item .wpo-event-text h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .static-hero-s3 .wpo-event-item .wpo-event-text p, .static-hero-s3 .wpo-event-item .wpo-event-text ul li',
			]
		);
		$this->add_control(
			'content_color',
			[
				'label' => esc_html__('Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .static-hero-s3 .wpo-event-item .wpo-event-text p, .static-hero-s3 .wpo-event-item .wpo-event-text ul li' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .static-hero-s3 .wpo-event-item .wpo-event-text p, .static-hero-s3 .wpo-event-item .wpo-event-text ul li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
			]
		);
		$this->add_control(
			'button_color',
			[
				'label' => esc_html__('Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .static-hero-s3 .wpo-event-item .wpo-event-text ul li a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_line_color',
			[
				'label' => esc_html__('Line Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .static-hero-s3 .wpo-event-item .wpo-event-text ul li a:before' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_hover_color',
			[
				'label' => esc_html__('Hover Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .static-hero-s3 .wpo-event-item .wpo-event-text ul li a:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section


	}

	/**
	 * Render InvitationHero widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$bg_image = !empty($settings['invitation_shape']['id']) ? $settings['invitation_shape']['id'] : '';
		$invitation_title = !empty($settings['invitation_title']) ? $settings['invitation_title'] : '';
		$invitation_content = !empty($settings['invitation_content']) ? $settings['invitation_content'] : '';
		$invitation_time = !empty($settings['invitation_time']) ? $settings['invitation_time'] : '';
		$invitation_address = !empty($settings['invitation_address']) ? $settings['invitation_address'] : '';
		$invitation_number = !empty($settings['invitation_number']) ? $settings['invitation_number'] : '';
		$location_btn = !empty($settings['location_btn']) ? $settings['location_btn'] : '';
		$location_map = !empty($settings['location_map']) ? $settings['location_map'] : '';

		// Image
		$image_url = wp_get_attachment_url($bg_image);
		$image_alt = get_post_meta($bg_image, '_wp_attachment_image_alt', true);

		if ($image_url) {
			$bg_url = ' style="';
			$bg_url .= ($image_url) ? 'background-image: url( ' . esc_url($image_url) . ' );' : '';
			$bg_url .= '"';
		} else {
			$bg_url = '';
		}


		// Turn output buffer on
		ob_start(); ?>
		<div class="static-hero-s3">
			<div class="hero-container">
				<div class="hero-inner">
					<div class="container">
						<div class="row justify-content-center">
							<div class="col-lg-6">
								<div class="wpo-event-item" <?php echo $bg_url; ?>>
									<div class="wpo-event-text">
										<?php
										if ($invitation_title) {
											echo '<h2>' . esc_html($invitation_title) . '</h2>';
										}
										if ($invitation_content) {
											echo '<p>' . esc_html($invitation_content) . '</p>';
										}
										?>
										<ul>
											<?php
											if ($invitation_time) {
												echo '<li>' . esc_html($invitation_time) . '</li>';
											}
											if ($invitation_address) {
												echo '<li>' . esc_html($invitation_address) . '</li>';
											}
											if ($invitation_number) {
												echo '<li>' . esc_html($invitation_number) . '</li>';
											}
											if ($location_btn) { ?>
												<li>
													<a class="popup-gmaps" href="<?php echo esc_url($location_map); ?>">
														<?php echo esc_html($location_btn); ?>
													</a>
												</li>
											<?php } ?>
										</ul>
									</div>
								</div>
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
	 * Render InvitationHero widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 */

	//protected function _content_template(){}

}
Plugin::instance()->widgets_manager->register_widget_type(new Loveme_InvitationHero());
