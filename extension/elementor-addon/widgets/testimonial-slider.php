<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class LPBColor_Elementor_Testimonial_Slider extends Widget_Base {
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

        if ( empty( $settings['gallery']) ) {
            return;
        }
    ?>

        <div class="element-testimonial-slider">
            <div class="item featured">
                <div class="featured-container">
                    <img src="<?php echo esc_url( wp_get_attachment_image_url( $settings['gallery'][0]['id'], 'large' ) ) ?>" alt="" class="featured-image">
                </div>
            </div>

            <div class="item thumbnails">
                <div class="thumbnail-container">
                    <?php foreach ( $settings['gallery'] as $image  ): ?>
                        <div class="thumbnail" data-featured-image="<?php echo esc_url( wp_get_attachment_image_url($image['id'], 'full') ); ?>">
                            <?php echo wp_get_attachment_image( $image['id'], 'medium', '', ['class' => 'thumbnail-image'] ); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

    <?php
    }
}