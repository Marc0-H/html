<?php
  session_start();
  include '../connection.php';
  $tag_query = "SELECT post_tag FROM post_tags";
  $tag_result = mysqli_query($connection, $tag_query);
  
  $usr_tag_query = "SELECT tag_name FROM user_tags";
  $usr_tag_result = mysqli_query($connection, $usr_tag_query);
  
  $user_query = "SELECT userUid, userId FROM users";
  $usr_result = mysqli_query($connection, $user_query);
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
        <script src="adminpage.js" defer></script>
        <script src="header.js" defer></script>
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
                      <div class= "admin_add_tag_div">
                        <h1> Add tag </h1>
                        <form class="add_tag_form" id="add_tag_form" action="admin_add_tag.php" method="post">
                          <div class="admin_add_tag_subdiv">
                            <input type="text" placeholder="New tag name" autocomplete="off" name="new_tag_name" class="new_tag_name" >
                            <input type="color" name="tag_color_picker" class="tag_color_picker" onchange="clickColor(0, -1, -1, 5)" value="#ff0000" >
                          </div>
                          <input type="submit" id="add_tag_submit" form="add_tag_form" class="admin_submit"  name="add_tag_submit" value="Add tag">
                        </form>
                      </div>
                      <div class= "admin_add_user_tag_div">
                        <h1> Add user-tag </h1>
                        <form class="add_user_tag_form" id="add_user_tag_form" action="admin_add_user_tag.php" method="post">
                          <div class="admin_add_tag_subdiv">
                            <input type="text" placeholder="New user-tag name" autocomplete="off" name="new_user_tag_name" class="new_user_tag_name">
                          </div>
                          <input type="submit" id="add_user_tag_submit" class="admin_submit" name="add_user_tag_submit" value="Add usertag">
                        </form>
                      </div>
                      <div class="admin_remove_tag_div">
                          <h1> Remove tag </h1>
                          <form id="remove_tag_form" action="admin_remove_tag.php" method="post">
                            <p class="tag_text">Tag:</p>
                            <select class="admin_tag_selector" name="remove_tag" form="remove_tag_form">
                              <?php
                              while ($row = mysqli_fetch_array($tag_result)) {
                                echo "<option class='tag_option' value=" . $row['post_tag'] . ">" . $row['post_tag'] . "</option>";
                              } 
                              ?>
                            <input type="submit" id="remove_tag_submit" class="admin_submit" name="remove_tag_submit" value="Remove tag">
                        </form>
                      </div>
                      <div class="admin_remove_user_tag_div">
                          <h1> Remove usertag </h1>
                          <form id="remove_user_tag_form" action="admin_remove_user_tag.php" method="post">
                            <p class="tag_text">Usertag:</p>
                            <select class="admin_user_tag_selector" name="remove_user_tag"  form="remove_user_tag_form">
                              <?php
                              while ($usrtag_row = mysqli_fetch_array($usr_tag_result)) {
                                echo "<option class='tag_option' value=" . $usrtag_row['tag_name'] . ">" . $usrtag_row['tag_name'] . "</option>";
                              } 
                              ?>
                            <input type="submit" id="remove_user_tag_submit" class="admin_submit" name="remove_user_tag_submit" value="Remove usertag">
                        </form>
                      </div>
                      <div class="admin_delete_user_div">
                        <h1> Remove user </h1>
                        <form id="remove_user_form" action="admin_remove_user.php" method="post">
                          <p>User:</p>   
                          <select class="admin_user_selector" name="remove_user" form="remove_user_form">
                            <?php
                            if ($usr_result) {
                              while($user_row = mysqli_fetch_assoc($usr_result)) {
                                echo "<option class='select_user' value=" . $user_row['userUid'] . ">" . $user_row['userUid'] . "</option>";
                              }
                            } else {
                              echo "Query failed: " . mysqli_error($conn);
                            }
                            ?>
                            <input type="submit" class="admin_submit" id="remove_user_submit" name="remove_user_submit" value="Remove user">
                        </form>
                      </div>
                    <?php } ?>
                    <div class="main_content_posts">
                    </div>
                  </div>
                </div>
            </div>
        </main>
    </body>
</html>
