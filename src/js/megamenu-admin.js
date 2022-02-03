const cbItems = document.querySelectorAll(".field-mm-megamenu input");

cbItems.forEach(function (item) {
  const liElement = item.closest("li");
  const options = {
    attributes: true,
  };

  function callback(mutationList, observer) {
    mutationList.forEach(function (mutation) {
      if (
        mutation.type === "attributes" &&
        mutation.attributeName === "class"
      ) {
        if (liElement.classList.contains("menu-item-depth-0")) {
          item.disabled = false;
        } else {
          item.disabled = true;
        }
      }
    });
  }

  const observer = new MutationObserver(callback);
  observer.observe(liElement, options);
});
