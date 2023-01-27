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
        <script src="filter.js" defer></script>
        <script src="header.js" defer></script>
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
                <div class="thread_content_container">

                    <?php
                        if (isset($_GET["v"])) {
                            $id = $_GET["v"];
                            $post_sql = "SELECT * FROM posts WHERE post_id = $id";
                            $post_result = mysqli_query($connection, $post_sql);
                            $post_result = mysqli_fetch_assoc($post_result);
                            ?>

                            <div class="post_container original_poster">
                                <div class="post_title"><span class="post_tag tag-<?php echo $post_result["post_tag"]?>"><?php echo $post_result["post_tag"]?></span><?php echo $post_result["post_title"]?></div>
                                <div class="user_info_container">
                                    <img src="images/profile_img.png">
                                    <div class="username">The Bridgekeeper</div>
                                    <div class="user_tag">PhD.</div>
                                    <i class="material-icons">query_builder</i>
                                    <div class="date"><?php echo $post_result["post_datetime"]?></div>
                                </div>
                                <div class="post_content"><?php echo $post_result["post_content"]?></div>
                                <div class="interaction_container">
                                    <i class="material-icons tooltip">thumb_up<div class="tooltip_text">Like</div></i>
                                    <div class="post_like_count">12</div>
                                    <i class="material-icons tooltip">forum<div class="tooltip_text">Go to replies</div></i>
                                    <div class="post_comment_count">4</div>
                                    <div class="reply_button">Reply</div>
                                </div>
                                <form>
                                    <textarea class="comment_box" name="comment_content" autocomplete="off" placeholder="Add a reply..." rows="1" required></textarea>
                                    <input type="submit" class="submit_button" value="Submit">
                                </form>
                            </div>

                        <?php
                        }
                    ?>



                    <div class="solution_container">
                        <div class="solution_sign">
                            <div class="solution_bar"></div>
                            <i class="material-icons">check_mark</i>
                            <div class="solution_bar"></div>
                        </div>
                        <div class="comment_container">
                            <div class="user_info_container">
                                <img src="images/profile_img.png">
                                <div class="username">Arthur</div>
                                <div class="user_tag">King of the Britons</div>
                                <i class="material-icons">query_builder</i>
                                <div class="date">2 hours ago</div>
                            </div>
                            <div class="comment_content">
                                <p>What do you mean? An African or European swallow? </p>
                            </div>
                            <div class="interaction_container">
                            <i class="material-icons tooltip">thumb_up<div class="tooltip_text">Like</div></i>
                                <div class="post_like_count">12</div>
                                <i class="material-icons tooltip">forum<div class="tooltip_text">Show replies</div></i>
                                <div class="post_comment_count">4</div>
                                <div class="reply_button">Reply</div>
                            </div>
                        </div>
                    </div>

                    <div class="comment_container">
                        <div class="user_info_container">
                            <img src="images/profile_img.png">
                            <div class="username">Arthur</div>
                            <div class="user_tag">King of the Britons</div>
                            <i class="material-icons">query_builder</i>
                            <div class="date">2 hours ago</div>
                        </div>
                        <div class="comment_content">
                            <p>What do you mean? An African or European swallow? </p>
                        </div>
                        <div class="interaction_container">
                            <i class="material-icons tooltip">thumb_up<div class="tooltip_text">Like</div></i>
                            <div class="post_like_count">12</div>
                            <i class="material-icons tooltip">forum<div class="tooltip_text">Show replies</div></i>
                            <div class="post_comment_count">4</div>
                            <div class="reply_button">Reply</div>
                        </div>
                    </div>

                    <div class="subcomment_container original_poster">
                        <div class="user_info_container">
                            <img src="images/profile_img.png">
                            <div class="username">The Bridgekeeper</div>
                            <div class="user_tag">PhD.</div>
                            <i class="material-icons">query_builder</i>
                            <div class="date">2 hours ago</div>
                        </div>
                        <div class="comment_content">
                            <p>Huh? I-- I don't know that.</p>
                        </div>
                        <div class="interaction_container">
                            <i class="material-icons tooltip">thumb_up<div class="tooltip_text">Like</div></i>
                            <div class="post_like_count">12</div>
                        </div>
                    </div>

                </div>
            </div>
        </main>
    </body>
</html>