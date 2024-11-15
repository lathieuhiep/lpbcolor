<?php
/*
*---------------------------------------------------------------------
* This file create and contains the template post_type meta elements
*---------------------------------------------------------------------
*/

add_action('init', 'lpbcolor_create_project', 10);

function lpbcolor_create_project() {

    /* Start post type template */
    $labels = array(   
        'name'                  =>  _x( 'Dự án', 'post type general name', 'lpbcolor' ),
        'singular_name'         =>  _x( 'Dự án', 'post type singular name', 'lpbcolor' ),
        'menu_name'             =>  _x( 'Dự án', 'admin menu', 'lpbcolor' ),
        'name_admin_bar'        =>  _x( 'Danh sách Dự án', 'add new on admin bar', 'lpbcolor' ),
        'add_new'               =>  _x( 'Thêm mới', 'Dự án', 'lpbcolor' ),
        'add_new_item'          =>  esc_html__( 'Thêm Dự án', 'lpbcolor' ),
        'edit_item'             =>  esc_html__( 'Sửa Dự án', 'lpbcolor' ),
        'new_item'              =>  esc_html__( 'Dự án mới', 'lpbcolor' ),
        'view_item'             =>  esc_html__( 'Xem dự án', 'lpbcolor' ),
        'all_items'             =>  esc_html__( 'Tất cả dự án', 'lpbcolor' ),
        'search_items'          =>  esc_html__( 'Tìm kiếm dự án', 'lpbcolor' ),
        'not_found'             =>  esc_html__( 'Không tìm thấy', 'lpbcolor' ),
        'not_found_in_trash'    =>  esc_html__( 'Không tìm thấy trong thùng rác', 'lpbcolor' ),
        'parent_item_colon'     =>  ''
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'menu_icon'          => 'dashicons-open-folder',
        'capability_type'    => 'post',
        'rewrite'            => array('slug' => 'du-an' ),
        'has_archive'        => true,
        'hierarchical'       => true,
        'menu_position'      => 5,
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
    );

    register_post_type('lpbcolor_project', $args );
    /* End post type template */

    /* Start taxonomy */
    $taxonomy_labels = array(
        'name'              => _x( 'Danh mục dự án', 'taxonomy general name', 'lpbcolor' ),
        'singular_name'     => _x( 'Danh mục dự án', 'taxonomy singular name', 'lpbcolor' ),
        'search_items'      => __( 'Tìm kiếm danh mục', 'lpbcolor' ),
        'all_items'         => __( 'Tất cả danh mục', 'lpbcolor' ),
        'parent_item'       => __( 'Danh mục cha', 'lpbcolor' ),
        'parent_item_colon' => __( 'Danh mục cha:', 'lpbcolor' ),
        'edit_item'         => __( 'Sửa', 'lpbcolor' ),
        'update_item'       => __( 'Cập nhật', 'lpbcolor' ),
        'add_new_item'      => __( 'Thêm mới', 'lpbcolor' ),
        'new_item_name'     => __( 'Tên mới', 'lpbcolor' ),
        'menu_name'         => __( 'Danh mục', 'lpbcolor' ),
    );

    $taxonomy_args = array(

        'labels'            => $taxonomy_labels,
        'hierarchical'      => true,
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'danh-muc-du-an' ),
    );

    register_taxonomy( 'lpbcolor_project_cat', array( 'lpbcolor_project' ), $taxonomy_args );
    /* End taxonomy */

}