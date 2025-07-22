<?php
/**
 * Categorías
 *
 * @package materialwp
 */

?>

<div class="bloque bloque-posts-2-estilos posts-category">
	<div class="container-custom">
		<div class="container-posts-2-estilos">

		<?php
		$category    = get_queried_object();
		$category_id = $category->term_id;
		$array_tags  = array();
		?>

			<div class="grupo-posts">
				<div class="inner">
					<div class="inf grupo-impar">
						<div class="container-posts">

		<?php
		$n_posts_per_page = get_field( 'numero_posts_por_paginacion', 'options' ) ? get_field( 'numero_posts_por_paginacion', 'options' ) : 9;
		$paged            = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1; //phpcs:ignore
		$my_posts         = new WP_Query(
			array(
				'post_type'      => 'post',
				'post_status'    => 'publish',
				'posts_per_page' => $n_posts_per_page,
				'cat'            => $category_id,
				'paged'          => $paged,
			)
		);

		if ( $my_posts->have_posts() ) :

			$n = 1;

			while ( $my_posts->have_posts() ) :
				$my_posts->the_post();
				$enlace_post = get_permalink( get_the_ID() );
				$imagen_post = get_the_post_thumbnail_url( get_the_ID(), 'full' );

				$dia        = get_the_date( 'd', get_the_ID() );
				$mes        = getLargeMonth( get_the_date( 'M', get_the_ID() ) );
				$ano        = get_the_date( 'Y', get_the_ID() );
				$fecha_post = strtoupper( $dia . ' ' . $mes . ' ' . $ano );

				$categorias_post = '';
				$cats            = get_the_terms( get_the_ID(), 'category' );

				if ( $cats ) :
					foreach ( $cats as $_cat ) :
						$categorias_post .= '<a href="' . get_category_link( $_cat ) . '">' . $_cat->name . '</a>, ';
					endforeach;
				endif;

				$categorias_post = substr( $categorias_post, 0, -2 );
				$titulo_post     = get_the_title();

				if ( 1 === intval( $n ) ) {
					echo '<div class="row">';
					echo '	<div class="col-md-8">';
				} elseif ( 2 === intval( $n ) ) {
					echo '	<div class="col-md-4">';
				}

				$class_group   = ( $n > 3 ) ? 'resto-de-posts' : '';
				$class_margins = ( 0 === $n % 6 ) ? 'custom-margins' : '';

				// TAGS.
				$post_tags = wp_get_post_tags( get_the_ID() );
				$tags      = '';

				foreach ( $post_tags as $tag ) : //phpcs:ignore

					if ( ! in_array( $tag, $array_tags, true ) ) {
						array_push( $array_tags, $tag );
					}

					$tags .= $tag->name . ',';

				endforeach;
				?>

					<?php // @codingStandardsIgnoreStart ?>
					<div class="mypost-<?php echo $n; ?> <?php echo $class_group; ?>" tags="<?php echo $tags; ?>">
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
					<?php // @codingStandardsIgnoreEnd ?>

				<?php

				if ( 1 === intval( $n ) ) {
					echo '	</div> <!-- .col-md-8 -->';
				} elseif ( 3 === intval( $n ) ) {
					echo '	</div> <!-- .col-md-4 -->';
					echo '</div> <!-- .row -->';
				}

				$n++;
			endwhile;
			wp_reset_postdata();
		endif;
		?>

						</div>

						<?php wp_pagenavi(); // Llamada a función de plugin WP-PageNavi. ?>

					</div>
				</div>
			</div>
		</div>

		<?php if ( ! empty( $array_tags ) ) : ?>
		<div class="container-tags">
			<?php
			$n = 1;
			foreach ( $array_tags as $tag ) { //phpcs:ignore
				?>

			<div class="etiqueta-<?php echo esc_html( $n ); ?>">
				<?php echo esc_html( $tag->name ); ?>
			</div>

				<?php
				$n++;
			}
			?>

			<div class="fadeout"></div>

		</div>

		<div class="leer-mas" accion="leermas">
			<?php esc_html_e( 'Ver más', 'materialwp' ); ?>
		</div>

		<script type="text/javascript">
			jQuery( document ).ready(function() {

				jQuery('.container-tags div[class^=etiqueta-]').on( 'click', function(){
					if( jQuery(this).hasClass('active') ){			    		
						jQuery(this).removeClass('active');			    		
					} else {
						jQuery(this).addClass('active');			    		
					}	

					allPostsActives();		    	

					tags = getAllTagsActives();

					if ( tags ){
						tags_array = tags.split(',');
						tags_array.forEach(evaluateEachTag);
					}

				});

				function allPostsActives(){
					jQuery('.container-posts div[class^=mypost-]').each( function(){
						jQuery(this).css({ 'pointer-events' : 'all' });
						jQuery(this).animate({
							'opacity' : '1',
						}, 500);
					});
				}

				function getAllTagsActives(){
					_tags = '';
					jQuery('.container-tags div[class^=etiqueta-]').each( function(){
						if ( jQuery(this).hasClass('active') ){
							_tags += jQuery(this).text().trim() + ',';
						}
					});
					return _tags;
				}

				function evaluateEachTag(tag){
					jQuery('.container-posts div[class^=mypost-]').each( function(){
						post_tags = jQuery(this).attr('tags');
						if ( post_tags.indexOf(tag) < 0 ) {
							jQuery(this).css({ 'pointer-events' : 'none' });
							jQuery(this).animate({
								'opacity' : '0.2',
							}, 500);
						}
					});
				}

				jQuery('.leer-mas').on( 'click', function(){
					var accion = jQuery(this).attr('accion');
					if ( accion == 'leermas' ) {
						jQuery('.container-tags').animate({
							maxHeight : '2000px',
						}, 1000 );

						setTimeout( function(){
							jQuery('.container-tags .fadeout').hide('slow');
							jQuery('.leer-mas').attr('accion','leermenos').text('<?php esc_html_e( 'Ver menos', 'materialwp' ); ?>');
						}, 500);

					} else if ( accion == 'leermenos' ){
						jQuery('.container-tags').animate({
							maxHeight : '100px',
						}, 1000 );

						setTimeout( function(){
							jQuery('.container-tags .fadeout').show('slow');
							jQuery('.leer-mas').attr('accion','leermas').text('<?php esc_html_e( 'Ver más', 'materialwp' ); ?>');
						}, 500);
					}

				});
			});
		</script>
		<?php endif; ?>

	</div>
</div>
