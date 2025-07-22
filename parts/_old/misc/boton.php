<?php
$boton_si=get_sub_field('add_boton');
if($boton_si):
while(have_rows('boton_wrap')): the_row();
    while(have_rows('boton')): the_row();
        $texto_btn=get_sub_field('texto_boton');
        $nueva_ventana=get_sub_field('nueva');
        $centrar=get_sub_field('centrar');
        $icono=get_sub_field('icono');
        $color=get_sub_field('color');
        $color_bg=get_sub_field('fondo_btn');
        $link=get_sub_field('link_boton');

    endwhile;
endwhile;

if($color_bg):
    $bg="background-color:".$color_bg.";";
else:
    $bg="";
endif;
if($color):
    $color="color:".$color."!important;";
else:
    $color="";
endif;
$estilo='style="'.$bg.' '.$color.'"';

if($texto_btn):
    ?>
    <div class="btn-wrap  <?php if($centrar): echo "d-flex justify-content-center"; endif; ?>">
        <a class="btn" <?php if($nueva_ventana): ?>target="_blank" <?php endif; ?>href="<?php echo $link ?>" <?php echo $estilo  ?>>
            <?php if($icono):
            echo wp_get_attachment_image($icono, 'medium');
            endif; ?>
            <span><?php echo $texto_btn  ?></span>

        </a>
    </div>
<?php endif;
endif;
?>


