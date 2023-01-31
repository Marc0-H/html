<?php
if ($_SERVER['HTTPS'] != 'on') {
  $url = "https://". $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
  header("location: $url");
  exit;
}
session_start();
header('Cache-Control: max-age=900');
include 'header.php';

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


</head>
<body>
  <main>
    <div class="main_container">
    <!-- <?php include 'sidebar.php'; ?> -->
    <div class="new_post_main_content_container">
      <?php 
          if (!isset($_SESSION['userId'])) {
        ?>
        <div><a href="login_signup/login_page.php">Log in</a> to create a post</div>
        <?php 
        } else {?>
        <div class="new_post_main_content">
          <div class="new_post_content">
            <form id="new_post_form" action="post_upload.php" method="post" enctype="multipart/form-data">
              <div class="new_post-title-container">
                  <input autocomplete="off" class="new_post_title" name="post_title" id="new_post_title" type="text" placeholder="Enter post title.." required>
              </div>
              <textarea class="new_post_textarea" name="post_content" id="new_post_textarea" form="new_post_form" maxlength="1000" placeholder="Enter text..." required></textarea>
              
              <div class="new_post_bottom">
                <div class="new_post_image_container">
                  <label for="new_post_image">Add PNG image:</label>
                  <input id="new_post_image" name="new_post_image" type="file" form="new_post_form">
                </div>
                <div class="tag_container">
                  <p class="tag_text">Tag:</p>
                  <select name="post_tag" id="tag_selector" form="new_post_form">
                    <option value="Math"  >Math</option>
                    <option value="Biology" >Biology</option>
                    <option value="English" >English</option>
                    <option value="History" >History</option>
                    <option value="General" >General</option>

                  </select>
                </div>
                <input type="submit" class="new_post_button" value="Submit">
              </div>
            </form>
          </div>
        </div>
        <?php
          }
        ?>
      </div>
    </div>
  </main>
</body>
</html>
