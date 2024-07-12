<?php
/*
 * Elementor Loveme Gallery Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Loveme_Gallery extends Widget_Base
{

	/**
	 * Retrieve the widget name.
	 */
	public function get_name()
	{
		return 'wpo-loveme_gallery';
	}

	/**
	 * Retrieve the widget title.
	 */
	public function get_title()
	{
		return esc_html__('Gallery', 'loveme-core');
	}

	/**
	 * Retrieve the widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-gallery-justified';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 */
	public function get_categories()
	{
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Loveme Gallery widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	 */
	public function get_script_depends()
	{
		return ['wpo-loveme_gallery'];
	}

	/**
	 * Register Loveme Gallery widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 */
	protected function register_controls()
	{

		$this->start_controls_section(
			'section_gallery',
			[
				'label' => esc_html__('Gallery Options', 'loveme-core'),
			]
		);
		$this->add_control(
			'gallery_style',
			[
				'label' => esc_html__('Gallery Style', 'loveme-core'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'style-one' => esc_html__('Style Grid', 'loveme-core'),
					'style-two' => esc_html__('Style Masonry', 'loveme-core'),
				],
				'default' => 'style-one',
				'description' => esc_html__('Select your gallery style.', 'loveme-core'),
			]
		);
		$repeater = new Repeater();
		$repeater->add_control(
			'gallery_image',
			[
				'label' => esc_html__('Gallery Image', 'loveme-core'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],

			]
		);
		$repeater->add_control(
			'gallery_title',
			[
				'label' => esc_html__('Title', 'loveme-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Title', 'loveme-core'),
				'placeholder' => esc_html__('Type Title here', 'loveme-core'),
				'label_block' => true,
			]
		);
		$this->add_control(
			'galleryItems_groups',
			[
				'label' => esc_html__('Gallery Items', 'loveme-core'),
				'type' => Controls_Manager::REPEATER,
				'default' => [
					[
						'gallery_title' => esc_html__('Gallery', 'loveme-core'),
					],

				],
				'fields' =>  $repeater->get_controls(),
				'title_field' => '{{{ gallery_title }}}',
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
					'{{WRAPPER}} .wpo-portfolio-section .grid .img-holder:before, .wpo-portfolio-section-s2 .grid .img-holder:before' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		//Icon
		$this->start_controls_section(
			'gallery_icon_style',
			[
				'label' => esc_html__('Icon', 'loveme-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'icon_color',
			[
				'label' => esc_html__('Icon Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portfolio-grids .grid .img-holder .hover-content i:before' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section
	}

	/**
	 * Render Gallery widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$galleryItems_groups = !empty($settings['galleryItems_groups']) ? $settings['galleryItems_groups'] : [];
		$gallery_style = !empty($settings['gallery_style']) ? $settings['gallery_style'] : [];

		if ($gallery_style == 'style-one') {
			$gallery_wrap = 'wpo-portfolio-section-s3';
		} else {
			$gallery_wrap = 'wpo-portfolio-section-s2';
		}

		// Turn output buffer on
		ob_start();
?>
		<div class="<?php echo esc_attr($gallery_wrap); ?>">
			<div class="sortable-gallery">
				<div class="portfolio-grids gallery-container clearfix">
					<?php 	// Group Param Output
					if (is_array($galleryItems_groups) && !empty($galleryItems_groups)) {
						foreach ($galleryItems_groups as $each_item) {

							$gallery_image_url = !empty($each_item['gallery_image']['id']) ? $each_item['gallery_image']['id'] : '';
							$image_url = wp_get_attachment_url($gallery_image_url);
							$image_alt = get_post_meta($each_item['gallery_image']['id'], '_wp_attachment_image_alt', true);

					?>
							<div class="grid">
								<?php if ($image_url) { ?>
									<div class="img-holder">
										<a href="<?php echo esc_url($image_url); ?>" class="fancybox" data-fancybox-group="gall-1">
											<img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>" class="img img-responsive">
											<div class="hover-content">
												<i class="ti-plus"></i>
											</div>
										</a>
									</div>
								<?php } ?>
							</div>
					<?php
						}
					}
					?>
				</div>
			</div>
		</div>
<?php
		// Return outbut buffer
		echo ob_get_clean();
	}
	/**
	 * Render Gallery widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 */

	//protected function _content_template(){}

}
Plugin::instance()->widgets_manager->register_widget_type(new Loveme_Gallery());
