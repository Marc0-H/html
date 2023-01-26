<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>New thread</title>
  <link rel="stylesheet" href="stylesheet.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <script src="main.js" defer></script>
  <script src="tag_color.js" defer></script>


</head>
<body>
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
        <div class="new_post_main_content">
          <div class="post_container">
            <div class="new_post_content">
              <form id="new_post_form" action="post_upload.php" method="post" enctype="multipart/form-data">
                <div class="new_post-title-container">
                    <input class="new_post_title" name="post_title" id="new_post_title" type="text" placeholder="Enter post title.." required>
                </div>
                <textarea class="new_post_textarea" name="post_content" id="new_post_textarea" form="new_post_form" maxlength="1000" placeholder="Enter text..." required></textarea>
                <div class="new_post_image_container">
                  <label for="new_post_image">Add PNG image:</label>
                  <input id="new_post_image" name="new_post_image" type="file" form="new_post_form">
                </div>
                <div class="new_post_bottom">
                  <div class="tag_container">
                    <p class="tag_text">Tag:</p>
                    <select name="post_tag" id="tag_selector" form="new_post_form">
                      <option value="Math" data-color="purple" >Math</option>
                      <option value="Biology" data-color="green">Biology</option>
                      <option value="English" data-color="green">English</option>
                      <option value="General" data-color="green">General</option>
                    </select>
                    <input type="hidden" name="tag_color" id="tag_color">
                  </div>
                  <input type="submit" class="new_post_button" value="Post">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</body>
</html>
