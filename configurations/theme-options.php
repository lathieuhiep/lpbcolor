<?php
// A Custom function for get an option
if ( ! function_exists( 'lpbcolor_get_option' ) ) {
	function lpbcolor_get_option( $option = '', $default = null ) {
		$options = get_option( 'options' );

		return ( isset( $options[ $option ] ) ) ? $options[ $option ] : $default;
	}
}

// Control core classes for avoid errors
if ( class_exists( 'CSF' ) ) {
// Set a unique slug-like ID
	$lpbcolor_prefix   = 'options';
	$lpbcolor_my_theme = wp_get_theme();

	// Create options
	CSF::createOptions( $lpbcolor_prefix, array(
		'menu_title'          => esc_html__( 'Theme Options', 'lpbcolor' ),
		'menu_slug'           => 'theme-options',
		'menu_position'       => 2,
		'admin_bar_menu_icon' => 'dashicons-admin-generic',
		'framework_title'     => $lpbcolor_my_theme->get( 'Name' ) . ' ' . esc_html__( 'Options', 'lpbcolor' ),
		'footer_text'         => esc_html__( 'Thank you for using my theme', 'lpbcolor' ),
		'footer_after'        => '<pre>Contact me:<br />Zalo/Phone: 0975458209 - Skype: lathieuhiep - facebook: <a href="https://www.facebook.com/lathieuhiep" target="_blank">lathieuhiep</a></pre>',
	) );

	// Create a section general
	CSF::createSection( $lpbcolor_prefix, array(
		'title'  => esc_html__( 'General', 'lpbcolor' ),
		'icon'   => 'fas fa-cog',
		'fields' => array(
			// logo
			array(
				'id'      => 'opt_general_logo',
				'type'    => 'media',
				'title'   => esc_html__( 'Upload Image Logo', 'lpbcolor' ),
				'library' => 'image',
				'url'     => false
			),

			// show loading
			array(
				'id'         => 'opt_general_loading',
				'type'       => 'switcher',
				'title'      => esc_html__( 'website loader', 'lpbcolor' ),
				'text_on'    => esc_html__( 'Yes', 'lpbcolor' ),
				'text_off'   => esc_html__( 'No', 'lpbcolor' ),
				'text_width' => 80,
				'default'    => false
			),

			array(
				'id'         => 'opt_general_image_loading',
				'type'       => 'media',
				'title'      => esc_html__( 'Upload Image Loading', 'lpbcolor' ),
				'subtitle'   => esc_html__( 'Use file .git', 'lpbcolor' ) . ' <a href="https://loading.io/" target="_blank">loading.io</a>',
				'dependency' => array( 'opt_general_loading', '==', 'true' ),
				'url'        => false
			),

			// show back to top
			array(
				'id'         => 'opt_general_back_to_top',
				'type'       => 'switcher',
				'title'      => esc_html__( 'Use Back To Top', 'lpbcolor' ),
				'text_on'    => esc_html__( 'Yes', 'lpbcolor' ),
				'text_off'   => esc_html__( 'No', 'lpbcolor' ),
				'text_width' => 80,
				'default'    => true
			),
		)
	) );

	//
	// Create a section menu
	CSF::createSection( $lpbcolor_prefix, array(
		'title'  => esc_html__( 'Menu', 'lpbcolor' ),
		'icon'   => 'fas fa-bars',
		'fields' => array(
			// Sticky menu
			array(
				'id'         => 'opt_menu_sticky',
				'type'       => 'switcher',
				'title'      => esc_html__( 'Sticky menu', 'lpbcolor' ),
				'text_on'    => esc_html__( 'Yes', 'lpbcolor' ),
				'text_off'   => esc_html__( 'No', 'lpbcolor' ),
				'text_width' => 80,
				'default'    => true
			),

			// Show cart
			array(
				'id'         => 'opt_menu_cart',
				'type'       => 'switcher',
				'title'      => esc_html__( 'Cart', 'lpbcolor' ),
				'text_on'    => esc_html__( 'Yes', 'lpbcolor' ),
				'text_off'   => esc_html__( 'No', 'lpbcolor' ),
				'text_width' => 80,
				'default'    => true
			),
		)
	) );

	//
	// -> Create a section blog
	CSF::createSection( $lpbcolor_prefix, array(
		'id'    => 'opt_post_section',
		'icon'  => 'fas fa-blog',
		'title' => esc_html__( 'Post', 'lpbcolor' ),
	) );

	// Category Post
	CSF::createSection( $lpbcolor_prefix, array(
		'parent' => 'opt_post_section',
		'title'  => esc_html__( 'Category', 'lpbcolor' ),
		'description' => esc_html__( 'Use for archive, index, page search', 'lpbcolor' ),
		'fields' => array(
			// Sidebar
			array(
				'id'      => 'opt_post_cat_sidebar_position',
				'type'    => 'select',
				'title'   => esc_html__( 'Sidebar position', 'lpbcolor' ),
				'options' => array(
					'hide'  => esc_html__( 'Hide', 'lpbcolor' ),
					'left'  => esc_html__( 'Left', 'lpbcolor' ),
					'right' => esc_html__( 'Right', 'lpbcolor' ),
				),
				'default' => 'right'
			),

			// Per Row
			array(
				'id'      => 'opt_post_cat_per_row',
				'type'    => 'select',
				'title'   => esc_html__( 'Blog Per Row', 'lpbcolor' ),
				'options' => array(
					'3' => esc_html__( '3 Column', 'lpbcolor' ),
					'4' => esc_html__( '4 Column', 'lpbcolor' ),
				),
				'default' => '3'
			),
		)
	) );

	// Single Post
	CSF::createSection( $lpbcolor_prefix, array(
		'parent' => 'opt_post_section',
		'title'  => esc_html__( 'Single', 'lpbcolor' ),
		'fields' => array(
			array(
				'id'      => 'opt_post_single_sidebar_position',
				'type'    => 'select',
				'title'   => esc_html__( 'Sidebar position', 'lpbcolor' ),
				'options' => array(
					'hide'  => esc_html__( 'Hide', 'lpbcolor' ),
					'left'  => esc_html__( 'Left', 'lpbcolor' ),
					'right' => esc_html__( 'Right', 'lpbcolor' ),
				),
				'default' => 'right'
			),

			// Show related post
			array(
				'id'         => 'opt_post_single_related',
				'type'       => 'switcher',
				'title'      => esc_html__( 'Show related post', 'lpbcolor' ),
				'text_on'    => esc_html__( 'Yes', 'lpbcolor' ),
				'text_off'   => esc_html__( 'No', 'lpbcolor' ),
				'default'    => true,
				'text_width' => 80
			),

			// Limit related post
			array(
				'id'      => 'opt_post_single_related_limit',
				'type'    => 'number',
				'title'   => esc_html__( 'Limit related post', 'lpbcolor' ),
				'default' => 3,
			),
		)
	) );

	//
	// Create a section social network
	CSF::createSection( $lpbcolor_prefix, array(
		'title'  => esc_html__( 'Social Network', 'lpbcolor' ),
		'icon'   => 'fab fa-hive',
		'fields' => array(
			array(
				'id'      => 'opt_social_network',
				'type'    => 'repeater',
				'title'   => esc_html__( 'Social Network', 'lpbcolor' ),
				'fields'  => array(
					array(
						'id'      => 'icon',
						'type'    => 'icon',
						'title'   => esc_html__( 'Icon', 'lpbcolor' ),
						'default' => 'fab fa-facebook-f'
					),

					array(
						'id'    => 'url',
						'type'  => 'text',
						'title' => esc_html__('URL', 'lpbcolor'),
						'default' => '#'
					),
				),
				'default' => array(
					array(
						'icon' => 'fab fa-facebook-f',
						'url' => '#',
					),

					array(
						'icon' => 'fab fa-youtube',
						'url' => '#',
					),
				)
			),
		)
	) );

	//
	// -> Create a section footer
	CSF::createSection( $lpbcolor_prefix, array(
		'id'    => 'opt_footer_section',
		'icon'  => 'fas fa-stream',
		'title' => esc_html__( 'Footer', 'lpbcolor' ),
	) );

	// footer columns
	CSF::createSection( $lpbcolor_prefix, array(
		'parent' => 'opt_footer_section',
		'title'  => esc_html__( 'Columns Sidebar', 'lpbcolor' ),
		'fields' => array(
			// select columns
			array(
				'id'      => 'opt_footer_columns',
				'type'    => 'select',
				'title'   => esc_html__( 'Number of footer columns', 'lpbcolor' ),
				'options' => array(
					'0' => esc_html__( 'Hide', 'lpbcolor' ),
					'1' => 1,
					'2' => 2,
					'3' => 3,
					'4' => 4,
				),
				'default' => '4'
			),

			// column width 1
			array(
				'id'         => 'opt_footer_column_width_1',
				'type'       => 'slider',
				'title'      => esc_html__( 'Column width 1', 'lpbcolor' ),
				'default'    => 3,
				'min'        => 1,
				'max'        => 12,
				'dependency' => array( 'opt_footer_columns', '!=', '0' )
			),

			// column width 2
			array(
				'id'         => 'opt_footer_column_width_2',
				'type'       => 'slider',
				'title'      => esc_html__( 'Column width 2', 'lpbcolor' ),
				'default'    => 3,
				'min'        => 1,
				'max'        => 12,
				'dependency' => array( 'opt_footer_columns', 'not-any', '0,1' )
			),

			// column width 3
			array(
				'id'         => 'opt_footer_column_width_3',
				'type'       => 'slider',
				'title'      => esc_html__( 'Column width 3', 'lpbcolor' ),
				'default'    => 3,
				'min'        => 1,
				'max'        => 12,
				'dependency' => array( 'opt_footer_columns', 'not-any', '0,1,2' )
			),

			// column width 4
			array(
				'id'         => 'opt_footer_column_width_4',
				'type'       => 'slider',
				'title'      => esc_html__( 'Column width 4', 'lpbcolor' ),
				'default'    => 3,
				'min'        => 1,
				'max'        => 12,
				'dependency' => array( 'opt_footer_columns', 'not-any', '0,1,2,3' )
			),
		)
	) );

	// Copyright
	CSF::createSection( $lpbcolor_prefix, array(
		'parent' => 'opt_footer_section',
		'title'  => esc_html__( 'Copyright', 'lpbcolor' ),
		'fields' => array(
			// show
			array(
				'id'         => 'opt_footer_copyright_show',
				'type'       => 'switcher',
				'title'      => esc_html__( 'Show copyright', 'lpbcolor' ),
				'text_on'    => esc_html__( 'Yes', 'lpbcolor' ),
				'text_off'   => esc_html__( 'No', 'lpbcolor' ),
				'text_width' => 80,
				'default'    => true
			),

			// content
			array(
				'id'      => 'opt_footer_copyright_content',
				'type'    => 'wp_editor',
				'title'   => esc_html__( 'Content', 'lpbcolor' ),
				'media_buttons' => false,
				'default' => esc_html__( 'Copyright &copy; DiepLK', 'lpbcolor' )
			),
		)
	) );
}