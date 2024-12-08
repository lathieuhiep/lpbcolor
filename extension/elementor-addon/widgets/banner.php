<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class LPBColor_Elementor_Banner extends Widget_Base
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
        return 'lpbcolor-banner';
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
        return esc_html__('Banner', 'lpbcolor');
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
        return 'eicon-banner';
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
        return ['banner', 'image', 'content' ];
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
            'width_content',
            [
                'label' => esc_html__( 'Width', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1200,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'rem' => [
                        'min' => 0,
                        'max' => 12,
                    ],
                ],
                'default' => [
                    'unit' => 'rem',
                    'size' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .element-banner__content' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .element-banner',
            ]
        );

        $this->add_control(
            'heading',
            [
                'label' => esc_html__( 'Tiêu đề', 'lpbcolor' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'placeholder' => esc_html__( 'Nhập văn bản', 'lpbcolor' ),
                'label_block' => true,
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
            'list_icon', [
                'label' => esc_html__( 'Icon', 'lpbcolor' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

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

        // link section
        $this->start_controls_section(
            'link_section',
            [
                'label' => esc_html__( 'Link', 'lpbcolor' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'btn_image', [
                'label' => esc_html__( 'Nút hình ảnh', 'lpbcolor' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => esc_html__( 'Link', 'lpbcolor' ),
                'type' => Controls_Manager::URL,
                'placeholder' => esc_html__( 'https://your-link.com', 'lpbcolor' ),
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                    'custom_attributes' => '',
                ],
            ]
        );

        $this->end_controls_section();

        // slider section
        $this->start_controls_section(
            'slider_section',
            [
                'label' => esc_html__( 'Slider', 'lpbcolor' ),
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

        $this->end_controls_section();

        // style section
        $this->start_controls_section(
            'style_list',
            [
                'label' => esc_html__( 'Danh sách', 'lpbcolor' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'list_title_color',
            [
                'label'     =>  esc_html__( 'Color', 'lpbcolor' ),
                'type'      =>  Controls_Manager::COLOR,
                'selectors' =>  [
                    '{{WRAPPER}} .element-banner__content ul li' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'list_title_typography',
                'label' => esc_html__( 'Typography', 'lpbcolor' ),
                'selector' => '{{WRAPPER}} .element-banner__content ul li',
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
        <div class="element-banner">
            <div class="element-banner__content">
                <h2 class="heading theme-color-secondary fw-900">
                    <?php echo wp_kses_post( $settings['heading'] ); ?>
                </h2>

                <?php if ( $settings['list'] ) : ?>
                <ul class="reset-list">
                    <?php foreach ( $settings['list'] as $item ) : ?>
                        <li class="d-flex align-items-center gap-3">
                            <div class="icon d-flex align-items-center justify-content-center">
                                <?php echo wp_get_attachment_image( $item['list_icon']['id'] ); ?>
                            </div>

                            <span class="text"><?php echo esc_html( $item['list_title'] ) ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>

                <?php
                if ( ! empty( $settings['link']['url'] ) ) :
                    $this->add_link_attributes( 'link', $settings['link'] );
                    ?>
                    <a class="link" <?php $this->print_render_attribute_string( 'link' ); ?>>
                        <?php echo wp_get_attachment_image( $settings['btn_image']['id'], 'medium' ); ?>
                    </a>
                <?php endif; ?>
            </div>

            <div class="element-banner__owl owl-carousel owl-theme">
                <?php foreach ( $settings['gallery'] as $image  ): ?>
                    <div class="thumbnail" data-featured-image="<?php echo esc_url( wp_get_attachment_image_url($image['id'], 'full') ); ?>">
                        <?php echo wp_get_attachment_image( $image['id'], 'medium' ); ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php
    }
}