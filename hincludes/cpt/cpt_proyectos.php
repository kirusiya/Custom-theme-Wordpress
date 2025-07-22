<?php

function proyectos()
{
    $labels = array(
        'name'                => __('Proyectos', 'materialwp'),
        'singular_name'       => __('Proyecto', 'materialwp'),
        'menu_name'           => __('Proyectos', 'materialwp'),
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

    $slug = get_option( 'cupa_cpt_proyectos' );
    if( ! $slug ) {
        $slug = 'proyectos';
    }

    $args = array(
        'label'               => __('proyectos', 'materialwp'),
        'labels'              => $labels,
        'supports'            => array('title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields'),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 4,
        'menu_icon'           => 'dashicons-tagcloud',
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
        'rewrite'             => array( 'slug' => $slug ),
    );

    register_post_type('proyectos', $args);

    $labels = array(
        'name'              => __('Categorías', 'materialwp'),
        'singular_name'     => __('Categoría', 'materialwp'),
        'search_items'      => __('Buscar', 'materialwp'),
        'all_items'         => __('Todas las categorías', 'materialwp'),
        'parent_item'       => __('Parent Categoría', 'materialwp'),
        'parent_item_colon' => __('Parent Categoría:', 'materialwp'),
        'edit_item'         => __('Editar categoría', 'materialwp'),
        'update_item'       => __('Actualizar categoría', 'materialwp'),
        'add_new_item'      => __('Añadir categoría', 'materialwp'),
        'new_item_name'     => __('Nuevo nombre de categoría', 'materialwp'),
        'menu_name'         => __('Categorías', 'materialwp'),
    );

    register_taxonomy('categorias_proyecto', array('proyectos'), array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'categorias_proyecto' ),
    ));

    $labels = array(
        'name'                          => __( 'Etiquetas', 'taxonomy general name' ),
        'singular_name'                 => __( 'Etiqueta', 'taxonomy singular name' ),
        'search_items'                  => __( 'Buscar' ),
        'popular_items'                 => __( 'Más utilizadas' ),
        'all_items'                     => __( 'Todas' ),
        'parent_item'                   => null,
        'parent_item_colon'             => null,
        'edit_item'                     => __( 'Editar' ), 
        'update_item'                   => __( 'Actualizar' ),
        'add_new_item'                  => __( 'Añadir nueva' ),
        'new_item_name'                 => __( 'Nuevo nombre' ),
        'separate_items_with_commas'    => __( 'Separa las etiquetas con comas' ),
        'add_or_remove_items'           => __( 'Añadir o eliminar etiquetas' ),
        'choose_from_most_used'         => __( 'Elige entre las más utilizadas' ),
        'menu_name'                     => __( 'Etiquetas' ),
    ); 

    register_taxonomy( 'tag_proyectos', array('proyectos'), array(
        'hierarchical'          => false,
        'labels'                => $labels,
        'show_ui'               => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'tag_proyectos' ),
    ));

    $labels = array(
        'name'              => __('Aplicaciones', 'materialwp'),
        'singular_name'     => __('Aplicación', 'materialwp'),
        'search_items'      => __('Buscar', 'materialwp'),
        'all_items'         => __('Todas', 'materialwp'),
        'parent_item'       => __('Parent', 'materialwp'),
        'parent_item_colon' => __('Parent:', 'materialwp'),
        'edit_item'         => __('Editar', 'materialwp'),
        'update_item'       => __('Actualizar', 'materialwp'),
        'add_new_item'      => __('Añadir', 'materialwp'),
        'new_item_name'     => __('Nuevo nombre', 'materialwp'),
        'menu_name'         => __('Aplicaciones', 'materialwp'),
    );

    register_taxonomy('aplicacion', array('proyectos','productos'), array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'aplicacion' ),
    ));

}
add_action('init', 'proyectos', 0);
