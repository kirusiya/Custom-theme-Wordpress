<?php

function ventajas()
{
    $labels = array(
        'name'                => __('Ventajas', 'materialwp'),
        'singular_name'       => __('Ventaja', 'materialwp'),
        'menu_name'           => __('Ventajas', 'materialwp'),
        'parent_item_colon'   => __('Parent', 'materialwp'),
        'all_items'           => __('Todos', 'materialwp'),
        'view_item'           => __('ver', 'materialwp'),
        'add_new_item'        => __('Añadir', 'materialwp'),
        'add_new'             => __('Añadir nuevo', 'materialwp'),
        'edit_item'           => __('Editar', 'materialwp'),
        'update_item'         => __('Actualizar', 'materialwp'),
        'search_items'        => __('Buscar', 'materialwp'),
        'not_found'           => __('No encontrado', 'materialwp'),
        'not_found_in_trash'  => __('Not found in Trash', 'materialwp'),
    );

    $args = array(
        'label'               => __('ventajas', 'materialwp'),
        'labels'              => $labels,
        'supports'            => array('title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields'),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 4,
        'menu_icon'           => 'dashicons-star-filled',
        'can_export'          => true,
        'has_archive'         => false,
        'exclude_from_search' => true,
        'publicly_queryable'  => false,
        'capability_type'     => 'page',
    );

    register_post_type('ventajas', $args);
}
add_action('init', 'ventajas', 0);
