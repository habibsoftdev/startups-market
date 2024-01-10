(function($) {
    $(document).ready(function() {
        $('#stm_profile_form').on('submit', function(e) {
            e.preventDefault();

            // Clear previous messages
            $('p.pr-notice').hide().empty();

            // Show loading message
            $('p.pr-notice').show().html('<div class="stm-alert stm-alert-warning"><span>' + stm_profile_object.loading_message + '</span></div>');

            var formData = {
                action: 'stm_profile',
                stm_first_name: $('#stm_first_name').val(),
                stm_last_name: $('#stm_last_name').val(),
                stm_user_phone: $('#stm_user_phone').val(),
                stm_website: $('#stm_website').val(),
                stm_user_address: $('#stm_user_address').val(),
                stm_user_new_pass: $('#stm_user_new_pass').val(),
                stm_user_con_pass: $('#stm_user_con_pass').val(),
                stm_user_bio: $('#stm_user_bio').val(),
                stm_user_prof_nonce: $('[name="stm_user_prof_nonce"]').val(),
            };

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: stm_profile_object.ajax_url,
                data: formData,
            })
            .done(function(data) {
                // Handle success
                if ('status' in data && data.status === 'error') {
                    $('p.pr-notice').html('<div class="stm_login_error"><span>' + data.message + '</span></div>');
                } else {
                    $('p.pr-notice').html('<div class="stm-registration-confirmation"><span>' + data.message + '</span></div>');

                    if (data.passwordsaved !== undefined) {
                        $('p.pr-notice').html('<div class="stm-registration-confirmation"><span>' + data.p_message + '</span></div>');
                    }
                }
            })
            .fail(function(data) {
                // Handle failure
                if ('status' in data && data.status === 'error') {
                    $('p.pr-notice').html('<div class="stm_login_error"><span>' + data.message + '</span></div>');
                }
            });
        });
    });
})(jQuery);
