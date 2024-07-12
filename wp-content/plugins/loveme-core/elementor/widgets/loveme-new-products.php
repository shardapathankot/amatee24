<?php
/*
 * Elementor Loveme Tabs Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Loveme_New_Products  extends Widget_Base
{

	/**
	 * Retrieve the widget name.
	 */
	public function get_name()
	{
		return 'wponewproducts';
	}

	/**
	 * Retrieve the widget title.
	 */
	public function get_title()
	{
		return esc_html__('New Arivals ', 'loveme-core');
	}

	/**
	 * Retrieve the widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-product-related';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 */
	public function get_categories()
	{
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Loveme New Arivals  widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	 */
	public function get_script_depends()
	{
		return ['owl-loveme_popular'];
	}

	/**
	 * Register Loveme New Arivals  widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 */
	protected function register_controls()
	{

		$this->start_controls_section(
			'section_tabs',
			[
				'label' => esc_html__('Products  Options', 'loveme-core'),
			]
		);
		$this->add_control(
			'pr_list_style',
			[
				'label' => esc_html__('Product Type', 'loveme-core'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'pr-bestsell' => esc_html__('Best Selling Products', 'loveme-core'),
					'pr-featured' => esc_html__('Featured Products', 'loveme-core'),
					'pr-random' => esc_html__('Random Products', 'loveme-core'),
					'pr-recent' => esc_html__('Recent Products', 'loveme-core'),
					'pr-onsales' => esc_html__('Onsales Products', 'loveme-core'),
					'pr-toprated' => esc_html__('Top Rated Products', 'loveme-core'),
				],
				'default' => 'pr-bestsell',
				'description' => esc_html__('Select product type.', 'loveme-core'),
			]
		);
		$this->add_control(
			'pr_list_limit',
			[
				'label' => esc_html__('Product Limit', 'loveme-core'),
				'type' => Controls_Manager::NUMBER,
				'step' => 1,
				'default' => 3,
				'description' => esc_html__('Enter the number of items to show.', 'loveme-core'),
			]
		);
		$this->add_control(
			'pr_list_order',
			[
				'label' => esc_html__('Product Order', 'loveme-core'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => esc_html__('Select Order', 'loveme-core'),
					'ASC' => esc_html__('Asending', 'loveme-core'),
					'DESC' => esc_html__('Desending', 'loveme-core'),
				],
				'default' => 'pr-bestsell',
				'description' => esc_html__('Select product type.', 'loveme-core'),
			]
		);
		$this->add_control(
			'pr_list_orderby',
			[
				'label' => esc_html__('Product Order', 'loveme-core'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'none' => esc_html__('None', 'loveme-core'),
					'ID' => esc_html__('ID', 'loveme-core'),
					'author' => esc_html__('Author', 'loveme-core'),
					'title' => esc_html__('Title', 'loveme-core'),
					'name' => esc_html__('Name', 'loveme-core'),
					'date' => esc_html__('Date', 'loveme-core'),
					'modified' => esc_html__('Modified', 'loveme-core'),
					'random' => esc_html__('Random', 'loveme-core'),
					'comment_count' => esc_html__('Comment Count', 'loveme-core'),
				],
				'default' => 'pr-bestsell',
				'description' => esc_html__('Select product type.', 'loveme-core'),
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
		$pr_list_orderby = !empty($settings['pr_list_orderby']) ? $settings['pr_list_orderby'] : '';
		$pr_list_order = !empty($settings['pr_list_order']) ? $settings['pr_list_order'] : '';
		$pr_list_style = !empty($settings['pr_list_style']) ? $settings['pr_list_style'] : '';
		$pr_list_limit = !empty($settings['pr_list_limit']) ? $settings['pr_list_limit'] : '';
		$title = !empty($settings['title']) ? $settings['title'] : '';

		$meta_query = WC()->query->get_meta_query();
		$tax_query  = WC()->query->get_tax_query();

		$args = array(
			'post_type'           => 'product',
			'post_status'			    => 'publish',
			'ignore_sticky_posts'	=> 1,
			'posts_per_page'      => (int)$pr_list_limit,
		);

		if ($pr_list_style === 'pr-bestsell') {

			$args['meta_key'] = 'total_sales';
			$args['orderby']  = 'meta_value_num';
		} else if ($pr_list_style === 'pr-featured') {

			$tax_query[] = array(
				'taxonomy' => 'product_visibility',
				'field'    => 'name',
				'terms'    => 'featured',
				'operator' => 'IN',
			);

			$args['order']   = $pr_list_order;
			$args['orderby'] = $pr_list_orderby;
		} else if ($pr_list_style === 'pr-random') {

			$args['order']   = $pr_list_order;
			$args['orderby'] = 'rand';
		} else if ($pr_list_style === 'pr-recent') {

			$args['order']   = $pr_list_order;
			$args['orderby'] = 'date';
		} else if ($pr_list_style === 'pr-onsales') {

			$args['post__in'] = array_merge(array(0), wc_get_product_ids_on_sale());
			$args['order']   = $pr_list_order;
			$args['orderby'] = $pr_list_orderby;
		} else if ($pr_list_style === 'pr-toprated') {

			$args['meta_key'] = '_wc_average_rating';
			$args['order']   = $pr_list_order;
			$args['orderby'] = $pr_list_orderby;
		}

		$args['meta_query'] = $meta_query;
		$args['tax_query']  = $tax_query;

		$loveme_products_list = new\WP_Query($args);

		// Turn output buffer on
		ob_start();
		if ($loveme_products_list->have_posts()) :
?>
			<div class="wpo-product-section-s2">
				<div class="wpo-product-wrap product-active owl-carousel">
					<?php
					while ($loveme_products_list->have_posts()) : $loveme_products_list->the_post();
						global $product;
						// $stock_quantity = $product->stock_quantity;

						$loveme_woocommerce_section = get_post_meta(get_the_ID(), 'loveme_woocommerce_section', true);
						$product_carousel = isset($loveme_woocommerce_section['product_carousel']) ? $loveme_woocommerce_section['product_carousel'] : '';

						$bg_url = wp_get_attachment_url($product_carousel);
						$bg_alt = get_post_meta($product_carousel, '_wp_attachment_image_alt', true);
					?>
						<div class="wpo-product-item">
							<div class="wpo-product-img">
								<?php if ($bg_url) {
									echo '<img src="' . esc_url($bg_url) . '" alt="' . esc_attr($bg_alt) . '">';
								} ?>
								<a href="<?php echo esc_url($product->add_to_cart_url()); ?>">
									<?php echo esc_html($product->add_to_cart_text()); ?>
								</a>
							</div>
							<div class="wpo-product-text">
								<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								<span class="price"><?php echo $product->get_price_html(); ?></span>
							</div>
						</div>
					<?php
					endwhile;
					?>
				</div>
			</div>
<?php
		endif;
		wp_reset_postdata();
		// Return outbut buffer
		echo ob_get_clean();
	}
	/**
	 * Render Tabs  widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 */

	//protected function _content_template(){}

}
Plugin::instance()->widgets_manager->register_widget_type(new Loveme_New_Products());
