let hamburger = document.querySelector('.hamburger_menu_btn');

hamburger.addEventListener("click", () => {
    console.log("click");
    hamburger.classList.toggle("hamburger_active");
    
});