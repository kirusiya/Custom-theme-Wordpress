        <div class="fake-a item-foto-titulo card overlay-item-wrap ">
            <div class="contenido-noticia">
                <?php include(get_stylesheet_directory().'/parts/misc/img_listados.php');
                ?>
                <div class="imagen-loop-item" style="background-image:url(<?phP echo $bg ?>)">

                    <div class="fecha-destacada">
                        <?php
                        $time = strtotime(get_the_date('ymd'));
                        $dia = date('d',$time);
                        $mes = date('m',$time);
                        $year=date('Y',$time);
                        echo '<span class="dia">'.$dia.'</span>';
                        echo '<span class="mes">'.$mes.'</span>';
                        echo '<span class="year">'.$year.'</span>';
                        ?>
                    </div>
                </div>
                <div class="item-info noticia-info">
                    <h3 class="titulo-item">
                        <a href="<?php echo get_permalink() ?>">
                        <?php echo get_the_title() ?>
                        </a>
                    </h3>
                </div>
            </div>
            <div class="overlay">
                <div class="overlay-int">
                    <img src="<?php echo get_template_directory_uri() ?>/images/mas.png">
                    <span class="texto-overlay">
                          <?php _e('Más información', 'material')?>
                    </span>

                </div>
            </div>
        </div>

