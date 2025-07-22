<?php
$contador=1;
if( have_rows('secciones') ):
    while ( have_rows('secciones') ) : the_row();

        include(get_template_directory() . '/parts/misc/fondo.php');
        if( get_row_layout() == 'texto_foto' ):
            include(get_stylesheet_directory().'/parts/interiores/bloque-texto_foto.php');
        elseif( get_row_layout() == '2_columnas_de_texto' ):
            include(get_stylesheet_directory().'/parts/interiores/bloque-2col-texto.php');
        elseif( get_row_layout() == 'texto_100' ):
            include(get_stylesheet_directory().'/parts/interiores/bloque-texto100.php');
        elseif( get_row_layout() == 'slide_custom' ):
            include(get_stylesheet_directory().'/parts/interiores/bloque-slide_custom.php');
        elseif( get_row_layout() == 'carrusel' ):
            include(get_stylesheet_directory().'/parts/interiores/bloque-carrusel.php');
        elseif( get_row_layout() == 'iconos' ):
            include(get_stylesheet_directory().'/parts/interiores/bloque-iconos.php');
        endif;
        $contador++;
    endwhile;
endif; ?>