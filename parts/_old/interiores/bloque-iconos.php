<?php

$num_cols=get_sub_field('num_cols');
if($num_cols==2):
    $cols="col-xs-12 col-md-6";
elseif($num_cols==3):
    $cols="col-xs-12 col-md-6 col-lg-4";
elseif($num_cols==4):
    $cols="col-xs-12 col-md-6 col-lg-3";
elseif($num_cols==6):
    $cols="col-xs-12 col-md-4 col-lg-2";
else:
    $cols="col-xs-12 col-md-4";
endif;

?>


<div <?php echo Seccion_ID(); ?>  class="bloque-interior  bloque-2coltexto bloque-interior<?php echo $cont_home.'-'.$contador ?>">
    <?php include(get_stylesheet_directory().'/parts/misc/ancla.php'); ?>
    <div class="container">
        <?php include(get_stylesheet_directory().'/parts/misc/titulo.php'); ?>
        <div class="row">
            <?php while(have_rows('iconos_wrap')): the_row(); ?>
                <div class="<?php echo $cols ?> icono_col">
                    <div class="img_icono">
                        <?php
                        $icono=get_sub_field('icono_img');
                        echo wp_get_attachment_image($icono);
                        ?>
                    </div>
                    <h3 class="titulo_icono">
                        <?php echo get_sub_field('titulo') ?>
                    </h3>
                </div>
            <?php endwhile; ?>

        </div>
        <?php include(get_stylesheet_directory().'/parts/misc/boton.php'); ?>

    </div>
</div>