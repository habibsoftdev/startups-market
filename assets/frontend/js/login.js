(function ($) {
  console.log("AJAX script loaded");
  $("form#stm-login-form").on("submit", function (e) {
    e.preventDefault();
    var $this = $(this);
    $("p.status")
      .show()
      .html(
        '<div class="stm-alert stm-alert-warning"><span>' +
          stm_ajax_object.loading_message +
          "</span></div>"
      );
    var form_data = {
      action: "stm_ajax_login",
      login_email: $this.find("#login_email").val(),
      login_pass: $this.find("#login_pass").val(),
      security: $this.find("[name='security']").val(),
    };
    console.log(form_data);
    $.ajax({
      type: "POST",
      dataType: "json",
      url: stm_ajax_object.ajax_url,
      data: form_data,
      success: function success(data) {
        if ("nonce_failed" in data && data.nonce_failed) {
          $("p.status").html(
            '<div class="stm-registration-confirmation"><span>' +
              data.message +
              "</span></div>"
          );
        }
        if (data.loggedin == true) {
          $("p.status").html(
            '<div class="stm-registration-confirmation"><span>' +
              data.message +
              "</span></div>"
          );
          setTimeout(function () {
            window.location.href = stm_ajax_object.redirect_url;
          });
        } else {
          $("p.status").html(
            '<div class="stm_login_error"><span>' +
              data.message +
              "</span></div>"
          );
        }
      },
      error: function error(data) {
        if ("nonce_failed" in data && data.nonce_failed) {
          $("p.status").html(
            '<div class="stm-registration-confirmation"><span>' +
              data.message +
              "</span></div>"
          );
        }
        $("p.status")
          .show()
          .html(
            '<div class="stm_login_error"><span>' +
              stm_ajax_object.login_error_message +
              "</span></div>"
          );
      },
    });
    // e.preventDefault();
  });
})(jQuery);
