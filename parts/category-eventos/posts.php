<?php /*
<!-- POSTS -->
<div class="bloque bloque-posts-2-estilos posts-category">

	<div class="container-custom">
		
		<div class="container-posts-2-estilos">
			
		<?php

		$categories  = get_the_category();
		$category_id = $categories[0]->cat_ID;

        ?>

        	<div class="grupo-posts">
        		
        		<div class="inner">
        			
        			<div class="inf grupo-impar">
        				
        				<div class="container-posts">
        					
        <?php

        $my_posts = new WP_Query( array(
			'post_type'         => 'post',
			'post_status'       => 'publish',
			'posts_per_page'    => -1,
			'cat' 				=> $category_id,
		));

		if ( $my_posts->have_posts() ):

			$n = 1;

			while( $my_posts->have_posts() ): $my_posts->the_post();

			 	$enlace_post = get_permalink( get_the_ID() );

			    $imagen_post = get_the_post_thumbnail_url( get_the_ID(), 'full' );

			    $fecha_post = strtoupper( get_the_date( 'd M Y', get_the_ID() ) );

			    $categorias_post = '';
			    $cats = get_the_terms( get_the_ID(), 'category' );
			    if ( $cats ):
			        foreach( $cats as $_cat ):
			            $categorias_post .= '<a href="' .get_category_link($_cat). '">' .$_cat->name. '</a>, ';
			        endforeach;
			    endif;
			    $categorias_post = substr( $categorias_post, 0, -2 );

			    $titulo_post = get_the_title();

			    if( $n==1 ) {
					echo '<div class="row">';
					echo '	<div class="col-md-8">';
				} elseif( $n==2 ) {
					echo '	<div class="col-md-4">';
				}

				$class_group = ( $n>3 ) ? 'resto-de-posts' : '';

				$class_margins = ( $n%6==0 ) ? 'custom-margins' : '';

		        
		        ?>

		                	<div class="mypost-<?php echo $n; ?> <?php echo $class_group; ?>">
			                	
				                <div class="image-container <?php echo $class_margins; ?>" style="background-image:url(<?php echo $imagen_post; ?>);">

				                	<div class="card-info">
				                	
				                		<div class="fecha">
				                			<?php echo $fecha_post; ?>
				                		</div>
				                	
				                		<div class="categorias">
				                			<?php echo $categorias_post; ?>
				                		</div>
				                	
				                		<div class="titulo">
				                			<a href="<?php echo $enlace_post; ?>">
				                				<?php echo $titulo_post; ?>
				                			</a>
				                		</div>

				                	</div>

				                </div>
				                
				            </div>

		        <?php

		        if( $n==1 ) {        
					echo '	</div> <!-- .col-md-8 -->';
				} elseif( $n==3 ) {
					echo '	</div> <!-- .col-md-4 -->';
					echo '</div> <!-- .row -->';
				}

			    $n++;

			endwhile;

		    wp_reset_postdata();

		endif;

        ?>

        				</div>

        			</div>

        		</div>

        	</div>
        
		</div>

	</div>
	
</div>
*/ ?>