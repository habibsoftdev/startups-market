;(function($){
 
$(document).ready(function(){
    var page = 2;
    var loading = false;
    $('#load-more-button').on('click', function () {
        if (!loading) {
            loading = true;
            var data = {
                'action': 'pb_load_more',
                'page': page,
                'security': stm_pb_load_more_object.security,
            };

            $.post(stm_pb_load_more_object.ajax_url, data, function (response) {
                $('#load_container .row').append(response);
                page++;
                loading = false;
            });
        }
    });
 
}); 
  })(jQuery);