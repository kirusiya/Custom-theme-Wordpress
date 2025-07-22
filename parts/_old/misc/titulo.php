<?php
while(have_rows('titulo_de_seccion')): the_row();
$titulo=get_sub_field('titulo');
$color_titulo=get_sub_field('color_del_titulo');
$alineacion=get_sub_field('alineacion');
endwhile;
if($alineacion=='Centro'):
    $ali="justify-content-center";
elseif($alineacion=='Izquierda'):
    $ali="justify-content-start";
elseif($alineacion=='Derecha'):
    $ali="justify-content-end";
else:
    $ali="justify-content-start";
endif;

if($titulo):
?>
<div class="titulo_seccion_wrap">
    <h2 class="d-flex <?php echo $ali ?>" <?php if($color_titulo): ?> style="color:<?php echo $color_titulo ?>" <?php endif;  ?>
        ><span><?php echo $titulo ?></span></h2>
</div>

<?php endif; ?>
