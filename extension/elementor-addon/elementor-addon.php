<?php
// Register Category Elementor Addon
use Elementor\Plugin;

// create category
add_action( 'elementor/elements/categories_registered', 'lpbcolor_add_elementor_widget_categories' );
function lpbcolor_add_elementor_widget_categories( $elements_manager ): void {
	$elements_manager->add_category(
		'my-theme',
		[
			'title' => esc_html__( 'My Theme', 'lpbcolor' ),
			'icon'  => 'icon-goes-here',
		]
	);
}

// image size options
function lpbcolor_image_size_options(): array
{
    return [
        'thumbnail' => esc_html__( 'Thumbnail (150 x 150)', 'lpbcolor' ),
        'medium' => esc_html__( 'Medium(300 x 300)', 'lpbcolor' ),
        'medium_large' => esc_html__( 'Medium Large(768 x 0 chiều cao vô hạn', 'lpbcolor' ),
        'large' => esc_html__( 'Large(1024 x 1024)', 'lpbcolor' ),
        'full' => esc_html__( 'Full Size(Kích thước gốc)', 'lpbcolor' ),
    ];
}


// Register widgets
add_action( 'elementor/widgets/register', 'lpbcolor_register_widget_elementor_addon' );
function lpbcolor_register_widget_elementor_addon( $widgets_manager ): void {
	// include add on
    require get_parent_theme_file_path( '/extension/elementor-addon/widgets/grid-blocks.php' );
    require get_parent_theme_file_path( '/extension/elementor-addon/widgets/grid-media-info-box.php' );
    require get_parent_theme_file_path( '/extension/elementor-addon/widgets/image-carousel.php' );
    require get_parent_theme_file_path( '/extension/elementor-addon/widgets/info-card.php' );


//	require get_parent_theme_file_path( '/extension/elementor-addon/widgets/slides.php' );
//	require get_parent_theme_file_path( '/extension/elementor-addon/widgets/about-text.php' );
//	require get_parent_theme_file_path( '/extension/elementor-addon/widgets/post-carousel.php' );
//	require get_parent_theme_file_path( '/extension/elementor-addon/widgets/post-grid.php' );
//	require get_parent_theme_file_path( '/extension/elementor-addon/widgets/testimonial-slider.php' );
//	require get_parent_theme_file_path( '/extension/elementor-addon/widgets/carousel-images.php' );
//	require get_parent_theme_file_path( '/extension/elementor-addon/widgets/contact-form-7.php' );
//	require get_parent_theme_file_path( '/extension/elementor-addon/widgets/info-box.php' );

	// register add on
    $widgets_manager->register( new \LPBColor_Elementor_Grid_Blocks() );
    $widgets_manager->register( new \LPBColor_Elementor_Grid_Media_Info_Box() );
    $widgets_manager->register( new \LPBColor_Elementor_Image_Carousel() );
    $widgets_manager->register( new \LPBColor_Elementor_Info_Card() );

//	$widgets_manager->register( new \lpbcolor_Elementor_Slides() );
//	$widgets_manager->register( new \lpbcolor_Elementor_About_Text() );
//	$widgets_manager->register( new \lpbcolor_Elementor_Post_Carousel() );
//	$widgets_manager->register( new \lpbcolor_Elementor_Post_Grid() );
//	$widgets_manager->register( new \lpbcolor_Elementor_Testimonial_Slider() );
//	$widgets_manager->register( new \lpbcolor_Elementor_Carousel_Images() );
//	$widgets_manager->register( new \lpbcolor_Elementor_Contact_Form_7() );
//	$widgets_manager->register( new \lpbcolor_Elementor_Info_Box() );
}

// Register scripts
add_action( 'wp_enqueue_scripts', 'lpbcolor_elementor_scripts', 11 );
function lpbcolor_elementor_scripts(): void {
	$lpbcolor_check_elementor = get_post_meta( get_the_ID(), '_elementor_edit_mode', true );

	if ( $lpbcolor_check_elementor == 'builder' ) {
		// style
		wp_enqueue_style( 'owl.carousel', get_theme_file_uri( '/assets/libs/owl.carousel/owl.carousel.min.css' ), array(), '2.3.4' );

		wp_enqueue_style( 'lpbcolor-elementor-style', get_theme_file_uri( '/extension/elementor-addon/css/addons.min.css' ), array(), lpbcolor_get_version_theme() );

		// js
		wp_enqueue_script( 'owl.carousel', get_theme_file_uri( '/assets/libs/owl.carousel/owl.carousel.min.js' ), array( 'jquery' ), '2.3.4', true );

		wp_enqueue_script( 'lpbcolor-elementor-script', get_theme_file_uri( '/extension/elementor-addon/js/elementor-addon.min.js' ), array( 'jquery' ), '1.0.0', true );
	}
}