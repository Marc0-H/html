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