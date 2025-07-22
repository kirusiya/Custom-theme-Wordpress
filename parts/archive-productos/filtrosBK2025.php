<?php
/**
 * Filtros productos
 *
 * @package materialwp
 */




?>

<div class="filtros-productos">
	<div class="container-custom">
		<div class="all-selects">

			<?php
			$args         = array(
				'orderby' => 'name',
				'order'   => 'ASC',
			);
			$gamas        = get_terms( 'gama', $args );
			$aplicaciones = get_terms( 'aplicacion', $args );
			$espacios     = get_terms( 'espacio', $args );
			$colores      = get_terms( 'color', $args );
			$acabados     = get_terms( 'acabado', $args );
			$materiales   = get_terms( 'material', $args );
			?>

			<div class="container-select gama">
				<?php echo getSelectFromTerms( $gamas, __( 'Gama', 'materialwp' ), 'Gama' ); //phpcs:ignore ?>
			</div>

			<div class="container-select aplicacion">
				<?php echo getSelectFromTerms( $aplicaciones, __( 'Aplicación', 'materialwp' ), 'Aplicación' ); //phpcs:ignore ?>
			</div>

			<div class="container-select espacio">
				<?php echo getSelectFromTerms( $espacios, __( 'Espacio', 'materialwp' ), 'Espacio' ); //phpcs:ignore ?>
			</div>

			<div class="container-select color">
				<?php echo getSelectFromTerms( $colores, __( 'Color', 'materialwp' ), 'Color' ); //phpcs:ignore ?>
			</div>			

			<div class="container-select acabado">
				<?php echo getSelectFromTerms( $acabados, __( 'Acabado', 'materialwp' ), 'Acabado' ); //phpcs:ignore ?>
			</div>

			<div class="container-select material">
				<?php echo getSelectFromTerms( $materiales, __( 'Material', 'materialwp' ), 'Material' ); //phpcs:ignore ?>
			</div>

		</div>
	</div>
</div>

