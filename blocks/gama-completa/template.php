<?php
/**
 * Bloque Gama completa.
 *
 * @package materialwp
 */

$rand   = wp_rand();
$tween1 = 'tween1_' . $rand;
?>

<div id="toda-la-gama" class="bloque bloque-gama-completa">

	<div class="titulos container-custom">
		<h1 class="inf">
			<?php _e( 'Toda la gama completa de STONEPANEL<sup>®</sup>', 'materialwp' ); //phpcs:ignore ?>
		</h1>
	</div>

	<div 	class="container-slider"
			style="background-image: url(<?php echo esc_html( get_stylesheet_directory_uri() . '/images/stonepanel-logo-2.png' ); ?>);">

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/tiny-slider.css"> <?php //phpcs:ignore ?>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/min/tiny-slider.js"></script> <?php //phpcs:ignore ?>

		<div class="myslider-<?php echo esc_html( $rand ); ?> container-posts <?php echo esc_html( $tween1 ); ?>">

			<?php
			$my_posts = new WP_Query(
				array(
					'post_type'      => 'productos',
					'post_status'    => 'publish',
					'posts_per_page' => -1,
					'tax_query'      => array( //phpcs:ignore
						array(
							'taxonomy' => 'gama',
							'field'    => 'slug',
							'terms'    => 'stonepanel',
						),
					),
				)
			);

			if ( $my_posts->have_posts() ) :
				$n = 1;

				while ( $my_posts->have_posts() ) :
					$my_posts->the_post();

					$titulo          = get_the_title( get_the_ID() );
					$titulo          = str_replace( '®', '<sup>®</sup>', $titulo );
					$imagen_listados = get_field( 'imagen_para_listados', get_the_ID() );
					$enlace          = get_permalink( get_the_ID() );
					?>

				<div class="producto-<?php echo esc_html( $n ); ?>">
					<a href="<?php echo esc_url( $enlace ); ?>">
						<div class="inner-producto">
							<img src="<?php echo esc_url( $imagen_listados ); ?>" alt="<?php echo esc_html( get_the_title( get_the_ID() ) ); ?>">
							<div class="titulo">
								<?php echo $titulo; //phpcs:ignore ?>
							</div>
						</div>
					</a>
				</div>

					<?php
					$n++;
				endwhile;
			endif;
			?>

		</div>

		<script type="module">
		jQuery( document ).ready( function(){
			var slider = tns({
				container: '.myslider-<?php echo esc_html( $rand ); ?>',
				items: 1,
				controls: false,
				autoplayButtonOutput: false,
				nav: false,
				slideBy: 'page',
				autoplay: true,
				autoplayTimeout: 5000,
				speed: 1500,
				controls: false,
				mouseDrag: true,
				slideBy: 1,
				responsive: {
					768: {
						items: 3,
					},
					992: {
						disable: true
					}
				},

			});

			function checkWidthProducto( w ){
				jQuery('div[class^=producto-], div[class^=producto-] .inner-producto').height( w );
			}

			function checkWidthForSlider(){
				jQuery('div[class^=myslider-]').css({'visibility':'hidden'});
				if( jQuery(window).width() >= 992 ){
					jQuery('.bloque-gama-completa .container-slider').addClass('no-slider');
				} else {
					jQuery('.bloque-gama-completa .container-slider').removeClass('no-slider');
				}				
				setTimeout( function(){ checkWidthProducto(jQuery('.bloque-gama-completa .tns-slide-active .inner-producto').width()); jQuery('div[class^=myslider-]').css({'visibility':'visible'}); }, 500);
			}

			jQuery(window).on('resize', function() {
				checkWidthForSlider();
			});

			checkWidthForSlider();


			/* Animation */
			<?php
			$rnd  = '_' . wp_rand();
			$base = '.bloque-blog-posts';
			?>

			var scrollMagicController<?php echo esc_html( $rnd ); ?> = new ScrollMagic.Controller();
			var timeline<?php echo esc_html( $rnd ); ?> = new TimelineMax();

			timeline<?php echo esc_html( $rnd ); ?>
			.from("<?php echo esc_html( $base ); ?> <?php echo esc_html( $tween1 ); ?>", 1.5, {
				opacity: 0,
			});

			var scene<?php echo esc_html( $rnd ); ?> = new ScrollMagic.Scene({
				triggerElement: '<?php echo esc_html( $base ); ?>',
				offset: -50,
				reverse: false,
			}).setTween( timeline<?php echo esc_html( $rnd ); ?> ).addTo( scrollMagicController<?php echo esc_html( $rnd ); ?> );
		});
		</script> 

	</div>	
</div>
