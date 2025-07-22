<script type="text/javascript">
    jQuery(document).ready(function($) {
        var slider = tns({
            container: '#slide<?php echo $contador ?>',
            items: 6,
            speed: 600,
            autoHeight: true,
            controls: true,
            mouseDrag: true,
            arrowKeys: false,
            autoplay: false,
            autoplayButtonOutput: false

        });
    })
</script>
<div <?php echo Seccion_ID(); ?> class="bloque-interior bloque-carrusel bloque-interior<?php echo $cont_home.'-'.$contador ?>" >
    <?php include(get_stylesheet_directory().'/parts/misc/ancla.php'); ?>
    <div class="container">

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

                    </div>
                </div>
            <?php endwhile; ?>

        </div>

    </div>
</div>