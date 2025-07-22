<?php
/**
 * Bloque Aplicaciones y Espacios.
 *
 * @package materialwp
 */

$prod_slug = get_option( 'cupa_cpt_productos' );
if ( ! $prod_slug ) {
	$prod_slug = 'productos';
}

?>

<div class="bloque bloque-aplicaciones-y-espacios <?php echo esc_html( $block['className'] ); ?>">
	<div class="container-custom">
		<div class="copy">
			<?php echo get_field( 'copy_aplicaciones_y_espacios', 'options' ); //phpcs:ignore ?>
		</div>
		<div class="container-custom-2">

			<?php
			$my_taxs = array(
				array(
					'taxonomy' => 'aplicacion',
					'name'     => 'aplicaciones',
				),
				array(
					'taxonomy' => 'espacio',
					'name'     => 'espacios',
				),
			);

			foreach ( $my_taxs as $_tax ) :
				?>

			<div class="my-tax <?php echo esc_html( $_tax['name'] ); ?>">
				<h2><?php echo esc_html( $_tax['name'] ); ?></h2>
				<div class="inner" style="background-image: url(<?php echo esc_url( get_field( 'imagen_taxonomia_' . $_tax['name'], 'options' ) ); ?>);">
					<div class="velo-tax"></div>
					<div class="izq">
						<?php echo get_field( 'descripcion_taxonomia_' . $_tax['name'], 'options' ); //phpcs:ignore ?>
					</div>
					<div class="der">
						<ul>

						<?php
						$terms = get_terms( $_tax['taxonomy'] );
						if ( $terms ) {
							echo '<li class="show-filter" tax="" term_id="">' . esc_html__( 'Ver todas', 'materialwp' ) . '</li>';
							foreach ( $terms as $_term ) {
								echo '<li class="show-filter" tax="' . esc_html( $_tax['taxonomy'] ) . '" term_id="' . esc_html( $_term->term_id ) . '">' . esc_html( $_term->name ) . '</li>';
							}
						}
						?>

						</ul>
					</div>
				</div>
			</div>

			<?php endforeach; ?>

			<script type="text/javascript">
				jQuery( document ).ready(function() {
					jQuery('li.show-filter').on( 'click', function(){
						var tax 	= jQuery(this).attr('tax');
						var term_id = jQuery(this).attr('term_id');
						if ( tax!="" && term_id!="" ){
							window.location.href = '/<?php echo esc_html( $prod_slug ); ?>/?tax='+tax+'&term_id='+term_id;
						} else {
							window.location.href = '/<?php echo esc_html( $prod_slug ); ?>/';
						}
					});

					function isScrolledIntoView(elem) {
						var elemTop 	= elem[0].getBoundingClientRect().top;
						var elemBottom 	= elem[0].getBoundingClientRect().bottom;
						var isVisible   = false;
						if( elemTop < window.innerHeight ){
							if( elemBottom >= 0 ){
								isVisible = true;
							}
						}
						return isVisible;
					}

					document.addEventListener( 'scroll', function (event) {
						checkShowHide();
					}, true );

					function checkShowHide(){
						if( document.body.clientWidth <= 768 ) {
							jQuery( '.bloque-aplicaciones-y-espacios .container-custom .my-tax' ).each( function(){
								if ( isScrolledIntoView( jQuery(this) ) ) {
									if ( !jQuery(this).hasClass('showData') ) {
										jQuery(this).addClass( 'showData' );
									}
								} else {
									jQuery(this).removeClass( 'showData' );
								}
							});
						}
					}

					checkShowHide();

				});
			</script>

		</div>
	</div>
</div>
