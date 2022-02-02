const adminMenuItem = document.querySelectorAll(".menu-item-depth-0");
adminMenuItem.forEach(function (item) {
  const cbItem = item.querySelector(".field-mm-megamenu input");
  const options = {
    attributes: true,
  };

  function callback(mutationList, observer) {
    mutationList.forEach(function (mutation) {
      if (
        mutation.type === "attributes" &&
        mutation.attributeName === "class"
      ) {
        console.log("something has change");
        if (item.classList.contains("menu-item-depth-0")) {
          cbItem.disabled = false;
        } else {
          cbItem.disabled = true;
        }
      }
    });
  }

  const observer = new MutationObserver(callback);
  observer.observe(item, options);
});
