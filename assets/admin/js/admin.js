;(function ($) {
  $(document).ready(function () {
      // Get the select dropdown
      var statusSelect = $('select[name="_status"]');

      // Add your custom status to the Quick Edit dropdown
      statusSelect.append('<option value="sold_out">Sold Out</option>');
  });


})(jQuery);


