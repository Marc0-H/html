<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>EduZone</title>
        <link rel="stylesheet" href="stylesheet.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <script src="filter.js" defer></script>
    </head>
    <body>
      <?php 
  include 'connection.php';
  if (!$connection) {
    die("Connection to server failed. !");
  }
  ?>
        <header>
            <div class="header_container">
                <img src="" alt="EDUZONE">
                <div class="header_content_right">
                    <input class="searchbar" type="text" placeholder="Search topic..">
                    <i class="material-icons">add</i>
                    <img src="./images/profile_img.png" alt="profile">
                </div>
            </div>
        </header>
        <main>
            <div class="main_container">
                <div class="sidebar_container">
                    <div class="sidebar_description">
                        <h2>Yo yo yo</h2>
                        <p>Tempora maxime similique cum iure architecto fuga libero labore ullam tenetur delectus deserunt, nihil porro est nesciunt magnam repellat qui quos!  <br><br> Tempora quasi itaque in natus vero incidunt consectetur nihil veritatis debitis doloremque aperiam. Neque, ut.</p>
                    </div>
                    <div class="sidebar_filter">

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
                            Apply
                        </button>
                    </div>
                </div>
                <div class="main_content_container">
                    <div class="main_content_title">The latest posts...</div>
                    <div class="main_content_posts">
                    <?php 
                    $post_sql = "SELECT post_id, post_title, post_content, post_tag, post_datetime from posts ORDER BY post_id DESC";
                    $post_result = mysqli_query($connection, $post_sql);

                    while($row = mysqli_fetch_assoc($post_result)) {
                      
                    ?>
                        <div class="post_container">
                            <div class="post_content_left">
                                <div class="post_title"><span class="post_tag tag-<?php echo $row["post_tag"]?>"><?php echo $row["post_tag"]?></span><?php echo $row["post_title"]?>?</div>
                                <div class="user_info_container">
                                    <img src="images/profile_img.png">
                                    <div class="username">The Bridgekeeper</div>
                                    <div class="user_tag">PhD.</div>
                                    <i class="material-icons">query_builder</i>
                                    <div class="date"><?php echo $row["post_datetime"]?></div>
                                </div>
                                <div class="post_content">
                                  <p><?php echo $row["post_content"]?></p>
                                </div>
                                <div class="interaction_container">
                                    <i class="material-icons">thumb_up</i>
                                    <div class="post_like_count">12</div>
                                    <i class="material-icons">forum</i>
                                    <div class="post_comment_count">4</div>
                                </div>
                            </div>
                            <div class="post_image_container">
                                <img src="images/rick_1.jpeg" alt="">
                            </div>
                        </div> 
                      <?php }?>                       
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>