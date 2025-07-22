<?php /* ?>
<!-- IMPORT CSV -->
<div class="bloque-import-csv">

<?php

$csv  = 'csv-posts.csv';
$file = get_stylesheet_directory().'/import/'.$csv;


if ( file_exists( $file ) ) {
?>

	<div class="message">Importando...</div>

<?php

	$array_posts = csv_to_array( $file, ';' );	// hincludes/functions.php

	foreach ( $array_posts as $my_post ) {

		// TITLE
		$title = trim( $my_post['TITLE'] );

		// CONTENT
		$content = $my_post['CONTENT'];

		// DATE
		$_arr = explode( '/', trim( $my_post['DATE'] ) );
		$day  = $_arr[0];
		$mon  = $_arr[1];
		$yea  = $_arr[2];
		$hou  = str_pad( rand( 9, 20 ), 2, "0", STR_PAD_LEFT );
		$min  = str_pad( rand( 0, 59 ), 2, "0", STR_PAD_LEFT );
		$sec  = str_pad( rand( 0, 59 ), 2, "0", STR_PAD_LEFT );
		$date = $yea.'-'.$mon.'-'.$day.' '.$hou.':'.$min.':'.$sec;

		// FEATURED IMAGE
		$featured_image = trim( $my_post['FEATURED IMAGE'] );

		// CATEGORIES
		$category = array();
		$category[] = get_cat_ID( trim($my_post['CATEGORIES']) );

		// TAGS
		$tags = trim( $my_post['TAGS'] );

		// SLUG
		$slug = trim( $my_post['SLUG'] );

		// _yoast_wpseo_title
		$_yoast_wpseo_title = trim( $my_post['_yoast_wpseo_title'] );

		// _yoast_wpseo_metadesc
		$_yoast_wpseo_metadesc = trim( $my_post['_yoast_wpseo_metadesc'] );

		// PARA MOSTRAR RESULTADOS EN PANTALLA
		//echo '<br><br>';
		//echo 	$title.'<br>'.					// OK
		//		$content.'<br>'.				// OK
		//		$date.'<br>'.					// OK
		//		$featured_image.'<br>'.			// OK
		//		$category.'<br>'.				// OK
		//		implode(',',$tags).'<br>'.		// OK
		//		$slug.'<br>'.					// OK
		//		$_yoast_wpseo_title.'<br>'.		// OK
		//		$_yoast_wpseo_metadesc.'<br>';	// OK

		// Create post
		$post_id = wp_insert_post([
			'post_title' 	=> $title,		// OK
			'post_name'		=> $slug,		// OK
			'post_content' 	=> $content,	// OK
			'post_status' 	=> 'publish',
			'post_date'		=> $date,		// OK
			'post_category'	=> $category,	// OK
			'tags_input'	=> $tags,		// OK
		]);

		// Featured image
		Generate_Featured_Image( $featured_image, $post_id );	// OK

		// Yoast fields
		update_post_meta( $post_id, '_yoast_wpseo_title', $_yoast_wpseo_title );		// OK
		update_post_meta( $post_id, '_yoast_wpseo_metadesc', $_yoast_wpseo_metadesc );	// OK

	}

	echo '<div class="message">' .__('Fin.'). '</div>';

} else {

	echo '<div class="message">' .__('No existe el fichero csv: ').$file. '</div>';
	echo '<div class="message">' .__('Fin.'). '</div>';

}

?>

</div>
<?php */
