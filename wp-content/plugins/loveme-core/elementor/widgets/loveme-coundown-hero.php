<?php
/*
 * Elementor Loveme Coundown_Hero Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Loveme_Coundown_Hero extends Widget_Base
{

	/**
	 * Retrieve the widget name.
	 */
	public function get_name()
	{
		return 'wpo-loveme_coundown_hero';
	}

	/**
	 * Retrieve the widget title.
	 */
	public function get_title()
	{
		return esc_html__('Coundown Hero', 'loveme-core');
	}

	/**
	 * Retrieve the widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-countdown';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 */
	public function get_categories()
	{
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Loveme Coundown_Hero widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	 */
	public function get_script_depends()
	{
		return ['wpo-loveme_coundown_hero'];
	}

	/**
	 * Register Loveme Coundown_Hero widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 */
	protected function register_controls()
	{

		$this->start_controls_section(
			'section_coundown_hero',
			[
				'label' => esc_html__('Coundown Hero Options', 'loveme-core'),
			]
		);
		$this->add_control(
			'coundown_style',
			[
				'label' => esc_html__('Coundown Style', 'loveme-core'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'style-one' => esc_html__('Style One', 'loveme-core'),
					'style-two' => esc_html__('Style Two', 'loveme-core'),
				],
				'default' => 'style-one',
				'description' => esc_html__('Select your coundown style.', 'loveme-core'),
			]
		);
		$this->add_control(
			'hero_title',
			[
				'label' => esc_html__('Title Text', 'loveme-core'),
				'type' => Controls_Manager::TEXT,
				'condition' => [
					'coundown_style' => array('style-one'),
				],
				'default' => esc_html__('Title Text Here ', 'loveme-core'),
				'placeholder' => esc_html__('Type title text here', 'loveme-core'),
				'label_block' => true,
			]
		);
		$this->add_control(
			'hero_content',
			[
				'label' => esc_html__('Content', 'loveme-core'),
				'default' => esc_html__('your content text', 'loveme-core'),
				'placeholder' => esc_html__('Type your content here', 'loveme-core'),
				'type' => Controls_Manager::TEXTAREA,
				'condition' => [
					'coundown_style' => array('style-one'),
				],
				'label_block' => true,
			]
		);
		$this->add_control(
			'countdown_date',
			[
				'label' => esc_html__('Countdown Date', 'loveme-core'),
				'type' => Controls_Manager::DATE_TIME,
				'default' => esc_html__('Countdown Date', 'loveme-core'),
				'placeholder' => esc_html__('Countdown Date here', 'loveme-core'),
				'label_block' => true,
				'picker_options' => [
					'enableTime' => false,
					'dateFormat' => 'Y/m/d '
				]
			]
		);
		$this->add_control(
			'clock_image',
			[
				'label' => esc_html__('Shape Image', 'loveme-core'),
				'type' => Controls_Manager::MEDIA,
				'frontend_available' => true,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'description' => esc_html__('Set Shape image for Title.', 'loveme-core'),
			]
		);
		$this->add_control(
			'countdown_month',
			[
				'label' => esc_html__('Countdown Month', 'loveme-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Month', 'loveme-core'),
				'placeholder' => esc_html__('Type Month text here', 'loveme-core'),
				'label_block' => true,
			]
		);
		$this->add_control(
			'countdown_days',
			[
				'label' => esc_html__('Countdown Days', 'loveme-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Days', 'loveme-core'),
				'placeholder' => esc_html__('Type Days text here', 'loveme-core'),
				'label_block' => true,
			]
		);
		$this->add_control(
			'countdown_hours',
			[
				'label' => esc_html__('Countdown Hours', 'loveme-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Hours', 'loveme-core'),
				'placeholder' => esc_html__('Type Hours text here', 'loveme-core'),
				'label_block' => true,
			]
		);
		$this->add_control(
			'countdown_mins',
			[
				'label' => esc_html__('Countdown Mins', 'loveme-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Mins', 'loveme-core'),
				'placeholder' => esc_html__('Type Mins text here', 'loveme-core'),
				'label_block' => true,
			]
		);
		$this->add_control(
			'countdown_secs',
			[
				'label' => esc_html__('Countdown Secs', 'loveme-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Secs', 'loveme-core'),
				'placeholder' => esc_html__('Type Secs text here', 'loveme-core'),
				'label_block' => true,
			]
		);
		$this->end_controls_section(); // end: Section

		$this->start_controls_section(
			'section_coundown_slide_hero',
			[
				'label' => esc_html__('Hero Slide', 'loveme-core'),
				'condition' => [
					'coundown_style' => array('style-one'),
				],
			]
		);

		$repeater = new Repeater();
		$repeater->add_control(
			'coundown_slider_image',
			[
				'label' => esc_html__('Coundown Slider Image', 'loveme-core'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		$repeater->add_control(
			'coundown_slider_title',
			[
				'label' => esc_html__('Title Text', 'loveme-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__(' Slide 1', 'loveme-core'),
				'placeholder' => esc_html__('Type title text here', 'loveme-core'),
				'label_block' => true,
			]
		);
		$this->add_control(
			'swipeCoundown_Sliders_groups',
			[
				'label' => esc_html__('Coundown Slider Items', 'loveme-core'),
				'type' => Controls_Manager::REPEATER,
				'default' => [
					[
						'coundown_slider_title' => esc_html__('Item #1', 'loveme-core'),
					],

				],
				'fields' =>  $repeater->get_controls(),
				'title_field' => '{{{ coundown_slider_title }}}',
			]
		);
		$this->end_controls_section(); // end: Section


		// Title
		$this->start_controls_section(
			'section_title_style',
			[
				'label' => esc_html__('Title', 'loveme-core'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'coundown_style' => array('style-one'),
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'loveme-core'),
				'name' => 'loveme_title_typography',
				'selector' => '{{WRAPPER}} .wpo-hero-style-3 .wedding-announcement .couple-text h2',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-hero-style-3 .wedding-announcement .couple-text h2' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .wpo-hero-style-3 .wedding-announcement .couple-text h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .wpo-hero-style-3 .wedding-announcement .couple-text p',
			]
		);
		$this->add_control(
			'content_color',
			[
				'label' => esc_html__('Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-hero-style-3 .wedding-announcement .couple-text p' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section


		// Counter Number
		$this->start_controls_section(
			'counter_number_style',
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
				'selector' => '{{WRAPPER}} .wpo-hero-style-3 .wpo-wedding-date #clock .time, .wpo-wedding-date #clock .time',
			]
		);
		$this->add_control(
			'number_color',
			[
				'label' => esc_html__('Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-hero-style-3 .wpo-wedding-date #clock .time, .wpo-wedding-date #clock .time' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .wpo-hero-style-3 .wpo-wedding-date #clock .time, .wpo-wedding-date #clock .time' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Counter Title
		$this->start_controls_section(
			'counter_title_style',
			[
				'label' => esc_html__('Counter Title', 'loveme-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'loveme-core'),
				'name' => 'ntrsvt_counter_title_typography',
				'selector' => '{{WRAPPER}} .wpo-hero-style-3 .wpo-wedding-date #clock span, .wpo-wedding-date #clock span',
			]
		);
		$this->add_control(
			'counter_title',
			[
				'label' => esc_html__('Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-hero-style-3 .wpo-wedding-date #clock span, .wpo-wedding-date #clock span' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section


		// Navigation
		$this->start_controls_section(
			'section_navigation_style',
			[
				'label' => esc_html__('Navigation', 'loveme-core'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'coundown_style' => array('style-one'),
				],
			]
		);
		$this->add_control(
			'slider_nav_color',
			[
				'label' => esc_html__('Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-hero-slider .swiper-button-prev:before,.wpo-hero-slider .swiper-button-next:before' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'slider_nav_bg_color',
			[
				'label' => esc_html__('Background Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-hero-slider .swiper-button-prev, .wpo-hero-slider .swiper-button-next' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'slider_nav_br_color',
			[
				'label' => esc_html__('Border Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-hero-slider .swiper-button-prev, .wpo-hero-slider .swiper-button-next' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

	}

	/**
	 * Render Coundown_Hero widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$coundown_style = !empty($settings['coundown_style']) ? $settings['coundown_style'] : '';
		$swipeCoundown_Sliders_groups = !empty($settings['swipeCoundown_Sliders_groups']) ? $settings['swipeCoundown_Sliders_groups'] : [];

		$countdown_month = !empty($settings['countdown_month']) ? $settings['countdown_month'] : '';
		$countdown_days = !empty($settings['countdown_days']) ? $settings['countdown_days'] : '';
		$countdown_hours = !empty($settings['countdown_hours']) ? $settings['countdown_hours'] : '';
		$countdown_mins = !empty($settings['countdown_mins']) ? $settings['countdown_mins'] : '';
		$countdown_secs = !empty($settings['countdown_secs']) ? $settings['countdown_secs'] : '';

		$hero_title = !empty($settings['hero_title']) ? $settings['hero_title'] : '';
		$hero_content = !empty($settings['hero_content']) ? $settings['hero_content'] : '';
		$countdown_date = !empty($settings['countdown_date']) ? $settings['countdown_date'] : '';

		$bg_clock = !empty($settings['clock_image']['id']) ? $settings['clock_image']['id'] : '';

		// Shape Image
		$shape_url = wp_get_attachment_url($bg_clock);

		$e_uniqid        = uniqid();
		$inline_style  = '';

		if ($shape_url) {
			$inline_style .= '.wpo-coundown-' . $e_uniqid . ' .wpo-wedding-date #clock>div, .wpo-coundown-' . $e_uniqid . '.wpo-wedding-date #clock > div {';
			$inline_style .= ($shape_url) ? 'background-image:url(' . $shape_url . ');' : '';
			$inline_style .= '}';
		}

		// add inline style
		loveme_add_inline_style($inline_style);
		$styled_class  = ' wpo-coundown-' . $e_uniqid;

		// Turn output buffer on
		ob_start();
		if ($coundown_style == 'style-one') { ?>
			<div class="wpo-coundown wpo-hero-slider wpo-hero-style-3 <?php echo esc_attr($styled_class); ?>">
				<div class="wedding-announcement">
					<div class="couple-text">
						<?php if ($hero_title) { ?>
							<h2 class="wow slideInUp" data-wow-duration="1s"><?php echo esc_html($hero_title); ?></h2>
						<?php }
						if ($hero_content) { ?>
							<p class="wow slideInUp" data-wow-duration="1.8s"><?php echo esc_html($hero_content); ?></p>
						<?php } ?>
						<!-- start wpo-wedding-date -->
						<div class="wpo-wedding-date wow slideInUp" data-wow-duration="2.1s">
							<div class="clock-grids">
								<div id="clock" data-date="<?php echo esc_attr($countdown_date); ?>"></div>
							</div>
						</div>
						<!-- end wpo-wedding-date -->
					</div>
				</div>
				<div class="swiper-container">
					<div class="swiper-wrapper">
						<?php
						if (is_array($swipeCoundown_Sliders_groups) && !empty($swipeCoundown_Sliders_groups)) {
							foreach ($swipeCoundown_Sliders_groups as $each_item) {
								$image_url = wp_get_attachment_url($each_item['coundown_slider_image']['id']);
						?>
								<div class="swiper-slide">
									<div class="slide-inner slide-bg-image" data-background="<?php echo esc_url($image_url); ?>">
									</div> <!-- end slide-inner -->
								</div> <!-- end swiper-slide -->
						<?php
							}
						}
						?>
					</div>
					<!-- end swiper-wrapper -->
					<!-- swipper controls -->
					<div class="swiper-pagination"></div>
					<div class="next-prev-btn">
						<div class="swiper-button-next"></div>
						<div class="swiper-button-prev"></div>
					</div>
				</div>
			</div>
		<?php } else { ?>
			<div class="wpo-coundown wpo-wedding-date">
				<div class="container">
					<div class="clock-grids">
						<div id="clock" data-date="<?php echo esc_attr($countdown_date); ?>"></div>
					</div>
				</div>
			</div>
		<?php } ?>

		<script>
// 			jQuery(document).ready(function() {
				/*------------------------------------------
            = COUNTDOWN CLOCK
        -------------------------------------------*/
// 				if (jQuery("#clock").length) {
// 					var weddingDate = jQuery('#clock').data('date');
// 					jQuery('#clock').countdown(weddingDate, function(event) {
// 						var $this = jQuery(this).html(event.strftime('' +
// 							'<div class="box"><div><div class="time">%m</div><span><?php echo esc_html($countdown_month); ?></span></div></div>' +
// 							'<div class="box"><div><div class="time">%D</div> <span><?php echo esc_html($countdown_days); ?></span></div></div>' +
// 							'<div class="box"><div><div class="time">%H</div> <span><?php echo esc_html($countdown_hours); ?></span></div></div>' +
// 							'<div class="box"><div><div class="time">%M</div> <span><?php echo esc_html($countdown_mins); ?></span> </div></div>' +
// 							'<div class="box"><div><div class="time">%S</div> <span><?php echo esc_html($countdown_secs); ?></span> </div></div>'));
// 					});
// 				}

// 			});

jQuery(document).ready(function() {
    /*------------------------------------------
        = COUNTDOWN CLOCK
    -------------------------------------------*/
    if (jQuery("#clock").length) {
        var weddingDate = jQuery('#clock').data('date');
        jQuery('#clock').countdown(weddingDate, function(event) {
            var currentDate = new Date();
            var remainingTime = event.finalDate - currentDate;
            var remainingDays = Math.floor(remainingTime / (1000 * 60 * 60 * 24));
            var remainingMonths = Math.floor(remainingDays / 30);
            remainingDays = remainingDays % 30;
            var remainingHours = Math.floor((remainingTime % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var remainingMinutes = Math.floor((remainingTime % (1000 * 60 * 60)) / (1000 * 60));
            var remainingSeconds = Math.floor((remainingTime % (1000 * 60)) / 1000);

            var $this = jQuery(this).html(event.strftime('' +
                // '<div class="box"><div><div class="time">%m</div><span><?php echo esc_html($countdown_month); ?></span></div></div>' +
                '<div class="box"><div><div class="time">' + remainingMonths + '</div><span>Months</span></div></div>' +
                '<div class="box"><div><div class="time">' + remainingDays + '</div><span>Days</span></div></div>' +
                '<div class="box"><div><div class="time">' + remainingHours + '</div><span>Hours</span></div></div>' +
                '<div class="box"><div><div class="time">' + remainingMinutes + '</div><span>Minutes</span></div></div>' +
                '<div class="box"><div><div class="time">' + remainingSeconds + '</div><span>Seconds</span></div></div>'));
        });
    }
});

		</script>
<?php
		// Return outbut buffer
		echo ob_get_clean();
	}
	/**
	 * Render Coundown_Hero widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 */

	//protected function _content_template(){}

}
Plugin::instance()->widgets_manager->register_widget_type(new Loveme_Coundown_Hero());
