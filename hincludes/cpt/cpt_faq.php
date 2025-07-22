<?php

function faq()
{
    $labels = array(
        'name'                => __('FAQs', 'materialwp'),
        'singular_name'       => __('FAQ', 'materialwp'),
        'menu_name'           => __('FAQs', 'materialwp'),
        'parent_item_colon'   => __('Parent', 'materialwp'),
        'all_items'           => __('Todas', 'materialwp'),
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
        'label'               => __('FAQs', 'materialwp'),
        'labels'              => $labels,
        'supports'            => array('title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields'),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 4,
        'menu_icon'           => 'dashicons-sos',
        'can_export'          => true,
        'has_archive'         => false,
        'exclude_from_search' => true,
        'publicly_queryable'  => false,
        'capability_type'     => 'page',
    );

    register_post_type('faq', $args);

    $labels = array(
        'name'              => __('Categorías', 'materialwp'),
        'singular_name'     => __('Categoría', 'materialwp'),
        'search_items'      => __('Buscar', 'materialwp'),
        'all_items'         => __('Todos', 'materialwp'),
        'parent_item'       => __('Parent', 'materialwp'),
        'parent_item_colon' => __('Parent:', 'materialwp'),
        'edit_item'         => __('Editar', 'materialwp'),
        'update_item'       => __('Actualizar', 'materialwp'),
        'add_new_item'      => __('Añadir', 'materialwp'),
        'new_item_name'     => __('Nuevo nombre', 'materialwp'),
        'menu_name'         => __('Categorías FAQs', 'materialwp'),
    );

    register_taxonomy('categoria-faqs', array('faq'), array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'categoria-faqs' ),
    ));

}
add_action('init', 'faq', 0);
