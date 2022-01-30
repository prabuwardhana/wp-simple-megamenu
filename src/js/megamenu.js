import "../scss/megamenu.scss";

(function () {
  const menu = document.querySelector(".simple-megamenu-nav");
  const menuBar = menu.querySelector(".menu-bar");
  const menuArrow = menu.querySelector(".menu-mobile-arrow-left");
  const menuClosed = menu.querySelector(".menu-mobile-close");
  const menuToggle = document.querySelector(".menu-mobile-toggle");
  var subMenu;

  menuBar.addEventListener("click", (e) => {
    if (!menu.classList.contains("active")) {
      return;
    }
    if (e.target.closest(".has-popup")) {
      const hasChildren = e.target.closest(".has-popup");
      showSubMenu(hasChildren);
    }
  });

  menuArrow.addEventListener("click", () => {
    hideSubMenu();
  });

  menuToggle.addEventListener("click", () => {
    toggleMenu();
  });

  menuClosed.addEventListener("click", () => {
    toggleMenu();
  });

  // Show & Hide Toggle Menu Function
  function toggleMenu() {
    menu.classList.toggle("active");
  }

  // Show the Mobile Side Menu Function
  function showSubMenu(hasChildren) {
    subMenu = hasChildren.querySelector(".menu-subs");
    subMenu.classList.add("active");
    subMenu.style.animation = "slideLeft 0.5s ease forwards";
    const menuTitle = hasChildren.querySelector(".menu-bar-link").textContent;
    menu.querySelector(".menu-mobile-title").innerHTML = menuTitle;
    menu.querySelector(".menu-mobile-header").classList.add("active");
  }

  // Hide the Mobile Side Menu Function
  function hideSubMenu() {
    subMenu.style.animation = "slideRight 0.5s ease forwards";
    setTimeout(() => {
      subMenu.classList.remove("active");
      subMenu.removeAttribute("style");
    }, 300);

    menu.querySelector(".menu-mobile-title").innerHTML = "";
    menu.querySelector(".menu-mobile-header").classList.remove("active");
  }

  // Windows Screen Resizes Function
  window.onresize = function () {
    if (this.innerWidth > 991) {
      if (menu.classList.contains("active")) {
        toggleMenu();
      }
    }
  };
})();
