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
                <?php if (isset($_SESSION["userId"])) { ?>

                    <div class="main_content_title">Your posts
                            <i id="create_post" class="material-icons tooltip">add<div class="tooltip_text">Create post</div></i>
                        <?php } else { ?>
                            <br>  
                            <div class="profile_page_title">Your posts
                            <div class= "profile_page_div">
                              <p> You don't have an account. <br>
                              <a href="login_signup/login_page.php">Log in</a> or <a href="login_signup/signup_page.php">Create one</a> to start posting! </p>
                            </div>
                          <?php } ?>
                    </div>
                    <div class="main_content_posts">
                        <?php include 'filtered_results_profile.php'  ?>
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>