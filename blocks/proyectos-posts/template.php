<div class="bloque bloque-proyectos-posts">
	<div class="container-custom">
		<div class="container-texto">
			<h2 class="titulo mb-5">
				<?php echo get_field( 'titulo' ); //phpcs:ignore ?>
			</h2>
			<p class="mb-5"><?php echo get_field( 'subtitulo' ); //phpcs:ignore ?></p>
		</div>

		<?php if ( get_field( 'anadir_boton_ver_todas' ) ) : ?>
		<div class="boton-cupa-granate">
			<a href="<?php echo esc_url( get_field( 'enlace_ver_todas' ) ); ?>">
				<?php echo esc_html( get_field( 'texto_enlace_ver_todas' ) ); ?>
				<span class="arrow-btn"></span>
			</a>
		</div>
		<?php endif; ?>

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/tiny-slider.css">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/min/tiny-slider.js"></script>

		<?php
			$rand   = wp_rand();
			$tween1 = 'tween1_' . $rand;
		?>

		<div class="myslider-<?php echo esc_html( $rand ); ?> container-posts">			

		<?php
			$my_posts = new WP_Query(
				array(
					'post_type'      => 'proyectos',
					'post_status'    => 'publish',
					'posts_per_page' => 12,
					'orderby' => 'date',
					'order'   => 'DESC',					
					
				)
			);

			if ( $my_posts->have_posts() ) :
				$n = 1;

				while ( $my_posts->have_posts() ) :
					$my_posts->the_post();
					$titulo = get_the_title( get_the_ID() );
					$imagen = get_the_post_thumbnail_url( get_the_ID(), 'full' );
					$enlace = get_permalink( get_the_ID() );
					?>

			<div class="mypost-<?php echo esc_html( $n ); ?> fake-a-last">
				<div class="image-container" style="background-image:url(<?php echo esc_url( $imagen ); ?>);">
					<div class="card-info">
						<div class="titulo">
							<a href="<?php echo esc_url( $enlace ); ?>">
								<?php echo esc_html( $titulo ); ?>
							</a>
						</div>
					</div>
				</div>
			</div>

					<?php
					$n++;
				endwhile;
				wp_reset_postdata();
			endif;
			?>

		</div>

		<script type="module">
		jQuery( document ).ready( function(){
			var slider = tns({
				container: '.myslider-<?php echo esc_html( $rand ); ?>',
				items: 1,
				controls: true,
				autoplayButtonOutput: false,
				nav: false,
				slideBy: 'page',
				autoplay: false,
				mouseDrag: true,
				responsive: {
					768: {
						items: 2
					},
					992: {
						items: 3
					}
				},
			});
		});
		</script> 

	</div>
</div>
