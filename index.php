<?php
session_start();

header('Cache-Control: max-age=900');
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
        <script src="filter.js" defer></script>
        <script src="masonry.js" defer></script>
        <script src="header.js" defer></script>
        <script src="cards.js" defer></script>
        <script src="user_info_resize.js" defer></script>
    </head>
    <body>
        <?php
            include 'connection.php';
            if (!$connection) {
                die("Connection to server failed. !");
            }

            include 'header.php';
        ?>
        <main>
            <div class="main_container">
              <?php include 'sidebar.php'; ?>
                <div class="main_content_container">
                    <div class="main_content_title">The latest posts...</div>
                    <div class="main_content_posts">
                        <?php
                        $query = "SELECT * FROM posts";
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            if (isset($_POST["filter-subject"])) {
                                $subject = array();
                                foreach($_POST["filter-subject"] as $filter) {

                                    if (strpos($filter, "math") !== false) {

                                        $subject[] = "math";
                                    }
                                    if (strpos($filter, "english") !== false) {

                                        $subject[] = "english";
                                    }
                                    if (strpos($filter, "biology") !== false) {

                                        $subject[] = "biology";
                                    }
                                    if (strpos($filter, "general") !== false) {

                                        $subject[] = "general";
                                    }
                                }

                                if (!empty($subject)) {
                                    $query .= " WHERE post_tag IN ('" . implode("','", $subject) . "')";
                                }
                                $result = mysqli_query($connection, $query);
                            }

                        }
                        // $result .= "ORDER BY post_id DESC";
                        $post_result = mysqli_query($connection, $query);


                        // $post_sql = "SELECT post_id, post_title, post_content, post_tag, post_datetime, post_image from posts ORDER BY post_id DESC";
                        // $post_result = mysqli_query($connection, $post_sql);

                        while($row = mysqli_fetch_assoc($post_result)) {                        
                          $user_id = $row['user_id'];
                          $user_query = "SELECT userUid, profile_image from users where userId = $user_id";
                          $user_result = mysqli_query($connection, $user_query);
                          $user_row = mysqli_fetch_assoc($user_result);
                        ?>

                        <div id="<?php echo $row["post_id"]?>" class="post_container">
                            <div class="post_image_container">
                                <?php
                                    if (!empty($row["post_image"])) {
                                ?>
                                        <img src="data:image/png;base64,<?php echo $row["post_image"]?>" alt="card1">
                                <?php
                                    }
                                ?>

                            </div>
                            <div class="post_content_container">
                                <div class="post_title">
                                  <span class="post_tag tag-<?php echo $row["post_tag"]?>">
                                    <?php echo $row["post_tag"]?></span> <?php echo $row["post_title"]?></div>
                                <div class="user_info_container">
                                    <img src="images/default.png">
                                    <div class="username" title="<?php echo $user_row["userUid"]?>"><?php echo $user_row["userUid"]?></div>
                                    <div class="user_tag">PhD.</div>
                                    <!-- <i class="material-icons">query_builder</i> -->
                                    <div class="date" title="<?php echo $row["post_datetime"]?>"><?php echo $row["post_datetime"]?></div>
                                </div>
                                <div class="post_content">
                                    <p><?php echo $row["post_content"]?></p>
                                </div>
                                <div class="interaction_container">
                                    <i class="material-icons">thumb_up</i>
                                    <div class="like_count">12</div>
                                    <i class="material-icons">forum</i>
                                    <div class="comment_count">4</div>
                                </div>
                            </div>
                        </div>
                        <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>
