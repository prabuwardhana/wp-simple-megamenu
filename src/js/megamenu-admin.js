(function ($) {
  const fnName = function () {
    // find all activate megamenu input fields
    $(".field-mm-megamenu input").each(function () {
      const self = $(this);
      const cbItems = self.closest("li");
      const observerTarget = cbItems[0];

      // Create an observer instance
      // We will monitor the mutation of the closest li element's class list
      // if the class list contains "menu-item-depth-0", we will enable the input element.
      // Otherwise, disable it.
      const observer = new MutationObserver(function (mutations) {
        mutations.forEach(function (mutation) {
          if (
            mutation.type === "attributes" &&
            mutation.attributeName === "class"
          ) {
            if (cbItems.hasClass("menu-item-depth-0")) {
              self.prop("disabled", false);
            } else {
              self.prop("disabled", true);
            }
          }
        });
      });

      const options = {
        attributes: true,
      };

      observer.observe(observerTarget, options);
    });
  };

  // Run the function
  fnName();

  // Run the function again when new menu item is added to the menu list
  // 'menu-item-added' event is a wordpress custom event!
  // it is triggered when new menu item is added to the list.
  // see: wp-admin/js/nav-menu.js
  $(document).on("menu-item-added", function () {
    fnName();
  });
})(jQuery);
