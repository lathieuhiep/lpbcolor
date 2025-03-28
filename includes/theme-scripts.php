<?php
// Register Back-End script
add_action('admin_enqueue_scripts', 'lpbcolor_register_back_end_scripts');
function lpbcolor_register_back_end_scripts(): void {
	/* Start Get CSS Admin */
	wp_enqueue_style( 'admin', get_theme_file_uri( '/assets/css/admin.css' ) );
}

// Remove jquery migrate
add_action( 'wp_default_scripts', 'lpbcolor_remove_jquery_migrate' );
function lpbcolor_remove_jquery_migrate( $scripts ): void {
	if ( ! is_admin() && isset( $scripts->registered['jquery'] ) ) {
		$script = $scripts->registered['jquery'];
		if ( $script->deps ) {
			$script->deps = array_diff( $script->deps, array( 'jquery-migrate' ) );
		}
	}
}

// Register Front-End Styles
add_action('wp_enqueue_scripts', 'lpbcolor_register_front_end');

// Load preconnect and preload for fonts and fontawesome
add_action( 'wp_head', function() {
    // Preconnect and preload for Google Fonts
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">';
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
    echo '<link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;900&family=Roboto:wght@400;500&display=swap" as="style" onload="this.onload=null;this.rel=\'stylesheet\'">';

    // Preconnect and preload for Font Awesome
    echo '<link rel="preconnect" href="https://cdnjs.cloudflare.com">';
    echo '<link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>';
    echo '<link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" as="style" onload="this.onload=null;this.rel=\'stylesheet\'">';
}, 5);

function lpbcolor_register_front_end(): void {
	// remove style gutenberg
	wp_dequeue_style('wp-block-library');
	wp_dequeue_style('wp-block-library-theme');
	wp_dequeue_style( 'classic-theme-styles' );

	wp_dequeue_style('wc-blocks-style');
	wp_dequeue_style('storefront-gutenberg-blocks');

	/** Load css **/

	// bootstrap css
	wp_enqueue_style( 'bootstrap', get_theme_file_uri( '/assets/libs/bootstrap/bootstrap.min.css' ), array(), null );

	// style theme
	wp_enqueue_style( 'lpbcolor-style', get_theme_file_uri( '/assets/css/style-theme.min.css' ), array(), lpbcolor_get_version_theme() );

	// style post
	if ( lpbcolor_is_blog() ) {
		wp_enqueue_style( 'category-post', get_theme_file_uri( '/assets/css/post-type/post/archive.min.css' ), array(), lpbcolor_get_version_theme() );
	}

	if (is_singular('post')) {
		wp_enqueue_style( 'single-post', get_theme_file_uri( '/assets/css/post-type/post/single.min.css' ), array(), lpbcolor_get_version_theme() );
	}

	// style page 404
	if ( is_404() ) {
		wp_enqueue_style( 'page-404', get_theme_file_uri( '/assets/css/page-templates/page-404.min.css' ), array(), lpbcolor_get_version_theme() );
	}

	/** Load js **/

	// bootstrap js
	wp_enqueue_script( 'bootstrap', get_theme_file_uri( '/assets/libs/bootstrap/bootstrap.min.js' ), array('jquery'), null, true );

	// comment reply
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// custom js
	wp_enqueue_script( 'lpbcolor-custom', get_theme_file_uri( '/assets/js/custom.min.js' ), array('jquery'), lpbcolor_get_version_theme(), true );
}