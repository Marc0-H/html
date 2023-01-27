

let allPosts = document.querySelectorAll('.post_container');

allPosts.forEach(post => {
    post.addEventListener("click", () => {
        let myURL = window.location.protocol + "//" + window.location.host + window.location.hostname;
        let postLink = "/thread.php?v=" + post.id;
        console.log(myURL + postLink);
        window.location.href = postLink;
    });
});