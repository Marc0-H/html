let posts = [];
let filterData = [];

const grid = document.querySelector('.main_content_posts');

let cards = document.querySelectorAll('.main_content_posts .post_container');

for (let i = 0; i < cards.length; i++) {
    posts.push(cards[i]);
}

function generateMasonryGrid(columns, posts) {
    // Reset all column data and store scroll position.
    let minIndex = 0;
    let columnHeights = [];
    let scrollPosition = document.documentElement.scrollTop || document.body.scrollTop;
    grid.innerHTML = '';

    // Create columns in grid.
    for (let i = 0; i < columns; i++) {
        let column = document.createElement('div');
        column.classList.add('column');
        grid.appendChild(column);

        columnHeights[i] = 0;
    }

    // Append posts to shortest column.
    for (let i = 0; i < posts.length; i++) {
        let column = grid.getElementsByClassName('column')[minIndex];
        column.appendChild(posts[i]);

        columnHeights[minIndex] += posts[i].clientHeight;

        let minimum = Math.min(...columnHeights);
        minIndex = columnHeights.indexOf(minimum);
    }

    // Scroll back to stored position.
    window.scrollTo(0, scrollPosition);

    $.getScript("user_info_resize.js");
}

window.addEventListener('resize', () => {
    handleResize();
});

window.addEventListener('load', () => {
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




/* Scroll fetch data start
 * Fetches new posts if the user has scrolled to the bottom of the page
 * Based on code from: https://makitweb.com/load-content-on-page-scroll-with-jquery-and-ajax/
*/
checkWindowSize()

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

        queryData = 'start=' + start + '&rowperpage=' + rowperpage;
        queryData += '&' + filterData;

        if (window.location.toString().includes("index.php")) {
            url = "filtered_results.php"
        } else {
            url = "filtered_results_profile.php"
        }

        $.ajax({
            url: url,
            type: 'GET',
            data: queryData,
            success: function(response){

                console.log(response);

                // Add new cards to post array
                cards = $($.parseHTML(response)).filter(".post_container");

                console.log(cards);

                for (let i = 0; i < cards.length; i++) {
                    posts.push(cards[i]);
                }

                // Check if the page has enough content or not. If not then fetch records
                checkWindowSize();

                handleResize();

                $.getScript("cards.js");
            }
        });
    }
}

function onScroll(){
    var position = $(window).scrollTop();
    var bottom = $(document).height() - $(window).height();

    if(position >= bottom) {
        fetchData();
    }
}

$(document).on('touchmove', onScroll); // for mobile

$(window).scroll(function(){
     onScroll();
});
/*Scroll fetch data end*/



/*Filter code*/
let subjectEl = document.getElementById('filter-option-subject');
let subjectDropdownEl = document.getElementById('dropdown-subject');
let sortbyEl = document.getElementById('filter-option-sortby');
let sortbyDropdownEl = document.getElementById('dropdown-sortby');
let userRoleEl = document.getElementById('filter-option-user-role');
let userRoleDropdownEl = document.getElementById('dropdown-user-role');

if (typeof(subjectEl) != 'undefined' && subjectEl != null)
{
    // This dropdown doesn't exist inside thread.php
    subjectEl.addEventListener("click", () => {
        toggleDropdown(subjectEl, subjectDropdownEl)
    });
}

if (window.location.toString().includes("index.php")) {
    sortbyEl.addEventListener("click", () => {
        toggleDropdown(sortbyEl, sortbyDropdownEl)
    });
    
    userRoleEl.addEventListener("click", () => {
        toggleDropdown(userRoleEl, userRoleDropdownEl)
    });
}

function toggleDropdown(buttonEl, dropdownEl) {
    if (dropdownEl.style.display === "block") {
        buttonEl.getElementsByClassName('dropdown-button-icon')[0].style.transform = 'rotate(0deg)';
        dropdownEl.style.display = "none";
    } else {
        dropdownEl.style.display = 'block';
        buttonEl.getElementsByClassName('dropdown-button-icon')[0].style.transform = 'rotate(180deg)';
    }
}

$(".filter_form").submit(function(event) {
    $('#start').val(0); // Start value for the database offset

    event.preventDefault();  // prevent the form from submitting

    filterData = $(this).serialize();

    $.ajax({
        type: "GET",
        url: "filtered_results.php",
        data: filterData,
        success: function (data) {
            $(".main_content_posts").empty();
            $(".main_content_posts").html(data);

            posts = [];

            let cards = document.querySelectorAll('.main_content_posts .post_container'); 
            for (let i = 0; i < cards.length; i++) {
                posts.push(cards[i]);
            }

            checkWindowSize();

            handleResize();

            $.getScript("cards.js");

            let sidebarContainer = document.querySelector(".sidebar_container");
            sidebarContainer.classList.toggle("sidebar_active");
        }
    });
});

$(".search_form").submit(function(event) {
    $('#start').val(0); // Start value for the database offset

    event.preventDefault();  // prevent the form from submitting
    $.ajax({
        type: "GET",
        url: "filtered_results.php",
        data: $(this).serialize(),
        success: function (data) {
            $(".main_content_posts").empty();
            $(".main_content_posts").html(data);

            posts = [];

            let cards = document.querySelectorAll('.main_content_posts .post_container'); 
            for (let i = 0; i < cards.length; i++) {
                posts.push(cards[i]);
            }

            checkWindowSize();

            handleResize();

            $.getScript("cards.js");

            let sidebarContainer = document.querySelector(".sidebar_container");
            sidebarContainer.classList.toggle("sidebar_active");
        }
    });
});
