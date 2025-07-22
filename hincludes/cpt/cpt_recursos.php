<?php

function recursos()
{
    $labels = array(
        'name'                => __('Recursos', 'materialwp'),
        'singular_name'       => __('Recurso', 'materialwp'),
        'menu_name'           => __('Recursos', 'materialwp'),
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
        'label'               => __('recursos', 'materialwp'),
        'labels'              => $labels,
        'supports'            => array('title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields'),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 4,
        'menu_icon'           => 'dashicons-download',
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => false,
        'capability_type'     => 'page',
    );

    register_post_type('recursos', $args);

    $labels = array(
        'name'              => __('Tipos', 'materialwp'),
        'singular_name'     => __('Tipo', 'materialwp'),
        'search_items'      => __('Buscar', 'materialwp'),
        'all_items'         => __('Todos', 'materialwp'),
        'parent_item'       => __('Parent', 'materialwp'),
        'parent_item_colon' => __('Parent:', 'materialwp'),
        'edit_item'         => __('Editar', 'materialwp'),
        'update_item'       => __('Actualizar', 'materialwp'),
        'add_new_item'      => __('Añadir', 'materialwp'),
        'new_item_name'     => __('Nuevo nombre', 'materialwp'),
        'menu_name'         => __('Tipos', 'materialwp'),
    );
    register_taxonomy('tipo', array('recursos'), array(
        'hierarchical'      => true,
        'public'            => false,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'tipo' ),
    ));
}
add_action('init', 'recursos', 0);
