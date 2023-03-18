window.addEventListener("load", () => {
  const navbarOpenMenuButton = document.querySelector(".open-menu-button");
  const navbarLinks = document.querySelector(".navbar-links");

  if (!navbarOpenMenuButton || !navbarLinks)
    throw new Error(
      "The button for opening the menu OR the navbar links are missing!"
    );

  navbarOpenMenuButton.addEventListener("click", () => {
    const isMenuOpened = navbarLinks.classList.contains("open");

    // when the user clicks the menu button, and the menu is NOT opened, we open it
    if (!isMenuOpened) navbarLinks.classList.add("open");
    // if the menu is already opened, the user is probably trying to close it
    else navbarLinks.classList.remove("open");
  });
});
