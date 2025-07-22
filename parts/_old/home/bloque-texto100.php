<?php
$color=get_sub_field('color_de_fondo');
$texto_btn=get_sub_field('texto_boton');
$bloque_estrecho=get_sub_field('estrechar');
$full=get_sub_field('full');
if($bloque_estrecho):
    $container_estrecho="container_estrecho";
else:
    $container_estrecho="";
endif;
if($full):
    $full_clase="container-fluid";
else:
    $full_clase="";
endif;
?>
<?php
include(get_template_directory() . '/parts/interiores/fondo.php');
?>
<div class="bloque-home bloque-texto100" <?php echo $style_bg ?>>
    <?php
    include(get_template_directory() . '/parts/interiores/ancla.php');
    ?>
    <div class="container <?php echo $container_estrecho.' '.$full_clase ?>">
        <div class="row">
                <div class="col-sm-12 texto-bloque">
                    <div class="titulo_home_wrap">
                        <h2 class="titulo_home">
                            <?php echo get_sub_field('titulo'); ?>
                        </h2>
                    </div>
                    <div class="contenido-texto-bloque">
                        <?php echo get_sub_field('texto') ?>
                    </div>
                     <?php
                         include(get_template_directory() . '/parts/interiores/boton.php');
                      ?>
                </div>
        </div>
    </div>
</div>