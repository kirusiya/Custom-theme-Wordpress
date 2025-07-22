<?php
    $img_defecto=get_field('imagen_defecto', 'options');

    if(has_post_thumbnail()):
        $bg=get_the_post_thumbnail_url();
    else:
        if($img_defecto):
            $bg=wp_get_attachment_url($img_defecto, 'large');
        else:
        ?>
        <?php $bg=get_template_directory_uri()."/images/default.jpg"; ?>
        <?php
        endif;
    endif;
    ?>
