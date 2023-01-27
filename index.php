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

                <div class="sidebar_container">
                    <div class="sidebar_description">
                        <h2>Find your Study Budy</h2>
                        <p>Tempora maxime similique cum iure architecto fuga libero labore ullam tenetur delectus deserunt, nihil porro est nesciunt magnam repellat qui quos!  <br><br> Tempora quasi. Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, saepe! <br><br> Made with ❤️ by the brainy-bunch.</p>
                    </div>
                    <div class="sidebar_filter">
                        <form method="post">
                            <button id="filter-option-subject" class="dropdown-button" type="button">
                                Subject
                                <svg class="dropdown-button-icon" viewBox="0 0 96 96" xmlns="http://www.w3.org/2000/svg"><title/><path d="M81.8457,25.3876a6.0239,6.0239,0,0,0-8.45.7676L48,56.6257l-25.396-30.47a5.999,5.999,0,1,0-9.2114,7.6879L43.3943,69.8452a5.9969,5.9969,0,0,0,9.2114,0L82.6074,33.8431A6.0076,6.0076,0,0,0,81.8457,25.3876Z"/></svg>
                            </button>
                            <div class="dropdown" id="dropdown-subject">
                                <label class="dropdown-label">
                                    <input name="filter-subject[]" value="math" type="checkbox">Math
                                </label>
                                <label  class="dropdown-label">
                                    <input name="filter-subject[]" value="biology" type="checkbox">Biology
                                </label>
                                <label class="dropdown-label">
                                    <input name="filter-subject[]" value="english" type="checkbox">English
                                </label>
                                <label class="dropdown-label">
                                    <input name="filter-subject[]" value="general" type="checkbox">General
                                </label>
                            </div>
                            <button id="filter-option-sortby" class="dropdown-button" type="button">
                                Sort by
                                <svg class="dropdown-button-icon" viewBox="0 0 96 96" xmlns="http://www.w3.org/2000/svg"><title/><path d="M81.8457,25.3876a6.0239,6.0239,0,0,0-8.45.7676L48,56.6257l-25.396-30.47a5.999,5.999,0,1,0-9.2114,7.6879L43.3943,69.8452a5.9969,5.9969,0,0,0,9.2114,0L82.6074,33.8431A6.0076,6.0076,0,0,0,81.8457,25.3876Z"/></svg>
                            </button>
                            <div class="dropdown" id="dropdown-sortby">
                                <label class="dropdown-label">
                                    <input name="filter-sortby" value="latest" type="radio" >Latest
                                </label>
                                <label  class="dropdown-label">
                                    <input name="filter-sortby" value="relevance" type="radio">Relevance
                                </label>
                                <label class="dropdown-label">
                                    <input name="filter-sortby" value="likes" type="radio">Likes
                                </label>
                                <label class="dropdown-label">
                                    <input name="filter-sortby" value="answered" type="radio">Answered
                                </label>
                            </div>
                            <button id="filter-option-user-role" class="dropdown-button" type="button">
                                User role
                                <svg class="dropdown-button-icon" viewBox="0 0 96 96" xmlns="http://www.w3.org/2000/svg"><title/><path d="M81.8457,25.3876a6.0239,6.0239,0,0,0-8.45.7676L48,56.6257l-25.396-30.47a5.999,5.999,0,1,0-9.2114,7.6879L43.3943,69.8452a5.9969,5.9969,0,0,0,9.2114,0L82.6074,33.8431A6.0076,6.0076,0,0,0,81.8457,25.3876Z"/></svg>
                            </button>
                            <div class="dropdown" id="dropdown-user-role">
                                <label class="dropdown-label">
                                    <input name="filter-role[]" value="phd" type="checkbox">PhD.
                                </label>
                                <label  class="dropdown-label">
                                    <input name="filter-role[]" value="student" type="checkbox">Student
                                </label>
                                <label class="dropdown-label">
                                    <input name="filter-role[]" value="teacher" type="checkbox">Teacher
                                </label>
                            </div>
                            <input type="submit" value="Apply" class="filter-button">
                        </form>
                    </div>
                </div>

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
                                    <div class="post_like_count">12</div>
                                    <i class="material-icons">forum</i>
                                    <div class="post_comment_count">4</div>
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
