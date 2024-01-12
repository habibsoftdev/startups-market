;(function($){
    $(document).ready(function(){
        var img_url = $('#stm_list_img_url').val();
        var image_urls = img_url ? img_url.split(';') : [];

        for (var i in image_urls) {
            var image_url = image_urls[i];
            $('.img-file-preview-container').append(`<div class="img-container">
                <img class="img-fluid" src="${image_url}" />
                <a href="#" class="remove-image" data-url="${image_url}">&#10006;</a>
            </div>`);
        }

        $(document).on('click', '.remove-image', function (e) {
            e.preventDefault();
            var imageUrlToRemove = $(this).data('url');
            // Remove the image container from display
            $(this).closest('.img-container').remove();
            // Update the hidden input field by excluding the removed image URL
            var remainingImageUrls = image_urls.filter(url => url !== imageUrlToRemove);
            $("#stm_list_img_url").val(remainingImageUrls.join(";"));
        });
    });
})(jQuery);
