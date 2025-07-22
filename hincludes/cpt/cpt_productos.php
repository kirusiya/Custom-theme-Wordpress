<?php

function productos()
{
    $labels = array(
        'name'                => __('Productos', 'materialwp'),
        'singular_name'       => __('Producto', 'materialwp'),
        'menu_name'           => __('Productos', 'materialwp'),
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

    $slug = get_option( 'cupa_cpt_productos' );
    if( ! $slug ) {
        $slug = 'productos';
    }

    $args = array(
        'label'               => __('productos', 'materialwp'),
        'labels'              => $labels,
        'supports'            => array('title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields'),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 4,
        'menu_icon'           => 'dashicons-cart',
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
        'rewrite'             => array( 'slug' => $slug ),
    );

    register_post_type('productos', $args);

    $labels = array(
        'name'              => __('Galerías', 'materialwp'),
        'singular_name'     => __('Galería', 'materialwp'),
        'search_items'      => __('Buscar', 'materialwp'),
        'all_items'         => __('Todos', 'materialwp'),
        'parent_item'       => __('Parent', 'materialwp'),
        'parent_item_colon' => __('Parent:', 'materialwp'),
        'edit_item'         => __('Editar', 'materialwp'),
        'update_item'       => __('Actualizar', 'materialwp'),
        'add_new_item'      => __('Añadir', 'materialwp'),
        'new_item_name'     => __('Nuevo nombre', 'materialwp'),
        'menu_name'         => __('Galerías', 'materialwp'),
    );

    register_taxonomy('galeria', array('productos'), array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'galeria' ),
    ));

    $labels = array(
        'name'              => __('Gamas', 'materialwp'),
        'singular_name'     => __('Gama', 'materialwp'),
        'search_items'      => __('Buscar', 'materialwp'),
        'all_items'         => __('Todas', 'materialwp'),
        'parent_item'       => __('Parent', 'materialwp'),
        'parent_item_colon' => __('Parent:', 'materialwp'),
        'edit_item'         => __('Editar', 'materialwp'),
        'update_item'       => __('Actualizar', 'materialwp'),
        'add_new_item'      => __('Añadir', 'materialwp'),
        'new_item_name'     => __('Nuevo nombre', 'materialwp'),
        'menu_name'         => __('Gamas', 'materialwp'),
    );

    $slug = get_option( 'cupa_cpt_gamas' );
    if( ! $slug ) {
        $slug = 'gama';
    }

    register_taxonomy('gama', array('productos', 'proyectos'), array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => $slug ),
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

    $slug = get_option( 'cupa_cpt_aplicaciones' );
    if( ! $slug ) {
        $slug = 'aplicacion';
    }

    register_taxonomy('aplicacion', array('proyectos','productos'), array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => $slug ),
    ));

    $labels = array(
        'name'              => __('Espacios', 'materialwp'),
        'singular_name'     => __('Espacio', 'materialwp'),
        'search_items'      => __('Buscar', 'materialwp'),
        'all_items'         => __('Todos', 'materialwp'),
        'parent_item'       => __('Parent', 'materialwp'),
        'parent_item_colon' => __('Parent:', 'materialwp'),
        'edit_item'         => __('Editar', 'materialwp'),
        'update_item'       => __('Actualizar', 'materialwp'),
        'add_new_item'      => __('Añadir', 'materialwp'),
        'new_item_name'     => __('Nuevo nombre', 'materialwp'),
        'menu_name'         => __('Espacios', 'materialwp'),
    );

    $slug = get_option( 'cupa_cpt_espacios' );
    if( ! $slug ) {
        $slug = 'espacio';
    }

    register_taxonomy('espacio', array('productos'), array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => $slug ),
    ));

    $labels = array(
        'name'              => __('Colores', 'materialwp'),
        'singular_name'     => __('Color', 'materialwp'),
        'search_items'      => __('Buscar', 'materialwp'),
        'all_items'         => __('Todas', 'materialwp'),
        'parent_item'       => __('Parent', 'materialwp'),
        'parent_item_colon' => __('Parent:', 'materialwp'),
        'edit_item'         => __('Editar', 'materialwp'),
        'update_item'       => __('Actualizar', 'materialwp'),
        'add_new_item'      => __('Añadir', 'materialwp'),
        'new_item_name'     => __('Nuevo nombre', 'materialwp'),
        'menu_name'         => __('Colores', 'materialwp'),
    );

    register_taxonomy('color', array('productos'), array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'color' ),
    ));

    $labels = array(
        'name'              => __('Acabados', 'materialwp'),
        'singular_name'     => __('Acabado', 'materialwp'),
        'search_items'      => __('Buscar', 'materialwp'),
        'all_items'         => __('Todos', 'materialwp'),
        'parent_item'       => __('Parent', 'materialwp'),
        'parent_item_colon' => __('Parent:', 'materialwp'),
        'edit_item'         => __('Editar', 'materialwp'),
        'update_item'       => __('Actualizar', 'materialwp'),
        'add_new_item'      => __('Añadir', 'materialwp'),
        'new_item_name'     => __('Nuevo nombre', 'materialwp'),
        'menu_name'         => __('Acabados', 'materialwp'),
    );

    register_taxonomy('acabado', array('productos'), array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'acabado' ),
    ));

    $labels = array(
        'name'              => __('Materiales', 'materialwp'),
        'singular_name'     => __('Material', 'materialwp'),
        'search_items'      => __('Buscar', 'materialwp'),
        'all_items'         => __('Todos', 'materialwp'),
        'parent_item'       => __('Parent', 'materialwp'),
        'parent_item_colon' => __('Parent:', 'materialwp'),
        'edit_item'         => __('Editar', 'materialwp'),
        'update_item'       => __('Actualizar', 'materialwp'),
        'add_new_item'      => __('Añadir', 'materialwp'),
        'new_item_name'     => __('Nuevo nombre', 'materialwp'),
        'menu_name'         => __('Materiales', 'materialwp'),
    );

    register_taxonomy('material', array('productos'), array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'material' ),
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

    register_taxonomy( 'tag', array('productos'), array(
        'hierarchical'          => false,
        'labels'                => $labels,
        'show_ui'               => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'tag' ),
    ));

}
add_action('init', 'productos', 0);
