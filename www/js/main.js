const navbar = document.getElementById("navbar");
const openMenu = document.getElementById("open-menu");
const menuIcon = document.getElementById("menu-icon");

function checkScroll() {
  if (window.scrollY > 0 && !navbar.classList.contains("scroll")) {
    navbar.classList.add("scroll")
  } else if (window.scrollY <= 0 && navbar.classList.contains("scroll")) {
    navbar.classList.remove("scroll")
  }
}

document.addEventListener('scroll', checkScroll);
checkScroll();

openMenu.addEventListener("click", () => {
  navbar.classList.toggle("opened");
  
  if (navbar.classList.contains("opened")) {
    menuIcon.setAttribute("name", "close-outline")
  } else {
    menuIcon.setAttribute("name", "menu-outline")
  }
});