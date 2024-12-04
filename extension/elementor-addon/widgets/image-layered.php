<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Utils;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class LPBColor_Elementor_Image_Layered extends Widget_Base
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
        return 'lpbcolor-image-layered';
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
        return esc_html__('Lớp hình ảnh', 'lpbcolor');
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
        return 'eicon-image-box';
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
        return ['image', 'content' ];
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
        // content section
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Nội dung', 'lpbcolor' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => esc_html__( 'Ảnh', 'lpbcolor' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
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

        $this->add_control(
            'stt',
            [
                'label' => __( 'Số thứ tự', 'lpbcolor' ),
                'type'  => Controls_Manager::NUMBER,
                'min' => 1,
                'default' => 1,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__( 'Tiêu đề', 'lpbcolor' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__( 'Tiêu đề', 'lpbcolor' ),
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => esc_html__( 'Mô tả', 'lpbcolor' ),
                'type' => Controls_Manager::WYSIWYG,
                'default' => esc_html__( 'Mô tả', 'lpbcolor' ),
            ]
        );

        $this->end_controls_section();

        // box style
        $this->start_controls_section(
            'box_style_section',
            [
                'label' => esc_html__( 'Hộp chứa', 'lpbcolor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'image_width',
            [
                'label' => esc_html__( 'Width', 'lpbcolor' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 100,
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                    'vw' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .element-image-layered img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_height',
            [
                'label' => esc_html__( 'Height', 'lpbcolor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem', 'vh', 'custom' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 500,
                    ],
                    'vh' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .element-image-layered img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_object_fit',
            [
                'label' => esc_html__( 'Đối tượng phù hợp', 'lpbcolor' ),
                'type' => Controls_Manager::SELECT,
                'condition' => [
                    'image_height[size]!' => '',
                ],
                'options' => [
                    '' => esc_html__( 'Mặc định', 'lpbcolor' ),
                    'fill' => esc_html__( 'Lấp đầy', 'lpbcolor' ),
                    'cover' => esc_html__( 'Bao bọc', 'lpbcolor' ),
                    'contain' => esc_html__( 'Chứa', 'lpbcolor' ),
                    'scale-down' => esc_html__( 'Thu nhỏ', 'lpbcolor' ),
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .element-image-layered img' => 'object-fit: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_object_position',
            [
                'label' => esc_html__( 'Ví trí của đối tượng', 'lpbcolor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'center center' => esc_html__( 'Chính giữa', 'lpbcolor' ),
                    'center left' => esc_html__( 'Ở giữa bên trái', 'lpbcolor' ),
                    'center right' => esc_html__( 'Ở giữa bên phải', 'lpbcolor' ),
                    'top center' => esc_html__( 'Trên cùng ở giữa', 'lpbcolor' ),
                    'top left' => esc_html__( 'Trên cùng bên trái', 'lpbcolor' ),
                    'top right' => esc_html__( 'Trên cùng bên phải', 'lpbcolor' ),
                    'bottom center' => esc_html__( 'Phía dưới ở giữa', 'lpbcolor' ),
                    'bottom left' => esc_html__( 'Phía dưới bên trái', 'lpbcolor' ),
                    'bottom right' => esc_html__( 'Phía dưới bên phải', 'lpbcolor' ),
                ],
                'default' => 'center center',
                'selectors' => [
                    '{{WRAPPER}} .element-image-layered img' => 'object-position: {{VALUE}};',
                ],
                'condition' => [
                    'image_height[size]!' => '',
                    'image_object_fit' => [ 'cover', 'contain', 'scale-down' ],
                ],
            ]
        );

        $this->end_controls_section();

        // stt style
        $this->start_controls_section(
            'stt_style_section',
            [
                'label' => esc_html__( 'Số thứ tự', 'lpbcolor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'stt_color',
            [
                'label'     =>  esc_html__( 'Màu chữ', 'lpbcolor' ),
                'type'      =>  Controls_Manager::COLOR,
                'selectors' =>  [
                    '{{WRAPPER}} .element-image-layered .stt' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'stt_typography',
                'label' => esc_html__( 'Typography', 'lpbcolor' ),
                'selector' => '{{WRAPPER}} .element-image-layered .stt',
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

        $this->add_control(
            'title_color',
            [
                'label'     =>  esc_html__( 'Màu chữ', 'lpbcolor' ),
                'type'      =>  Controls_Manager::COLOR,
                'selectors' =>  [
                    '{{WRAPPER}} .element-image-layered .title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__( 'Typography', 'lpbcolor' ),
                'selector' => '{{WRAPPER}} .element-image-layered .title',
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
                    '{{WRAPPER}} .element-image-layered .content' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'label' => esc_html__( 'Typography', 'lpbcolor' ),
                'selector' => '{{WRAPPER}} .element-image-layered',
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
        <div class="element-image-layered">
            <div class="thumbnail">
                <?php echo wp_get_attachment_image( $settings['image']['id'], $settings['image_size'] ); ?>
            </div>

            <div class="body d-flex justify-content-end flex-column gap-4">
                <p class="stt theme-color-secondary fw-900 mb-0">
                    <?php echo esc_html( str_pad($settings['stt'], 2, '0', STR_PAD_LEFT) ); ?>
                </p>

                <h3 class="title theme-color-white mb-0">
                    <?php echo esc_html( $settings['title'] ); ?>
                </h3>

                <div class="content theme-color-white">
                    <?php echo wpautop( $settings['description'] ); ?>
                </div>
            </div>
        </div>
        <?php
    }
}