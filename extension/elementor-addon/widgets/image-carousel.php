<?php

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class LPBColor_Elementor_Image_Carousel extends Widget_Base
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
        return 'lpbcolor-image-carousel';
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
        return esc_html__('Slider Ảnh', 'lpbcolor');
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
        return 'eicon-slider-push';
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
        return ['slider', 'carousel' ];
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
        // slider
        $this->start_controls_section(
            'slider_section',
            [
                'label' => esc_html__( 'Slider', 'lpbcolor' ),
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
                'label' => esc_html__( 'Tiêu đề', 'paint' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'List Title' , 'paint' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'list_image',
            [
                'label' => esc_html__( 'Ảnh', 'paint' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'list_link',
            [
                'label'         =>  esc_html__( 'Link', 'paint' ),
                'type'          =>  Controls_Manager::URL,
                'label_block'   =>  true,
                'placeholder'   =>  esc_html__( 'https://your-link.com', 'paint' ),
                'default' => [
                    'url' => ''
                ],
            ]
        );

        $this->add_control(
            'list',
            [
                'label' => esc_html__( 'Danh sách', 'paint' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'list_title' => esc_html__( 'Tiêu đề #1', 'paint' )
                    ],
                    [
                        'list_title' => esc_html__( 'Tiêu đề #2', 'paint' )
                    ],
                ],
                'title_field' => '{{{ list_title }}}',
            ]
        );

        $this->end_controls_section();

        // carousel options
        $this->start_controls_section(
            'options_section',
            [
                'label' => esc_html__( 'Tùy chọn bổ sung', 'lpbcolor' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'loop',
            [
                'type'          =>  Controls_Manager::SWITCHER,
                'label'         =>  esc_html__('Lặp lại vô hạn', 'lpbcolor'),
                'label_off'     =>  esc_html__('Không', 'lpbcolor'),
                'label_on'      =>  esc_html__('Có', 'lpbcolor'),
                'return_value'  =>  'yes',
                'default'       =>  'yes',
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label'         =>  esc_html__('Tự động chạy', 'lpbcolor'),
                'type'          =>  Controls_Manager::SWITCHER,
                'label_off'     =>  esc_html__('Không', 'lpbcolor'),
                'label_on'      =>  esc_html__('Có', 'lpbcolor'),
                'return_value'  =>  'yes',
                'default'       =>  'no',
            ]
        );

        $this->add_control(
            'navigation',
            [
                'label' => esc_html__( 'Thanh điều hướng', 'lpbcolor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'arrows',
                'options' => [
                    'both'  => esc_html__( 'Mũi tên và Dấu chấm', 'lpbcolor' ),
                    'arrows'  => esc_html__( 'Mũi tên', 'lpbcolor' ),
                    'dots'  => esc_html__( 'Dấu chấm', 'lpbcolor' ),
                    'none' => esc_html__( 'Không', 'lpbcolor' ),
                ],
            ]
        );

        $this->end_controls_section();

        // responsive
        $this->start_controls_section(
            'responsive_section',
            [
                'label' => esc_html__( 'Responsive', 'lpbcolor' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'margin_item',
            [
                'label'     =>  esc_html__( 'Khoảng cách', 'lpbcolor' ),
                'type'      =>  Controls_Manager::NUMBER,
                'default'   =>  24,
                'min'       =>  0,
                'max'       =>  100,
                'step'      =>  1,
            ]
        );

        // greater 1200px
        $this->add_control(
            'min_width_1200',
            [
                'label'     =>  esc_html__( 'Độ rộng lớn hơn 1200px', 'lpbcolor' ),
                'type'      =>  Controls_Manager::HEADING,
                'separator' =>  'before',
            ]
        );

        $this->add_control(
            'item',
            [
                'label'     =>  esc_html__( 'Số lượng hiển thị', 'lpbcolor' ),
                'type'      =>  Controls_Manager::NUMBER,
                'default'   =>  5,
                'min'       =>  1,
                'max'       =>  100,
                'step'      =>  1,
            ]
        );

        // greater 992px
        $this->add_control(
            'min_width_992',
            [
                'label'     =>  esc_html__( 'Độ rộng lớn hơn 992px', 'lpbcolor' ),
                'type'      =>  Controls_Manager::HEADING,
                'separator' =>  'before',
            ]
        );

        $this->add_control(
            'item_992',
            [
                'label'     =>  esc_html__( 'Số lượng hiển thị', 'lpbcolor' ),
                'type'      =>  Controls_Manager::NUMBER,
                'default'   =>  3,
                'min'       =>  1,
                'max'       =>  100,
                'step'      =>  1,
            ]
        );

        // greater 768px
        $this->add_control(
            'min_width_768',
            [
                'label'     =>  esc_html__( 'Độ rộng lớn hơn 768px', 'lpbcolor' ),
                'type'      =>  Controls_Manager::HEADING,
                'separator' =>  'before',
            ]
        );

        $this->add_control(
            'margin_item_greater_768',
            [
                'label'     =>  esc_html__( 'Khoảng cách', 'lpbcolor' ),
                'type'      =>  Controls_Manager::NUMBER,
                'default'   =>  24,
                'min'       =>  0,
                'max'       =>  100,
                'step'      =>  1,
            ]
        );

        $this->add_control(
            'item_768',
            [
                'label'     =>  esc_html__( 'Số lượng hiển thị', 'lpbcolor' ),
                'type'      =>  Controls_Manager::NUMBER,
                'default'   =>  2,
                'min'       =>  1,
                'max'       =>  100,
                'step'      =>  1,
            ]
        );

        // greater 576px
        $this->add_control(
            'width_greater_576',
            [
                'label'     =>  esc_html__( 'Độ rộng lớn hơn 576px', 'lpbcolor' ),
                'type'      =>  Controls_Manager::HEADING,
                'separator' =>  'before',
            ]
        );

        $this->add_control(
            'item_greater_576',
            [
                'label'     =>  esc_html__( 'Số lượng hiển thị', 'lpbcolor' ),
                'type'      =>  Controls_Manager::NUMBER,
                'default'   =>  2,
                'min'       =>  1,
                'max'       =>  100,
                'step'      =>  1,
            ]
        );

        $this->add_control(
            'margin_item_greater_576',
            [
                'label'     =>  esc_html__( 'Khoảng cách', 'lpbcolor' ),
                'type'      =>  Controls_Manager::NUMBER,
                'default'   =>  12,
                'min'       =>  0,
                'max'       =>  100,
                'step'      =>  1,
            ]
        );

        // greater 480px
        $this->add_control(
            'width_greater_480',
            [
                'label'     =>  esc_html__( 'Độ rộng lớn hơn 480px', 'lpbcolor' ),
                'type'      =>  Controls_Manager::HEADING,
                'separator' =>  'before',
            ]
        );

        $this->add_control(
            'item_greater_480',
            [
                'label'     =>  esc_html__( 'Số lượng hiển thị', 'lpbcolor' ),
                'type'      =>  Controls_Manager::NUMBER,
                'default'   =>  2,
                'min'       =>  1,
                'max'       =>  100,
                'step'      =>  1,
            ]
        );

        $this->add_control(
            'margin_item_greater_480',
            [
                'label'     =>  esc_html__( 'Khoảng cách', 'lpbcolor' ),
                'type'      =>  Controls_Manager::NUMBER,
                'default'   =>  12,
                'min'       =>  0,
                'max'       =>  100,
                'step'      =>  1,
            ]
        );

        // less 480px
        $this->add_control(
            'max_width_item_less_480',
            [
                'label'     =>  esc_html__( 'Nhỏ hơn 480px', 'lpbcolor' ),
                'type'      =>  Controls_Manager::HEADING,
                'separator' =>  'before',
            ]
        );

        $this->add_control(
            'item_less_480',
            [
                'label'     =>  esc_html__( 'Số lượng hiển thị', 'lpbcolor' ),
                'type'      =>  Controls_Manager::NUMBER,
                'default'   =>  1,
                'min'       =>  1,
                'max'       =>  100,
                'step'      =>  1,
            ]
        );

        $this->add_control(
            'margin_item_less_480',
            [
                'label'     =>  esc_html__( 'Khoảng cách', 'lpbcolor' ),
                'type'      =>  Controls_Manager::NUMBER,
                'default'   =>  0,
                'min'       =>  0,
                'max'       =>  100,
                'step'      =>  1,
            ]
        );

        $this->end_controls_section();

        // style image box
        $this->start_controls_section(
            'section_style_box_image',
            [
                'label' => esc_html__( 'Hộp chứa hình ảnh', 'lpbcolor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'image_box_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'lpbcolor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .element-image-carousel .item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // style image
        $this->start_controls_section(
            'section_style_image',
            [
                'label' => esc_html__( 'Hình ảnh', 'lpbcolor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
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
                    '{{WRAPPER}} .element-image-carousel .item__thumbnail img' => 'width: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .element-image-carousel .item__thumbnail img' => 'height: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .element-image-carousel .item__thumbnail img' => 'object-fit: {{VALUE}};',
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
                    '{{WRAPPER}} .element-image-carousel .item__thumbnail img' => 'object-position: {{VALUE}};',
                ],
                'condition' => [
                    'image_height[size]!' => '',
                    'image_object_fit' => [ 'cover', 'contain', 'scale-down' ],
                ],
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

        // owl options
        $owl_options = [
            'loop' => ('yes' === $settings['loop']),
            'nav' => $settings['navigation'] == 'both' || $settings['navigation'] == 'arrows',
            'dots' => $settings['navigation'] == 'both' || $settings['navigation'] == 'dots',
            'autoplay' => ('yes' === $settings['autoplay']),
            'margin' => $settings['margin_item'],
            'responsive' => [
                '0' => array(
                    'items' => $settings['item_less_480'],
                    'margin' => $settings['margin_item_less_480']
                ),
                '480' => array(
                    'items' => $settings['item_greater_480'],
                    'margin' => $settings['margin_item_greater_480']
                ),
                '576' => array(
                    'items' => $settings['item_greater_576'],
                    'margin' => $settings['margin_item_greater_576']
                ),
                '768' => array(
                    'items' => $settings['item_768'],
                    'margin' => $settings['margin_item_greater_768']
                ),
                '992' => array(
                    'items' => $settings['item_992']
                ),
                '1200' => array(
                    'items' => $settings['item']
                ),
            ],
        ];
    ?>
        <div class="element-image-carousel custom-owl-carousel owl-carousel owl-theme" data-owl-options='<?php echo wp_json_encode( $owl_options ); ?>'>
            <?php
            foreach ( $settings['list'] as $index => $item  ):
                $imageId = $item['list_image']['id'];
                $url = $item['list_link']['url'];
            ?>
                <div class="item lpbcolor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>">
                    <?php if ( $imageId ) : ?>
                        <div class="item__thumbnail">
                            <?php
                            if ( !empty( $url ) ) :
                                $link_key = 'link_' . $index;
                                $this->add_link_attributes( $link_key, $item['list_link'] );
                            ?>
                                <a class="link" <?php $this->print_render_attribute_string( $link_key ); ?>></a>
                            <?php
                            endif;

                            echo wp_get_attachment_image( $imageId, $settings['image_size'] );
                            ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
        <?php
    }
}