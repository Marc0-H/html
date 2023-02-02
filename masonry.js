const grid = document.querySelector('.main_content_posts');

posts = [];

let cards = document.querySelectorAll('.main_content_posts .post_container');

for (let i = 0; i < cards.length; i++) {
    posts.push(cards[i]);
}


function generateMasonryGrid(columns, posts) {
    posts.forEach(post => { post.style.display = "none"});

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

    posts.forEach(post => { post.style.display = "flex"});
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



checkWindowSize();

// Check if the page has enough content or not. If not then fetch records
function checkWindowSize(){
   if($(window).height() >= $(document).height()){
      // Fetch records
      fetchData();
   }
}

// Fetch records
function fetchData(){
   var start = Number($('#start').val());
   var allcount = Number($('#totalrecords').val());
   var rowperpage = Number($('#rowperpage').val());
   start = start + rowperpage;

    if(start <= allcount){
        $('#start').val(start);

        $.ajax({
            url:"filtered_results.php",
            type: 'post',
            data: {start:start,rowperpage: rowperpage},
            success: function(response){

                cards = $($.parseHTML(response)).filter(".post_container");
                
                for (let i = 0; i < cards.length; i++) {
                    posts.push(cards[i]);
                }

                grid.innerHTML = '';
                generateMasonryGrid(3, posts);

                // Check if the page has enough content or not. If not then fetch records
                checkWindowSize();

                loading_data = false;

                $.getScript("cards.js");
            }
        });
    }
}

$(document).on('touchmove', onScroll); // for mobile

let loading_data = false;

function onScroll(){
    var position = $(window).scrollTop();
    var bottom = $(document).height() - $(window).height() - 1;

    if(position >= bottom && loading_data == false) {
        loading_data = true;
        fetchData();
    }
}

$(window).scroll(function(){
     onScroll();
});

