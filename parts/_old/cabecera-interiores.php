<?php
$cabecera_bg=get_field('imagen_de_fondo', get_hpage());
$color_titulo=get_field('color_del_titulo', get_hpage());
if($color_titulo):
$color="style='color:".$color_titulo."'";
else:
    $color="";
endif;

if (!empty($cabecera_bg)):
    $fondo_cabecera=wp_get_attachment_url($cabecera_bg, 'full');
endif;
?>

<header class="entry-header cabecera-custom" style="background-image:url(<?php echo $fondo_cabecera ?>)">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                    <?php if(is_single()): ?>
                        <div class="entry-title" <?php echo $color  ?>>
                            <?php  echo get_the_title(get_hpage()) ?>
                        </div>

                    <?php elseif(is_search()): ?>
                        <div class="entry-title" <?php echo $color  ?>>
                            <?php _e('Resultados de búsqueda para ');
                            echo '"'.$_GET['s'].'"'

                            ?>
                        </div>
                    <?php elseif(is_tax()): ?>
                        <h1 class="entry-title" <?php echo $color  ?>>
                            <?php echo  single_term_title(); ?>
                        </h1>

                    <?php else: ?>
                        <h1 class="entry-title" <?php echo $color  ?>>
                            <?php echo get_the_title(get_hpage()); ?>
                        </h1>
                    <?php endif;  ?>


            </div>
        </div>
    </div>

</header><!-- .entry-header -->
