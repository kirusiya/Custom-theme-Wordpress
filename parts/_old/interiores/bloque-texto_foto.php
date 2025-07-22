<?php
$img_id=get_sub_field('imagen');
$full=get_sub_field('full');
$invertir=get_sub_field('invertir');

if($invertir):
    $orientacion='bloque_invertir';
    $direccion_texto="justify-content-start";
else:
    $orientacion="";
    $direccion_texto="justify-content-end";

endif;
if($full):
    $container="container-fluid";
else:
    $container="container";
endif;

?>
<div <?php echo Seccion_ID(); ?> class=" bloque-interior bloque-texto_foto bloque-interior<?php echo $cont_home.'-'.$contador ?> <?php echo $orientacion ?>"
>
    <?php include(get_stylesheet_directory().'/parts/misc/ancla.php'); ?>
    <div class="<?php echo $container ?>">
        <div class="row wrap_contenido_foto align-self-stretch">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 d-flex align-self-center <?php echo $direccion_texto ?> texto-bloque">
                <div class="contenido-texto-bloque">
                    <div class="texto-solo">
                    <?php echo get_sub_field('texto') ?>
                    </div>
                    <?php include(get_stylesheet_directory().'/parts/misc/boton.php'); ?>

                </div>

            </div>
            <div class="col-xs-12 col-sm-12 col-lg-6 img-bloque"
                <?php if($img_id): ?>
                 style="background-image:url(<?php echo wp_get_attachment_url($img_id,'full'); ?>);"
                <?php endif; ?>
            >
                <?php echo wp_get_attachment_image($img_id,'full'); ?>
            </div>

        </div>
    </div>
</div>