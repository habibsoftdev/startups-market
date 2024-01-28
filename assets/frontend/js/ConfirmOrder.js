(function($){
    $(document).ready(function(){
        $('.confirm-button').on('click', function(e){
            e.preventDefault();

            var orderId = $(this).data('order-id');
            var Confirm = confirm(stm_confirm_order_object.confirm_message);
            var button = $(this);

            if(Confirm){
                console.log('Button Clicked. Order ID:', orderId);

                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: stm_confirm_order_object.ajax_url,
                    data: {
                        action: 'update_order_confirmation',
                        order_id: orderId,
                        nonce: stm_confirm_order_object.confirm_order_nonce,
                    },
                    success: function(response){
                        console.log('AJAX Success:', response);
                        if (response.success) {
                            button.addClass('confirmed-button');
                            button.attr('disabled', 'disabled');
                            button.text('Approved');
                            alert(response.message);
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(error) {
                        console.log('AJAX Error:', error);
                    }
                });
            }
        });
    });
})(jQuery);