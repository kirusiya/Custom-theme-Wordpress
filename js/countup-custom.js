/* Minilibrary to animate numbers counting up thorw jQuery */
function countUpAnimation( class_count, animation_duration ){
    jQuery( class_count ).each(function() {
        var $this = jQuery(this),
          countTo = $this.attr('data-count');
      
        jQuery({ countNum: $this.text()}).animate(
            {
                countNum: countTo
            },
            {
                duration: animation_duration,
                easing:'linear',
                step: function() {
                  $this.text(Math.floor(this.countNum));
                },
                complete: function() {
                  $this.text(this.countNum);
                }
            }
        );
    });
}