<?php
/*
 * Elementor Loveme Tabs Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Loveme_Product_Cat  extends Widget_Base
{

	/**
	 * Retrieve the widget name.
	 */
	public function get_name()
	{
		return 'wpo-product-cat';
	}

	/**
	 * Retrieve the widget title.
	 */
	public function get_title()
	{
		return esc_html__('Product Categories ', 'loveme-core');
	}

	/**
	 * Retrieve the widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-product-categories';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 */
	public function get_categories()
	{
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Loveme Product Categories  widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	 */
	/*	public function get_script_depends() {
		return ['wpo-product-cat'];
	}*/

	/**
	 * Register Loveme Product Categories  widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 */
	protected function register_controls()
	{
		$args = array();
		$args['order'] = 'DESC';
		$args['orderby'] = 'none';
		$args['hide_empty'] = true;

		$categories =  get_terms('product_cat', $args);

		$allCategories = array();
		if ($categories) {
			foreach ($categories as $product_tem) {
				$allCategories[$product_tem->term_id] = $product_tem->name;
			}
		} else {
			$allCategories[__('No ID\'s found', 'loveme')] = 0;
		}

		$this->start_controls_section(
			'section_tabs',
			[
				'label' => esc_html__('Product Categories  Options', 'loveme-core'),
			]
		);
		$repeater = new Repeater();

		$repeater->add_control(
			'select_category',
			[
				'label' => __('Select Category', 'loveme-core'),
				'type' => Controls_Manager::SELECT,
				'default' => [],
				'options' => $allCategories,
			]
		);
		$repeater->add_control(
			'category_image',
			[
				'label' => esc_html__('Slider Image', 'loveme-core'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'tabsItems_groups',
			[
				'label' => esc_html__('Category  Items', 'loveme-core'),
				'type' => Controls_Manager::REPEATER,
				'default' => [
					[
						'select_category' => esc_html__('Select Category ', 'loveme-core'),
					],

				],
				'fields' =>  $repeater->get_controls(),
				'title_field' => '{{{ select_category }}}',
			]
		);
		$this->end_controls_section(); // end: Section

	}

	/**
	 * Render Tabs  widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$tabsItems_groups = !empty($settings['tabsItems_groups']) ? $settings['tabsItems_groups'] : [];

		// Turn output buffer on
		ob_start();
?>
		<div class="wpo-category-section">
			<div class="wpo-category-wrap">
				<div class="container-fluid">
					<div class="row">
						<?php
						foreach ($tabsItems_groups as $tabsItems_groups) {
							$select_category = $tabsItems_groups['select_category'] ? (int) $tabsItems_groups['select_category'] : 0;
							$image_url = wp_get_attachment_url($tabsItems_groups['category_image']['id']);
							$term = get_term_by('term_id', $select_category, 'product_cat');
							$term_name = $term->name;
							$term_url = get_term_link($select_category, 'product_cat');
						?>
							<div class="col-lg-4 col-md-6 col-12">
								<div class="wpo-category-item">
									<div class="wpo-category-img">
										<img src="<?php echo esc_url($image_url); ?>" alt="">
									</div>
									<div class="wpo-category-text">
										<a href="<?php echo esc_url($term_url); ?>"><?php echo esc_html($term_name); ?></a>
									</div>
								</div>
							</div>
						<?php
						}
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
	 * Render Tabs  widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 */

	//protected function _content_template(){}

}
Plugin::instance()->widgets_manager->register_widget_type(new Loveme_Product_Cat());
