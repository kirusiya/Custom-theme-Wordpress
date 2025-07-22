<?php

function cronologia()
{
    $labels = array(
        'name'               => __('Cronología', 'materialwp'),
        'singular_name'      => __('Cronología', 'materialwp'),
        'menu_name'          => __('Cronología', 'materialwp'),
        'parent_item_colon'  => __('Parent', 'materialwp'),
        'all_items'          => __('Todos', 'materialwp'),
        'view_item'          => __('ver', 'materialwp'),
        'add_new_item'       => __('Añadir', 'materialwp'),
        'add_new'            => __('Añadir nuevo', 'materialwp'),
        'edit_item'          => __('Editar', 'materialwp'),
        'update_item'        => __('Actualizar', 'materialwp'),
        'search_items'       => __('Buscar', 'materialwp'),
        'not_found'          => __('No encontrado', 'materialwp'),
        'not_found_in_trash' => __('Not found in Trash', 'materialwp'),
    );

    $args = array(
        'label'               => __('cronologia', 'materialwp'),
        'labels'              => $labels,
        'supports'            => array('title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields'),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 4,
        'menu_icon'           => 'dashicons-calendar-alt',
        'can_export'          => true,
        'has_archive'         => false,
        'exclude_from_search' => true,
        'publicly_queryable'  => false,
        'capability_type'     => 'page',
    );

    register_post_type('cronologia', $args);

}
add_action('init', 'cronologia', 0);

/*
 * Add columns to dashboard CPT list
 */
add_filter( 'manage_cronologia_posts_columns', 'add_acf_columns_cronologia', 10, 1 );
function add_acf_columns_cronologia ( $columns ) {    
    return array_merge ( $columns, array ( 
        'ano' => __( 'Año' ),
    ) );
}

/*
 * Add html for columns to dashboard CPT list
 */
add_action ( 'manage_cronologia_posts_custom_column', 'html_custom_column_cronologia', 10, 2 );
function html_custom_column_cronologia ( $column, $post_id ) {
    if ( $column == 'ano' ) {
        echo get_field( 'ano', $post_id );
    }
}
