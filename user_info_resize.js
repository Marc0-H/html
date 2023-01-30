
function resize() {
    let mainContentWidth = document.querySelector(".main_content_container").offsetWidth;
    let maxSize = mainContentWidth;

    let winSize = window.innerWidth;
    if (winSize >= 1600) {
        maxSize = mainContentWidth / 3;
    } else if (winSize >= 800) {
        maxSize = mainContentWidth / 2;
    }




    let allPosts = document.querySelectorAll(".user_info_container");

    allPosts.forEach(post => {
        post.style.maxWidth = maxSize - 90 + "px";
        // AAA HET WERKT!!!
    });
}



window.addEventListener('resize', () => {
    resize();
});

window.addEventListener('load', () => {
    resize();
});
