<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package materialwp
 */

get_header(); ?>

<div class="home_secciones">

<?php
while ( have_posts() ) :
	the_post();
	global $post;
	if ( '' !== $post->post_content ) :
		?>
		<div class="content-page">
			<div class="row">
				<?php the_content(); ?>        
			</div>
		</div>
	<?php endif; ?>
<?php endwhile; ?>

</div>

<?php get_footer(); ?>
