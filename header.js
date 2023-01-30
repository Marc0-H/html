let hamburger = document.querySelector('.hamburger_menu_btn');

hamburger.addEventListener("click", () => {
    console.log("click");
    hamburger.classList.toggle("hamburger_active");
});

let profile_button = document.querySelector('.profile_button');

profile_button.addEventListener("click", () => {
    console.log("click");
    profile_button.classList.toggle("profile_button_active");
});
