// profile-uploader.js

jQuery(document).ready(function ($) {
  var fileInput = $("#ezmu__file-input");
  var selectedImage = $(".ezmu__media-picker-controls img");

  fileInput.on("change", function () {
    // Update image source
    var files = this.files;
    if (files.length > 0) {
      var reader = new FileReader();
      reader.onload = function (e) {
        selectedImage.attr("src", e.target.result);
      };
      reader.readAsDataURL(files[0]);
    }
  });

  // Close button click event
  $(document).on(
    "click",
    ".ezmu__media-picker-controls .ezmu__close-btn",
    function () {
      // Clear the selected image
      selectedImage.attr("src", "<?php echo esc_url($avatardefault); ?>");
      fileInput.val(""); // Reset the file input
    }
  );
});
