<?php
/**
 * The template for displaying search results pages.
 *
 * @package materialwp
 */

get_header();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="container">
		<div class="row">
			<section id="primary" class="col-md-8 offset-md-2">
				<main id="main" class="site-main" role="main">

				<?php
				$query_productos = new WP_Query(
					array(
						'post_type' => array( 'productos' ),
						's'			=> esc_html( $_GET['s'] ), //phpcs:ignore
						'orderby'   => 'title',
						'order'     => 'ASC',
					)
				);

				$query_posts = new WP_Query(
					array(
						'post_type' => array( 'post' ),
						's'			=> esc_html( $_GET['s'] ), //phpcs:ignore
					)
				);
				?>

				<?php if ( $query_productos->have_posts() || $query_posts->have_posts() ) : ?>

					<div class="resultado-busqueda">
						<?php echo esc_html__( 'Resultados para: ' ) . '"<span>' . $_GET['s'] . '</span>"'; //phpcs:ignore ?>
					</div>

					<?php
					while ( $query_productos->have_posts() ) :
						$query_productos->the_post();
						get_template_part( 'content', 'search' );
					endwhile;
					?>

					<?php
					while ( $query_posts->have_posts() ) :
						$query_posts->the_post();
						get_template_part( 'content', 'search' );
					endwhile;
					?>

				<?php endif; ?>

				<?php
				if ( ! $query_productos->have_posts() && ! $query_posts->have_posts() ) :
					get_template_part( 'content', 'none' );
				endif;
				?>

				</main>
			</section>

		</div>
	</div>
</article>

<?php get_footer(); ?>

<?php if ( have_posts() ) : ?>
<script type="text/javascript">
	jQuery( window ).ready( function($) {
		$('*').replaceText(/(<?php echo $_GET['s']; //phpcs:ignore ?>)/gi, '<span class="highlight">$1</span>');
	});
</script>
<?php endif; ?>
