<?php
// optimize WordPress
add_action('init', 'lpbcolor_optimize_wordpress');
function lpbcolor_optimize_wordpress(): void {
    // Disable WordPress Emoji
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    add_filter( 'tiny_mce_plugins', 'lpbcolor_disable_emojis_tinymce' );

    // Disable WordPress REST API links
    remove_action('wp_head', 'rest_output_link_wp_head');
    remove_action('template_redirect', 'rest_output_link_header', 11);

    // Disable RSD link and WLW manifest link
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');

    // Disable WordPress version
    remove_action('wp_head', 'wp_generator');
}

function lpbcolor_disable_emojis_tinymce( $plugins ): array {
    if ( is_array( $plugins ) ) {
        return array_diff( $plugins, array( 'wpemoji' ) );
    } else {
        return array();
    }
}

// add property
add_action( 'wp_head', 'lpbcolor_opengraph', 5 );
function lpbcolor_opengraph(): void {
	global $post;

	if ( is_single() ) :
		if ( has_post_thumbnail( $post->ID ) ) :
			$img_src = get_the_post_thumbnail_url( get_the_ID(), 'full' );
		else :
			$img_src = get_theme_file_uri( '/images/no-image.png' );
		endif;

		$excerpt = $post->post_excerpt;

		if ( $excerpt ) :
			$excerpt = strip_tags( $post->post_excerpt );
			$excerpt = str_replace( "", "'", $excerpt );
		else :
			$excerpt = get_bloginfo( 'description' );
		endif;

		?>
		<meta property="og:url" content="<?php the_permalink(); ?>" />
		<meta property="og:type" content="website" />
		<meta property="og:title" content="<?php the_title(); ?>" />
		<meta property="og:description" content="<?php echo esc_attr( $excerpt ); ?>" />
		<meta property="og:image" content="<?php echo esc_url( $img_src ); ?>" />
	<?php
	endif;
}

// Sanitize Pagination
add_action( 'navigation_markup_template', 'lpbcolor_sanitize_pagination' );
function lpbcolor_sanitize_pagination( $lpbcolor_content ): string {
	// Remove role attribute
	$lpbcolor_content = str_replace( 'role="navigation"', '', $lpbcolor_content );

	// Remove h2 tag
	return preg_replace( '#<h2.*?>(.*?)<\/h2>#si', '', $lpbcolor_content );
}

// Walker for the main menu
add_filter( 'walker_nav_menu_start_el', 'lpbcolor_add_arrow',10,4);
function lpbcolor_add_arrow( $output, $item, $depth, $args ){
	if('primary' == $args->theme_location && $depth >= 0 ){
		if (in_array("menu-item-has-children", $item->classes)) {
			$output .='<span class="sub-menu-toggle"></span>';
		}
	}

	return $output;
}

// Custom Search Post
add_action( 'pre_get_posts', 'lpbcolor_include_custom_post_types_in_search_results' );
function lpbcolor_include_custom_post_types_in_search_results( $query ): void {
	if ( $query->is_main_query() && $query->is_search() && ! is_admin() ) {
		$query->set( 'post_type', array( 'post' ) );
	}
}

// check spam contact form 7
if ( function_exists('wpcf7') ) {
    add_filter('wpcf7_form_elements', 'lpbcolor_check_spam_form_cf7');
    function lpbcolor_check_spam_form_cf7($html): string {
        ob_start();
        ?>
        <div class="d-none">
            <input class="wpcf7-form-control wpcf7-text" aria-invalid="false" value="" type="text" name="spam-email" aria-label="">
        </div>
        <?php
        $content = ob_get_contents();
        ob_end_clean();
        return $html . $content;
    }

    // check field spam
    add_action('wpcf7_posted_data', 'lpbcolor_check_spam_form_cf7_valid');
    function lpbcolor_check_spam_form_cf7_valid($posted_data) {
        $submission = WPCF7_Submission::get_instance();
        $note_text = esc_html__('Đã có lỗi xảy ra', 'lpbcolor');

        if ( !empty($posted_data['spam-email']) || !isset($_POST['spam-email'])) {
            $submission->set_status( 'spam' );
            $submission->set_response( $note_text );
        }
        unset($posted_data['spam-email']);
        return $posted_data;
    }

    // validate phone
    add_filter('wpcf7_validate_tel', 'lpbcolor_custom_validate_sdt', 10, 2);
    add_filter('wpcf7_validate_tel*', 'lpbcolor_custom_validate_sdt', 10, 2);
    function lpbcolor_custom_validate_sdt($result, $tag) {
        $name = $tag->name;
        if ($name === 'phone') {
            $sdt = isset($_POST[$name]) ? wp_unslash($_POST[$name]) : '';
            if (!preg_match('/^0([0-9]{9,10})+$/D', $sdt)) {
                $result->invalidate($tag, 'Số điện thoại không hợp lệ.');
            }
        }
        return $result;
    }
}
