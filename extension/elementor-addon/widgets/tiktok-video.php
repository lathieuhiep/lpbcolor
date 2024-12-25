<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class LPBColor_Elementor_Tiktok_Video extends Widget_Base {

    public function get_categories(): array {
        return array( 'my-theme' );
    }

    public function get_name(): string {
        return 'lpbcolor-tiktok-video';
    }

    public function get_title(): string {
        return esc_html__( 'TikTok Video', 'lpbcolor' );
    }

    public function get_icon(): string {
        return 'eicon-video-camera';
    }

    protected function register_controls(): void {

        // Content section
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'TikTok Videos', 'lpbcolor' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'video_urls',
            [
                'label' => esc_html__( 'Video IDs', 'elementor' ),
                'type' => Controls_Manager::TEXTAREA,
                'placeholder' => esc_html__('Nhập URL video TikTok (phân tách bằng ngắt dòng)', 'lpbcolor'),
                'label_block' => true,
            ]
        );

        $this->end_controls_section();
    }

    protected function render(): void {
        if ( ! wp_script_is( 'tiktok-embed', 'enqueued' ) ) {
            wp_enqueue_script( 'tiktok-embed', 'https://www.tiktok.com/embed.js', [], null, true );
        }

        $settings = $this->get_settings_for_display();
        $video_urls = $settings['video_urls'] ? explode("\n", $settings['video_urls']) : null;

        if ( !empty( $video_urls ) ) :
        ?>
        <div class="element-tik-tok-video">
            <?php
            foreach ( $video_urls as $video_url ) :
                $video_url = trim($video_url);
                $video_id = basename(parse_url($video_url, PHP_URL_PATH));
            ?>
            <div class="item">
                <blockquote class="tiktok-embed" cite="<?php echo esc_url($video_url); ?>" data-video-id="<?php echo esc_attr($video_id); ?>"  style="max-width: 100%;min-width: 100%;">
                    <section>
                        <a target="_blank" title="Video TikTok" href="<?php echo esc_url($video_url); ?>">
                            <span>Video TikTok</span>
                        </a>
                    </section>
                </blockquote>
            </div>
            <?php endforeach; ?>
        </div>
        <?php
        endif;
    }
}
?>
