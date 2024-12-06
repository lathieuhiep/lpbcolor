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
		'title'  => esc_html__( 'Columns', 'lpbcolor' ),
		'fields' => array(
            array(
                'id'     => 'opt_footer_introduce',
                'type'   => 'fieldset',
                'title'  => esc_html__( 'Giới thiệu', 'lpbcolor' ),
                'fields' => array(
                    array(
                        'id'      => 'logo',
                        'type'    => 'media',
                        'title'   => esc_html__( 'Upload Image Logo', 'lpbcolor' ),
                        'library' => 'image',
                        'url'     => false
                    ),

                    array(
                        'id'    => 'heading',
                        'type'  => 'text',
                        'title' => esc_html__( 'Tiêu đề', 'lpbcolor' ),
                        'default' => esc_html__('CÔNG TY CỔ PHẦN SƠN BEECOLOR VIỆT NAM', 'lpbcolor')
                    ),

                    array(
                        'id'    => 'sub_heading',
                        'type'  => 'text',
                        'title' => esc_html__( 'Tiêu đề phụ', 'lpbcolor' ),
                        'default' => esc_html__('Hải Âu 16-89, Vinhomes Ocean Park, Gia Lâm, Hà Nội', 'lpbcolor')
                    ),
                ),
            ),

            array(
                'id'     => 'opt_footer_contact',
                'type'   => 'fieldset',
                'title'  => esc_html__( 'Liên hệ', 'lpbcolor' ),
                'fields' => array(
                    array(
                        'id'     => 'phone_list',
                        'type'   => 'repeater',
                        'title'  => esc_html__( 'Danh sách số điện thoại', 'lpbcolor' ),
                        'fields' => array(
                            array(
                                'id'    => 'number',
                                'type'  => 'text',
                                'title' => '',
                            ),
                        ),
                    ),

                    array(
                        'id'    => 'link_website',
                        'type'  => 'link',
                        'title' => esc_html__( 'Địa chỉ website', 'lpbcolor' ),
                        'default'  => array(
                            'url'    => 'bcolor.vn',
                            'text'   => 'www.bcolor.vn',
                            'target' => '_blank'
                        ),
                    ),

                    array(
                        'id'    => 'address',
                        'type'  => 'text',
                        'title' => esc_html__( 'Địa chỉ', 'lpbcolor' ),
                        'default' => esc_html__('Hải Âu 16-89, Vinhomes Ocean Park, Gia Lâm, Hà Nội', 'lpbcolor')
                    ),
                ),
            ),

            array(
                'id'     => 'opt_footer_quick_link',
                'type'   => 'fieldset',
                'title'  => esc_html__( 'Liên kết nhanh', 'lpbcolor' ),
                'fields' => array(
                    array(
                        'id'          => 'menus',
                        'type'        => 'select',
                        'title'       =>  esc_html__( 'Chọn menu', 'lpbcolor' ),
                        'chosen'      => true,
                        'multiple'    => true,
                        'placeholder' =>  esc_html__( 'Chọn menu', 'lpbcolor' ),
                        'options'     => 'menus'
                    ),

                    array(
                        'id'    => 'link_tiktok',
                        'type'  => 'link',
                        'title' => esc_html__( 'Địa chỉ TikTok', 'lpbcolor' ),
                        'default'  => array(
                            'url'    => '#',
                            'text'   => 'TikTok',
                            'target' => '_blank'
                        ),
                    ),
                ),
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