<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class LPBColor_Elementor_Grid_Media_Info_Box extends Widget_Base
{

    /**
     * Get widget name.
     *
     * Retrieve oEmbed widget name.
     *
     * @access public
     * @return string Widget name.
     */
    public function get_name(): string
    {
        return 'lpbcolor-grid-media-info-box';
    }

    /**
     * Get widget title.
     *
     * Retrieve oEmbed widget title.
     *
     * @access public
     * @return string Widget title.
     */
    public function get_title(): string
    {
        return esc_html__('Grid Media Info Box', 'lpbcolor');
    }

    /**
     * Get widget icon.
     *
     * Retrieve oEmbed widget icon.
     *
     * @access public
     * @return string Widget icon.
     */
    public function get_icon(): string
    {
        return 'eicon-gallery-grid';
    }

    /**
     * Get widget keywords.
     *
     * Retrieve the list of keywords the oEmbed widget belongs to.
     *
     * @access public
     * @return array Widget keywords.
     */
    public function get_keywords(): array
    {
        return ['grid', 'image', 'media', 'content' ];
    }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the oEmbed widget belongs to.
     *
     * @access public
     * @return array Widget categories.
     */
    public function get_categories(): array
    {
        return ['my-theme'];
    }

    /**
     * Register oEmbed widget controls.
     *
     * Add input fields to allow the user to customize the widget settings.
     *
     * @access protected
     */
    protected function register_controls(): void
    {
        // layout section
        $this->start_controls_section(
            'layout_section',
            [
                'label' => esc_html__( 'Layout', 'lpbcolor' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_responsive_control(
            'grid_columns',
            [
                'label' => esc_html__( 'Cột', 'lpbcolor' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'step' => 1,
                'default' => 4,
                'selectors' => [
                    '{{WRAPPER}} .element-grid-media-info-box' => '--grid-columns: repeat({{VALUE}}, minmax(0, 1fr));',
                ],
            ]
        );

        $this->add_responsive_control(
            'column_gap',
            [
                'label' => esc_html__( 'Grid column gap', 'lpbcolor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', 'rem' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'rem',
                    'size' => 2,
                ],
                'selectors' => [
                    '{{WRAPPER}} .element-grid-media-info-box' => '--column-gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'row_gap',
            [
                'label' => esc_html__( 'Grid row gap', 'lpbcolor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', 'rem' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'rem',
                    'size' => 2,
                ],
                'selectors' => [
                    '{{WRAPPER}} .element-grid-media-info-box' => '--row-gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // content section
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Nội dung', 'lpbcolor' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'image_size',
            [
                'label' => esc_html__( 'Độ phân giải ảnh', 'lpbcolor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'large',
                'options' => lpbcolor_image_size_options(),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'list_title', [
                'label' => esc_html__( 'Tiêu đề', 'lpbcolor' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'List Title' , 'lpbcolor' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'list_image', [
                'label' => esc_html__( 'Image', 'lpbcolor' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'list_content', [
                'label' => esc_html__( 'Nội dung', 'lpbcolor' ),
                'type' => Controls_Manager::WYSIWYG,
                'default' => esc_html__( 'Nội dung' , 'lpbcolor' ),
                'show_label' => false,
            ]
        );

        // list
        $this->add_control(
            'list',
            [
                'label' => esc_html__( 'Danh sách', 'lpbcolor' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'list_title' => esc_html__( 'Title #1', 'lpbcolor' ),
                    ],
                    [
                        'list_title' => esc_html__( 'Title #2', 'lpbcolor' ),
                    ],
                ],
                'title_field' => '{{{ list_title }}}',
            ]
        );

        $this->end_controls_section();

        // title style
        $this->start_controls_section(
            'title_style_section',
            [
                'label' => esc_html__( 'Tiêu đề', 'lpbcolor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__( 'Typography', 'lpbcolor' ),
                'selector' => '{{WRAPPER}} .element-grid-media-info-box .title',
            ]
        );

        $this->end_controls_section();

        // content style
        $this->start_controls_section(
            'content_style_section',
            [
                'label' => esc_html__( 'Nội dung', 'lpbcolor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'content_color',
            [
                'label'     =>  esc_html__( 'Màu chữ', 'lpbcolor' ),
                'type'      =>  Controls_Manager::COLOR,
                'selectors' =>  [
                    '{{WRAPPER}} .element-grid-media-info-box .content' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'label' => esc_html__( 'Typography', 'lpbcolor' ),
                'selector' => '{{WRAPPER}} .element-grid-media-info-box .content',
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render oEmbed widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @access protected
     */
    protected function render(): void
    {
        $settings = $this->get_settings_for_display();

    ?>
        <div class="element-grid-media-info-box">
            <?php foreach ( $settings['list'] as $item ) : ?>

            <div class="item elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>">
                <?php if ( !empty( $item['list_image']['id'] ) ) : ?>
                    <div class="item__thumbnail text-center">
                        <?php
                        echo wp_get_attachment_image( $item['list_image']['id'], $settings['image_size'], false,
                            array(
                                'class' => 'd-inline-block'
                            ) );
                        ?>
                    </div>
                <?php endif; ?>

                <div class="item__body">
                    <?php if ( $item['list_title'] ) : ?>
                        <h3 class="title fs-14 theme-color-white text-center">
                            <?php echo esc_html( $item['list_title'] ); ?>
                        </h3>
                    <?php endif; ?>

                    <?php if ( $item['list_content'] ) : ?>
                        <div class="content text-align-justify">
                            <?php echo wpautop( $item['list_content'] ); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <?php endforeach; ?>
        </div>
        <?php
    }
}