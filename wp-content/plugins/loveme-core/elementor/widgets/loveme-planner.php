<?php
/*
 * Elementor Loveme Team Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Loveme_TeamPlanner extends Widget_Base
{

	/**
	 * Retrieve the widget name.
	 */
	public function get_name()
	{
		return 'wpo-loveme_team';
	}

	/**
	 * Retrieve the widget title.
	 */
	public function get_title()
	{
		return esc_html__('Planner', 'loveme-core');
	}

	/**
	 * Retrieve the widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-person';
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
		return ['wpo-loveme_team'];
	}

	/**
	 * Register Loveme Team widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 */
	protected function register_controls()
	{


		$posts = get_posts('post_type="team"&numberposts=-1');
		$PostID = array();
		if ($posts) {
			foreach ($posts as $post) {
				$PostID[$post->ID] = $post->ID;
			}
		} else {
			$PostID[__('No ID\'s found', 'loveme')] = 0;
		}

		$this->start_controls_section(
			'section_team_listing',
			[
				'label' => esc_html__('Planner Options', 'loveme-core'),
			]
		);
		$this->add_control(
			'team_limit',
			[
				'label' => esc_html__('Planner Limit', 'loveme-core'),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 100,
				'step' => 1,
				'default' => 3,
				'description' => esc_html__('Enter the number of items to show.', 'loveme-core'),
			]
		);
		$this->add_control(
			'team_order',
			[
				'label' => __('Order', 'loveme-core'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'ASC' => esc_html__('Asending', 'loveme-core'),
					'DESC' => esc_html__('Desending', 'loveme-core'),
				],
				'default' => 'DESC',
			]
		);
		$this->add_control(
			'team_orderby',
			[
				'label' => __('Order By', 'loveme-core'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'none' => esc_html__('None', 'loveme-core'),
					'ID' => esc_html__('ID', 'loveme-core'),
					'author' => esc_html__('Author', 'loveme-core'),
					'title' => esc_html__('Title', 'loveme-core'),
					'date' => esc_html__('Date', 'loveme-core'),
				],
				'default' => 'date',
			]
		);
		$this->add_control(
			'team_show_category',
			[
				'label' => __('Certain Categories?', 'loveme-core'),
				'type' => Controls_Manager::SELECT2,
				'default' => [],
				'options' => Controls_Helper_Output::get_terms_names('team_category'),
				'multiple' => true,
			]
		);
		$this->add_control(
			'team_show_id',
			[
				'label' => __('Certain ID\'s?', 'loveme-core'),
				'type' => Controls_Manager::SELECT2,
				'default' => [],
				'options' => $PostID,
				'multiple' => true,
			]
		);
		$this->end_controls_section(); // end: Section


		// Subtitle
		$this->start_controls_section(
			'section_subtitle_style',
			[
				'label' => esc_html__('Subtitle', 'loveme-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'subtitle_color',
			[
				'label' => esc_html__('Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-team-section .wpo-team-wrap .wpo-team-item .wpo-team-text span' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'subtitle_padding',
			[
				'label' => esc_html__('Subtitle Padding', 'loveme-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .wpo-team-section .wpo-team-wrap .wpo-team-item .wpo-team-text span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .wpo-team-section .wpo-team-wrap .wpo-team-item .wpo-team-text h3',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-team-section .wpo-team-wrap .wpo-team-item .wpo-team-text h3 a' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .wpo-team-section .wpo-team-wrap .wpo-team-item .wpo-team-text h3 a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Icon
		$this->start_controls_section(
			'section_content_icon_style',
			[
				'label' => esc_html__('Icon', 'loveme-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'team_icon_color',
			[
				'label' => esc_html__('Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-team-section .wpo-team-wrap .wpo-team-item .wpo-team-text ul li a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'team_icon_bg_color',
			[
				'label' => esc_html__('Background Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-team-section .wpo-team-wrap .wpo-team-item .wpo-team-text ul li a' => 'background-color: {{VALUE}};',
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

		$team_limit = !empty($settings['team_limit']) ? $settings['team_limit'] : '';
		$team_order = !empty($settings['team_order']) ? $settings['team_order'] : '';
		$team_orderby = !empty($settings['team_orderby']) ? $settings['team_orderby'] : '';
		$team_show_category = !empty($settings['team_show_category']) ? $settings['team_show_category'] : [];
		$team_show_id = !empty($settings['team_show_id']) ? $settings['team_show_id'] : [];


		// Turn output buffer on
		ob_start();

		// Pagination
		global $paged;
		if (get_query_var('paged'))
			$my_page = get_query_var('paged');
		else {
			if (get_query_var('page'))
				$my_page = get_query_var('page');
			else
				$my_page = 1;
			set_query_var('paged', $my_page);
			$paged = $my_page;
		}

		if ($team_show_id) {
			$team_show_id = json_encode($team_show_id);
			$team_show_id = str_replace(array('[', ']'), '', $team_show_id);
			$team_show_id = str_replace(array('"', '"'), '', $team_show_id);
			$team_show_id = explode(',', $team_show_id);
		} else {
			$team_show_id = '';
		}

		$args = array(
			// other query params here,
			'paged' => $my_page,
			'post_type' => 'team',
			'posts_per_page' => (int)$team_limit,
			'category_name' => implode(',', $team_show_category),
			'orderby' => $team_orderby,
			'order' => $team_order,
			'post__in' => $team_show_id,
		);

		$loveme_team = new \WP_Query($args);

?>
		<div class="wpo-team-section">
			<div class="container">
				<div class="wpo-team-wrap">
					<div class="row">
						<?php
						if ($loveme_team->have_posts()) : while ($loveme_team->have_posts()) : $loveme_team->the_post();

								$team_options = get_post_meta(get_the_ID(), 'team_options', true);
								$team_title = isset($team_options['team_title']) ? $team_options['team_title'] : '';
								$team_subtitle = isset($team_options['team_subtitle']) ? $team_options['team_subtitle'] : '';
								$team_image = isset($team_options['team_image']) ? $team_options['team_image'] : '';
								$team_socials = isset($team_options['team_socials']) ? $team_options['team_socials'] : '';
								global $post;
								$image_url = wp_get_attachment_url($team_image);
								$image_alt = get_post_meta($team_image, '_wp_attachment_image_alt', true);
						?>
								<div class="col-lg-3 col-md-4 col-sm-6 col-12">
									<div class="wpo-team-item">
										<div class="wpo-team-img">
											<?php if ($image_url) {
												echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($image_alt) . '">';
											} ?>
										</div>
										<div class="wpo-team-text">
											<?php
											if ($team_title) {
												echo '<h3><a href="' . esc_url(get_permalink()) . '">' . esc_html($team_title) . '</a></h3>';
											}
											if ($team_subtitle) {
												echo '<span>' . esc_html($team_subtitle) . '</span>';
											}
											?>
											<ul>
												<?php foreach ($team_socials as $key => $team_social) {
													echo '<li class="on"><a href="' . esc_url($team_social['team_social_link']) . '"><i class="' . esc_attr($team_social['team_social_icon']) . '" ></i></a></li>';
												} ?>
											</ul>
										</div>
									</div>
								</div>
						<?php
							endwhile;
						endif;
						wp_reset_postdata();
						?>
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
Plugin::instance()->widgets_manager->register_widget_type(new Loveme_TeamPlanner());
