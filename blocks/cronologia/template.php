<?php
/**
 * Bloque Cronología.
 *
 * @package materialwp
 */

?>

<?php if ( get_field( 'mostrar_cronologia' ) ) : ?>

	<div class="bloque bloque-cronologia <?php echo esc_html( $block['className'] ); ?>">

		<h2><?php echo get_field( 'titulo' ); //phpcs:ignore ?></h2>

		<?php
		$query = new WP_Query(
			array(
				'post_type'      => 'cronologia',
				'post_status'    => 'publish',
				'posts_per_page' => -1,
				'meta_key'       => 'ano', //phpcs:ignore
				'orderby'        => 'meta_value',
				'order'          => 'ASC',
			)
		);

		if ( $query->have_posts() ) :
			?>


		<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/inc/tiny/tiny-slider.min.css"> <?php //phpcs:ignore ?>
		<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/inc/tiny/tiny-slider.min.js"></script> <?php //phpcs:ignore ?>

		<div class="slider-crono container-cronologia">
			<?php
			while ( $query->have_posts() ) {
				$query->the_post();
				include get_stylesheet_directory() . '/parts/loop/item-cronologia.php';
			}
			wp_reset_postdata();
			?>
		</div>

		<div class="balls">

			<?php
			$n         = 1;
			$prev_year = 0;
			while ( $query->have_posts() ) :
				$query->the_post();
				$ball_year = get_field( 'ano', get_the_ID() );
				if ( $ball_year != $prev_year ) : //phpcs:ignore
					$prev_year = $ball_year;
					?>

				<div 	class="item-bola item-bola-<?php echo esc_html( $ball_year ); ?> <?php echo 1 === $n ? 'active' : ''; ?>"
						data-year="<?php echo esc_html( $ball_year ); ?>">
					<div class="bola"></div>
					<div class="ano-move">
						<?php echo esc_html( $ball_year ); ?>
					</div>
				</div>

					<?php
					$n++;
				endif;
			endwhile;
			wp_reset_postdata();
			?>

		</div>

		<script type="module">
			jQuery( document ).ready( function(){

				var slider = tns({
					container:           '.slider-crono',
					items:                1.1,
					autoplayButtonOutput: false,
					nav:                  false,
					slideBy:              1,
					autoplay:             false,
					controls:             false,
					mouseDrag:            true,
					speed:                800,
					gutter:               10,

					responsive: {
						1400: {
							items: 3.25,
						},
						1025: {
							mouseDrag: false,
							items:     2.25,
						},
						768: {
							items:     1.5,
							controls:  true,
						},
					},
				});

				var customizedFunction = function (info, eventName) {
					var slide_info  = slider.getInfo();
					var slide_class = slide_info.slideItems[slide_info.index].classList[0];
					var year        = slide_class.split('-');
					$('.item-bola').removeClass('active');
					$('.item-bola-' + year[1]).addClass('active');
				}

				slider.events.on('indexChanged', customizedFunction);

				$('.item-bola').on('click', function(){
					var year = $(this).data('year');

					$('.tns-item').each(function( index ) {
						if($(this).hasClass('cronologia-' + year)){
							slider.goTo(index);
							return false;
						}
					});
				});

			});
		</script>

		<?php endif; // query have_posts. ?>

	</div>

<?php endif; // get_field 'mostrar_cronologia'. ?>
