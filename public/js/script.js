/** @format */

//navbar fixd
window.onscroll = function () {
    const header = document.querySelector("header");
    const fixdNav = header.offsetTop;

    if (window.pageYOffset > fixdNav) {
        header.classList.add("navbar-fixed");
    } else {
        header.classList.remove("navbar-fixed");
    }
};

//hamburger
const hamburger = document.querySelector("#hamburger");
const navMenu = document.querySelector("#nav-menu");

hamburger.addEventListener("click", function () {
    hamburger.classList.toggle("hamburger-active");
    navMenu.classList.toggle("hidden");
});
