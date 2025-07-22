<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package materialwp
 */

?>

<section class="no-results not-found">
	<div class="entry-container">
		<header>
			<h1 class="page-title">
				<?php echo esc_html__( 'Sin resultados para ', 'materialwp' ) . '"' . esc_html( $_GET['s'] ) . '"'; //phpcs:ignore ?>
			</h1>
		</header>

		<div class="page-content">
			<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<?php elseif ( is_search() ) : ?>
				<p><?php esc_html_e( 'Lo sentimos, no hemos encontrada nada, prueba una nueva búsqueda.', 'materialwp' ); ?></p>
				<?php get_search_form(); ?>

			<?php else : ?>
				<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'materialwp' ); ?></p>
				<?php get_search_form(); ?>

			<?php endif; ?>
		</div>
	</div>
</section>
