<?php
/**
 * The template part for displaying content in single post.
 *
 * @package materialwp
 */

?>

<div class="entry-container">

	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<div class="entry-meta">
			<?php
			if ( is_singular( 'eventos' ) ) {
				include get_stylesheet_directory() . '/parts/misc/meta_evento.php';
			} else {
				materialwp_posted_on();
			}
			?>
		</div>
	</header>

	<div class="entry-content">
		<?php the_content(); ?>
	</div>

</div>
