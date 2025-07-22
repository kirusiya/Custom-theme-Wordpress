<?php
$fondo_custom=get_sub_field('personalizar_fondo');
if($fondo_custom):
//var_dump($fondo);
while(have_rows('fondo_custom')): the_row();
while(have_rows('fondo')): the_row();
$color=get_sub_field('color_de_texto');
$color_bg=get_sub_field('color_de_fondo');
$img_id=get_sub_field('imagen_de_fondo');
$bg=wp_get_attachment_url($img_id, 'full');
$img_no_full=get_sub_field('no_full');
$alineacion_hor=get_sub_field('alineacion');
$alineacion_vert=get_sub_field('alineacion_ver');
endwhile;
endwhile;
if($color_bg):
    $color_bg_style='background-color:'.$color_bg;
else:
    $color_bg_style='background-color:#fff';
endif;
if($img_id):
    $bg="background-image:url(".$bg.') ';
    if($alineacion_hor):
        if($alineacion_hor=='derecha'):
            $hor='right';
        elseif($alineacion_hor=='izquierda'):
            $hor='left';
        elseif($alineacion_hor=='centro'):
            $hor='center';
        else:
            $hor='center';
        endif;
    else:
        $hor='center';
    endif;
    if($alineacion_vert):
        if($alineacion_vert=='arriba'):
            $vert='top';
        elseif($alineacion_vert=='abajo'):
            $vert='bottom';
        elseif($alineacion_vert=='centro'):
            $vert='center';
        else:
            $vert='center';
        endif;

    else:
        $vert='center';
    endif;
    $bg_position="background-position:".$hor.' '.$vert;
    if($img_no_full):
        $bg_size="background-size: auto";
    else:
        $bg_size="background-size: cover";
    endif;

else:
    $bg="";
endif;
//$style=$color_bg_style.'; '.$bg.'; '.$bg_size.'; '.$bg_position.'; ';
//$style_bg='style="'.$style.'"';
//$style_bg='';

?>

        <style type="text/css">
        <?php if($color): //Si se ha seleccionado un color para el texto ?>
            .bloque-interior<?php echo $cont_home.'-'.$contador ?>,
            .bloque-interior<?php echo $cont_home.'-'.$contador ?> h1,
            .bloque-interior<?php echo $cont_home.'-'.$contador ?> h2,
            .bloque-interior<?php echo $cont_home.'-'.$contador ?> h3,
            .bloque-interior<?php echo $cont_home.'-'.$contador ?> h4,
            .bloque-interior<?php echo $cont_home.'-'.$contador ?> h5,
            .bloque-interior<?php echo $cont_home.'-'.$contador ?> h6,
            .bloque-interior<?php echo $cont_home.'-'.$contador ?> strong,
            .bloque-interior<?php echo $cont_home.'-'.$contador ?> p,
            .bloque-interior<?php echo $cont_home.'-'.$contador ?> li{
                color:<?php echo $color ?>
            }
            .bloque-interior<?php echo $cont_home.'-'.$contador ?> ul > li:before{
                background-color:<?php echo $color ?>
            }
        <?php endif; ?>
        <?php if($color_bg): //si se ha seleccionado un color para el fondo ?>
            .bloque-interior<?php echo $cont_home.'-'.$contador ?>{
                <?php echo $color_bg_style ?>
            }
        <?php endif; ?>
        <?php if($img_id): //si se ha seleccionado una imagen  rpara el fondo  ?>

        .bloque-interior<?php echo $cont_home.'-'.$contador ?>{
                <?php echo $bg.'; '.$bg_size.'; '.$bg_position.' '?>
            }
        <?php endif; ?>
        </style>


<?php endif; ?>



