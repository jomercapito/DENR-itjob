<?php
/**
 * Apex distributed chart elementor widget class.
 *
 * @link  https://iqonic.design
 *
 * @package    Graphina_Charts_For_Elementor
 */

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Elementor distributed chart widget.
 *
 * Elementor widget that displays an eye-catching distributed chart.
 *
 * @since 1.5.7
 */
class Distributed_Column_Chart extends Widget_Base {


	/**
	 * Get widget name.
	 *
	 * Retrieve heading widget name.
	 *
	 * @return string Widget name.
	 * @since 1.5.7
	 * @access public
	 */
	public function get_name(): string {
		return 'distributed_column_chart';
	}

	/**
	 * Get widget Title.
	 *
	 * Retrieve heading widget Title.
	 *
	 * @return string Widget Title.
	 * @since 1.5.7
	 * @access public
	 */
	public function get_title(): string {
		return 'Distributed Column';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the heading widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * @return array Widget categories.
	 * @since 1.5.7
	 * @access public
	 */
	public function get_categories(): array {
		return array( 'iq-graphina-charts' );
	}


	/**
	 * Get widget icon.
	 *
	 * Retrieve heading widget icon.
	 *
	 * @return string Widget icon.
	 * @since 1.5.7
	 * @access public
	 */
	public function get_icon(): string {
		return 'graphina-apex-distributedcolumn-chart';
	}

	/**
	 * Get widget type.
	 *
	 * @return string Widget ty[e.
	 *
	 * @access public
	 */
	public function get_chart_type(): string {
		return 'distributed_column';
	}

	/**
	 * Register controller to elementor
	 *
	 * @return void
	 */
	protected function register_controls(): void {
		$type = $this->get_chart_type();

		graphina_basic_setting( $this, $type );

		graphina_chart_data_option_setting( $this, $type, 7, true );

		$this->start_controls_section(
			'iq_' . $type . '_section_2',
			array(
				'label' => esc_html__( 'Chart Setting', 'graphina-charts-for-elementor' ),
			)
		);

		graphina_common_chart_setting( $this, $type, false, true, true );

		graphina_tooltip( $this, $type );

		$this->add_control(
			'iq_' . $type . '_is_chart_stroke_width',
			array(
				'label'   => esc_html__( 'Column Width', 'graphina-charts-for-elementor' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 50,
				'min'     => 1,
				'max'     => 100,
				'step'    => 10,
			)
		);

		$this->add_responsive_control(
			'iq_' . $type . '_is_chart_horizontal',
			array(
				'label'           => esc_html__( 'Horizontal', 'graphina-charts-for-elementor' ),
				'type'            => Controls_Manager::SWITCHER,
				'label_on'        => esc_html__( 'Yes', 'graphina-charts-for-elementor' ),
				'label_off'       => esc_html__( 'No', 'graphina-charts-for-elementor' ),
				'desktop_default' => false,
				'tablet_default'  => false,
				'mobile_default'  => false,
			)
		);

		graphina_dropshadow( $this, $type );

		graphina_animation( $this, $type );

		$this->add_control(
			'iq_' . $type . '_chart_hr_plot_setting',
			array(
				'type' => Controls_Manager::DIVIDER,
			)
		);

		$this->add_control(
			'iq_' . $type . '_chart_plot_setting_title',
			array(
				'label' => esc_html__( 'Plot Settings', 'graphina-charts-for-elementor' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$this->add_control(
			'iq_' . $type . '_chart_plot_border_radius',
			array(
				'label'   => esc_html__( 'Border Radius', 'graphina-charts-for-elementor' ),
				'type'    => Controls_Manager::NUMBER,
				'min'     => 0,
				'default' => 0,
			)
		);

		$this->add_control(
			'iq_' . $type . '_chart_hr_category_listing',
			array(
				'type'      => Controls_Manager::DIVIDER,
				'condition' => array(
					'iq_' . $type . '_chart_data_option' => 'manual',
				),
			)
		);

		$repeater = new Repeater();
		$repeater->add_control(
			'iq_' . $type . '_chart_category',
			array(
				'label'       => esc_html__( 'Category Value', 'graphina-charts-for-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Add Value', 'graphina-charts-for-elementor' ),
				'dynamic'     => array(
					'active' => true,
				),
				'description' => esc_html__( 'Note: For multiline text seperate Text by comma(,) and Only work if Labels Prefix/Postfix in X-axis is disable ', 'graphina-charts-for-elementor' ),
			)
		);

		/** Chart value list. */
		$this->add_control(
			'iq_' . $type . '_category_list',
			array(
				'label'     => esc_html__( 'Categories', 'graphina-charts-for-elementor' ),
				'type'      => Controls_Manager::REPEATER,
				'fields'    => $repeater->get_controls(),
				'default'   => array(
					array( 'iq_' . $type . '_chart_category' => 'Jan' ),
					array( 'iq_' . $type . '_chart_category' => 'Feb' ),
					array( 'iq_' . $type . '_chart_category' => 'Mar' ),
					array( 'iq_' . $type . '_chart_category' => 'Apr' ),
					array( 'iq_' . $type . '_chart_category' => 'May' ),
					array( 'iq_' . $type . '_chart_category' => 'Jun' ),
					array( 'iq_' . $type . '_chart_category' => 'July' ),
					array( 'iq_' . $type . '_chart_category' => 'Aug' ),
				),
				'condition' => array(
					'iq_' . $type . '_chart_data_option' => 'manual',
				),
			)
		);

		$this->end_controls_section();

		graphina_chart_label_setting( $this, $type );

		graphina_advance_x_axis_setting( $this, $type );

		graphina_advance_y_axis_setting( $this, $type );

		graphina_series_setting( $this, $type, array( 'tooltip', 'color' ), true, array( 'classic', 'gradient', 'pattern' ), true, true );

		$this->start_controls_section(
			'iq_' . $type . '_section_4_',
			array(
				'label'      => esc_html__( 'Element 1', 'graphina-charts-for-elementor' ),
				'condition'  => array(
					'iq_' . $type . '_chart_data_option' => 'manual',
				),
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'relation' => 'and',
							'terms'    => array(
								array(
									'name'     => 'iq_' . $type . '_chart_is_pro',
									'operator' => '==',
									'value'    => 'false',
								),
								array(
									'name'     => 'iq_' . $type . '_chart_data_option',
									'operator' => '==',
									'value'    => 'manual',
								),
							),
						),
						array(
							'relation' => 'and',
							'terms'    => array(
								array(
									'name'     => 'iq_' . $type . '_chart_is_pro',
									'operator' => '==',
									'value'    => 'true',
								),
							),
						),
					),
				),
			)
		);
		$repeater = new Repeater();

		$repeater->add_control(
			'iq_' . $type . '_chart_value_4_',
			array(
				'label'       => esc_html__( 'Chart Value', 'graphina-charts-for-elementor' ),
				'type'        => Controls_Manager::NUMBER,
				'placeholder' => esc_html__( 'Add Value', 'graphina-charts-for-elementor' ),
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		/** Chart value list. */
		$this->add_control(
			'iq_' . $type . '_value_list_4_1_',
			array(
				'label'       => esc_html__( 'Chart value list', 'graphina-charts-for-elementor' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array( 'iq_' . $type . '_chart_value_4_' => wp_rand( 100, 200 ) ),
					array( 'iq_' . $type . '_chart_value_4_' => wp_rand( 100, 200 ) ),
					array( 'iq_' . $type . '_chart_value_4_' => wp_rand( 100, 200 ) ),
					array( 'iq_' . $type . '_chart_value_4_' => wp_rand( 100, 200 ) ),
					array( 'iq_' . $type . '_chart_value_4_' => wp_rand( 100, 200 ) ),
					array( 'iq_' . $type . '_chart_value_4_' => wp_rand( 100, 200 ) ),
					array( 'iq_' . $type . '_chart_value_4_' => wp_rand( 100, 200 ) ),
					array( 'iq_' . $type . '_chart_value_4_' => wp_rand( 100, 200 ) ),
				),
				'condition'   => array(
					'iq_' . $type . '_can_chart_negative_values!' => 'yes',
				),
				'title_field' => '{{{ iq_' . $type . '_chart_value_4_}}}',
			)
		);
		/** Chart value list. */

		/** Chart value negative list. */
		$this->add_control(
			'iq_' . $type . '_value_list_4_2_',
			array(
				'label'       => esc_html__( 'Chart value list', 'graphina-charts-for-elementor' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array( 'iq_' . $type . '_chart_value_4_' => wp_rand( -200, 200 ) ),
					array( 'iq_' . $type . '_chart_value_4_' => wp_rand( -200, 200 ) ),
					array( 'iq_' . $type . '_chart_value_4_' => wp_rand( -200, 200 ) ),
					array( 'iq_' . $type . '_chart_value_4_' => wp_rand( -200, 200 ) ),
					array( 'iq_' . $type . '_chart_value_4_' => wp_rand( -200, 200 ) ),
					array( 'iq_' . $type . '_chart_value_4_' => wp_rand( -200, 200 ) ),
					array( 'iq_' . $type . '_chart_value_4_' => wp_rand( -200, 200 ) ),
					array( 'iq_' . $type . '_chart_value_4_' => wp_rand( -200, 200 ) ),
				),
				'condition'   => array(
					'iq_' . $type . '_can_chart_negative_values' => 'yes',
				),
				'title_field' => '{{{ iq_' . $type . '_chart_value_4_ }}}',
			)
		);
		/** Chart value negative list. */

		$this->end_controls_section();

		graphina_style_section( $this, $type );

		graphina_card_style( $this, $type );

		graphina_chart_style( $this, $type );

		graphina_chart_filter_style( $this, $type );

		if ( function_exists( 'graphina_pro_password_style_section' ) ) {
			graphina_pro_password_style_section( $this, $type );
		}
	}

	/**
	 * Render element.
	 *
	 * Generates the final HTML on the frontend.
	 *
	 * @return void
	 */
	protected function render(): void {
		$settings                 = $this->get_settings_for_display();
		$type                     = $this->get_chart_type();
		$ajax_settings            = graphina_ajax_settings( $settings, $type );
		$enable_number_formatting = $settings[ 'iq_' . $type . '_chart_yaxis_number_format' ] === 'yes';
		$locale                   = $settings[ 'iq_' . $type . '_chart_yaxis_locale' ];
		$main_id                  = graphina_widget_id( $this );
		$gradient                 = array();
		$second_gradient          = array();
		$fill_pattern             = array();
		$datalabels_offset_y      = 0;
		$datalabels_offset_x      = 0;
		$dropshadow_series        = array();
		$tooltip_series           = array();
		$data                     = array(
			'series'   => array(),
			'category' => array(),
		);
		$data_label_prefix        = '';
		$data_label_postfix       = '';
		$y_label_prefix           = '';
		$y_label_postfix          = '';
		$x_label_prefix           = '';
		$x_label_postfix          = '';
		$call_ajax                = false;
		$loading_text             = esc_html( isset( $settings[ 'iq_' . $type . '_chart_no_data_text' ] ) ? $settings[ 'iq_' . $type . '_chart_no_data_text' ] : '' );

		$export_file_name = (
			! empty( $settings[ 'iq_' . $type . '_can_chart_show_toolbar' ] ) && $settings[ 'iq_' . $type . '_can_chart_show_toolbar' ] === 'yes'
			&& ! empty( $settings[ 'iq_' . $type . '_export_filename' ] )
		) ? $settings[ 'iq_' . $type . '_export_filename' ] : $main_id;

		if ( $settings[ 'iq_' . $type . '_chart_datalabel_show' ] === 'yes' ) {
			$data_label_prefix  = $settings[ 'iq_' . $type . '_chart_datalabel_prefix' ];
			$data_label_postfix = $settings[ 'iq_' . $type . '_chart_datalabel_postfix' ];
		}

		if ( $settings[ 'iq_' . $type . '_chart_xaxis_label_show' ] === 'yes' ) {
			$x_label_prefix  = $settings[ 'iq_' . $type . '_chart_xaxis_label_prefix' ];
			$x_label_postfix = $settings[ 'iq_' . $type . '_chart_xaxis_label_postfix' ];
		}

		if ( $settings[ 'iq_' . $type . '_chart_yaxis_label_show' ] === 'yes' ) {
			$y_label_prefix  = $settings[ 'iq_' . $type . '_chart_yaxis_label_prefix' ];
			$y_label_postfix = $settings[ 'iq_' . $type . '_chart_yaxis_label_postfix' ];
		}

		$series_count = isset( $settings[ 'iq_' . $type . '_chart_data_series_count' ] ) ? $settings[ 'iq_' . $type . '_chart_data_series_count' ] : 0;
		for ( $i = 0; $i < $series_count; $i++ ) {
			$dropshadow_series[] = $i;
			if ( ! empty( $settings[ 'iq_' . $type . '_chart_tooltip_enabled_on_1_' . $i ] ) && $settings[ 'iq_' . $type . '_chart_tooltip_enabled_on_1_' . $i ] === 'yes' ) {
				$tooltip_series[] = $i;
			}
			$gradient[] = esc_html( $settings[ 'iq_' . $type . '_chart_gradient_1_' . $i ] );
			if ( strval( $settings[ 'iq_' . $type . '_chart_gradient_2_' . $i ] ) === '' ) {
				$second_gradient[] = esc_html( $settings[ 'iq_' . $type . '_chart_gradient_1_' . $i ] );
			} else {
				$second_gradient[] = esc_html( $settings[ 'iq_' . $type . '_chart_gradient_2_' . $i ] );
			}
			if ( $settings[ 'iq_' . $type . '_chart_bg_pattern_' . $i ] !== '' ) {
				$fill_pattern[] = esc_html( $settings[ 'iq_' . $type . '_chart_bg_pattern_' . $i ] );
			} else {
				$fill_pattern[] = 'verticalLines';
			}
		}

		$category_list = $settings[ 'iq_' . $type . '_category_list' ];

		if ( graphina_pro_active() && $settings[ 'iq_' . $type . '_chart_data_option' ] !== 'manual' ) {
			$call_ajax       = true;
			$gradient        = array( '#ffffff' );
			$second_gradient = array( '#ffffff' );
			$loading_text    = esc_html__( 'Loading...', 'graphina-charts-for-elementor' );
		} else {
			if ( gettype( $category_list ) === 'NULL' ) {
				$category_list = array();
			}
			if ( empty( $series_count ) ) {
				$category_list = array();
			}
			foreach ( $category_list as $v ) {
				$data['category'][] = esc_html( graphina_get_dynamic_tag_data( $v, 'iq_' . $type . '_chart_category' ) );
			}
			$value_list = $settings[ 'iq_' . $type . '_value_list_4_' . ( $settings[ 'iq_' . $type . '_can_chart_negative_values' ] === 'yes' ? 2 : 1 ) . '_' ];
			$value      = array();
			if ( gettype( $value_list ) === 'NULL' ) {
				$value_list = array();
			}
			if ( empty( $series_count ) ) {
				$value_list = array();
			}
			foreach ( $value_list as $v ) {
				$value[] = (float) graphina_get_dynamic_tag_data( $v, 'iq_' . $type . '_chart_value_4_' );
			}
			$data['series'][] = array(
				'data' => $value,
			);
			if ( $settings[ 'iq_' . $type . '_chart_data_option' ] !== 'manual' ) {
				$data = array(
					'series'   => array(),
					'category' => array(),
				);
			}
		}

		$gradient          = implode( '_,_', $gradient );
		$second_gradient   = implode( '_,_', $second_gradient );
		$fill_pattern      = implode( '_,_', $fill_pattern );
		$dropshadow_series = implode( ',', $dropshadow_series );
		$tooltip_series    = implode( ',', $tooltip_series );
		$category          = implode( '_,_', $data['category'] );
		$local_string_type = graphina_common_setting_get( 'thousand_seperator' );

		if ( $settings[ 'iq_' . $type . '_chart_datalabel_position_show' ] === 'top' && $settings[ 'iq_' . $type . '_is_chart_horizontal' ] === 'yes' ) {
			$datalabels_offset_x = 20;
		} elseif ( $settings[ 'iq_' . $type . '_chart_datalabel_position_show' ] === 'top' && $settings[ 'iq_' . $type . '_is_chart_horizontal' ] !== 'yes' ) {
			$datalabels_offset_y = -20;
		}
		graphina_chart_widget_content( $this, $main_id, $settings );

		if ( graphina_restricted_access( 'column', $main_id, $settings, false ) === false ) {
			?>
			<script>
				( function () {

					if (typeof isInit === 'undefined') {
						var isInit = {};
					}
					isInit['<?php echo esc_attr( $main_id ); ?>'] = false;

					const myElement = document.querySelector(".distributed_column-chart-<?php echo esc_attr( $main_id ); ?>");
					const columnOptions = {
						series: <?php echo wp_json_encode( $data['series'] ); ?>,
						chart: {
							background: '<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_background_color1' ] ); ?>',
							height: parseInt('<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_height' ] ); ?>'),
							type: 'bar',
							fontFamily: '<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_font_family' ] ); ?>',
                            locales: [JSON.parse('<?php echo graphina_apexchart_localization(); //@phpcs:ignore ?>')],
							defaultLocale: "en",
							animations: {
								enabled: '<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_animation' ] === 'yes' ); ?>',
								speed: '<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_animation_speed' ] ); ?>' || 800,
							},
							toolbar: {
								offsetX: parseInt('<?php echo esc_js( ! empty( $settings[ 'iq_' . $type . '_chart_toolbar_offsetx' ] ) ? $settings[ 'iq_' . $type . '_chart_toolbar_offsetx' ] : 0 ); ?>') || 0,
								offsetY: parseInt('<?php echo esc_js( ! empty( $settings[ 'iq_' . $type . '_chart_toolbar_offsety' ] ) ? $settings[ 'iq_' . $type . '_chart_toolbar_offsety' ] : 0 ); ?>')|| 0,
								show: '<?php echo esc_js( $settings[ 'iq_' . $type . '_can_chart_show_toolbar' ] ); ?>',
								export: {
									csv: {
										filename: "<?php echo esc_js( $export_file_name ); ?>"
									},
									svg: {
										filename: "<?php echo esc_js( $export_file_name ); ?>"
									},
									png: {
										filename: "<?php echo esc_js( $export_file_name ); ?>"
									}
								}
							},
							dropShadow: {
								enabled: '<?php echo esc_js( $settings[ 'iq_' . $type . '_is_chart_dropshadow' ] === 'yes' ); ?>',
								enabledOnSeries: [<?php echo esc_js( $dropshadow_series ); ?>],
								top: parseInt('<?php echo esc_js( $settings[ 'iq_' . $type . '_is_chart_dropshadow_top' ] ); ?>'),
								left: parseInt('<?php echo esc_js( $settings[ 'iq_' . $type . '_is_chart_dropshadow_left' ] ); ?>'),
								blur: parseInt('<?php echo esc_js( $settings[ 'iq_' . $type . '_is_chart_dropshadow_blur' ] ); ?>'),
								color: '<?php echo esc_js( isset( $settings[ 'iq_' . $type . '_is_chart_dropshadow_color' ] ) ? $settings[ 'iq_' . $type . '_is_chart_dropshadow_color' ] : '' ); ?>',
								opacity: parseFloat('<?php echo esc_js( $settings[ 'iq_' . $type . '_is_chart_dropshadow_opacity' ] ); ?>')
							}
						},
						plotOptions: {
							bar: {
								horizontal: '<?php echo esc_js( $settings[ 'iq_' . $type . '_is_chart_horizontal' ] ); ?>',
								columnWidth: '<?php echo esc_js( $settings[ 'iq_' . $type . '_is_chart_stroke_width' ] ); ?>% ',
								borderRadius: parseInt('<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_plot_border_radius' ] ); ?>') || 0,
								dataLabels: {
									position: '<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_datalabel_position_show' ] ); ?>',
								},
								distributed:true
							},
						},
						noData: {
							text: '<?php echo esc_js( $loading_text ); ?>',
							align: 'center',
							verticalAlign: 'middle',
							style: {
								fontSize: '<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_font_size' ]['size'] . $settings[ 'iq_' . $type . '_chart_font_size' ]['unit'] ); ?>',
								fontFamily: '<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_font_family' ] ); ?>',
								color: '<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_font_color' ] ); ?>'
							}
						},
						dataLabels: {
							enabled: '<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_datalabel_show' ] === 'yes' ); ?>',
							offsetY: parseFloat('<?php echo esc_js( $datalabels_offset_y ); ?>'),
							offsetX: parseFloat('<?php echo esc_js( $datalabels_offset_x ); ?>'),
							style: {
								fontSize: '<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_font_size' ]['size'] . $settings[ 'iq_' . $type . '_chart_font_size' ]['unit'] ); ?>',
								fontFamily: '<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_font_family' ] ); ?>',
								fontWeight: '<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_font_weight' ] ); ?>',
								colors: ['<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_datalabel_background_show' ] === 'yes' ? $settings[ 'iq_' . $type . '_chart_datalabel_font_color_1' ] : $settings[ 'iq_' . $type . '_chart_datalabel_font_color' ] ); ?>']
							},
							background: {
								enabled: '<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_datalabel_background_show' ] === 'yes' ); ?>',
								borderRadius:parseInt('<?php echo esc_js( ! empty( $settings[ 'iq_' . $type . '_chart_datalabel_border_radius' ] ) ? $settings[ 'iq_' . $type . '_chart_datalabel_border_radius' ] : 0 ); ?>'),
								foreColor: ['<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_datalabel_background_color' ] ); ?>'],
								borderWidth: parseInt('<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_datalabel_border_width' ] ); ?>') || 0,
								borderColor: '<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_datalabel_border_color' ] ); ?>'
							},
						},
						stroke: {
							show: true,
							width: 2,
							colors: ['transparent']
						},
						grid: {
							borderColor: '<?php echo esc_js( ! empty( $settings[ 'iq_' . $type . '_chart_yaxis_line_grid_color' ] ) ? $settings[ 'iq_' . $type . '_chart_yaxis_line_grid_color' ] : '#90A4AE' ); ?>',
							yaxis: {
								lines: {
									show: '<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_yaxis_line_show' ] ); ?>'
								}
							}
						},
						xaxis: {
							categories: '<?php echo esc_js( $category ); ?>'.split('_,_'),
							position: '<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_xaxis_datalabel_position' ] ); ?>',
							tickAmount: parseInt("<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_xaxis_datalabel_tick_amount' ] ); ?>"),
							labels: {
								show: '<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_xaxis_datalabel_show' ] ); ?>',
								rotateAlways: '<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_xaxis_datalabel_auto_rotate' ] ); ?>',
								rotate: parseInt('<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_xaxis_datalabel_rotate' ] ); ?>') || 0,
								offsetX: parseInt('<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_xaxis_datalabel_offset_x' ] ); ?>')|| 0,
								offsetY: parseInt('<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_xaxis_datalabel_offset_y' ] ); ?>') || 0,
								trim: true,
								style: {
									colors: '<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_font_color' ] ); ?>',
									fontSize: '<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_font_size' ]['size'] . $settings[ 'iq_' . $type . '_chart_font_size' ]['unit'] ); ?>',
									fontFamily: '<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_font_family' ] ); ?>',
									fontWeight: '<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_font_weight' ] ); ?>'
								},
								formatter: function (val) {
									if('<?php echo esc_js( ! empty( $settings[ 'iq_' . $type . '_chart_xaxis_label_show' ] ) && $settings[ 'iq_' . $type . '_chart_xaxis_label_show' ] === 'yes' ); ?>'){
										if('<?php echo esc_js( ! empty( $settings[ 'iq_' . $type . '_is_chart_horizontal' ] ) && $settings[ 'iq_' . $type . '_is_chart_horizontal' ] === 'yes' ); ?>'){
											let decimal = parseInt('<?php echo esc_js( ! empty( $settings[ 'iq_' . $type . '_chart_xaxis_prefix_postfix_decimal_point' ] ) ? $settings[ 'iq_' . $type . '_chart_xaxis_prefix_postfix_decimal_point' ] : 0 ); ?>') || 0;
											if("<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_xaxis_format_number' ] ) === 'yes'; ?>"){
												val = graphinNumberWithCommas(val,'<?php echo esc_js( $local_string_type ); ?>',decimal)
											}
											else if("<?php echo esc_js( ! empty( $settings[ 'iq_' . $type . '_chart_xaxis_label_pointer' ] ) && esc_html( $settings[ 'iq_' . $type . '_chart_xaxis_label_pointer' ] ) === 'yes' ); ?>"
												&&  typeof graphinaAbbrNum  !== "undefined"){
												val = graphinaAbbrNum(val ,  parseInt("<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_xaxis_label_pointer_number' ] ); ?>") || 0 );
											}else{
												val = parseFloat(val).toFixed(decimal)
											}
											return '<?php echo esc_js( $x_label_prefix ); ?>' + val + '<?php echo esc_js( $x_label_postfix ); ?>';
										}else{
											val = '<?php echo esc_js( $x_label_prefix ); ?>' + val + '<?php echo esc_js( $x_label_postfix ); ?>'
											if(val){
												val = val.split(',')
											}
											return val;
										}
									}
									return val;
								}
							},
							tooltip: {
								enabled: "<?php echo esc_js( ! empty( $settings[ 'iq_' . $type . '_chart_xaxis_tooltip_show' ] ) && $settings[ 'iq_' . $type . '_chart_xaxis_tooltip_show' ] === 'yes' ); ?>"
							},
							crosshairs: {
								show: "<?php echo esc_js( ! empty( $settings[ 'iq_' . $type . '_chart_xaxis_crosshairs_show' ] ) && $settings[ 'iq_' . $type . '_chart_xaxis_crosshairs_show' ] === 'yes' ); ?>"
							}
						},
						yaxis: {
							opposite: '<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_yaxis_datalabel_position' ] ); ?>',
							decimalsInFloat: parseInt("<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_yaxis_datalabel_decimals_in_float' ] ); ?>"),
							labels: {
								show: '<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_yaxis_datalabel_show' ] ); ?>',
								rotate: parseInt('<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_yaxis_datalabel_rotate' ] ); ?>') || 0,
								offsetX: parseInt('<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_yaxis_datalabel_offset_x' ] ); ?>') || 0,
								offsetY: parseInt('<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_yaxis_datalabel_offset_y' ] ); ?>') || 0,
								style: {
									colors: '<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_font_color' ] ); ?>',
									fontSize: '<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_font_size' ]['size'] . $settings[ 'iq_' . $type . '_chart_font_size' ]['unit'] ); ?>',
									fontFamily: '<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_font_family' ] ); ?>',
									fontWeight: '<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_font_weight' ] ); ?>'
								}
							},
							tooltip: {
								enabled: "<?php echo esc_js( ! empty( $settings[ 'iq_' . $type . '_chart_yaxis_tooltip_show' ] ) && $settings[ 'iq_' . $type . '_chart_yaxis_tooltip_show' ] === 'yes' ); ?>"
							},
							crosshairs: {
								show: "<?php echo esc_js( ! empty( $settings[ 'iq_' . $type . '_chart_yaxis_crosshairs_show' ] ) && $settings[ 'iq_' . $type . '_chart_yaxis_crosshairs_show' ] === 'yes' ); ?>"
							}
						},
						colors: '<?php echo esc_js( $gradient ); ?>'.split('_,_'),
						fill: {
							type: '<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_fill_style_type' ] ); ?>',
							opacity: parseFloat('<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_fill_opacity' ] ); ?>'),
							colors: '<?php echo esc_js( $gradient ); ?>'.split('_,_'),
							gradient: {
								gradientToColors: '<?php echo esc_js( $second_gradient ); ?>'.split('_,_'),
								type: '<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_gradient_type' ] ); ?>',
								inverseColors: '<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_gradient_inversecolor' ] ); ?>',
								opacityFrom: parseFloat('<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_gradient_opacityFrom' ] ); ?>'),
								opacityTo: parseFloat('<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_gradient_opacityTo' ] ); ?>')
							},
							pattern: {
								style: '<?php echo esc_js( $fill_pattern ); ?>'.split('_,_'),
								width: 6,
								height: 6,
								strokeWidth: 2
							}
						},
						legend: {
							showForSingleSeries:true,
							show: '<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_legend_show' ] ); ?>',
							position: '<?php echo esc_js( ! empty( $settings[ 'iq_' . $type . '_chart_legend_position' ] ) ? $settings[ 'iq_' . $type . '_chart_legend_position' ] : 'bottom' ); ?>',
							horizontalAlign: '<?php echo esc_js( ! empty( $settings[ 'iq_' . $type . '_chart_legend_horizontal_align' ] ) ? $settings[ 'iq_' . $type . '_chart_legend_horizontal_align' ] : 'center' ); ?>',
							fontSize: '<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_font_size' ]['size'] . $settings[ 'iq_' . $type . '_chart_font_size' ]['unit'] ); ?>',
							fontFamily: '<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_font_family' ] ); ?>',
							fontWeight: '<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_font_weight' ] ); ?>',
							labels: {
								colors: '<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_font_color' ] ); ?>'
							},
							formatter:function (val){
								if(val){
									val = val.split(',')
								}
								return val;
							}
						},
						tooltip: {
							enabled: '<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_tooltip' ] ); ?>',
							theme: '<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_tooltip_theme' ] ); ?>',
							shared: '<?php echo esc_js( ! empty( $settings[ 'iq_' . $type . '_chart_tooltip_shared' ] ) && $settings[ 'iq_' . $type . '_chart_tooltip_shared' ] === 'yes' ? $settings[ 'iq_' . $type . '_chart_tooltip_shared' ] : '' ); ?>' ,
							intersect:!('<?php echo esc_js( ! empty( $settings[ 'iq_' . $type . '_chart_tooltip_shared' ] ) && $settings[ 'iq_' . $type . '_chart_tooltip_shared' ] === 'yes' ? $settings[ 'iq_' . $type . '_chart_tooltip_shared' ] : '' ); ?>'),
							style: {
								fontSize: '<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_font_size' ]['size'] . $settings[ 'iq_' . $type . '_chart_font_size' ]['unit'] ); ?>',
								fontFamily: '<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_font_family' ] ); ?>'
							},
							y:{

							}
						},
						responsive: [{
							breakpoint: 1024,
							options: {
								chart: {
									height: parseInt('<?php echo esc_js( ! empty( $settings[ 'iq_' . $type . '_chart_height_tablet' ] ) ? $settings[ 'iq_' . $type . '_chart_height_tablet' ] : $settings[ 'iq_' . $type . '_chart_height' ] ); ?>')
								},
								plotOptions: {
									bar: {
										horizontal: '<?php echo esc_js( ! empty( $settings[ 'iq_' . $type . '_is_chart_horizontal_tablet' ] ) && $settings[ 'iq_' . $type . '_is_chart_horizontal_tablet' ] === 'yes' ); ?>'
									}
								}
							}
						},
							{
								breakpoint: 674,
								options: {
									chart: {
										height: parseInt('<?php echo esc_js( ! empty( $settings[ 'iq_' . $type . '_chart_height_mobile' ] ) ? $settings[ 'iq_' . $type . '_chart_height_mobile' ] : $settings[ 'iq_' . $type . '_chart_height' ] ); ?>')
									},
									plotOptions: {
										bar: {
											horizontal: '<?php echo esc_js( ! empty( $settings[ 'iq_' . $type . '_is_chart_horizontal_mobile' ] ) && $settings[ 'iq_' . $type . '_is_chart_horizontal_mobile' ] === 'yes' ); ?>'
										}
									}
								}
							}
						]
					};

					if ("<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_yaxis_number_format' ] ) === 'yes'; ?>") {
						columnOptions.tooltip.y.formatter = function (val) {
							const enableNumberFormatting = '<?php echo esc_js( $enable_number_formatting ); ?>';
							const locale = '<?php echo esc_js( $locale ); ?>';

							const dataLabelShow = '<?php echo esc_js( ! empty( $settings[ 'iq_' . $type . '_chart_datalabels_format' ] ) && $settings[ 'iq_' . $type . '_chart_datalabels_format' ] === 'yes' ); ?>';
							const prefix = '<?php echo esc_js( ! empty( $settings[ 'iq_' . $type . '_chart_datalabel_format_prefix' ] ) ? $settings[ 'iq_' . $type . '_chart_datalabel_format_prefix' ] : '' ); ?>'
							const postfix = '<?php echo esc_js( ! empty( $settings[ 'iq_' . $type . '_chart_datalabel_format_postfix' ] ) ? $settings[ 'iq_' . $type . '_chart_datalabel_format_postfix' ] : '' ); ?>'

							if (enableNumberFormatting) {
								const numberFormatter = new Intl.NumberFormat(locale, {
									style: 'decimal',
									minimumFractionDigits: 0,
									maximumFractionDigits: 2,
									useGrouping: true,
								});
								val = numberFormatter.format(val);
							}

							if (dataLabelShow) {
								val = prefix + val + postfix;
							}

							return val;
						};
					}
					if('<?php echo esc_js( ! empty( $settings[ 'iq_' . $type . '_is_chart_horizontal' ] ) && $settings[ 'iq_' . $type . '_is_chart_horizontal' ] === 'yes' ); ?>'){
						columnOptions.tooltip.y.formatter = function(val){
							if('<?php echo esc_js( ! empty( $settings[ 'iq_' . $type . '_chart_xaxis_label_show' ] ) && $settings[ 'iq_' . $type . '_chart_xaxis_label_show' ] === 'yes' ); ?>'){
								let decimal = parseInt('<?php echo esc_js( ! empty( $settings[ 'iq_' . $type . '_chart_xaxis_prefix_postfix_decimal_point' ] ) ? $settings[ 'iq_' . $type . '_chart_xaxis_prefix_postfix_decimal_point' ] : 0 ); ?>') || 0;
								if("<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_xaxis_format_number' ] ) === 'yes'; ?>"){
									val = graphinNumberWithCommas(val,'<?php echo esc_js( $local_string_type ); ?>',decimal)
								}
								else if("<?php echo esc_js( ! empty( $settings[ 'iq_' . $type . '_chart_xaxis_label_pointer' ] ) && $settings[ 'iq_' . $type . '_chart_xaxis_label_pointer' ] === 'yes' ); ?>"
									&&  typeof graphinaAbbrNum  !== "undefined"){
									val = graphinaAbbrNum(val ,  parseInt("<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_xaxis_label_pointer_number' ] ); ?>") || 0 );
								}else{
									val = parseFloat(val).toFixed(decimal)
								}
								return '<?php echo esc_js( $x_label_prefix ); ?>' + val + '<?php echo esc_js( $x_label_postfix ); ?>';
							}
							return val;
						}
					}
					if ("<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_yaxis_label_show' ] ) === 'yes'; ?>" ) {
						columnOptions.yaxis.labels.formatter = function (val) {
							if('<?php echo esc_js( ! empty( $settings[ 'iq_' . $type . '_is_chart_horizontal' ] ) && $settings[ 'iq_' . $type . '_is_chart_horizontal' ] === 'yes' ); ?>'){
								val = '<?php echo esc_js( $y_label_prefix ); ?>' + val + '<?php echo esc_js( $y_label_postfix ); ?>';
								if(val){
									val = val.split(',')
								}
								return val;
							}
							let decimal = parseInt('<?php echo esc_js( ! empty( $settings[ 'iq_' . $type . '_chart_yaxis_prefix_postfix_decimal_point' ] ) ? $settings[ 'iq_' . $type . '_chart_yaxis_prefix_postfix_decimal_point' ] : 0 ); ?>') || 0;
							if("<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_yaxis_format_number' ] ) === 'yes'; ?>"){
								val = graphinNumberWithCommas(val,'<?php echo esc_js( $local_string_type ); ?>',decimal)
							}
							else if("<?php echo esc_js( ! empty( $settings[ 'iq_' . $type . '_chart_yaxis_label_pointer' ] ) && esc_html( $settings[ 'iq_' . $type . '_chart_yaxis_label_pointer' ] ) === 'yes' ); ?>"
								&&  typeof graphinaAbbrNum  !== "undefined"){
								val = graphinaAbbrNum(val ,  parseInt("<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_yaxis_label_pointer_number' ] ); ?>") || 0 );
							}else{
								val = parseFloat(val).toFixed(decimal)
							}
							return '<?php echo esc_js( $y_label_prefix ); ?>' + val + '<?php echo esc_js( $y_label_postfix ); ?>';
						}
					}
					columnOptions.yaxis.tickAmount = parseInt("<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_yaxis_datalabel_tick_amount' ] ); ?>");
					columnOptions.dataLabels.formatter = function (val) {
						if(Number.isNaN(val)){
							return  '';
						}
						if("<?php echo esc_js( ! empty( $settings[ 'iq_' . $type . '_chart_number_format_commas' ] ) && esc_html( $settings[ 'iq_' . $type . '_chart_number_format_commas' ] ) === 'yes' ); ?>" ){
							val = graphinNumberWithCommas(val,'<?php echo esc_js( $local_string_type ); ?>')
						}
						else if("<?php echo esc_js( ! empty( $settings[ 'iq_' . $type . '_chart_label_pointer_for_label' ] ) && esc_html( $settings[ 'iq_' . $type . '_chart_label_pointer_for_label' ] ) === 'yes' ); ?>"
							&&  typeof graphinaAbbrNum  !== "undefined"){
							val = graphinaAbbrNum(val ,  parseInt("<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_label_pointer_number_for_label' ] ); ?>") || 0 );
						}
						return '<?php echo esc_js( $data_label_prefix ); ?>' + val + '<?php echo esc_js( $data_label_postfix ); ?>';
					};

					if ("<?php echo esc_js( ! empty( $settings[ 'iq_' . $type . '_chart_tooltip_shared' ] ) && $settings[ 'iq_' . $type . '_chart_tooltip_shared' ] === 'yes' ? $settings[ 'iq_' . $type . '_chart_tooltip_shared' ] : '' ); ?>" ) {
						columnOptions.tooltip['enabledOnSeries'] = [<?php echo esc_js( $tooltip_series ); ?>];
					}
					if ("<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_yaxis_0_indicator_show' ] ) === 'yes'; ?>" ) {
						columnOptions['annotations'] = {
							yaxis: [
								{
									y: 0,
									strokeDashArray: parseInt("<?php echo esc_js( ! empty( $settings[ 'iq_' . $type . '_chart_yaxis_0_indicator_stroke_dash' ] ) ? $settings[ 'iq_' . $type . '_chart_yaxis_0_indicator_stroke_dash' ] : 0 ); ?>"),
									borderColor: '<?php echo esc_js( ! empty( $settings[ 'iq_' . $type . '_chart_yaxis_0_indicator_stroke_color' ] ) ? strval( $settings[ 'iq_' . $type . '_chart_yaxis_0_indicator_stroke_color' ] ) : '#000000' ); ?>'
								}
							]
						};
					}

					if("<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_xaxis_title_enable' ] === 'yes' ); ?>"){
						let style ={
							color:'<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_font_color' ] ); ?>',
							fontSize: '<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_font_size' ]['size'] . $settings[ 'iq_' . $type . '_chart_font_size' ]['unit'] ); ?>',
							fontFamily: '<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_font_family' ] ); ?>',
							fontWeight: '<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_font_weight' ] ); ?>',
						}
						let title = '<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_xaxis_title' ] ); ?>';
						let xaxisYoffset ='<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_xaxis_datalabel_position' ] ) === 'top'; ?>'  ? -95 : 0;
						if(typeof axisTitle !== "undefined"){
							axisTitle(columnOptions, 'xaxis' ,title, style ,xaxisYoffset);
						}
					}

					if("<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_yaxis_title_enable' ] === 'yes' ); ?>"){
						let style ={
							color:'<?php echo esc_js( $settings[ 'iq_' . $type . '_card_yaxis_title_font_color' ] ); ?>',
							fontSize: '<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_font_size' ]['size'] . $settings[ 'iq_' . $type . '_chart_font_size' ]['unit'] ); ?>',
							fontFamily: '<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_font_family' ] ); ?>',
							fontWeight: '<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_font_weight' ] ); ?>',
						}
						let title = '<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_yaxis_title' ] ); ?>';
						if(typeof axisTitle !== "undefined"){
							axisTitle(columnOptions, 'yaxis' ,title, style );
						}
					}

					if('<?php echo esc_js( ! empty( $settings[ 'iq_' . $type . '_chart_xaxis_enable_min_max' ] ) && $settings[ 'iq_' . $type . '_chart_xaxis_enable_min_max' ] === 'yes' ); ?>'){
						columnOptions.xaxis.tickAmount = parseInt("<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_xaxis_datalabel_tick_amount' ] ); ?>") || 6;
						columnOptions.xaxis.min = parseFloat('<?php echo esc_js( ! empty( $settings[ 'iq_' . $type . '_chart_xaxis_min_value' ] ) ? $settings[ 'iq_' . $type . '_chart_xaxis_min_value' ] : 0 ); ?>') || 0;
						columnOptions.xaxis.max = parseFloat('<?php echo esc_js( ! empty( $settings[ 'iq_' . $type . '_chart_xaxis_max_value' ] ) ? $settings[ 'iq_' . $type . '_chart_xaxis_max_value' ] : 0 ); ?>') || 200;
					}

					if('<?php echo esc_js( ! empty( $settings[ 'iq_' . $type . '_chart_yaxis_enable_min_max' ] ) && $settings[ 'iq_' . $type . '_chart_yaxis_enable_min_max' ] === 'yes' ); ?>'){
						columnOptions.yaxis.tickAmount = parseInt("<?php echo esc_js( $settings[ 'iq_' . $type . '_chart_yaxis_datalabel_tick_amount' ] ); ?>") || 6;
						columnOptions.yaxis.min = parseFloat('<?php echo esc_js( ! empty( $settings[ 'iq_' . $type . '_chart_yaxis_min_value' ] ) ? $settings[ 'iq_' . $type . '_chart_yaxis_min_value' ] : 0 ); ?>') || 0;
						columnOptions.yaxis.max = parseFloat('<?php echo esc_js( ! empty( $settings[ 'iq_' . $type . '_chart_yaxis_max_value' ] ) ? $settings[ 'iq_' . $type . '_chart_yaxis_max_value' ] : 0 ); ?>') || 200;
					}

					if (typeof initNowGraphina !== "undefined") {
						initNowGraphina(
							myElement,
							{
								ele: document.querySelector(".distributed_column-chart-<?php echo esc_attr( $main_id ); ?>"),
								options: columnOptions,
								series: [{name: '', data: []}],
								animation: true,
								setting_date:<?php echo Plugin::$instance->editor->is_edit_mode() ? wp_json_encode( $settings ) : wp_json_encode( $ajax_settings ); ?>
							},
							'<?php echo esc_attr( $main_id ); ?>'
						);
					}
					if (window.ajaxIntervalGraphina_<?php echo esc_attr( $main_id ); ?> !== undefined) {
						clearInterval(window.ajaxIntervalGraphina_<?php echo esc_attr( $main_id ); ?>)
					}
				})()
			</script>
			<?php
		}
		if ( $settings[ 'iq_' . $type . '_chart_data_option' ] !== 'manual' ) {
			if ( $settings[ 'iq_' . $type . '_chart_data_option' ] === 'forminator' ) {
				graphina_ajax_reload( true, array(), $type, $main_id );
			} elseif ( graphina_pro_active() ) {
				graphina_ajax_reload( $call_ajax, array(), $type, $main_id );
			}
		}
	}
}

Plugin::instance()->widgets_manager->register( new Distributed_Column_Chart() );