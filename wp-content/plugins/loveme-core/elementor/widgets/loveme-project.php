<?php
/*
 * Elementor Loveme Project Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Loveme_Project extends Widget_Base
{

	/**
	 * Retrieve the widget name.
	 */
	public function get_name()
	{
		return 'wpo-loveme_project';
	}

	/**
	 * Retrieve the widget title.
	 */
	public function get_title()
	{
		return esc_html__('Project', 'loveme-core');
	}

	/**
	 * Retrieve the widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-posts-masonry';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 */
	public function get_categories()
	{
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Loveme Project widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	 */
	public function get_script_depends()
	{
		return ['wpo-loveme_project'];
	}

	/**
	 * Register Loveme Project widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 */
	protected function register_controls()
	{


		$posts = get_posts('post_type="project"&numberposts=-1');
		$PostID = array();
		if ($posts) {
			foreach ($posts as $post) {
				$PostID[$post->ID] = $post->ID;
			}
		} else {
			$PostID[__('No ID\'s found', 'loveme')] = 0;
		}


		$this->start_controls_section(
			'section_project_listing',
			[
				'label' => esc_html__('Project Options', 'loveme-core'),
			]
		);
		$this->add_control(
			'project_limit',
			[
				'label' => esc_html__('Project Limit', 'loveme-core'),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 100,
				'step' => 1,
				'default' => 3,
				'description' => esc_html__('Enter the number of items to show.', 'loveme-core'),
			]
		);
		$this->add_control(
			'project_order',
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
			'project_orderby',
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
			'project_show_category',
			[
				'label' => __('Certain Categories?', 'loveme-core'),
				'type' => Controls_Manager::SELECT2,
				'default' => [],
				'options' => Controls_Helper_Output::get_terms_names('project_category'),
				'multiple' => true,
			]
		);
		$this->add_control(
			'project_show_id',
			[
				'label' => __('Certain ID\'s?', 'loveme-core'),
				'type' => Controls_Manager::SELECT2,
				'default' => [],
				'options' => $PostID,
				'multiple' => true,
			]
		);
		$this->add_control(
			'project_more',
			[
				'label' => esc_html__('Plus', 'loveme-core'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'loveme-core'),
				'label_off' => esc_html__('Hide', 'loveme-core'),
				'return_value' => 'true',
				'default' => 'true',
			]
		);
		$this->end_controls_section(); // end: Section


		// Title
		$this->start_controls_section(
			'section_project_overly_style',
			[
				'label' => esc_html__('Overly', 'loveme-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'overly_color',
			[
				'label' => esc_html__('Overly Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-portfolio-section .grid .img-holder:before' => 'background-color: {{VALUE}};',
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
				'selector' => '{{WRAPPER}} .wpo-portfolio-section .grid .img-holder .hover-content h4 a',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-portfolio-section .grid .img-holder .hover-content h4 a' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .wpo-portfolio-section .grid .img-holder .hover-content h4 a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .wpo-portfolio-section .grid .img-holder .hover-content span',
			]
		);
		$this->add_control(
			'subtitle_color',
			[
				'label' => esc_html__('Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-portfolio-section .grid .img-holder .hover-content span' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

	}

	/**
	 * Render Project widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$project_limit = !empty($settings['project_limit']) ? $settings['project_limit'] : '';
		$project_order = !empty($settings['project_order']) ? $settings['project_order'] : '';
		$project_orderby = !empty($settings['project_orderby']) ? $settings['project_orderby'] : '';
		$project_show_category = !empty($settings['project_show_category']) ? $settings['project_show_category'] : [];
		$project_show_id = !empty($settings['project_show_id']) ? $settings['project_show_id'] : [];
		$project_more = !empty($settings['project_more']) ? $settings['project_more'] : [];

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

		if ($project_show_id) {
			$project_show_id = json_encode($project_show_id);
			$project_show_id = str_replace(array('[', ']'), '', $project_show_id);
			$project_show_id = str_replace(array('"', '"'), '', $project_show_id);
			$project_show_id = explode(',', $project_show_id);
		} else {
			$project_show_id = '';
		}

		$args = array(
			// other query params here,
			'paged' => $my_page,
			'post_type' => 'project',
			'posts_per_page' => (int)$project_limit,
			'category_name' => implode(',', $project_show_category),
			'orderby' => $project_orderby,
			'order' => $project_order,
			'post__in' => $project_show_id,
		);

		$loveme_project = new \WP_Query($args);
?>

		<div class="wpo-portfolio-section">
			<div class="container-fluid">
				<div class="sortable-gallery">
					<div class="gallery-filters"></div>
					<div class="portfolio-grids gallery-container clearfix">
						<?php
						if ($loveme_project->have_posts()) : while ($loveme_project->have_posts()) : $loveme_project->the_post();

								$project_options = get_post_meta(get_the_ID(), 'project_options', true);

								$project_title = isset($project_options['project_title']) ? $project_options['project_title'] : '';
								$project_subtitle = isset($project_options['project_subtitle']) ? $project_options['project_subtitle'] : '';
								$project_image = isset($project_options['project_image']) ? $project_options['project_image'] : '';

								global $post;
								$image_url = wp_get_attachment_url($project_image);
								$image_alt = get_post_meta($project_image, '_wp_attachment_image_alt', true);
						?>
								<div class="grid">
									<div class="img-holder">
										<?php if ($image_url) {
											echo '<img class="img img-responsive"  src="' . esc_url($image_url) . '" alt="' . esc_attr($image_alt) . '">';
										} ?>
										<div class="hover-content">
											<?php
											if ($project_title) {
												echo '<h4><a href="' . esc_url(get_permalink()) . '">' . esc_html($project_title) . '</a></h4>';
											}
											if ($project_subtitle) {
												echo '<span>' . esc_html($project_subtitle) . '</span>';
											}
											?>
										</div>
									</div>
								</div>
								<!--/item-->
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
	 * Render Project widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 */

	//protected function _content_template(){}

}
Plugin::instance()->widgets_manager->register_widget_type(new Loveme_Project());
