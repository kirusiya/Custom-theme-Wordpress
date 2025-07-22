<?php
/**
 * Cabecera de post
 *
 * @package materialwp
 */

?>

<div class="bloque-cabecera-single-post" style="background-image: url(<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'full' ) ); ?>);">
	<div class="container-blog">
		<h1><?php the_title(); ?></h1>
	</div>
	<div class="velo-cabecera-single-post"></div>
</div>
