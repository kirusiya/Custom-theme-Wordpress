jQuery(document).ready(function($) {

  // Botón menú móvil
  $('.hamburguer-button').on('click', function () {
    $(this).find('.animated-icon').toggleClass('open');
  });

  // Ocultar topbar al hacer scroll hacia abajo en desktop
  function checkWidth() {
    var windowsize = $( window ).width();
    if (windowsize > 1200) {
      var prevScrollpos = window.pageYOffset;
      window.onscroll = function() {
        var currentScrollPos = window.pageYOffset;
        if (prevScrollpos > currentScrollPos) {
          document.getElementById("mastheadNav").style.top = "0";
        } else {
          document.getElementById("mastheadNav").style.top = "-35px";
        }
        prevScrollpos = currentScrollPos;
      }
    } else {
      document.getElementById("mastheadNav").style.top = "0";
      window.onscroll = function() {
        document.getElementById("mastheadNav").style.top = "0";
      }
    }
  }
  checkWidth();
  $(window).resize(function() {
    checkWidth();
  });

  // Enlace en contenedor
  $('.fake-a').on('click',function(e){
    document.location.href = $(this).find('a')[0].href;
  });
  $('.fake-a-last').on('click',function(e){
      var last = $(this).find('a').length - 1;
      document.location.href = $(this).find('a')[last].href;
  });

  // Buscar
  $('#iconSearch').on('click', function(e){
    $('#searchForm').fadeIn();
    $('#searchForm input').focus();
  });
  $('#iconSearchClose').on('click', function(e){
    $('#searchForm').fadeOut();
  });
});
