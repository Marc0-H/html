let hamburger = document.querySelector('.hamburger_menu_btn');

hamburger.addEventListener("click", () => {
    let headerContentRight = document.querySelector(".header_content_right");
    hamburger.classList.toggle("hamburger_active");
    headerContentRight.classList.toggle("hamburger_active");
});

let profile_button = document.querySelector('.profile_button');

if (profile_button != null) {
    profile_button.addEventListener("click", () => {
        profile_button.classList.toggle("profile_button_active");
    });
}



let sidebarContainer = document.querySelector(".sidebar_container");
let mobileFilterBtn = document.querySelector(".mobile_filter_btn");

mobileFilterBtn.addEventListener("click", () => {
    sidebarContainer.classList.toggle("sidebar_active");
});