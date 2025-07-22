<?php
/**
 * Importar productos
 *
 * @package materialwp
 */

// @codingStandardsIgnoreStart

/*
?>

<div class="bloque-import-csv container" style="padding-top: 200px;">

<?php
switch ( $_SERVER['SERVER_NAME'] ) {
	case 'cupastonept.servidor.gal':
		$lang = 'PT';
		break;
	case 'cupastoneen.servidor.gal':
		$lang = 'COM';
		break;
	case 'cupastonefr.servidor.gal':
		$lang = 'FR';
		break;
	case 'cupastonede.servidor.gal':
		$lang = 'DE';
		break;
}

$file    = get_stylesheet_directory() . '/import/productos_' . $lang . '.csv';
$img_dir = get_template_directory_uri() . '/import/images/' . $lang . '/';

if ( file_exists( $file ) ) {
	?>

	<div class="message">Importando...</div>

	<?php
	ini_set( 'auto_detect_line_endings', true );

	if ( ( $handle = fopen( $file, 'r' ) ) !== false ) {
		$count 	  = 0;
		$cabecera = [];

		while ( ( $data = fgetcsv( $handle, 100000, ',' ) ) !== false ) {
			$linea = $data;

			if ( 0 === intval( $count ) ) { // Línea 0: cabeceras
				$c = 0;

				foreach ( $linea as $_cab ) {
					$cabecera[$c] = $_cab;
					$c++;
				}
			} else { // Resto de líneas: contenido
				$referencia    = null;
				$array_espacio = null;
				$c             = 0;
				$espacio       = [];
				$acabado       = [];
				$ficha_tecnica = [];
				$aplicacion    = [];
				$imgs_prod     = [];

				foreach ( $linea as $_contenido ) { // Recorremos cada campo de línea
					$contenido[$c] = $_contenido;

					switch ( $cabecera[$c] ) {

						case 'PRODUCT':
							if ( '' !== $contenido[$c] ) {
								$title = $contenido[$c];
							} else {
								$title = 'Sin título';
							}							
							break;

						case 'MATERIEL':
							if ( '' !== $contenido[$c] ) {
								$term = get_term_by( 'name', $contenido[$c], 'material' );
								if ( $term === false ) {
									$term     = wp_insert_term( $contenido[$c], 'material' );
									$material = $term['term_id'];
								} else {
									$material = $term->term_id;
								}
							} else {
								$material = '';
							}
							break;

						case 'GAMME':
							if ( '' !== $contenido[$c] ) {
								$term = get_term_by( 'name', $contenido[$c], 'gama' );
								if ( $term === false ) {
									$term = wp_insert_term( $contenido[$c], 'gama' );
									$gama = $term['term_id'];
								} else {
									$gama = $term->term_id;
								}
							} else {
								$gama = '';
							}
							break;

						case 'REFERENCE':
							if ( '' !== $contenido[$c] ) {
								$referencia = $contenido[$c];
							} else {
								$referencia = '';
							}
							break;

						case 'DESCRIPTION':
							if ( '' !== $contenido[$c] ) {
								$descripcion = $contenido[$c];
							} else {
								$descripcion = '';
							}
							break;

						case 'CATALOGUE':
							if ( '' !== $contenido[$c] ) {
								$catalogo = attachment_url_to_postid( $contenido[$c] );
							} else {
								$catalogo = '';
							}
							break;

						case 'MAIN COLOR':
							if ( '' !== $contenido[$c] ) {
								$term = get_term_by( 'name', $contenido[$c], 'color' );
								if ( $term === false ) {
									$term  = wp_insert_term( $contenido[$c], 'color' );
									$color = $term['term_id'];
								} else {
									$color = $term->term_id;
								}
							} else {
								$color = '';
							}
							break;

						case 'FINITION':
							if ( '' !== $contenido[$c] ) {
								$array = explode( ',', $contenido[$c] );
								foreach ( $array as $_elem ) {
									$term = get_term_by( 'name', $_elem, 'acabado' );
									if ( $term === false ) {
										$term      = wp_insert_term( $_elem, 'acabado' );
										$acabado[] = $term['term_id'];
									} else {
										$acabado[] = $term->term_id;
									}
								}
							}
							break;

						case 'ESPACES 1':
						case 'ESPACES 2':
						case 'ESPACES 3':
						case 'ESPACES 4':
						case 'ESPACES 5':
						case 'ESPACES 6':
							if ( 'all' === $contenido[$c] ) {
								$terms = get_terms( 'espacio' );
								foreach ( $terms as $term ) {
							        $espacio[] = $term->term_id;
							    }
							} elseif ( '' !== $contenido[$c] ) {
								$term = get_term_by( 'name', $contenido[$c], 'espacio' );
								if ( $term === false ) {
									$term      = wp_insert_term( $contenido[$c], 'espacio' );
									$espacio[] = $term['term_id'];
								} else {
									$espacio[] = $term->term_id;
								}
							}
							break;

						case 'UTILISATIONS':
						case 'UTILISATIONS 2':
						case 'UTILISATIONS 3':
						case 'UTILISATIONS 4':
						case 'UTILISATIONS 5':
							if ( 'all' === $contenido[$c] ) {
								$terms = get_terms( 'aplicacion' );
								foreach ( $terms as $term ) {
							        $aplicacion[] = $term->term_id;
							    }
							} elseif ( '' !== $contenido[$c] ) {
								$term = get_term_by( 'name', $contenido[$c], 'aplicacion' );
								if ( $term === false ) {
									$term         = wp_insert_term( $contenido[$c], 'aplicacion' );
									$aplicacion[] = $term['term_id'];
								} else {
									$aplicacion[] = $term->term_id;
								}
							}
							break;

						case 'FORMATS':
							if ( '' !== $contenido[$c] ) {
								$formato = $contenido[$c];
							} else {
								$formato = '';
							}
							break;

						case 'OPTIONS':
							if ( '' !== $contenido[$c] ) {
								$opciones = $contenido[$c];
							} else {
								$opciones = '';
							}
							break;

						case 'FICHE TECNIQUE':
							if ( '' !== $contenido[$c] ) {
								$array = explode( ';', $contenido[$c] );
								if ( $array ) {
									foreach ( $array as $_elem ) {
										$ficha_tecnica[] = array( 'elemento' => $_elem );
									}
								}
							}
							break;

						case 'ORIGINE':
							if ( '' !== $contenido[$c] ) {
								$origen = strtolower( $contenido[$c] );
							} else {
								$origen = '';
							}
							break;

						case 'IMAGES PRODUIT':
							if ( '' !== $contenido[$c] ) {
								$array = explode( ',', $contenido[$c] );
								if ( $array ) {
									foreach ( $array as $_elem ) {
										$imgs_prod[] = $img_dir . $_elem;
									}
								}
							}
							break;

						case 'IMAGES AMBIENCE':
							if ( '' !== $contenido[$c] ) {
								$img_amb = $img_dir . $contenido[$c];
							} else {
								$img_amb = '';
							}
							break;

						default:
							break;
					}

					$c++;
				}

				// PARA MOSTRAR RESULTADOS EN PANTALLA
				echo 'Nombre: ' . $title . '<br>';
				echo 'Material (id): ' . $material . '<br>';
				echo 'Gama (id): ' . $gama . '<br>';
				echo 'Referencia: ' . $referencia . '<br>';
				echo 'Descripción: ' . $descripcion . '<br>';
				echo 'Catálogo (id imagen): ' . $catalogo . '<br>';
				echo 'Color (id): ' . $color . '<br>';
				echo 'Acabados (ids): ' . implode( ',', $acabado ) . '<br>';
				echo 'Espacios (ids): ' . implode( ',', $espacio ) . '<br>';
				echo 'Aplicaciones (ids): ' . implode( ',', $aplicacion ) . '<br>';
				echo 'Formato: ' . $formato . '<br>';
				echo 'Opciones: ' . $opciones . '<br>';
				echo 'Ficha técnica: ' . implode( ',', $ficha_tecnica ) . '<br>';
				echo 'Origen: ' . $origen . '<br>';
				echo 'Imágenes producto: ' . implode( ',', $imgs_prod ) . '<br>';
				echo 'Imagen ambiente: ' . $img_amb . '<br>';
				echo '<br><br>';

				// Create post
				$post_id = wp_insert_post([
					'post_type' 	=> 'productos',
					'post_title' 	=> $title,
					'post_content' 	=> $descripcion,
					'post_status' 	=> 'publish',
				]);

				// Taxonomies
				if ( '' !== $material ) {
					wp_set_post_terms( $post_id, $material, 'material' );
				}
				if ( '' !== $gama ) {
					wp_set_post_terms( $post_id, $gama, 'gama' );
				}
				if ( '' !== $color ) {
					wp_set_post_terms( $post_id, $color, 'color' );
				}
				if ( $acabado ) {
					wp_set_post_terms( $post_id, $acabado, 'acabado' );
				}
				if ( $espacio ) {
					wp_set_post_terms( $post_id, $espacio, 'espacio' );
				}
				if ( $aplicacion ) {
					wp_set_post_terms( $post_id, $aplicacion, 'aplicacion' );
				}

				// Custom fields
				if ( '' !== $material ) {
					update_field( 'referencia', $referencia, $post_id );
				}
				if ( '' !== $catalogo ) {
					update_field( 'catalogo', $catalogo, $post_id );
				}
				if ( '' !== $formato ) {
					update_field( 'formato', $formato, $post_id );
				}
				if ( '' !== $opciones ) {
					update_field( 'opciones', $opciones, $post_id );
				}
				if ( $ficha_tecnica ) {
					update_field( 'ficha_tecnica', $ficha_tecnica, $post_id );
				}
				if ( '' !== $origen ) {
					update_field( 'origen', $origen, $post_id );
				}

				// Imagen de búsqueda y destacada
				if ( $imgs_prod ) {
					foreach ( $imgs_prod as $img ) {
						$string = 'TEXTURA';
						$pos = strpos( $img, $string );
						if ( $pos !== false ) {
							$img_buscar = $img;
							break;
						} else {
							$img_buscar = $imgs_prod[0];
						}
					}
					$attachment_id_bus = import_multimedia( $img_buscar, $post_id );
					set_post_thumbnail( $post_id, $attachment_id_bus );
					update_field( 'imagen_para_busqueda_de_productos', $attachment_id_bus, $post_id );
					update_field( 'imagen_para_listados', $attachment_id_bus, $post_id );
				}

				// Imagen de ambiente
				if ( '' !== $img_amb ) {
					wp_set_post_terms( $post_id, [70, 71], 'galeria' );
					$attachment_id_amb = import_multimedia( $img_amb, $post_id );
					update_field( 'imagen_para_galeria_70', $attachment_id_amb, $post_id );
					update_field( 'imagen_para_galeria_71', $attachment_id_amb, $post_id );
				}

				// Galería
				$cf_imagenes	 = 'field_5dc9335cbe108';
				$subfield_imagen = 'field_5dc9336dbe109';
				if ( '' !== $img_amb ) {
					$row = array( $subfield_imagen => $attachment_id_amb );
					add_row( $cf_imagenes, $row, $post_id );
				}
				if ( $imgs_prod ) {
					$row = array( $subfield_imagen => $attachment_id_bus );
					add_row( $cf_imagenes, $row, $post_id );
					foreach ( $imgs_prod as $img ) {
						if ( $img !== $img_buscar ) {
							$attachment_id = import_multimedia( $img, $post_id );
							$row = array( $subfield_imagen => $attachment_id );
							add_row( $cf_imagenes, $row, $post_id );
						}
					}
				}

			}

			$count++;
		}

		fclose( $handle );

		echo '<div class="message">' .__('Fin.'). '</div>';
	}

} else {
	echo '<div class="message">' .__('No existe el fichero: ').$file. '</div>';
	echo '<div class="message">' .__('Fin.'). '</div>';
}

?>

</div>

<?php */ ?>