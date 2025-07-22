jQuery( document ).ready(function($) {

    if ($('.modalyoutube').length) {
    $(".modalyoutube").iziModal({
        iframe : true,
        fullscreen: true,
        width: 700
      });

      $(".openvideo").click( function(event){
        event.preventDefault(); // Previene la navegación estándar del enlace
        event.stopImmediatePropagation();
      $('.modalyoutube').iziModal('open', { zindex: 99999 });
     });
    }

    /* MENU */
    jQuery('nav button.navbar-toggler').click( function(){
    	if ( jQuery(this).hasClass('collapsed') ){
            jQuery('html').css({    /* disable scrolling */
                'height'   : '100%',
                'overflow' : 'hidden',
            });
	       jQuery('nav.navbar').addClass('menu-is-open');
        } else {
            jQuery('html').css({    /* enable scrolling */
                'height'   : 'unset',
                'overflow' : 'unset',
            });
	    	jQuery('nav.navbar').removeClass('menu-is-open');
	    }
    });

    /* MODAL WINDOW */
    jQuery('.div-ampliar.open').on( 'click', function(e){
        e.preventDefault();
    	var src = jQuery(this).find('.ampliar').attr('src');
    	jQuery('.mymodal .img-modal img').attr('src', src);
    	jQuery('.mymodal').show('slow');
    });
    jQuery('.mymodal .close').on( 'click', function(e){
    	jQuery('.mymodal').hide('slow');
    	jQuery('.mymodal .img-modal img').attr('src', '');
    });
    jQuery( document ).mouseup( function(e) {
    	if ( jQuery('.mymodal').is(":visible") ) {
		    var container = jQuery(".mymodal .img-modal");
		    if ( !container.is(e.target) && container.has(e.target).length === 0 ) {
		        jQuery('.mymodal .close').click();
		    }
		}
	});
    jQuery( document ).keyup( function(e) {
        if ( e.key === "Esc" || e.key === "Escape" || e.key === "27" || e.key === 27 ) {            
            if ( jQuery('.mymodal').is(":visible") ) {
                jQuery('.mymodal .close').click();                
            }
        }
    });

    /* FORM CUPA */
    jQuery('.form-cupa select option:first-child').attr( 'disabled', 'disabled' );

    /* FIX FOR MENU */
    if( jQuery( window ).scrollTop() != 0 ){
        jQuery(window).scrollTop( jQuery(window).scrollTop() + 1 );
    }

    // jQuery plugin to replace text strings
    $.fn.replaceText = function( search, replace, text_only ) {
    return this.each(function(){
            var node = this.firstChild,
            val, new_val, remove = [];
            if ( node ) {
                do {
                  if ( node.nodeType === 3 ) {
                    val = node.nodeValue;
                    new_val = val.replace( search, replace );
                    if ( new_val !== val ) {
                      if ( !text_only && /</.test( new_val ) ) {
                        $(node).before( new_val );
                        remove.push( node );
                      } else {
                        node.nodeValue = new_val;
                      }
                    }
                  }
                } while ( node = node.nextSibling );
            }
            remove.length && $(remove).remove();
        });
    };
    
});



// Asegurarse de que Lightbox se reinicializa después de que el DOM esté completamente cargado
$(window).on('load', function() {
    

    if ($('a[data-lightbox]').length) {

    $('a[data-lightbox]').each(function() {
        var href = $(this).attr('href');
        // Modifica el href para remover el tamaño específico, asumiendo que los nombres de archivos siguen un patrón consistente
        var fullHref = href.replace(/-\d+x\d+(\.\w+)$/, '$1');
        $(this).attr('href', fullHref);
    });

    lightbox.option({
        'resizeDuration': 200,
        'wrapAround': true,
        'maxWidth': window.innerWidth * 0.95,  // 95% del ancho de la ventana
        'maxHeight': window.innerHeight * 0.95 // 95% de la altura de la ventana
    });
    


    $('a[data-lightbox], a[rel^="lightbox"]').on('click', function(event) {
        event.preventDefault(); // Previene la navegación estándar del enlace
        event.stopImmediatePropagation();
        lightbox.start($(this)); // Inicia Lightbox para el elemento actual
    });
    }
    
});

// También puedes llamar a reinicializarLightbox() después de agregar dinámicamente imágenes o enlaces que deban usar Lightbox
