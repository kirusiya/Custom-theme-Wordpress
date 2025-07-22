<?php
$marker = get_field('marker', 'options');
$marker_url = wp_get_attachment_url($marker, 'medium');
?>
<div class="acf-map">
<?php
$marker = get_field('marker', 'options');
$marker_url = wp_get_attachment_url($marker, 'medium');

while ( have_rows('localizacion') ) : the_row();

    $location=get_sub_field('mapa');
    $lat=$location['lat'];
    $long=$location['lng'];
    $title=get_sub_field('titulo');
    $desc=get_sub_field('texto');
    ?>
    <div class="marker"
         data-marker="<?php echo $marker_url; ?>"
         data-lat="<?php echo $location['lat']; ?>"
         data-lng="<?php echo $location['lng']; ?>">
        <div class="infowindow_custom">
            <h3><?php echo $title ?></h3>
            <p><?php echo $location['address']; ?></p>
            <p><?php echo $desc  ?></p>
        </div>
    </div>

<?php endwhile; ?>
</div>

