;(function ($) {
    $(window).on('load', function () {
      if ($.fn.slick) {
        $('.stm-slider').slick({
          dots: true,
          prevArrow: '<a class="slick-prev slick-arrow" href="#" style=""><div class="icon icon--ei-arrow-left"><svg class="icon__cnt"><use xlink:href="#ei-arrow-left-icon"></use></svg></div></a>',
          nextArrow: '<a class="slick-next slick-arrow" href="#" style=""><div class="icon icon--ei-arrow-right"><svg class="icon__cnt"><use xlink:href="#ei-arrow-right-icon"></use></svg></div></a>',
          customPaging: function (slick, index) {
            var targetImage = slick.$slides.eq(index).find('img').attr('src');
            return '<img src="' + targetImage + '"/>';
          }
        });
        
        var loggedin = slider_object.is_user_logged_in ? '' : 'listing-stm-img';
        $('.slick-dots li img').addClass(loggedin);
      } else {
        console.error('Slick slider not loaded properly.');
      }
    });
  })(jQuery);
  