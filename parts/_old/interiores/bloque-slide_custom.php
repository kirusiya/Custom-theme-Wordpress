<script type="text/javascript">
    jQuery(document).ready(function($) {
        var slider = tns({
            container: '#slide<?php echo $contador ?>',
            items: 1,
            speed: 600,
            autoHeight: true,
            controls: false,
            mouseDrag: true,
            arrowKeys: true,
            autoplay: false,
            autoplayButtonOutput: false

        });
    })
</script>
<div <?php echo Seccion_ID(); ?>  class="bloque-slide-custom  bloque-interior<?php echo $cont_home.'-'.$contador ?>" >
    <?php include(get_stylesheet_directory().'/parts/misc/ancla.php'); ?>
    <div class="container-fluid">

        <div id="slide<?php echo $contador ?>" class="slide_wrap ">
            <?php while(have_rows('slide')): the_row();  ?>
                <div class="slide_item">
                    <div class="slide_item_int">
                    <div class="img_wrap">
                        <?php
                        $foto=get_sub_field('imagen');
                        echo wp_get_attachment_image($foto, 'full');
                        ?>

                    </div>
                 <div class="texto_wrap">
                        <div class="container texto_int">
                        <div class="texto_slide">
                            <?php echo get_sub_field('texto') ?>
                        </div>
                        <div class="btn_wrap">
                            <?php include(get_stylesheet_directory().'/parts/misc/boton.php'); ?>
                        </div>
                        </div>

                    </div>
                    </div>
                </div>
            <?php endwhile; ?>

        </div>

    </div>
</div>