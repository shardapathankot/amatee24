<?php
/*
 * Elementor Loveme Tabs Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Loveme_Tabs  extends Widget_Base
{

	/**
	 * Retrieve the widget name.
	 */
	public function get_name()
	{
		return 'wpo-loveme_tabs';
	}

	/**
	 * Retrieve the widget title.
	 */
	public function get_title()
	{
		return esc_html__('Tabs ', 'loveme-core');
	}

	/**
	 * Retrieve the widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-library-save';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 */
	public function get_categories()
	{
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Loveme Tabs  widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	 */
	public function get_script_depends()
	{
		return ['wpo-loveme_tabs'];
	}

	/**
	 * Register Loveme Tabs  widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 */
	protected function register_controls()
	{

		$this->start_controls_section(
			'section_tabs',
			[
				'label' => esc_html__('Tabs  Options', 'loveme-core'),
			]
		);
		$repeater = new Repeater();
		$repeater->add_control(
			'active_tabs',
			[
				'label' => __('Active Tabs', 'loveme-core'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __('Show', 'loveme-core'),
				'label_off' => __('Hide', 'loveme-core'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$repeater->add_control(
			'tabs_title',
			[
				'label' => esc_html__('Title Text', 'loveme-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Title Text', 'loveme-core'),
				'placeholder' => esc_html__('Type title text here', 'loveme-core'),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'tabs_content',
			[
				'label' => esc_html__('Content Text', 'loveme-core'),
				'type' => Controls_Manager::WYSIWYG,
				'default' => esc_html__('Content Text', 'loveme-core'),
				'placeholder' => esc_html__('Type content text here', 'loveme-core'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'tabsItems_groups',
			[
				'label' => esc_html__('Tabs  Items', 'loveme-core'),
				'type' => Controls_Manager::REPEATER,
				'default' => [
					[
						'tabs_title' => esc_html__('Tabs ', 'loveme-core'),
					],

				],
				'fields' =>  $repeater->get_controls(),
				'title_field' => '{{{ tabs_title }}}',
			]
		);
		$this->end_controls_section(); // end: Section

		// Tabs Title
		$this->start_controls_section(
			'section_tabs_title_style',
			[
				'label' => esc_html__('Tabs Title', 'loveme-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'loveme-core'),
				'name' => 'ntrsvt_tabs_title_typography',
				'selector' => '{{WRAPPER}} .theme-default-tab-wrap .theme-default-tab .nav a',
			]
		);
		$this->add_control(
			'tabs_title_color',
			[
				'label' => esc_html__('Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .theme-default-tab-wrap .theme-default-tab .nav a' => 'color: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'tabs_title_bg_color',
			[
				'label' => esc_html__('Background Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .theme-default-tab-wrap .theme-default-tab .nav a' => 'background-color: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'tabs_title_active_color',
			[
				'label' => esc_html__('Active Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .theme-default-tab-wrap .theme-default-tab .nav .active a' => 'color: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'tabs_title_active_bg_color',
			[
				'label' => esc_html__('Active Background Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .theme-default-tab-wrap .theme-default-tab .nav .active a' => 'background-color: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'tabs_title_border_color',
			[
				'label' => esc_html__('Border Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .theme-default-tab-wrap .theme-default-tab .nav a' => 'border-color: {{VALUE}};'
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Tabs Content
		$this->start_controls_section(
			'section_tabs_content_style',
			[
				'label' => esc_html__('Tabs Content', 'loveme-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'loveme-core'),
				'name' => 'ntrsvt_tabs_content_typography',
				'selector' => '{{WRAPPER}} .theme-default-tab-wrap .tab-content .tab-pane p',
			]
		);
		$this->add_control(
			'tabs_content_color',
			[
				'label' => esc_html__('Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .theme-default-tab-wrap .tab-content .tab-pane p' => 'color: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'tabs_content_border_color',
			[
				'label' => esc_html__('Border Color', 'loveme-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .theme-default-tab-wrap .tab-content' => 'border-color: {{VALUE}};'
				],
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
		<div class="theme-default-tab-wrap">
			<div class="theme-default-tab">
				<ul class="nav">
					<?php 	// Group Param Output
					if (is_array($tabsItems_groups) && !empty($tabsItems_groups)) {
						$id = 1;
						foreach ($tabsItems_groups as $each_items) {
							$id++;
							$tabs_title = !empty($each_items['tabs_title']) ? $each_items['tabs_title'] : '';
							$active_tabs = !empty($each_items['active_tabs']) ? $each_items['active_tabs'] : '';

							if ($active_tabs == 'yes') {
								$active_class = 'active in';
							} else {
								$active_class = '';
							}

							if ($tabs_title) { ?>
								<li class="nav-item">
									<button class="nav-link <?php echo esc_attr($active_class); ?>" id="pills-tab-<?php echo esc_attr($id); ?>" data-bs-toggle="pill" data-bs-target="#pills-<?php echo esc_attr($id); ?>" type="button" aria-controls="pills-home"><?php echo esc_html($tabs_title); ?></button>
								</li>
					<?php }
						}
					}
					?>
				</ul>
				<div class="tab-content">
					<?php 	// Group Param Output
					if (is_array($tabsItems_groups) && !empty($tabsItems_groups)) {
						$id = 1;
						foreach ($tabsItems_groups as $each_items) {
							$id++;
							$tabs_content = !empty($each_items['tabs_content']) ? $each_items['tabs_content'] : '';
							$active_tabs = !empty($each_items['active_tabs']) ? $each_items['active_tabs'] : '';

							if ($active_tabs == 'yes') {
								$active_class = 'show active';
							} else {
								$active_class = '';
							}

							if ($tabs_content) { ?>
								<div class="tab-pane fade <?php echo esc_attr($active_class); ?>" id="pills-<?php echo esc_attr($id); ?>" role="tabpanel" aria-labelledby="pills-<?php echo esc_attr($id); ?>">
									<?php echo wp_kses_post($tabs_content); ?>
								</div>
					<?php }
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
	 * Render Tabs  widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 */

	//protected function _content_template(){}

}
Plugin::instance()->widgets_manager->register_widget_type(new Loveme_Tabs());
