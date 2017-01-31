(function ($, Drupal, drupalSettings) {
  $( document ).ready(function() {
    //$('a').attr('target', '_blank');
    $('.node__content a').attr('target', '_blank');
    //$('.sidebar h2').slideToggle();
    $( "div.sidebar .block h2" ).click(function() {
		  $(this).parent().find('.content').slideToggle( "fast", function() {
		    // Animation complete.
		  });
	});
	//$('.views-col').matchHeight(options);$('.row').each(function(i, elem) {
	/*$('.views-row').each(function(i, elem) {
        $(elem)
            .find('.views-row')   // Only children of this row
            .matchHeight({byRow: false}); // Row detection gets confused so disable it
    });*/
    $('.view-same-height- .views-col').matchHeight();
   
});
})(jQuery, Drupal, drupalSettings);