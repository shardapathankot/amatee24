<?php
/*
 * Elementor Loveme Service Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Loveme_Service extends Widget_Base
{

	/**
	 * Retrieve the widget name.
	 */
	public function get_name()
	{
		return 'wpo-loveme_service';
	}

	/**
	 * Retrieve the widget title.
	 */
	public function get_title()
	{
		return esc_html__('Service', 'loveme-core');
	}

	/**
	 * Retrieve the widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-gallery-grid';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 */
	public function get_categories()
	{
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Loveme Service widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	 */
	public function get_script_depends()
	{
		return ['wpo-loveme_service'];
	}

	/**
	 * Register Loveme Service widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 */
	protected function register_controls()
	{


		$posts = get_posts('post_type="service"&numberposts=-1');
		$PostID = array();
		if ($posts) {
			foreach ($posts as $post) {
				$PostID[$post->ID] = $post->ID;
			}
		} else {
			$PostID[__('No ID\'s found', 'loveme')] = 0;
		}


		$this->start_controls_section(
			'section_service_listing',
			[
				'label' => esc_html__('Listing Options', 'loveme-core'),
			]
		);
		$this->add_control(
			'service_style',
			[
				'label' => esc_html__('Service Style', 'finco-core'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'style-one' => esc_html__('Style One', 'finco-core'),
					'style-two' => esc_html__('Style Two', 'finco-core'),
				],
				'default' => 'style-one',
				'description' => esc_html__('Select your service style.', 'finco-core'),
			]
		);
		$this->add_control(
			'service_limit',
			[
				'label' => esc_html__('Service Limit', 'loveme-core'),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 100,
				'step' => 1,
				'default' => 3,
				'description' => esc_html__('Enter the number of items to show.', 'loveme-core'),
			]
		);
		$this->add_control(
			'service_order',
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
			'service_orderby',
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
			'service_show_category',
			[
				'label' => __('Certain Categories?', 'loveme-core'),
				'type' => Controls_Manager::SELECT2,
				'default' => [],
				'options' => Controls_Helper_Output::get_terms_names('service_category'),
				'multiple' => true,
			]
		);
		$this->add_control(
			'service_show_id',
			[
				'label' => __('Certain ID\'s?', 'loveme-core'),
				'type' => Controls_Manager::SELECT2,
				'default' => [],
				'options' => $PostID,
				'multiple' => true,
			]
		);
		$this->end_controls_section(); // end: Section

		// Service Item
		$this->start_controls_section(
			'section_service_item_style',
			[
				'label' => esc_html__('Service Box ', 'loveme-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'service_box_bg_color',
			[
				'label' => esc_html__('Background Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .loveme-services .wpo-service-item' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'service_box_color',
			[
				'label' => esc_html__('Box Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .loveme-services .wpo-service-item .wpo-service-text' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Service Icon
		$this->start_controls_section(
			'section_service_icon_style',
			[
				'label' => esc_html__('Icon ', 'loveme-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'service_icon_color',
			[
				'label' => esc_html__('Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .loveme-services .wpo-service-item .wpo-service-text .s-icon i:before' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'service_icon_shape_color',
			[
				'label' => esc_html__('Line Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-service-section .wpo-service-item .wpo-service-img .wpo-service-text .s-icon:before, .wpo-service-section .wpo-service-item .wpo-service-img .wpo-service-text .s-icon:after, .wpo-service-section-s2 .wpo-service-wrap .wpo-service-item .wpo-service-text .s-icon:before,.wpo-service-section-s2 .wpo-service-wrap .wpo-service-item .wpo-service-text .s-icon:after' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Title
		$this->start_controls_section(
			'service_section_title_style',
			[
				'label' => esc_html__('Title', 'loveme-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'loveme-core'),
				'name' => 'service_loveme_title_typography',
				'selector' => '{{WRAPPER}} .loveme-services .wpo-service-item .wpo-service-text h3 a',
			]
		);
		$this->add_control(
			'service_section_title_color',
			[
				'label' => esc_html__('Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .loveme-services .wpo-service-item .wpo-service-text h3 a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'service_section_title_padding',
			[
				'label' => esc_html__('Title Padding', 'loveme-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .loveme-services .wpo-service-item .wpo-service-text h3 a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Content
		$this->start_controls_section(
			'service_section_content_style',
			[
				'label' => esc_html__('Content', 'loveme-core'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'service_style' => array('style-two'),
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'loveme-core'),
				'name' => 'service_section_content_typography',
				'selector' => '{{WRAPPER}} .loveme-services .wpo-service-item .wpo-service-text p',
			]
		);
		$this->add_control(
			'service_content_color',
			[
				'label' => esc_html__('Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .loveme-services .wpo-service-item .wpo-service-text p' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// dot
		$this->start_controls_section(
			'service_section_dot_style',
			[
				'label' => esc_html__('Arrow', 'loveme-core'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'service_style' => array('style-one'),
				],
			]
		);
		$this->add_control(
			'service_dot_color',
			[
				'label' => esc_html__('Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-service-section .owl-nav [class*=owl-] .fi::before' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section




	}

	/**
	 * Render Service widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$service_style = !empty($settings['service_style']) ? $settings['service_style'] : '';
		$service_limit = !empty($settings['service_limit']) ? $settings['service_limit'] : '';
		$service_order = !empty($settings['service_order']) ? $settings['service_order'] : '';
		$service_orderby = !empty($settings['service_orderby']) ? $settings['service_orderby'] : '';
		$service_show_category = !empty($settings['service_show_category']) ? $settings['service_show_category'] : [];
		$service_show_id = !empty($settings['service_show_id']) ? $settings['service_show_id'] : [];

		if ($service_style == 'style-two') {
			$service_wrapper = 'wpo-service-section-s2';
			$service_wrap = 'wpo-service-wrap';
		} else {
			$service_wrapper = 'wpo-service-section';
			$service_wrap = 'wpo-service-active owl-carousel';
		}

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

		if ($service_show_id) {
			$service_show_id = json_encode($service_show_id);
			$service_show_id = str_replace(array('[', ']'), '', $service_show_id);
			$service_show_id = str_replace(array('"', '"'), '', $service_show_id);
			$service_show_id = explode(',', $service_show_id);
		} else {
			$service_show_id = '';
		}

		$args = array(
			// other query params here,
			'paged' => $my_page,
			'post_type' => 'service',
			'posts_per_page' => (int)$service_limit,
			'category_name' => implode(',', $service_show_category),
			'orderby' => $service_orderby,
			'order' => $service_order,
			'post__in' => $service_show_id,
		);

		$loveme_service = new \WP_Query($args); ?>

		<div class="loveme-services <?php echo esc_attr($service_wrapper); ?>">
			<div class="container">
				<div class="<?php echo esc_attr($service_wrap); ?>">
					<?php
					if ($service_style == 'style-two') { ?>
						<div class="row">
							<?php }
						if ($loveme_service->have_posts()) : while ($loveme_service->have_posts()) : $loveme_service->the_post();

								$service_options = get_post_meta(get_the_ID(), 'service_options', true);
								$service_title = isset($service_options['service_title']) ? $service_options['service_title'] : '';
								$grid_image = isset($service_options['grid_image']) ? $service_options['grid_image'] : '';
								$flate_icon = isset($service_options['flate_icon']) ? $service_options['flate_icon'] : '';
								$service_excerpt = isset($service_options['service_excerpt']) ? $service_options['service_excerpt'] : '';
								global $post;
								// service
								$bg_url = wp_get_attachment_url($grid_image);
								$bg_alt = get_post_meta($grid_image, '_wp_attachment_image_alt', true);

								if ($service_style == 'style-one') { ?>
									<div class="wpo-service-item">
										<div class="wpo-service-img">
											<?php if ($bg_url) {
												echo '<img src="' . esc_url($bg_url) . '" alt="' . esc_attr($bg_alt) . '">';
											} ?>
											<div class="wpo-service-text">
												<div class="s-icon">
													<i class="fi <?php echo esc_attr($flate_icon); ?>"></i>
												</div>
												<h3>
													<a href="<?php echo esc_url(get_permalink()); ?>">
														<?php echo esc_html($service_title); ?>
													</a>
												</h3>
											</div>
										</div>
									</div>
								<?php } else { ?>
									<div class="col-lg-4 col-md-6 col-12">
										<div class="wpo-service-item">
											<div class="wpo-service-text">
												<div class="s-icon">
													<i class="fi <?php echo esc_attr($flate_icon); ?>"></i>
												</div>
												<h3>
													<a href="<?php echo esc_url(get_permalink()); ?>">
														<?php echo esc_html($service_title); ?>
													</a>
												</h3>
												<p><?php echo esc_html($service_excerpt); ?></p>
											</div>
										</div>
									</div>
							<?php }
							endwhile;
						endif;
						wp_reset_postdata();
						if ($service_style == 'style-two') { ?>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
<?php
		// Return outbut buffer
		echo ob_get_clean();
	}
	/**
	 * Render Service widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 */

	//protected function _content_template(){}

}
Plugin::instance()->widgets_manager->register_widget_type(new Loveme_Service());
