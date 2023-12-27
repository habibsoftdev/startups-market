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
