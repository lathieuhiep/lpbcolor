<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class lpbcolor_Elementor_Testimonial_Slider extends Widget_Base {
    public function get_categories(): array {
        return array( 'my-theme' );
    }

    public function get_name(): string {
        return 'lpbcolor-testimonial-slider';
    }

    public function get_title(): string {
        return esc_html__( 'Testimonial Slider', 'lpbcolor' );
    }

    public function get_icon(): string {
        return 'eicon-user-circle-o';
    }

    public function get_style_depends()
    {
        return ['e-swiper'];
    }

    protected function register_controls(): void {

        // Content testimonial
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
                'label' => esc_html__( 'Thêm ảnh', 'lpbcolor' ),
                'type' => Controls_Manager::GALLERY,
                'show_label' => false,
                'default' => [],
            ]
        );

        $this->end_controls_section();
    }

    protected function render(): void {
        $settings = $this->get_settings_for_display();
    ?>

        <div class="element-testimonial-slider">
            <div class="item">
                <div class="main-slider swiper-container">
                    <div class="swiper-wrapper">
                        <?php foreach ( $settings['gallery'] as $image  ): ?>
                            <div class="swiper-slide">
                                <?php echo wp_get_attachment_image( $image['id'], 'large' ); ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

            </div>

            <div class="item">
                <div class="thumb-slider swiper-container">
                    <div class="swiper-wrapper">
                        <?php foreach ( $settings['gallery'] as $image  ): ?>
                            <div class="swiper-slide">
                                <?php echo wp_get_attachment_image( $image['id'], 'medium' ); ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

            </div>
        </div>

    <?php
    }
}