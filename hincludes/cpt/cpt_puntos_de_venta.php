<?php

function puntos_de_venta()
{
    $labels = array(
        'name'                => __('Puntos de venta', 'materialwp'),
        'singular_name'       => __('Punto de venta', 'materialwp'),
        'menu_name'           => __('Puntos de venta', 'materialwp'),
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
        'label'               => __('puntos-de-venta', 'materialwp'),
        'labels'              => $labels,
        'supports'            => array('title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields'),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 4,
        'menu_icon'           => 'dashicons-store',
        'can_export'          => true,
        'has_archive'         => false,
        'exclude_from_search' => true,
        'publicly_queryable'  => false,
        'capability_type'     => 'page',
    );

    register_post_type('puntos-de-venta', $args);

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

    register_taxonomy('categorias_puntos_de_venta', array('puntos_de_venta'), array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'categorias_puntos_de_venta' ),
    ));

}

add_action('init', 'puntos_de_venta', 0);

/*
 * Add columns to dashboard CPT list
 */
 function add_acf_columns ( $columns ) {    
    return array_merge ( $columns, array ( 
        'url' => __( 'URL' ),
    ) );
 }
 add_filter ( 'manage_puntos-de-venta_posts_columns', 'add_acf_columns' );

/*
 * Add columns to dashboard CPT list
 */
 function exhibition_custom_column ( $column, $post_id ) {
    if ( $column == 'url' ) {
        $rand = rand( 0,999999 );
        $url = get_home_url().'/punto-de-venta/?'.get_post_field( 'post_name', $post_id );
        echo '
        <input type="text" value="'.$url.'" id="input-'.$rand.'" style="width:400px;">
        <br>
        <div style="max-width:100px;text-align:center;border:1px solid gray;padding:3px;margin-top:5px;margin-right:10px;float:left;"><a href="'.$url.'" target="_blank">IR a la página</a></div>
        <div onclick="copiarURL_'.$rand.'()" style="max-width:80px;text-align:center;border:1px solid gray;padding:3px;margin-top:5px;float:left;cursor:pointer;">Copiar URL</div>
        <script>
        function copiarURL_'.$rand.'() {
            var copyText = document.getElementById(\'input-'.$rand.'\');
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            document.execCommand("copy");
            alert("URL COPIADA AL PORTAPAPELES: \n\n" + copyText.value);}
        </script>
        ';
    }
 }
 add_action ( 'manage_puntos-de-venta_posts_custom_column', 'exhibition_custom_column', 10, 2 );