<div class="filters-used">
	<div class="container-custom">
		<div class="all-filters">
			<div class="clean-filters">
				<a href="#"><?php esc_html_e( 'Limpiar filtros', 'materialwp' ); ?></a>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	jQuery( document ).ready( function() {




		var arrayFilters = [];
		arrayFilters['aplicacion'] = 0;
		arrayFilters['espacio']    = 0;
		arrayFilters['color'] 	   = 0;
		arrayFilters['gama'] 	   = 0;
		arrayFilters['acabado']    = 0;
		arrayFilters['material']   = 0;

		jQuery('.all-selects select').change( function() {

			var tax  = jQuery(this).attr( 'id' );
			var term = jQuery(this).find( 'option:selected' ).text();
			var term_id = jQuery(this).find( 'option:selected' ).val();

			if ( arrayFilters[ tax ] > 0 ) {
				jQuery( '.all-filters .filter#' + tax ).remove();
				arrayFilters[ tax ] = 0;
			}

			arrayFilters[tax] = 1;

			jQuery( this ).parent().addClass('active');

			jQuery( '.all-filters' ).prepend( '<div id="'+tax+'" class="filter" content="'+term+'" term_id="'+term_id+'"><div class="close">+</div>'+term+'</div>' );
			jQuery( '.all-filters .clean-filters' ).show('slow');

			getTaxonomiesAndTerms();

		});

		function getTaxonomiesAndTerms(){
			cleanCustomFilters();

			var taxonomies = '';
			var terms 	   = '';

			jQuery('.all-filters .filter').each( function(){
				taxonomies += jQuery(this).attr( 'id' ) + ',';
				terms 	   += jQuery(this).attr( 'term_id' ) + ',';				
				if( (jQuery(this).attr( 'id' ) != "") && (jQuery(this).attr('term_id')!="") ){
					saveCustomFilters( jQuery(this).attr( 'id' ), jQuery(this).attr('term_id') );
				}				
			});

			taxonomies = taxonomies.slice( 0, -1 );
			terms      = terms.slice( 0, -1 );

			launchAjax( taxonomies, terms );
		}

		function launchAjax( tax, term ) {

			var datos = {						
				'action'     : 'get_all_productos',
				'taxonomies' : tax,
				'terms' 	 : term,
			};

			jQuery.ajax({
				type : 'post',
				url  : '/wp-admin/admin-ajax.php',
				data : datos,

				beforeSend: function(){
					jQuery( '.posts-productos .posts' ).html("");
					jQuery( '.posts-productos .posts' ).append( "<div class='searching'></div>");
				},

				success: function( res ){
					console.log(res);
					if ( res=="" ){						
						res = '<div class="no-results">' +
								'<?php _e( 'No existen productos con los filtros que has seleccionado.<br><br>¿Necesitas ayuda?', 'materialwp' ); ?>' +
								'<div class="boton-cupa-granate">' +
									'<a href="<?php echo esc_url( get_field( 'contacto_pagina', 'options' ) ); ?>">' +
										'<?php esc_html_e( 'Contacta', 'materialwp' ); ?><span class="arrow-btn"></span>' +
									'</a>' +
								'</div>' +
							'</div>';
					}
					jQuery( '.posts-productos .posts' ).html( res );
					window.scrollTo(0,0);
				}
			});
		}

		jQuery( document ).on( 'click', '.all-filters .filter .close', function() {
			var id_parent = jQuery(this).parent().attr('id');
			jQuery( '.all-selects select#'+id_parent )[0].selectedIndex = 0;
			jQuery('.all-selects select#'+id_parent).parent().removeClass('active');
			jQuery( this ).parent().remove();
			getTaxonomiesAndTerms();
			if( jQuery( '.all-filters .filter' ).length == 0 ){
				jQuery( '.all-filters .clean-filters' ).hide();
			}
		});

		jQuery( '.all-filters .clean-filters a' ).click( function() {
			jQuery( '.all-selects select' ).each( function(){
				jQuery( this )[0].selectedIndex = 0;
				jQuery( this ).parent().removeClass('active');
			});			
			jQuery( '.all-filters .filter' ).remove();
			getTaxonomiesAndTerms();
			jQuery( this ).parent().hide();
		});

		function saveCustomFilters( tax, term_id ) {
			var date = new Date();
			date.setTime( date.getTime() + (5*60*1000) );
			document.cookie = 'tax_' +tax+ '=' +tax+ ';expires=' +date.toGMTString();
			document.cookie = 'term_id_' +tax+ '=' +term_id+ ';expires=' +date.toGMTString();
		}

		function cleanCustomFilters() {
			var date = new Date();
			date.setTime( date.getTime() + (0*60*1000) );
			var arrayFilters = [ 'aplicacion', 'espacio', 'color', 'gama', 'acabado', 'material' ];
			for( i=0; i<arrayFilters.length; i++ ) {
				document.cookie = 'tax_' + arrayFilters[i] + '=;expires=' +date.toGMTString();
				document.cookie = 'term_id_' + arrayFilters[i] + '=;expires=' +date.toGMTString();
			}
		}

		function getCookie(name) {
			const value = `; ${document.cookie}`;
			const parts = value.split(`; ${name}=`);
			if (parts.length === 2) return parts.pop().split(';').shift();
		}

		var hasGETParams = false;

		<?php
		$tax_param     = $_GET['tax']; //phpcs:ignore
		$term_id_param = $_GET['term_id']; //phpcs:ignore

		if ( isset( $tax_param ) && ( '' !== $tax_param ) && isset( $term_id_param ) && ( '' !== $term_id_param ) ) {
			?>
			hasGETParams = true;
			jQuery('select#<?php echo esc_html( $tax_param ); ?>').val('<?php echo esc_html( $term_id_param ); ?>').trigger('change');
			<?php
		}
		?>

		var hasCookieParams = false;		

		if( !hasGETParams ) {
			var array_Filters = [ 'aplicacion', 'espacio', 'color', 'gama', 'acabado', 'material' ];
			var tax_last, term_id_last;
			for( i=0; i<array_Filters.length; i++ ) {
				var tax     = getCookie( 'tax_' + array_Filters[i] );
				var term_id = getCookie( 'term_id_' + array_Filters[i] );
				if( tax && term_id ) {
					saveCustomFilters( tax, term_id );
					hasCookieParams = true;
					jQuery( 'select#' + tax ).val( term_id.toString() );
					var term = jQuery( 'select#' + tax ).find( 'option:selected' ).text();
					if ( arrayFilters[ tax ] > 0 ) {
						jQuery( '.all-filters .filter#' + tax ).remove();
						arrayFilters[ tax ] = 0;
					}
					arrayFilters[tax] = 1;
					jQuery( 'select#' + tax ).parent().addClass('active');
					jQuery( '.all-filters' ).prepend( '<div id="'+tax+'" class="filter" content="'+term+'" term_id="'+term_id+'"><div class="close">+</div>'+term+'</div>' );
					jQuery( '.all-filters .clean-filters' ).show('slow');
				}
			}
			if( hasCookieParams ){
				getTaxonomiesAndTerms();
			}
		}

		if( !hasGETParams && !hasCookieParams ){
			getTaxonomiesAndTerms();
		}


		<?php
			
			$tax_params = isset($_GET['tax']) ? $_GET['tax'] : [];
			$term_id_params = isset($_GET['term_id']) ? $_GET['term_id'] : [];
			
			// Verificar que ambos arrays tienen la misma longitud
			if (count($tax_params) == count($term_id_params)) {
				for ($i = 0; $i < count($tax_params); $i++) {
					$tax = esc_html($tax_params[$i]);
					$term_id = esc_html($term_id_params[$i]);
			
					// Asignar valor al select adecuado en el frontend mediante JavaScript
					echo "jQuery('select#{$tax}').val('{$term_id}').trigger('change');";
				}
			}
					   ?>

jQuery('.all-selects  select:first').change();

	});
</script>
