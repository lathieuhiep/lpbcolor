<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class LPBColor_Elementor_Countdown_Timer extends Widget_Base {
    public function get_categories(): array {
        return array( 'my-theme' );
    }

    public function get_name(): string {
        return 'lpbcolor-countdown-timer';
    }

    public function get_title(): string {
        return esc_html__( 'Đếm ngược thời gian', 'lpbcolor' );
    }

    public function get_icon(): string {
        return 'eicon-countdown';
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
            'time_unit',
            [
                'label'   => __( 'Đơn vị', 'lpbcolor' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'days' => __( 'Ngày', 'lpbcolor' ),
                    'hours' => __( 'Giờ', 'lpbcolor' ),
                    'minutes' => __( 'Phút', 'lpbcolor' ),
                ],
                'default' => 'days',
            ]
        );

        $this->add_control(
            'time_value',
            [
                'label' => __( 'Thời gian', 'lpbcolor' ),
                'type'  => Controls_Manager::NUMBER,
                'min' => 1,
                'default' => 1,
            ]
        );

        $this->end_controls_section();
    }

    protected function render(): void {
        $settings = $this->get_settings_for_display();

        $time_value = $settings['time_value'];
        $time_unit = $settings['time_unit'];

        if ( $time_value <= 0 ) {
            return;
        }
    ?>
        <div class="element-countdown-timer"
             data-time-value="<?php echo esc_attr( $time_value ); ?>"
             data-time-unit="<?php echo esc_attr( $time_unit ); ?>"
        >
            <?php if ($time_unit == 'days'): ?>
                <div class="countdown-time days">
                    <span class="val val-days">00</span>
                    <span class="txt"><?php esc_html_e('Ngày', 'lpbcolor'); ?></span>
                </div>
            <?php endif; ?>

            <?php if ($time_unit != 'minutes'): ?>
                <div class="countdown-time hours">
                    <span class="val val-hours">00</span>
                    <span class="txt"><?php esc_html_e('Giờ', 'lpbcolor'); ?></span>
                </div>
            <?php endif; ?>

            <div class="countdown-time minutes">
                <span class="val val-minutes">00</span>
                <span class="txt"><?php esc_html_e('Phút', 'lpbcolor'); ?></span>
            </div>

            <div class="countdown-time seconds">
                <span class="val val-seconds">00</span>
                <span class="txt"><?php esc_html_e('Giây', 'lpbcolor'); ?></span>
            </div>
        </div>
    <?php
    }
}