<?php
/**
 * Bloque Descargas y recursos.
 *
 * @package materialwp
 */

?>

<div class="bloque bloque-descargas-y-recursos <?php echo esc_html( $block['className'] ); ?>">
	<div class="container-custom">

		<!-- Categorías -->
		<div class="selector">

		<?php
		$tipos = get_terms(
			'tipo',
			array(
				'parent'     => 0,
				'hide_empty' => true,
			)
		);

		if ( $tipos ) :
			?>

			<ul>

			<?php
			$count = count( $tipos );
			$n     = 1;
			foreach ( $tipos as $_tipo ) {
				$id_tipo            = $_tipo->term_id;
				$nombre_tipo        = $_tipo->name;
				$imagen_tipo_normal = get_field( 'imagen_normal', $_tipo->taxonomy . '_' . $id_tipo );
				$imagen_tipo_hover  = get_field( 'imagen_hover', $_tipo->taxonomy . '_' . $id_tipo );
				?>

				<li class="icono-<?php echo esc_html( $n ); ?>"
					tipo="<?php echo esc_html( $id_tipo ); ?>"
					style="width: <?php echo esc_html( round( ( 100 / $count ), 2 ) ); ?>%;">
					<div class="imagen-tipo" style="background-image: url(<?php echo esc_url( $imagen_tipo_normal ); ?>);"></div>
					<p class="nombre-tipo">
						<?php echo esc_html( $nombre_tipo ); ?>
					</p>
					<div class="borde-inferior"></div>
					<style type="text/css">
						.selector ul li.icono-<?php echo esc_html( $n ); ?>:hover .imagen-tipo,
						.selector ul li.icono-<?php echo esc_html( $n ); ?>.active .imagen-tipo {
							background-image: url(<?php echo esc_html( $imagen_tipo_hover ); ?>) !important;
						}
					</style>
				</li>

				<?php
				$n++;
			}
			?>

			</ul>

		<?php endif; ?>

		</div>

		<!-- Elementos de cada categoría -->
		<div class="elementos">
			<ul>

			<?php
			foreach ( $tipos as $_tipo ) :
				if ( ! get_term_children( $_tipo->term_id, 'tipo' ) ) :

					$args = array(
						'post_type'      => 'recursos',
						'post_status'    => 'publish',
						'posts_per_page' => -1,
						'orderby'        => 'date',
						'order' 		 => 'DESC',
						'tax_query'      => array(
							array(
								'taxonomy' => 'tipo',
								'terms'    => $_tipo->term_id,
							),
						),
					);

					$query = new WP_Query( $args );

					if ( $query->have_posts() ) :
						$n = 1;

						while ( $query->have_posts() ) :
							$query->the_post();
							$titulo      = get_the_title();
							$descripcion = get_the_content();
							$imagen      = get_the_post_thumbnail_url( get_the_ID(), 'full' );
							$terms       = get_the_terms( get_the_ID(), 'tipo' );

							foreach ( $terms as $_term ) {
								$tipo_id = $_term->term_id;
							}

							$archivos   = get_field( 'archivos', get_the_ID() );
							$n_archivos = count( $archivos );
							?>

						<li class="tipo-<?php echo esc_html( $n ); ?> li-<?php echo esc_html( $tipo_id ); ?>" tipo="<?php echo esc_html( $tipo_id ); ?>">
							<div class="inner-tipo">

								<?php
								if ( 1 === intval( $n_archivos ) ) : // Modelo 1 archivo para descargar.
									if ( have_rows( 'archivos', get_the_ID() ) ) :
										while ( have_rows( 'archivos', get_the_ID() ) ) :
											the_row();
											$enlace = get_sub_field( 'archivo' );
											$extension = substr($enlace,-3,3);
										endwhile;
									endif;
									?>

								<a class="<?php echo $extension; ?>" href="<?php echo esc_url( $enlace ); ?>" target="_blank">
									<div class="imagen" style="background-image: url(<?php echo esc_url( $imagen ); ?>);">
										<div class="overlay"></div>
									</div>
									<div class="texto">

										<?php if ( $titulo ) : ?>
										<div class="titulo">
											<?php echo str_replace( '®', '<sup>®</sup>', $titulo ); //phpcs:ignore ?>
										</div>
										<?php endif; ?>

										<?php if ( $descripcion ) : ?>
										<div class="descripcion">
											<?php echo str_replace( '®', '<sup>®</sup>', $descripcion ); //phpcs:ignore ?>
										</div>
										<?php endif; ?>

									</div>
								</a>

								<?php else : // Modelo varios archivos para descargar. ?>

								<div class="imagen varios-archivos" style="background-image: url(<?php echo esc_url( $imagen ); ?>);"></div>

								<div class="texto varios-archivos">

									<?php if ( $titulo ) : ?>
									<div class="titulo">
										<?php echo str_replace( '®', '<sup>®</sup>', $titulo ); //phpcs:ignore ?>
									</div>
									<?php endif; ?>

									<?php if ( $descripcion ) : ?>
									<div class="descripcion">
										<?php echo str_replace( '®', '<sup>®</sup>', $descripcion ); //phpcs:ignore ?>
									</div>
									<?php endif; ?>

									<ul>

									<?php
									if ( have_rows( 'archivos', get_the_ID() ) ) :

										while ( have_rows( 'archivos', get_the_ID() ) ) :
											the_row();
											$enlace_fichero = get_sub_field( 'archivo' );
											$titulo_fichero = get_sub_field( 'titulo' );
											$icono_fichero  = get_sub_field( 'icono' );
											$extension = substr($enlace_fichero,-3,3);
											?>

										<li>
											<a class="<?php echo $extension; ?>" href="<?php echo esc_url( $enlace_fichero ); ?>" target="_blank">

												<?php if ( $icono_fichero ) : ?>
												<div class="icono">
													<img src="<?php echo esc_url( $icono_fichero ); ?>" alt="<?php echo esc_html( $titulo_fichero ); ?>">
												</div>
												<?php endif; ?>

												<?php if ( $titulo_fichero ) : ?>
												<div class="titulo-fichero">
													<?php echo str_replace( '®', '<sup>®</sup>', $titulo_fichero ); //phpcs:ignore ?>
												</div>
												<?php endif; ?>

											</a>
										</li>

											<?php
										endwhile;
									endif;
									?>

									</ul>
								</div>

								<?php endif; ?>

							</div>						
						</li>

							<?php
							$n++;
						endwhile;
					endif;

					wp_reset_postdata();
					?>

					<?php
				else :
					$term_childs = get_terms(
						'tipo',
						array(
							'parent'     => $_tipo->term_id,
							'hide_empty' => true,
						)
					);
					foreach ( $term_childs as $t_child ) :
						?>

						<li class="tipo-<?php echo esc_html( $_tipo->term_id ); ?> li-listado" tipo="<?php echo esc_html( $_tipo->term_id ); ?>">
							<h2 class="mb-3"><?php echo esc_html( $t_child->name ); ?></h2>

							<?php
							$args_child = array(
								'post_type'      => 'recursos',
								'post_status'    => 'publish',
								'posts_per_page' => -1,
								'order'          => 'ASC',
								'orderby'        => 'post_title',
								'tax_query'      => array(
									array(
										'taxonomy' => 'tipo',
										'terms'    => $t_child->term_id,
									),
								),
							);

							$query_child = new WP_Query( $args_child );

							if ( $query_child->have_posts() ) :
								while ( $query_child->have_posts() ) :
									$query_child->the_post();
									?>

									<div>
										<strong><?php the_title(); ?></strong><br>
										<?php the_content(); ?>
									</div>

									<?php
								endwhile;
							endif;

							wp_reset_postdata();
							?>

						</li>

						<?php
					endforeach;
				endif;
			endforeach;
			?>

			</ul>
		</div>

		<script type="text/javascript">
			jQuery( document ).ready(function() {
				jQuery('.selector ul li[class^=icono-]').click( function(){
					quitaTodosActives();
					jQuery(this).addClass('active');
					nTipo = jQuery(this).attr('tipo');
					ocultaTodosElementos();
					jQuery('.elementos ul li[tipo=' +nTipo+ ']').fadeIn();
				});

				function quitaTodosActives(){
					jQuery('.selector ul li[class^=icono-]').removeClass('active');
				}

				function ocultaTodosElementos(){
					jQuery('.elementos ul li[class^=tipo-]').hide();
				}

				<?php if ( $_GET['bim'] != '' ) { ?>
				jQuery('.selector ul li[class^=icono-][tipo=<?php echo $_GET['bim']; ?>]').click();
				<?php } else { ?>
				jQuery('.selector ul li.icono-1').click();
				<?php } ?>
			});
		</script>

	</div>

</div>
