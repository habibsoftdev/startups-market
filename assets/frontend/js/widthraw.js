;(function($){
 
$(document).ready(function(){
 
    $('#widthraw-button').on('click', function(e){
        e.preventDefault();

        var ConfirmWidthraw = confirm( stm_widthraw_object.confirm_message);
        if( ConfirmWidthraw ){

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: stm_widthraw_object.ajax_url,
                data: {
                    action: 'initiate_widthraw',
                    nonce: stm_widthraw_object.nonce,
                    
                },
                success: function($response){
                    if( $response.success){
                        alert( $response.message);
                    }else{
                        alert($response.message);
                    }
                },
                error: function(error) {
                    console.log(error);
                }

            });
        }
    })
 
}); 
  })(jQuery);