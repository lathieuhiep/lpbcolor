<?php
// Remove gutenberg widgets
add_filter('use_widgets_block_editor', '__return_false');

/* Better way to add multiple widgets areas */
function lpbcolor_widget_registration($name, $id, $description = ''): void {
	register_sidebar( array(
		'name' => $name,
		'id' => $id,
		'description' => $description,
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	));
}

function lpbcolor_multiple_widget_init(): void {
	lpbcolor_widget_registration( esc_html__('Sidebar Main', 'lpbcolor'), 'sidebar-main' );

	lpbcolor_widget_registration( esc_html__('Sidebar Footer Column 1', 'lpbcolor'), 'sidebar-footer-column-1' );
	lpbcolor_widget_registration( esc_html__('Sidebar Footer Column 2', 'lpbcolor'), 'sidebar-footer-column-2' );
	lpbcolor_widget_registration( esc_html__('Sidebar Footer Column 3', 'lpbcolor'), 'sidebar-footer-column-3' );
	lpbcolor_widget_registration( esc_html__('Sidebar Footer Column 4', 'lpbcolor'), 'sidebar-footer-column-4' );
}

add_action('widgets_init', 'lpbcolor_multiple_widget_init');