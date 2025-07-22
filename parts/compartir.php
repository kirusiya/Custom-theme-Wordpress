<?php
/**
 * Compartir
 *
 * @package materialwp
 */

?>

<div class="iconos-compartir">

	<?php
	global $wp;
	$current_url = home_url( $wp->request );
	if ( is_single() && 'post' === get_post_type() ) :
		?>

		<p><?php esc_html_e( 'Compartir artículo', 'materialwp' ); ?></p>

	<?php endif; ?>

	<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url( $current_url ); ?>" target="_blank">
		<img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/images/facebook-2.png" alt="Facebook">
	</a>

	<a href="https://twitter.com/share?url=<?php echo esc_url( $current_url ); ?>" target="_blank">
		<img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/images/twitter-2.png" alt="Twitter">
	</a>

	<a href="http://pinterest.com/pin/create/link/?url=<?php echo esc_url( $current_url ); ?>&media=<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'full' ) ); ?>&description=<?php echo esc_html( str_replace( ' ', '%20', get_the_title() ) ); ?>" target="_blank">
		<img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/images/pinterest-2.png" alt="Pinterest">
	</a>

	<a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo esc_url( $current_url ); ?>&title=<?php echo esc_html( str_replace( ' ', '%20', get_the_title() ) ); ?>&summary=<?php echo esc_html( str_replace( ' ', '%20', get_the_title() ) ); ?>&source=LinkedIn" target="_blank">
		<img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/images/linkedin-2.png" alt="Linkedin">
	</a>

	<a href="http://www.houzz.com/imageClipperUpload?imageUrl=<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'full' ) ); ?>&title=<?php echo esc_html( str_replace( ' ', '%20', get_the_title() ) ); ?>&link=<?php echo esc_url( $current_url ); ?>" target="_blank">
		<img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/images/houzz-2.png" alt="Houzz">
	</a>

</div>
