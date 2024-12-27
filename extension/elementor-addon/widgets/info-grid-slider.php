<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Utils;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class LPBColor_Elementor_Info_Grid_Slider extends Widget_Base
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
        return 'lpbcolor-info-grid-slider';
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
        return esc_html__('Thông tin hình ảnh slider', 'lpbcolor');
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
        return 'eicon-slides';
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
            'gallery',
            [
                'label' => esc_html__( 'Thêm ảnh', 'textdomain' ),
                'type' => Controls_Manager::GALLERY,
                'show_label' => false,
                'default' => [],
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
            'image_box_style_section',
            [
                'label' => esc_html__( 'Hộp chứa ảnh', 'lpbcolor' ),
                'tab' => Controls_Manager::TAB_STYLE,
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
                    '{{WRAPPER}} .element-info-grid-slider .feature-image img' => 'height: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .element-info-grid-slider .feature-image img' => 'object-fit: {{VALUE}};',
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
                    '{{WRAPPER}} .element-info-grid-slider .feature-image img' => 'object-position: {{VALUE}};',
                ],
                'condition' => [
                    'image_height[size]!' => '',
                    'image_object_fit' => [ 'cover', 'contain', 'scale-down' ],
                ],
            ]
        );

        $this->add_control(
            'image_box_order',
            [
                'label' => esc_html__('Đổi vị trí', 'lpbcolor'),
                'type' => Controls_Manager::SWITCHER,
                'default' => '',
                'label_on' => esc_html__('Có', 'lpbcolor'),
                'label_off' => esc_html__('Không', 'lpbcolor'),
                'return_value' => 'yes',
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
        $galleries = $settings['gallery'];
        $image_box_order = $settings['image_box_order'];

    ?>
        <div class="element-info-grid-slider">
            <div class="row row-gap-3">
                <div class="col-12 col-md-6 <?php echo esc_attr( $image_box_order == 'yes' ? 'order-2 right-box' : 'order-2 order-md-1 left-box' ); ?>">
                    <div class="feature-image owl-carousel owl-theme">
                        <?php
                        if ( $galleries ) :
                            foreach ( $galleries as $gallery ) :
                        ?>
                            <div class="item d-block" data-image="<?php echo esc_url( wp_get_attachment_image_url( $gallery['id'], 'full' ) ); ?>">
                                <?php echo wp_get_attachment_image( $gallery['id'], $settings['image_size'] ); ?>
                            </div>
                        <?php
                            endforeach;
                        endif;
                        ?>
                    </div>
                </div>

                <div class="col-12 col-md-6 order-1">
                    <div class="body">
                        <h4 class="title">
                            <?php echo esc_html( $settings['title'] ); ?>
                        </h4>

                        <div class="content text-justify">
                            <?php echo wpautop( $settings['description'] ); ?>
                        </div>
                    </div>

                    <div class="thumbnail-grid">
                        <?php
                        if ( $galleries ) :
                            foreach ( $galleries as $index => $gallery ) :
                                ?>
                                <div class="thumbnail" data-index="<?php echo esc_attr( $index ); ?>">
                                    <?php echo wp_get_attachment_image( $gallery['id'], 'medium' ); ?>
                                </div>
                            <?php
                            endforeach;
                        endif;
                        ?>
                    </div>
                </div>
            </div>

            <div class="popup">
                <div class="popup-content d-flex align-items-center">
                    <button class="btn close">
                        <i class="fa-solid fa-xmark"></i>
                    </button>

                    <img class="popup-image" src="" alt="Popup Image">

                    <div class="popup-nav">
                        <button class="btn prev">
                            <i class="fa-solid fa-angle-left"></i>
                        </button>
                        <button class="btn next">
                            <i class="fa-solid fa-angle-right"></i>
                        </button>
                    </div>

                    <div class="popup-count"></div>
                </div>
            </div>
        </div>
        <?php
    }
}