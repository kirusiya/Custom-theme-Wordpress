<?php
$container=get_sub_field('opciones_de_contenedor');
if($container=='Estrechar'):
    $cont='container container_estrecho';
elseif($container=='Ancho completo'):
    $cont='container-fluid';
elseif($container=='Estandar'):
    $cont='container';
else:
    $cont='container';
endif;
?>
<div <?php echo Seccion_ID(); ?> class="bloque-interior bloque-texto100 bloque-interior<?php echo $cont_home.'-'.$contador ?>"  >
    <?php include(get_stylesheet_directory().'/parts/misc/ancla.php'); ?>
    <div class="<?php echo $cont ?>">
        <div class="row">
                <div class="col-sm-12 texto-bloque">
                    <div class="contenido-texto-bloque">
                        <?php echo get_sub_field('texto') ?>
                    </div>
                </div>
        </div>
        <?php include(get_stylesheet_directory().'/parts/misc/boton.php'); ?>
    </div>
</div>