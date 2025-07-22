<?php

$separador=get_sub_field('separador');
if($separador):
$separador_class="cols_separador";
else:
$separador_class="";
endif;
$num_cols=get_sub_field('num_cols');
if($num_cols==2):
    $cols="col-xs-12 col-md-6";
elseif($num_cols==3):
    $cols="col-xs-12 col-md-6 col-lg-4";
elseif($num_cols==4):
    $cols="col-xs-12 col-md-6 col-lg-3";
else:
    $cols="col-sm-6";
endif;

?>


<div <?php echo Seccion_ID(); ?>  class="bloque-interior  bloque-2coltexto bloque-interior<?php echo $cont_home.'-'.$contador.' '.$separador_class ?>">
    <?php include(get_stylesheet_directory().'/parts/misc/ancla.php'); ?>
    <div class="container">
       <?php include(get_stylesheet_directory().'/parts/misc/titulo.php'); ?>
        <div class="row">
            <?php while(have_rows('columnas')): the_row(); ?>
            <div class="<?php echo $cols ?> texto-bloque">
                <div class="contenido-texto-bloque">
                    <?php echo get_sub_field('columna') ?>
                </div>
                <?php include(get_stylesheet_directory().'/parts/misc/boton.php'); ?>
            </div>
           <?php endwhile; ?>
        </div>
    </div>
</div>