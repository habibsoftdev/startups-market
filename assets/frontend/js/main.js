(function($){
  $(document).ready(function(){
    const fileInput = $('#list_thumbnail_url');
    const previewContainer = $('.img-file-preview-container');
    const errorMessage = $('.error-message'); // Updated here
    const maxFileSize = 1024 * 1024;
    const maxTotalSize = 5 * 1024 * 1024;
    const maxImages = 5;

    fileInput.on('change', function(){
      previewContainer.html('');
      errorMessage.text('');

      const files = fileInput[0].files;

      if(files.length > maxImages){
        errorMessage.text('Maximum 5 images allowed.');
        return;
      }

      let totalSize = 0;

      for(const file of files){
        if(file.size > maxFileSize){
          errorMessage.text('Each image should be less than 1 MB');
          return;
        }

        totalSize += file.size;

        if(totalSize > maxTotalSize){
          errorMessage.text('Total size of all images should not exceed 5 MB.');
          return;
        }

        const reader = new FileReader();

        reader.onload = function(e){
          const imgContainer = $('<div>').addClass('img-container');
          const img = $('<img>').addClass('img-fluid').attr('src', e.target.result).attr('alt', 'Image Preview');
          const closeButton = $('<span>').addClass('close-button').html('&times;').css({
            'position': 'absolute',
            'top': '0',
            'right': '0',
            'background-color': 'red',
            'padding': '5px',
            'cursor': 'pointer'
          });

          closeButton.on('click', function(){
            imgContainer.remove();
          });

          imgContainer.append(img).append(closeButton);
          previewContainer.append(imgContainer);
        };

        reader.readAsDataURL(file);
      }
    });
  });
})(jQuery);
