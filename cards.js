

let allPosts = document.querySelectorAll('.post_container');

allPosts.forEach(post => {
    post.addEventListener("click", () => {
        //create new url 
        //          /thread.php?v=78
        //goto url
        let myURL = window.location.protocol + "//" + window.location.host  + window.location.pathname;
        let postLink = "thread.php?v=" + post.id;
        console.log(myURL + postLink);
        window.location.href = myURL + postLink;
    });
});