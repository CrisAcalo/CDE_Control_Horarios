const bodyElement = document.body;

const menuEmail = document.querySelector(".navbar-email");
const desktopMenu = document.querySelector(".desktop-menu");
const flechaEmail = document.querySelector(".flecha-email");

const mobileMenuIcon = document.querySelector(".menu-icon");
const mobileMenu = document.querySelector(".mobile-menu");
const mobileMenuBlurBackground = document.querySelector(
  ".mobile-menu_inactive-background"
);

const shoppingCartIcon = document.querySelector(".navbar-shopping-cart");
const shoppingCartContainer = document.querySelector(
  ".shopping-cart_container"
);
const shoppingCartCloseIcon = document.querySelector(
  ".title_shopping-cart_container"
);

const cardsContainer = document.querySelector(".cards-container");

const productDetail = document.querySelector(".product-detail");
const closeProductDetailIcon = document.querySelector(".product-detail-close");

menuEmail.addEventListener("click", toogleSubMenuDesktop);
mobileMenuIcon.addEventListener("click", toogleMobileMenu);
mobileMenuBlurBackground.addEventListener("click", toogleMobileMenu);
shoppingCartIcon.addEventListener("click", toogleShoppingCart);
shoppingCartCloseIcon.addEventListener("click", toogleShoppingCart);
closeProductDetailIcon.addEventListener("click", closeProductDetailAside);

function toogleSubMenuDesktop() {
  desktopMenu.classList.toggle("inactive");
  flechaEmail.classList.toggle("rotate");
}

function toogleMobileMenu() {
  // Si el menú móvil se activa (es decir, se remueve la clase "inactive-mobile_menu")
  if (!mobileMenu.classList.toggle("inactive-mobile_menu")) {
    mobileMenuBlurBackground.classList.remove("inactive-mobile_menu");
    // Bloquea el scroll del body
    bodyElement.classList.add("no-scroll");
    // Si el carrito de compras está activo, lo desactiva
    if (!shoppingCartContainer.classList.contains("inactive-shopping-cart")) {
      shoppingCartContainer.classList.add("inactive-shopping-cart");
    }
  } else {
    // Si el menú móvil se desactiva, desbloquea el scroll del body
    bodyElement.classList.remove("no-scroll");
    mobileMenuBlurBackground.classList.add("inactive-mobile_menu");
  }
}
