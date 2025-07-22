<?php
/**
 * Galería
 *
 * @package materialwp
 */

$rand = wp_rand();
?>

<div class="bloque bloque-taxonomy-galeria">
	<div class="container-slider">
		<div class="myslider-<?php echo esc_html( $rand ); ?>">

		<?php
		$tax_id         = get_queried_object()->term_id;
		$term_gal       = get_term( $tax_id );
		$nombre_galeria = $term_gal->name;

		$query = new WP_Query(
			array(
				'post_type'      => 'productos',
				'post_status'    => 'publish',
				'orderby'        => 'rand',
				'posts_per_page' => '-1',
				'tax_query'      => array(
					array(
						'taxonomy' => 'galeria',
						'field'    => 'id',
						'terms'    => $tax_id,
					),
				),
				'meta_query'     => array(
					array(
						'key'     => 'imagen_para_galeria_' . $tax_id,
						'value'   => array( '', array(), serialize( array() ) ),
						'compare' => 'NOT IN',
					),
				),
			)
		);

		$n = 1;

		while ( $query->have_posts() ) :
			$query->the_post();
			$enlace_producto = get_permalink( get_the_ID() );
			$imagen_producto = get_field( 'imagen_para_galeria_' . $tax_id, get_the_ID() );
			$gama            = getTaxonomiesForProducts( get_the_ID(), 'gama', true );
			?>

			<div class="myslide-<?php echo esc_html( $n ); ?>">
				<a href="<?php echo esc_url( $enlace_producto ); ?>">
					<div class="inner" style="background-image: url(<?php echo esc_url( $imagen_producto ); ?>);">
						<img src="<?php echo esc_url( $imagen_producto ); ?>" alt="<?php echo esc_html( get_the_title() ); ?>">
					</div>
				</a>
				<div class="datos-hide">
					<span class="contenido">
						<a href="<?php echo esc_url( $enlace_producto ); ?>">
							<?php echo esc_html( get_the_title() ); ?>
						</a>
						<div class="gama">
							<?php echo esc_html__( 'Gama: ', 'materialwp' ) . $gama; //phpcs:ignore ?>
						</div>
					</span>
				</div>
			</div>

			<?php
			$n++;
		endwhile;
		wp_reset_postdata();
		?>

		</div>
	</div>

	<script type="module">
		jQuery( document ).ready( function(){
			var slider = tns({
				container:           '.myslider-<?php echo esc_html( $rand ); ?>',
				items:                1,
				speed:                700,
				controls:             false,
				autoplayButtonOutput: false,
				nav:                  false,
				slideBy:              1,
				autoplay:             true,
				controls:             true,
				mouseDrag:            true,
			});

			jQuery('.tns-controls button[data-controls=next]').click( function(){
				setTimeout( function(){
					fireEffect;
				}, 900);
			});

			jQuery('.tns-controls button[data-controls=prev]').click( function(){
				setTimeout( function(){
					fireEffect;
				}, 800);
			});

			var fireEffect = function(info, eventName){
				jQuery('.pie-slider .datos .contenido').hide();
				var content = jQuery('.tns-slide-active .datos-hide .contenido').html();
				jQuery('.pie-slider .datos .contenido').html( content );
				jQuery('.pie-slider .datos .contenido').fadeIn( 500 );
			}

			function startDataDown(){
				jQuery('.pie-slider .datos .contenido').hide();
				var content = jQuery('.tns-slide-active .datos-hide .contenido').html();
				jQuery('.pie-slider .datos .contenido').html( content );
				jQuery('.pie-slider .datos .contenido').fadeIn( 500 );
			}

			slider.events.on( 'transitionEnd', fireEffect );
			startDataDown();
		});
	</script>

	<div class="pie-slider">
		<h1 class="nombre-galeria">
			<?php echo esc_html( $nombre_galeria ); ?>
		</h1>
		<div class="datos">
			<div class="contenido"></div>
		</div>
		<div class="boton-cupa-granate volver">
			<a href="/galeria/">
				<span class="arrow-btn"></span>
				<?php esc_html_e( 'Volver', 'materialwp' ); ?>
			</a>
		</div>
		<div class="aspa-abajo">
			<img class="animated bounce" src="<?php echo esc_url( get_stylesheet_directory_uri() ) . '/images/aspa-abajo-granate.png'; ?>" alt="Aspa">
		</div>
	</div>

	<div class="prefooter prefooter-galeria">
		<div class="container-custom">
			<div class="row">
				<div class="col-md-12">
					<h2><?php echo get_field( 'texto_prefooter_galeria', 'options' ); //phpcs:ignore ?></h2>
				</div>
				<div class="col-md-12">
					<?php echo do_shortcode( '[contact-form-7 id="6291" title="Form GALERIA"]' ); ?>
				</div>
			</div>
		</div>
	</div>

</div>

<script type="text/javascript">
	jQuery( document ).ready(function() {
		jQuery('.aspa-abajo img').click( function(){				
			$('html,body').animate({
				scrollTop: $('.prefooter-galeria').offset().top
			}, 'slow');
		});
	});
</script>
