var gframe;
;(function ($) {
  $(document).ready(function () {

    //Retrive the images
    var images_url = $("#stm_images_url").val();
    images_url = images_url ? images_url.split(";") : [];
    for(i in images_url){
      var image_url = images_url[i];
      //$("#stm_image_show").append(`<img style="margin-right:10px;" src="${image_url}" />`);
      $("#stm_image_show").append(`<div class="image-container"><img style="margin-right:10px;" src="${image_url}" /><a href="#" class="remove-image" data-url="${image_url}">&#10006;</a></div>`);
    }



    $("#stm_gallery_upload").on("click", function(){
      if(gframe){
        gframe.open();
        return false;
      }

      gframe = wp.media({
        title: "Select Images",
        button: {
          text: "Insert Images"
        },
        multiple: true,
      });

      gframe.on('select', function(){
        var image_ids = [];
        var image_urls = [];
        var attachments = gframe.state().get('selection').toJSON();
        console.log(attachments);
        $("#stm_image_show").html('');
        for(i in attachments){
          var attachment = attachments[i];
          image_ids.push(attachment.id);
          var thumbnailUrl = attachment.sizes && attachment.sizes.thumbnail && attachment.sizes.thumbnail.url
          ? attachment.sizes.thumbnail.url
          : attachment.url;

          image_urls.push(thumbnailUrl);
          //$("#stm_image_show").append(`<img style="margin-right:10px;" src="${thumbnailUrl}" />`)
          $("#stm_image_show").append(`<div class="image-container"><img style="margin-right:10px;" src="${thumbnailUrl}" /><a href="#" class="remove-image" data-url="${thumbnailUrl}">&#10006;</a></div>`);
        }

        $("#stm_images_id").val(image_ids.join(";"));
        $("#stm_images_url").val(image_urls.join(";"));

      });


      gframe.open();
      return false;
    });
    $(document).on('click', '.remove-image', function (e) {
      e.preventDefault();
      var imageUrlToRemove = $(this).data('url');
      // Remove the image container from display
      $(this).closest('.image-container').remove();
      // Update the hidden input field by excluding the removed image URL
      var remainingImageUrls = images_url.filter(url => url !== imageUrlToRemove);
      $("#stm_images_url").val(remainingImageUrls.join(";"));
    });
  });
})(jQuery);
