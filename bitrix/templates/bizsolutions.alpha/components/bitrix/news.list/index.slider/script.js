$(function(){
    $('#alpha-slider').flexslider({
        animation: 'slide',
        customDirectionNav: $('.alpha-nav a'),
        controlsContainer: $('.alpha-bullets')
    });
});

$(window).on('resize load', function() {
    var width = $(this).width();
    var ratio = 2;
    var height = Math.round(width / ratio);
    $('#alpha-slider').height(height);
});