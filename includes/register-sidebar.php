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
}

add_action('widgets_init', 'lpbcolor_multiple_widget_init');