<?php
/**
 * Filtros para eventos
 *
 * @package materialwp
 */

?>

<div class="filtros-productos filtros-eventos">
	<div class="container-custom">
		<div class="all-selects">

			<?php
			$tipo_de_evento = get_terms( 'tipos-de-evento' );
			$paises         = get_terms( 'paises' );
			?>

			<div class="container-select tipos-de-evento">
				<?php echo getSelectFromTerms( $tipo_de_evento, 'Tipo de evento', 'Tipo de evento' ); //phpcs:ignore ?>
			</div>

			<div class="container-select paises">
				<?php echo getSelectFromTerms( $paises, 'País', 'País' ); //phpcs:ignore ?>
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
		arrayFilters['tipos-de-evento'] = 0;
		arrayFilters['paises']   		= 0;

		jQuery('.all-selects select').change( function() {

			var tax  = jQuery(this).attr( 'id' );
			var term = jQuery(this).find( 'option:selected' ).text();

			if ( arrayFilters[ tax ] > 0 ) {
				jQuery( '.all-filters .filter#' + tax ).remove();
				arrayFilters[ tax ] = 0;
			}

			arrayFilters[tax] = 1;

			jQuery( this ).parent().addClass('active');

			jQuery( '.all-filters' ).prepend( '<div id="'+tax+'" class="filter" content="'+term+'"><div class="close">+</div>'+term+'</div>' );
			jQuery( '.all-filters .clean-filters' ).show('slow');

			getTaxonomiesAndTerms();

		});

		function getTaxonomiesAndTerms(){
			var taxonomies = '';
			var terms 	   = '';
			jQuery('.all-filters .filter').each( function(){
				taxonomies += jQuery(this).attr( 'id' ) + ',';
				terms 	   += jQuery(this).attr( 'content' ) + ',';
			});

			taxonomies = taxonomies.slice( 0, -1 );
			terms      = terms.slice( 0, -1 );

			launchAjax( taxonomies, terms );
		}

		function launchAjax( tax, term ) {

			var datos = {						
				'action'     : 'get_all_eventos',
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
					jQuery( '.posts-productos .posts' ).html( res );
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

		getTaxonomiesAndTerms();

	});
</script>
