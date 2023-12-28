(function ($) {
  $(document).ready(function () {
    var tabLinks = $(".stm-tab__nav__items .stm-tab__nav__link");
    var tabContents = $(".stm-user-dashboard__tab-content .stm-tab__pane");

    function activateTab(tabId) {
      tabLinks.removeClass("stm-tab__nav__active");
      tabContents.removeClass("stm-tab__pane--active");

      var targetTab = $(".stm-tab__nav__link[data-tab='" + tabId + "']");
      if (targetTab.length) {
        targetTab.addClass("stm-tab__nav__active");
        $("#" + tabId).addClass("stm-tab__pane--active");

        // Update the URL fragment identifier
        history.pushState(null, null, "#" + tabId);
      }
    }

    function activateTabByHash() {
      var hash = window.location.hash.substring(1);
      if (hash) {
        activateTab(hash);
      }
    }

    tabLinks.on("click", function (event) {
      event.preventDefault();

      var targetPaneId = $(this).data("tab");

      // Activate the tab
      activateTab(targetPaneId);
    });

    // Activate tab based on URL hash
    activateTabByHash();
  });
})(jQuery);

// Listing tabs

(function ($) {
  $(document).ready(function () {
    // When a tab is clicked
    $(".stm-dashboard-listing-nav-js a").on("click", function (event) {
      // Prevent the default behavior (following the link)
      event.preventDefault();

      // Get the data-tab attribute value
      var tabId = $(this).data("tab");

      // Hide all tab contents
      $(".stm-tab__pane").removeClass("stm-tab__pane--active");

      // Show the clicked tab content
      $("#" + tabId).addClass("stm-tab__pane--active");

      // Add/remove active class for styling
      $(".stm-dashboard-listing-nav-js a").removeClass("stm-tab__nav__active");
      $(this).addClass("stm-tab__nav__active");
    });
  });
})(jQuery);

(function ($) {
  $(document).ready(function () {
    // When the toggle icon is clicked
    $(".stm-user-dashboard__toggle__link").on("click", function (event) {
      // Prevent the default behavior (following the link)
      event.preventDefault();

      // Log a message to check if the script is executed
      console.log("Toggle icon clicked");

      // Toggle the class that controls visibility with a slide effect
      $(".stm-tab__nav").slideToggle();

      // Log a message after toggling the class
      console.log("Navigation bar toggled");
    });
  });
})(jQuery);
