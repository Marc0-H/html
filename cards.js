let allPosts = document.querySelectorAll('.post_container');

allPosts.forEach(post => {
    post.addEventListener("click", () => {
        // let myURL = window.location.protocol + "//" + window.location.host + window.location.hostname;
        let postLink = "thread.php?v=" + post.id;
        // console.log(myURL + postLink);
        // window.location.href = postLink;
        let newUrl = window.location.href;
        if (newUrl.includes("index.php")) {
            newUrl = newUrl.substring(0, newUrl.length - 9) + postLink;
        } else {
            newUrl = newUrl + postLink;
        } 
        window.location.href = newUrl;
    });
});