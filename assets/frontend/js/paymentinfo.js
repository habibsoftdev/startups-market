;(function ($) {
    $(document).ready(function () {
      $('#paymentinfo').on('submit', function (e) {
        e.preventDefault();
  
        // Clear previous messages
        $('p.pr-notice').hide().empty();
  
        // Show loading message
        $('p.pr-notice').show().html('<div class="stm-alert stm-alert-warning"><span>' + stm_payement_method.loading_message + '</span></div>');
  
        var wdtData = {
          action: 'paymentmethod_save',
          nonce: stm_payement_method.nonce,
          wdt_display_name: $('#wdt_display_name').val(),
          wdt_bank_name: $('#wdt_bank_name').val(),
          wdt_account_number: $('#wdt_account_number').val(),
          wdt_account_type: $('#wdt_account_type').val(),
          wdt_routing_number: $('#wdt_routing_number').val(),
        };
  
        $.ajax({
          type: 'POST',
          dataType: 'json',
          url: stm_payement_method.ajax_url,
          data: wdtData,
        })
        .done(function(data) {
            // Handle success
            if (data && 'status' in data && data.status === 'error') {
              $('p.pr-notice').html('<div class="stm_login_error"><span>' + data.message + '</span></div>');
            } else {
              $('p.pr-notice').html('<div class="stm-registration-confirmation"><span>' + data.message + '</span></div>');
            }
          })
          .fail(function(data) {
            // Handle failure
            if (data && 'status' in data && data.status === 'error') {
              $('p.pr-notice').html('<div class="stm_login_error"><span>' + data.message + '</span></div>');
            }
          });
      });
    });
  })(jQuery);