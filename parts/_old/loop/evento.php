<?php
$terms=wp_get_post_terms(get_the_ID(), 'categorias_evento');
$term_id=$terms[0]->term_id;
?>

<div class="item-wrap-ext item-evento align-items-stretch">
        <div class=" card fake-a overlay-item-wrap">
            <div class="contenido-noticia">
                <div class="fecha-destacada">
                    <?php
                    $time = strtotime(str_replace("/","-",get_field('fecha')));
                    $dia = date('d',$time);
                    $mes = date('m',$time);
                    $year=date('Y',$time);
                    echo '<span class="dia">'.$dia.'</span>';
                    echo '<span class="mes">'.$mes.'</span>';
                    echo '<span class="year">'.$year.'</span>';
                    ?>
                </div>
                <div class="item-info noticia-info">
                    <h3 class="titulo-item">
                        <a href="<?php echo get_permalink() ?>">
                            <?php echo get_the_title() ?>
                        </a>
                    </h3>
                    <?php
                    include(get_stylesheet_directory().'/parts/misc/meta_evento.php');
                    ?>


                </div>
            </div>
            <div class="overlay">
                <div class="overlay-int">
                    <img src="<?php echo get_template_directory_uri() ?>/images/mas.png">
                    <span class="texto-overlay">
                          <?php _e('More info',  'materialwp')?>
                    </span>

                </div>
            </div>
        </div>
    </a>
</div>
