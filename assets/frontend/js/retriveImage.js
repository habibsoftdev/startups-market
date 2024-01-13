;(function($){
    $(document).ready(function(){
        var img_url = $('#stm_list_img_url').val();
        var img_id = $('#stm_list_img_id').val();
        var image_urls = img_url ? img_url.split(';') : [];
        var image_ids = img_id ? img_id.split(';') : [];

        for (var i in image_urls) {
            var image_url = image_urls[i];
            var image_id = image_ids[i];
            $('.img-file-preview-container').append(`<div class="img-container">
                <img class="img-fluid" src="${image_url}" id="${image_id}" />
                <a href="#" class="close-button" data-url="${image_url}" data-id="${image_id}">&#10006;</a>
            </div>`);
        }

        $(document).on('click', '.close-button', function (e) {
            e.preventDefault();
            var imageUrlToRemove = $(this).data('url');
            var imageIdToRemove = $(this).data('id');
            // Remove the image container from display
            $(this).closest('.img-container').remove();
            // Update the hidden input fields by excluding the removed image URL and ID
            var remainingImageUrls = image_urls.filter(url => url !== imageUrlToRemove);
            var remainingImageIds = image_ids.filter(id => id !== imageIdToRemove);
            $("#stm_list_img_url").val(remainingImageUrls.join(";"));
            $("#stm_list_img_id").val(remainingImageIds.join(";"));
        });
    });
})(jQuery);