<?php
/**
 * Contenido de post
 *
 * @package materialwp
 */

?>

<div class="bloque-contenido-single-post">
	<div class="container-blog">
		<div class="top">

			<div class="fecha">
				<?php
					$dia = get_the_date( 'd', get_the_ID() );
					$mes = getLargeMonth( get_the_date( 'M', get_the_ID() ) );
					$ano = get_the_date( 'Y', get_the_ID() );
					echo $dia .' ' . $mes . ' ' . $ano; //phpcs:ignore
				?>
			</div>

			<div class="categorias">
				<?php
				$categorias_post = '';
				$cats            = get_the_terms( get_the_ID(), 'category' );
				if ( $cats ) :
					foreach ( $cats as $_cat ) :
						$categorias_post .= '<a href="' . get_category_link( $_cat ) . '">' . $_cat->name . '</a>, ';
					endforeach;
				endif;
				$categorias_post = substr( $categorias_post, 0, -2 );
				echo $categorias_post; //phpcs:ignore
				?>
			</div>

		</div>

		<div class="contenido">
			<?php the_content(); ?>
		</div>

		<?php
		if (
			( 'evento' === $currentCategorySlug ) && //phpcs:ignore
			( eventNotExpired( get_field( 'cuando' ) ) ) &&
			( get_field( 'cuando' ) || get_field( 'donde' ) )
		) :
			?>
		<div class="form-asistir">

			<?php echo do_shortcode( '[contact-form-7 id="1435" title="Form ASISTIR single-evento"]' ); ?>

			<script type="text/javascript">
			jQuery( document ).ready(function() {
				jQuery('input#your-evento[type=hidden]').attr('value','<?php echo esc_html( get_the_title() ); ?>');
				jQuery('input#your-cuando[type=hidden]').attr('value','<?php echo esc_html( get_field( 'cuando' ) ); ?>');
				jQuery('input#your-donde[type=hidden]').attr('value','<?php echo esc_html( get_field( 'donde' ) ); ?>');
			});
			</script>

		</div>
		<?php endif; ?>

		<?php require get_stylesheet_directory() . '/parts/compartir.php'; ?>

	</div>

</div>
