<?php

use Elementor\Repeater;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class LPBColor_Elementor_Table_Press extends Widget_Base {

    public function get_categories(): array {
        return array( 'my-theme' );
    }

    public function get_name(): string {
        return 'lpbcolor-table';
    }

    public function get_title(): string {
        return esc_html__( 'Table Press', 'lpbcolor' );
    }

    public function get_icon(): string {
        return 'eicon-table';
    }

    protected function register_controls(): void {

        // Content section
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Nội dung', 'lpbcolor' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'custom_panel_alert',
            [
                'type' => Controls_Manager::ALERT,
                'alert_type' => 'info',
                'heading' => esc_html__( 'Lưu ý', 'lpbcolor' ),
                'content' => esc_html__( 'Hỗ trợ style cho plugin TablePress. Chèn shortcode của TablePress để sử dụng', 'lpbcolor' ),
            ]
        );

        $this->add_control(
            'shortcode',
            [
                'label' => esc_html__( 'Nhập shortcode TablePress', 'lpbcolor' ),
                'type' => Controls_Manager::TEXTAREA,
                'placeholder' => '[table id=1 /]',
                'default' => '',
            ]
        );

        $this->end_controls_section();
    }

    protected function render(): void {
        $settings = $this->get_settings_for_display();
        $shortcode = $settings['shortcode'];

        if ( empty( $shortcode ) ) {
            return;
        }

        $shortcode = do_shortcode( shortcode_unautop( $shortcode ) );
    ?>
        <div class="element-table-press">
            <?php echo $shortcode; ?>
        </div>
    <?php

    }

}
