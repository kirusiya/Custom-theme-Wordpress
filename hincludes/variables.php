<?php
/*Este archivo está includo en header.php */
function get_hpage(){
    $id_noticias=get_field('noticias', 'options');
    $id_noticias=apply_filters( 'wpml_object_id', $id_noticias, 'page' );

    $id_eventos=get_field('eventos', 'options');
    $id_eventos=apply_filters( 'wpml_object_id', $id_eventos, 'page' );

    if(is_home()):
        $page_id=$id_noticias;
    elseif(is_singular('post')):
        $page_id=$id_noticias;

    elseif(is_post_type_archive('eventos')):
            $page_id=$id_eventos;
    elseif(is_singular('eventos')):
            $page_id=$id_eventos;
    else:
        $page_id=get_the_ID();
    endif;
    return $page_id;
}



