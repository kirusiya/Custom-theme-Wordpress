<?php
$terms=wp_get_post_terms(get_the_ID(), 'categorias_evento');
$term_id=$terms[0]->term_id;
?>
<div class="meta-wrap-evento">
    <div> <i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo get_field('ciudad') ?></div>
    <div><?php
        foreach($terms as $term):
            echo $term->name;
        endforeach;
        ?>
    </div>

</div>