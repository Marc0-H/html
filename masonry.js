const grid = document.querySelector('.main_content_posts');

posts = [];

let cards = document.querySelectorAll('.main_content_posts > .post_container');

for (let i = 0; i < cards.length; i++) {

    posts.push(cards[i]);
}


function generateMasonryGrid(columns, posts) {


    //store all column arrays which contains the relevant posts.
    let columnWrappers = {};

    //Create column item array and add this to column wrapper object.
    for (let i = 0; i < columns; i++) {
        columnWrappers[`column${i}`] = []
    }

    for (let i = 0; i < posts.length; i++) {
        const column = i % columns;
        columnWrappers[`column${column}`].push(posts[i]);
    }

    for (let i = 0; i < columns; i++) {
        let columnPosts = columnWrappers[`column${i}`];
        let column = document.createElement('div');
        column.classList.add('column');

        columnPosts.forEach(post => {
            column.appendChild(post);
        });


        grid.appendChild(column);
    }
}

window.addEventListener('resize', () => {
    grid.innerHTML = '';
    handleResize();
});

window.addEventListener('load', () => {
    grid.innerHTML = '';
    handleResize();
})


function handleResize() {
    let winSize = window.innerWidth;
    if (winSize >= 1600) {
        generateMasonryGrid(3, posts);
    } else if (winSize >= 800) {
        generateMasonryGrid(2, posts);
    } else {
        generateMasonryGrid(1, posts);
    }
}

grid.innerHTML = '';
handleResize();

/*Create post button*/
let create_post = document.getElementById("create_post");

if (create_post != null) {
    create_post.addEventListener("click", () => {
        window.location.href = "login_signup/login_page.php";
    });
}

let create_post_logged_in = document.getElementById("create_post_logged_in");

if (create_post_logged_in != null) {
    create_post_logged_in.addEventListener("click", () => {
        window.location.href = "newthread.php";
    });
}