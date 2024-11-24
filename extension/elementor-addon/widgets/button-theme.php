<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Utils;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class LPBColor_Elementor_Button extends Widget_Base
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
        return 'lpbcolor-button';
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
        return esc_html__('Nút bấm', 'lpbcolor');
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
        return 'eicon-button';
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
        return ['button', 'link' ];
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
            'text',
            [
                'label' => esc_html__( 'Văn bản', 'lpbcolor' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'placeholder' => esc_html__( 'Nhập văn bản', 'lpbcolor' ),
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => esc_html__( 'Link', 'lpbcolor' ),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => '#',
                ],
            ]
        );

        $this->add_control(
            'icon',
            [
                'label' => esc_html__( 'Icon', 'lpbcolor' ),
                'type' => Controls_Manager::ICONS,
                'skin' => 'inline',
                'label_block' => false,
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
            'content_align',
            [
                'label' => esc_html__( 'Alignment', 'lpbcolor' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'start'    => [
                        'title' => esc_html__( 'Căn trái', 'lpbcolor' ),
                        'icon' => "eicon-h-align-left",
                    ],
                    'center' => [
                        'title' => esc_html__( 'Căn giữa', 'lpbcolor' ),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'end' => [
                        'title' => esc_html__( 'Căn phải', 'lpbcolor' ),
                        'icon' => "eicon-h-align-right",
                    ],
                    'space-between' => [
                        'title' => esc_html__( 'Căn đều', 'lpbcolor' ),
                        'icon' => 'eicon-h-align-stretch',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .element-button' => 'justify-content: {{VALUE}};',
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
        ?>
        <div class="element-button">
            <div class="element-button__warp theme-color-white">
                <?php
                if ( ! empty( $settings['link']['url'] ) ) :
                    $this->add_link_attributes( 'link', $settings['link'] );

                ?>
                    <a class="link" <?php $this->print_render_attribute_string( 'link' ); ?>></a>
                <?php endif; ?>

                <div class="icon">
                    <div class="icon__box">
                        <?php Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                    </div>
                </div>

                <div class="text">
                    <?php echo esc_html( $settings['text'] ); ?>
                </div>
            </div>
        </div>
        <?php
    }
}