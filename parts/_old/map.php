
<?php while ( have_rows('google_map') ) : the_row();
    //$image = get_sub_field('image');
    $location=get_sub_field('mapa');
    $lat=$location['lat'];
    $long=$location['lng'];
    $title=get_sub_field('titulo');
    $desc=get_sub_field('texto');
    if( !empty($image) ):
            // vars
            $url = $image['url'];
            $alt = $image['alt'];

            // thumbnail
            $marker = 'marker';
            $size = 'thumbnail';
            $thumb = $image['sizes'][ $size ];
            $markerthumb = $image['sizes'][ $marker ];
        else:
            $marker=get_field('marker', 'options');
            $markerthumb= wp_get_attachment_image($marker, 'medium');

    endif; ?>
    <div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>" data-icon="<?php echo $markerthumb; ?>">
        <?php if ($image){ ?><img class="img-responsive thumb" src="<?php echo $thumb; ?>" alt="<?php echo $alt; ?>"/><?php } ?>
        <?php if ($title){ ?><h3><?php echo $title; ?></h3><?php } ?>
        <address><span class="glyphicon glyphicon-map-marker"></span><?php echo $location['address']; ?></address>
        <?php if ($desc){ ?><p><?php echo $desc; ?></p><?php } ?>
    </div>
<?php endwhile; ?>