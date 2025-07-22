
<div <?php echo Seccion_ID(); ?>  class="bloque-home bloque-noticias">
    <div class="container">
        <div class="row">

                <div class="col-sm-12 titulo-home-wrap">
                    <h2 class="titulo-home">
                        <span><?php echo get_sub_field('titulo') ?> </span>
                    </h2>

                </div>
        </div>
            <div class="row">
                <?php

                $args=array (
                    'post_type'     =>  'post',
                    'orderBy'       =>  'date',
                    'order'         =>  'DESC',
                    'posts_per_page' =>  4,
                    'post_status'   =>  'publish'
                );

                $query=new WP_Query($args);

                if ($query->have_posts()){
                    while ($query->have_posts()):
                        $query->the_post();
                        ?>
                        <div class="col-md-6 col-lg-3 item-wrap-exterior d-flex align-items-stretch">
                            <?php include(get_stylesheet_directory().'/parts/loop/foto-fecha-titulo.php');
                            ?>
                        </div>
                        <?php
                    endwhile;
                }
                wp_reset_postdata();

                ?>
            </div>
        <div class="link_ver_todos col-sm-12">
            <a href="<?php echo get_post_type_archive_link('post')  ?>" class="btn-link">
                <?php _e('Ver todos' , 'nigran')  ?>
            </a>
        </div>

        </div>
    </div>


