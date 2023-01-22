<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website</title>
    <link rel="stylesheet" href="indexstyle.css">
    <script src="main.js" defer></script>
</head>
<body>
  <?php 
  include 'connection.php';
  if (!$connection) {
    die("Connection to server failed. !");
  }
  ?>
    <header>
        <div class="inner__header">

            <div class="logo__container">
                <h1 class="logo">LOGO</h1>
            </div>

            <div class="header-content-right">
                <div class="search-bar__container">
                    <input class="search-bar" type="text" placeholder="Search topic..">
                </div>
                <div class="notification-button__container">
                    <button class="notification-button">
                        <svg data-name="Layer 1" id="Layer_1" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg"><title/><path d="M40.62,28.34l-.87-.7A2,2,0,0,1,39,26.08V18A15,15,0,0,0,26.91,3.29a3,3,0,0,0-5.81,0A15,15,0,0,0,9,18v8.08a2,2,0,0,1-.75,1.56l-.87.7a9,9,0,0,0-3.38,7V37a4,4,0,0,0,4,4h8.26a8,8,0,0,0,15.47,0H40a4,4,0,0,0,4-4V35.36A9,9,0,0,0,40.62,28.34ZM24,43a4,4,0,0,1-3.44-2h6.89A4,4,0,0,1,24,43Zm16-6H8V35.36a5,5,0,0,1,1.88-3.9l.87-.7A6,6,0,0,0,13,26.08V18a11,11,0,0,1,22,0v8.08a6,6,0,0,0,2.25,4.69l.87.7A5,5,0,0,1,40,35.36Z"/></svg>
                    </button>
                </div>
                <div class="action-button__container">
                    <button id="action-button" class="action-button">
                        <svg id="Layer_1" style="enable-background:new 0 0 32 32;" version="1.1" viewBox="0 0 32 32" width="32px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M28,14H18V4c0-1.104-0.896-2-2-2s-2,0.896-2,2v10H4c-1.104,0-2,0.896-2,2s0.896,2,2,2h10v10c0,1.104,0.896,2,2,2  s2-0.896,2-2V18h10c1.104,0,2-0.896,2-2S29.104,14,28,14z"/></svg>
                    </button>
                    <div class="action-options">
                        <button class="create-post-btn">Create post</button>
                        <button class="start-chat-btn">Start chat</button>
                    </div>
                </div>

                <div class="profile__container">
                    <img src="./images/profile.jpg" alt="profile" class="profile">
                    <div class="online_status"></div>
                </div>
            </div>
        </div>
    </header>

    <main>
        <div class="inner__main">
            <div class="side-bar__container">
                <div class="side-bar">
                    <h2 class="side-bar-title__container">Filter options</h2>
                    <hr>
                    <button id="filter-option-subject" class="dropdown-button">
                        Subject
                        <svg class="dropdown-button-icon" viewBox="0 0 96 96" xmlns="http://www.w3.org/2000/svg"><title/><path d="M81.8457,25.3876a6.0239,6.0239,0,0,0-8.45.7676L48,56.6257l-25.396-30.47a5.999,5.999,0,1,0-9.2114,7.6879L43.3943,69.8452a5.9969,5.9969,0,0,0,9.2114,0L82.6074,33.8431A6.0076,6.0076,0,0,0,81.8457,25.3876Z"/></svg>
                    </button>
                    <div class="dropdown" id="dropdown-subject">
                        <label class="dropdown-label">
                            <input type="checkbox">Math
                        </label>
                        <label  class="dropdown-label">
                            <input type="checkbox">Biology
                        </label>
                        <label class="dropdown-label">
                            <input type="checkbox">Chemistry
                        </label>
                    </div>
                    <button id="filter-option-sortby" class="dropdown-button">
                        Sort by
                        <svg class="dropdown-button-icon" viewBox="0 0 96 96" xmlns="http://www.w3.org/2000/svg"><title/><path d="M81.8457,25.3876a6.0239,6.0239,0,0,0-8.45.7676L48,56.6257l-25.396-30.47a5.999,5.999,0,1,0-9.2114,7.6879L43.3943,69.8452a5.9969,5.9969,0,0,0,9.2114,0L82.6074,33.8431A6.0076,6.0076,0,0,0,81.8457,25.3876Z"/></svg>
                    </button>
                    <div class="dropdown" id="dropdown-sortby">
                        <label class="dropdown-label">
                            <input type="radio" name="sortby">Newest
                        </label>
                        <label  class="dropdown-label">
                            <input type="radio" name="sortby">Relevance
                        </label>
                        <label class="dropdown-label">
                            <input type="radio" name="sortby">Likes
                        </label>
                        <label class="dropdown-label">
                            <input type="radio" name="sortby">Answered
                        </label>
                    </div>
                    <button id="filter-option-user-role" class="dropdown-button">
                        User role
                        <svg class="dropdown-button-icon" viewBox="0 0 96 96" xmlns="http://www.w3.org/2000/svg"><title/><path d="M81.8457,25.3876a6.0239,6.0239,0,0,0-8.45.7676L48,56.6257l-25.396-30.47a5.999,5.999,0,1,0-9.2114,7.6879L43.3943,69.8452a5.9969,5.9969,0,0,0,9.2114,0L82.6074,33.8431A6.0076,6.0076,0,0,0,81.8457,25.3876Z"/></svg>
                    </button>
                    <div class="dropdown" id="dropdown-user-role">
                        <label class="dropdown-label">
                            <input type="checkbox">PhD.
                        </label>
                        <label  class="dropdown-label">
                            <input type="checkbox">Student
                        </label>
                        <label class="dropdown-label">
                            <input type="checkbox">Teacher
                        </label>
                    </div>
                    <button class="filter-button">
                        Filter
                    </button>
                </div>

            </div>
            <div class="main-content__container">
                <div class="main-content-title__container">
                    <h2 class="main-content-title">The latest posts...</h2>
                    <hr>
                </div>

                <div class="main-content">
                  <?php 
                    $post_sql = "SELECT post_id, post_title, post_content, post_tag, post_datetime from posts ORDER BY post_id DESC";
                    $post_result = mysqli_query($connection, $post_sql);

                    while($row = mysqli_fetch_assoc($post_result)) {
                      
                  ?>
                  <div class="card1 card__container" >
                    <div class="card-content__container" href="thread.html">
                      <div class="post-title__container"> 
                        <h3 class="card-title"><span class="tag tag-<?php echo $row["post_tag"]?>"><?php echo $row["post_tag"]?></span><?php echo $row["post_title"]?></h3>
                      </div>
                      <div class="post-general-info__container">
                        <svg class="profile-icon" style="enable-background:new 0 0 24 24;" version="1.1" viewBox="0 0 24 24" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="info"/><g id="icons"><g id="user"><ellipse cx="12" cy="8" rx="5" ry="6"/><path d="M21.8,19.1c-0.9-1.8-2.6-3.3-4.8-4.2c-0.6-0.2-1.3-0.2-1.8,0.1c-1,0.6-2,0.9-3.2,0.9s-2.2-0.3-3.2-0.9    C8.3,14.8,7.6,14.7,7,15c-2.2,0.9-3.9,2.4-4.8,4.2C1.5,20.5,2.6,22,4.1,22h15.8C21.4,22,22.5,20.5,21.8,19.1z"/></g></g></svg>
                        <p class="author-name">John Smith</p>
                        <p class="author-role">PhD.</p>
                        <svg class="date-icon" data-name="Layer 1" height="200" id="Layer_1" viewBox="0 0 200 200" width="200" xmlns="http://www.w3.org/2000/svg"><title/><path d="M100,15a85,85,0,1,0,85,85A84.93,84.93,0,0,0,100,15Zm0,150a65,65,0,1,1,65-65A64.87,64.87,0,0,1,100,165Zm24-76.5-14,6V60a10,10,0,0,0-20,0v50a9.82,9.82,0,0,0,4.5,8.5,9.28,9.28,0,0,0,9.5.5l28-12.5c5-2.5,7.5-8,5-13s-8-7.5-13-5Z"/></svg>
                        <p class="post-date"><?php echo $row["post_datetime"] ?></p>
                      </div>
                      <div class="post-message__container">
                        <p class="message"><?php echo $row["post_content"]?></p>
                      </div>
                      <div class="post-reaction-info__container">
                        <svg class="likes-icon" height="20" viewBox="0 0 20 20" width="20" xmlns="http://www.w3.org/2000/svg"><path d="M2 10.5C2 9.67157 2.67157 9 3.5 9C4.32843 9 5 9.67157 5 10.5V16.5C5 17.3284 4.32843 18 3.5 18C2.67157 18 2 17.3284 2 16.5V10.5Z" /><path d="M6 10.3333V15.7639C6 16.5215 6.428 17.214 7.10557 17.5528L7.15542 17.5777C7.71084 17.8554 8.32329 18 8.94427 18H14.3604C15.3138 18 16.1346 17.3271 16.3216 16.3922L17.5216 10.3922C17.7691 9.15465 16.8225 8 15.5604 8H12V4C12 2.89543 11.1046 2 10 2C9.44772 2 9 2.44772 9 3V3.66667C9 4.53215 8.71929 5.37428 8.2 6.06667L6.8 7.93333C6.28071 8.62572 6 9.46785 6 10.3333Z"/></svg>
                        <p class="likes">11</p>
                        <svg class="comments-icon" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="M256 32C114.6 32 0 125.1 0 240c0 49.6 21.4 95 57 130.7C44.5 421.1 2.7 466 2.2 466.5c-2.2 2.3-2.8 5.7-1.5 8.7S4.8 480 8 480c66.3 0 116-31.8 140.6-51.4 32.7 12.3 69 19.4 107.4 19.4 141.4 0 256-93.1 256-208S397.4 32 256 32z"/></svg>
                        <p class="comments">4023</p>
                      </div>
                    </div>
                  </div>
                <?php }?>
                    <!-- <div class="card2 card__container">
                        <div class="card-content__container">
                            <div class="post-title__container">
                                <h3 class="card-title"><span class="tag tag-biology">Biology</span>Lorem Ipsum</h3>
                            </div>
                            <div class="post-general-info__container">
                                <svg class="profile-icon" style="enable-background:new 0 0 24 24;" version="1.1" viewBox="0 0 24 24" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="info"/><g id="icons"><g id="user"><ellipse cx="12" cy="8" rx="5" ry="6"/><path d="M21.8,19.1c-0.9-1.8-2.6-3.3-4.8-4.2c-0.6-0.2-1.3-0.2-1.8,0.1c-1,0.6-2,0.9-3.2,0.9s-2.2-0.3-3.2-0.9    C8.3,14.8,7.6,14.7,7,15c-2.2,0.9-3.9,2.4-4.8,4.2C1.5,20.5,2.6,22,4.1,22h15.8C21.4,22,22.5,20.5,21.8,19.1z"/></g></g></svg>
                                <p class="author-name">John Smith</p>
                                <p class="author-role">PhD.</p>
                                <svg class="date-icon" data-name="Layer 1" height="200" id="Layer_1" viewBox="0 0 200 200" width="200" xmlns="http://www.w3.org/2000/svg"><title/><path d="M100,15a85,85,0,1,0,85,85A84.93,84.93,0,0,0,100,15Zm0,150a65,65,0,1,1,65-65A64.87,64.87,0,0,1,100,165Zm24-76.5-14,6V60a10,10,0,0,0-20,0v50a9.82,9.82,0,0,0,4.5,8.5,9.28,9.28,0,0,0,9.5.5l28-12.5c5-2.5,7.5-8,5-13s-8-7.5-13-5Z"/></svg>
                                <p class="post-date">Yesterday</p>
                            </div>
                            <div class="post-message__container">
                                <p class="message">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aspernatur amet molestias voluptatum dolore. Omnis praesentium iure corrupti facere quae aliquid! <br><br> Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit dolor nisi assumenda quam omnis. Eligendi officiis repellat quo maxime tempora inventore eaque voluptas labore, dolor dolores quod hic tempore quibusdam. <br><br> Lorem ipsum dolor sit amet consectetur adipisicing elit. Non officiis tenetur sapiente veritatis harum, dolorem excepturi dolore illo nihil a? Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus dicta atque quos tenetur inventore harum sapiente nam, omnis dolorum temporibus?</p>
                            </div>
                            <div class="post-reaction-info__container">
                                <svg class="likes-icon" height="20" viewBox="0 0 20 20" width="20" xmlns="http://www.w3.org/2000/svg"><path d="M2 10.5C2 9.67157 2.67157 9 3.5 9C4.32843 9 5 9.67157 5 10.5V16.5C5 17.3284 4.32843 18 3.5 18C2.67157 18 2 17.3284 2 16.5V10.5Z" /><path d="M6 10.3333V15.7639C6 16.5215 6.428 17.214 7.10557 17.5528L7.15542 17.5777C7.71084 17.8554 8.32329 18 8.94427 18H14.3604C15.3138 18 16.1346 17.3271 16.3216 16.3922L17.5216 10.3922C17.7691 9.15465 16.8225 8 15.5604 8H12V4C12 2.89543 11.1046 2 10 2C9.44772 2 9 2.44772 9 3V3.66667C9 4.53215 8.71929 5.37428 8.2 6.06667L6.8 7.93333C6.28071 8.62572 6 9.46785 6 10.3333Z"/></svg>
                                <p class="likes">11</p>
                                <svg class="comments-icon" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="M256 32C114.6 32 0 125.1 0 240c0 49.6 21.4 95 57 130.7C44.5 421.1 2.7 466 2.2 466.5c-2.2 2.3-2.8 5.7-1.5 8.7S4.8 480 8 480c66.3 0 116-31.8 140.6-51.4 32.7 12.3 69 19.4 107.4 19.4 141.4 0 256-93.1 256-208S397.4 32 256 32z"/></svg>
                                <p class="comments">4023</p>
                            </div>

                        </div>
                    </div>

                    <div class="card3 card__container">
                        <img src="./images/card1.jpg" alt="card1">
                        <div class="card-content__container">
                            <div class="post-title__container">

                                <h3 class="card-title"><span class="tag tag-english">English</span>Lorem Ipsum yadayada text</h3>
                            </div>
                            <div class="post-general-info__container">
                                <svg class="profile-icon" style="enable-background:new 0 0 24 24;" version="1.1" viewBox="0 0 24 24" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="info"/><g id="icons"><g id="user"><ellipse cx="12" cy="8" rx="5" ry="6"/><path d="M21.8,19.1c-0.9-1.8-2.6-3.3-4.8-4.2c-0.6-0.2-1.3-0.2-1.8,0.1c-1,0.6-2,0.9-3.2,0.9s-2.2-0.3-3.2-0.9    C8.3,14.8,7.6,14.7,7,15c-2.2,0.9-3.9,2.4-4.8,4.2C1.5,20.5,2.6,22,4.1,22h15.8C21.4,22,22.5,20.5,21.8,19.1z"/></g></g></svg>
                                <p class="author-name">John Smith</p>
                                <p class="author-role">PhD.</p>
                                <svg class="date-icon" data-name="Layer 1" height="200" id="Layer_1" viewBox="0 0 200 200" width="200" xmlns="http://www.w3.org/2000/svg"><title/><path d="M100,15a85,85,0,1,0,85,85A84.93,84.93,0,0,0,100,15Zm0,150a65,65,0,1,1,65-65A64.87,64.87,0,0,1,100,165Zm24-76.5-14,6V60a10,10,0,0,0-20,0v50a9.82,9.82,0,0,0,4.5,8.5,9.28,9.28,0,0,0,9.5.5l28-12.5c5-2.5,7.5-8,5-13s-8-7.5-13-5Z"/></svg>
                                <p class="post-date">Yesterday</p>
                            </div>
                            <div class="post-message__container">
                                <p class="message">Lorem ipsum dolor sit amet consectetur adipisicing elit. Non officiis tenetur sapiente veritatis harum, dolorem excepturi dolore illo nihil a? Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus dicta atque quos tenetur inventore harum sapiente nam, omnis dolorum temporibus?</p>
                            </div>
                            <div class="post-reaction-info__container">
                                <svg class="likes-icon" height="20" viewBox="0 0 20 20" width="20" xmlns="http://www.w3.org/2000/svg"><path d="M2 10.5C2 9.67157 2.67157 9 3.5 9C4.32843 9 5 9.67157 5 10.5V16.5C5 17.3284 4.32843 18 3.5 18C2.67157 18 2 17.3284 2 16.5V10.5Z" /><path d="M6 10.3333V15.7639C6 16.5215 6.428 17.214 7.10557 17.5528L7.15542 17.5777C7.71084 17.8554 8.32329 18 8.94427 18H14.3604C15.3138 18 16.1346 17.3271 16.3216 16.3922L17.5216 10.3922C17.7691 9.15465 16.8225 8 15.5604 8H12V4C12 2.89543 11.1046 2 10 2C9.44772 2 9 2.44772 9 3V3.66667C9 4.53215 8.71929 5.37428 8.2 6.06667L6.8 7.93333C6.28071 8.62572 6 9.46785 6 10.3333Z"/></svg>
                                <p class="likes">11</p>
                                <svg class="comments-icon" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="M256 32C114.6 32 0 125.1 0 240c0 49.6 21.4 95 57 130.7C44.5 421.1 2.7 466 2.2 466.5c-2.2 2.3-2.8 5.7-1.5 8.7S4.8 480 8 480c66.3 0 116-31.8 140.6-51.4 32.7 12.3 69 19.4 107.4 19.4 141.4 0 256-93.1 256-208S397.4 32 256 32z"/></svg>
                                <p class="comments">4023</p>
                            </div>

                        </div>
                    </div>

                    <div class="card4 card__container">
                        <img src="./images/card1.jpg" alt="card1">
                        <div class="card-content__container">
                            <div class="post-title__container">
                                <h3 class="card-title"><span class="tag tag-math">Math</span>Lorem Ipsum</h3>
                            </div>
                            <div class="post-general-info__container">
                                <svg class="profile-icon" style="enable-background:new 0 0 24 24;" version="1.1" viewBox="0 0 24 24" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="info"/><g id="icons"><g id="user"><ellipse cx="12" cy="8" rx="5" ry="6"/><path d="M21.8,19.1c-0.9-1.8-2.6-3.3-4.8-4.2c-0.6-0.2-1.3-0.2-1.8,0.1c-1,0.6-2,0.9-3.2,0.9s-2.2-0.3-3.2-0.9    C8.3,14.8,7.6,14.7,7,15c-2.2,0.9-3.9,2.4-4.8,4.2C1.5,20.5,2.6,22,4.1,22h15.8C21.4,22,22.5,20.5,21.8,19.1z"/></g></g></svg>
                                <p class="author-name">John Smith</p>
                                <p class="author-role">PhD.</p>
                                <svg class="date-icon" data-name="Layer 1" height="200" id="Layer_1" viewBox="0 0 200 200" width="200" xmlns="http://www.w3.org/2000/svg"><title/><path d="M100,15a85,85,0,1,0,85,85A84.93,84.93,0,0,0,100,15Zm0,150a65,65,0,1,1,65-65A64.87,64.87,0,0,1,100,165Zm24-76.5-14,6V60a10,10,0,0,0-20,0v50a9.82,9.82,0,0,0,4.5,8.5,9.28,9.28,0,0,0,9.5.5l28-12.5c5-2.5,7.5-8,5-13s-8-7.5-13-5Z"/></svg>
                                <p class="post-date">Yesterday</p>
                            </div>
                            <div class="post-message__container">
                                <p class="message">Lorem ipsum dolor sit amet consectetur adipisicing elit. Non officiis tenetur sapiente veritatis harum, dolorem excepturi dolore illo nihil a? Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus dicta atque quos tenetur inventore harum sapiente nam, omnis dolorum temporibus?</p>
                            </div>
                            <div class="post-reaction-info__container">
                                <svg class="likes-icon" height="20" viewBox="0 0 20 20" width="20" xmlns="http://www.w3.org/2000/svg"><path d="M2 10.5C2 9.67157 2.67157 9 3.5 9C4.32843 9 5 9.67157 5 10.5V16.5C5 17.3284 4.32843 18 3.5 18C2.67157 18 2 17.3284 2 16.5V10.5Z" /><path d="M6 10.3333V15.7639C6 16.5215 6.428 17.214 7.10557 17.5528L7.15542 17.5777C7.71084 17.8554 8.32329 18 8.94427 18H14.3604C15.3138 18 16.1346 17.3271 16.3216 16.3922L17.5216 10.3922C17.7691 9.15465 16.8225 8 15.5604 8H12V4C12 2.89543 11.1046 2 10 2C9.44772 2 9 2.44772 9 3V3.66667C9 4.53215 8.71929 5.37428 8.2 6.06667L6.8 7.93333C6.28071 8.62572 6 9.46785 6 10.3333Z"/></svg>
                                <p class="likes">11</p>
                                <svg class="comments-icon" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="M256 32C114.6 32 0 125.1 0 240c0 49.6 21.4 95 57 130.7C44.5 421.1 2.7 466 2.2 466.5c-2.2 2.3-2.8 5.7-1.5 8.7S4.8 480 8 480c66.3 0 116-31.8 140.6-51.4 32.7 12.3 69 19.4 107.4 19.4 141.4 0 256-93.1 256-208S397.4 32 256 32z"/></svg>
                                <p class="comments">4023</p>
                            </div>

                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </main>

</body>
</html>