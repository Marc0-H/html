<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>EduZone</title>
        <link rel="stylesheet" href="stylesheet.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" defer></script>
        <script src="masonry.js" defer></script>
        <script src="header.js" defer></script>
        <script src="cards.js" defer></script>
        <script src="user_info_resize.js" defer></script>
    </head>
    <body>
        <?php
            include '../connection.php';
            if (!$connection) {
                die("Connection to server failed. !");
            }

            include 'header.php';
            if (isset($_SESSION["userId"])) {
              $session_id = $_SESSION["userId"];
            }
        ?>
        <main>
            <div class="main_container">

              <div class="sidebar_container">
                <div class="sidebar_description">
                  <h2>Find your Study Buddy</h2>
                  <p>Welcome to our community! Here you can connect with fellow students and share knowledge and resources. Whether you need help with a specific subject or just want to discuss your coursework with others, our forum is the place to be. Join now and start building your support network!<br><br> Made with ❤️ by the brainy-bunch.</p>
                </div>
            </div>
            
            <div class="main_content_container">
              <?php if ($session_id != 1) { 
                  echo "<script>";
                  echo "window.location.href='index.php'";
                  echo "</script>";
               } else { ?>
                  <div class="main_content_title">Admin page</div>
                  <br>  
                      <div class= "profile_page_div">
                        <h1> Add tag </h1><br>
                        <form id="add_tag_form" action="add_tag.php" method="post">
                          <input name="new_tag_name" class="new_tag_name" type="text" placeholder="New tag name">
                          <label for="tag_color_picker">Tag color:</label>
                          <input type="color" name="tag_color_picker" onchange="clickColor(0, -1, -1, 5)" value="#ff0000" >
                          <input type="submit" id="add_tag_submit" name="add_tag_submit" value="Add tag!">
                        </form>
                      </div>
                    <?php } ?>
                    <div class="main_content_posts">
                      <p>HALLO TEST</p>
                    </div>
                  </div>
                </div>
            </div>
        </main>
    </body>
</html>
