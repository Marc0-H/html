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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <script src="filter.js" defer></script>
        <script src="header.js" defer></script>
        <script src="thread.js" defer></script>
        <script src="textarea_resize.js" defer></script>
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
                    /* Check if post has parameter */
                    if (!isset($_GET["v"])) {
                        ?><p>Post could not be found</p><?php
                    } else {
                        $post_id = $_GET["v"];
                        $post_query = "SELECT * FROM posts WHERE post_id = $post_id";
                        $post_result = mysqli_fetch_assoc(mysqli_query($connection, $post_query));

                        $op_id = $post_result["user_id"];
                        $op_query = "SELECT userUid, profile_image FROM users WHERE userId = $op_id";
                        $op_result = mysqli_fetch_assoc(mysqli_query($connection, $op_query));

                        $comment_count_query = "SELECT COUNT(post_id) FROM comments WHERE post_id = $post_id";
                        $comment_count = mysqli_fetch_assoc(mysqli_query($connection, $comment_count_query));

                        $like_count_query = "SELECT COUNT(post_id) FROM post_upvote_link WHERE post_id = $post_id";
                        $like_count = mysqli_fetch_assoc(mysqli_query($connection, $like_count_query));

                        if (isset($_SESSION["userId"])) {
                            $session_id = $_SESSION["userId"];
                            $user_like_query = "SELECT COUNT(user_id) FROM post_upvote_link WHERE user_id = $session_id AND post_id = $post_id";
                            $user_like = mysqli_fetch_assoc(mysqli_query($connection, $user_like_query));
                        }
                ?>

                        <div class="post_container original_poster">
                            <div class="post_title">
                                <span class="post_tag tag-<?php echo $post_result["post_tag"]?>">
                                    <?php echo $post_result["post_tag"]?>
                                </span>
                                <?php echo $post_result["post_title"]?>
                            </div>
                            <div class="user_info_container">
                                <img src="images/default.png">
                                <div class="username"><?php echo $op_result["userUid"]?></div>
                                <div class="user_tag">PhD.</div>
                                <i class="material-icons">query_builder</i>
                                <div class="date"><?php echo $post_result["post_datetime"]?></div>
                            </div>

                            <div class="post_image_container">
                                <?php
                                    if (!empty($post_result["post_image"])) {
                                        ?><img src="data:image/png;base64,<?php echo $post_result["post_image"]?>" alt="card1"><?php
                                    }
                                ?>
                            </div>

                            <div class="post_content"><?php echo $post_result["post_content"]?></div>
                            <div id="bookmark"></div>
                            <div class="interaction_container">
                                <i id="post-like-<?php echo $post_id ?>" class="material-icons tooltip like_button <?php if ($user_like["COUNT(user_id)"] > 0) { echo 'liked'; }?>">thumb_up<div class="tooltip_text">Like</div></i>
                                <div class="like_count"><?php echo $like_count["COUNT(post_id)"]?></div>
                                <a href="#bookmark" class="material-icons tooltip">forum<div class="tooltip_text">Go to replies</div></a>
                                <div class="post_comment_count"><?php echo $comment_count["COUNT(post_id)"]?></div>
                                <div id="reply-post" class="reply_button">Reply</div>
                            </div>
                            <form id="form-reply-post" action="comment_upload.php?v=<?php echo $_GET["v"]?>" method="post">
                                <textarea class="comment_box" name="comment_content" autocomplete="off" placeholder="Add a reply..." rows="1" required></textarea>
                                <input type="hidden" name="post_id" value="<?php echo $_GET["v"]?>">
                                <input type="hidden" name="parent_comment_id" value="">
                                <input class="submit_button" type="submit" value="Submit">
                            </form>
                        </div>

                    <!--
                    <div class="solution_container">
                        <div class="solution_sign">
                            <div class="solution_bar"></div>
                            <i class="material-icons">check_mark</i>
                            <div class="solution_bar"></div>
                        </div>
                        <div class="comment_container">
                            <div class="user_info_container">
                                <img src="images/default.png">
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
                                <div class="like_count">12</div>
                                <i class="material-icons tooltip">forum<div class="tooltip_text">Show replies</div></i>
                                <div class="post_comment_count">4</div>
                                <div class="reply_button">Reply</div>
                            </div>
                        </div>
                    </div>
                    -->
                    <?php
                        $comment_query = "SELECT * FROM comments WHERE post_id = $post_id ORDER BY comment_datetime DESC";
                        $comment_result = mysqli_query($connection, $comment_query);
                        
                        while($comment_row = mysqli_fetch_assoc($comment_result)) {
                            $user_id = $comment_row['user_id'];
                            $user_query = "SELECT userUid, profile_image FROM users WHERE userId = $user_id";
                            $user_result = mysqli_fetch_assoc(mysqli_query($connection, $user_query));

                            $comment_id = $comment_row["id"];
                            $subcomment_count_query = "SELECT COUNT(parent_comment_id) FROM comments WHERE parent_comment_id = $comment_id";
                            $subcomment_count = mysqli_fetch_assoc(mysqli_query($connection, $subcomment_count_query));

                            $like_count_query = "SELECT COUNT(comment_id) FROM comment_upvote_link WHERE comment_id = $comment_id";
                            $like_count = mysqli_fetch_assoc(mysqli_query($connection, $like_count_query));
                            
                            if (isset($_SESSION["userId"])) {
                                $user_like_query = "SELECT COUNT(user_id) FROM comment_upvote_link WHERE user_id = $session_id AND comment_id = $comment_id";
                                $user_like = mysqli_fetch_assoc(mysqli_query($connection, $user_like_query));
                            }
                    ?>

                            <div class="comment_container <?php if ($user_id == $op_id) { echo 'original_poster'; }?>">
                                <div class="user_info_container">
                                    <img src="images/default.png">
                                    <div class="username"><?php echo $user_result["userUid"]?></div>
                                    <div class="user_tag">Leerling</div>
                                    <i class="material-icons">query_builder</i>
                                    <div class="date"><?php echo $comment_row["comment_datetime"]?></div>
                                </div>
                                <div class="comment_content">
                                    <p><?php echo $comment_row["comment_content"]?></p>
                                </div>
                                <div class="interaction_container">
                                    <i id="comment-like-<?php echo $comment_id ?>" class="material-icons tooltip like_button <?php if ($user_like["COUNT(user_id)"] > 0) { echo 'liked'; }?>">thumb_up<div class="tooltip_text">Like</div></i>
                                    <div class="like_count"><?php echo $like_count["COUNT(comment_id)"]?></div>
                                    <i id="subcomment-<?php echo $comment_id ?>" class="material-icons tooltip hide_replies">forum<div class="tooltip_text">Show replies</div></i>
                                    <div class="post_comment_count"><?php echo $subcomment_count["COUNT(parent_comment_id)"]?></div>
                                    <div id="reply-<?php echo $comment_id ?>" class="reply_button">Reply</div>
                                </div>
                                <form id="form-reply-<?php echo $comment_id ?>" action="comment_upload.php?v=<?php echo $_GET["v"]?>" method="post">
                                    <textarea class="comment_box" name="comment_content" autocomplete="off" placeholder="Add a reply..." rows="1" required></textarea>
                                    <input type="hidden" name="post_id" value="">
                                    <input type="hidden" name="parent_comment_id" value="<?php echo $comment_row["id"] ?>">
                                    <input class="submit_button" type="submit" value="Submit">
                                </form>
                            </div>

                            <?php
                                $subcomment_query = "SELECT * FROM comments WHERE parent_comment_id = $comment_id ORDER BY comment_datetime ASC";
                                $subcomment_result = mysqli_query($connection, $subcomment_query);

                                while($subcomment_row = mysqli_fetch_assoc($subcomment_result)) {
                                    $subcomment_id = $subcomment_row['id'];

                                    $user_id = $subcomment_row['user_id'];
                                    $user_query = "SELECT userUid, profile_image FROM users WHERE userId = $user_id";
                                    $user_result = mysqli_fetch_assoc(mysqli_query($connection, $user_query));

                                    $like_count_query = "SELECT COUNT(comment_id) FROM comment_upvote_link WHERE comment_id = $subcomment_id";
                                    $like_count = mysqli_fetch_assoc(mysqli_query($connection, $like_count_query));
        
                                    if (isset($_SESSION["userId"])) {
                                    $user_like_query = "SELECT COUNT(user_id) FROM comment_upvote_link WHERE user_id = $session_id AND comment_id = $subcomment_id";
                                    $user_like = mysqli_fetch_assoc(mysqli_query($connection, $user_like_query));
                                    }
                            ?>   
                                    <div class="subcomment_container subcomment-<?php echo $comment_id ?> <?php if ($user_id == $op_id) { echo 'original_poster'; }?>">
                                        <div class="user_info_container">
                                            <img src="images/default.png">
                                            <div class="username"><?php echo $user_result["userUid"]?></div>
                                            <div class="user_tag">PhD.</div>
                                            <i class="material-icons">query_builder</i>
                                            <div class="date"><?php echo $subcomment_row["comment_datetime"]?></div>
                                        </div>
                                        <div class="comment_content">
                                            <p><?php echo $subcomment_row["comment_content"]?></p>
                                        </div>
                                        <div class="interaction_container">
                                            <i id="comment-like-<?php echo $subcomment_id ?>" class="material-icons tooltip like_button <?php if ($user_like["COUNT(user_id)"] > 0) { echo 'liked'; }?>">thumb_up<div class="tooltip_text">Like</div></i>
                                            <div class="like_count"><?php echo $like_count["COUNT(comment_id)"]?></div>
                                        </div>
                                    </div>
                <?php
                                }
                        }
                    }
                ?>
                </div>
            </div>
        </main>
    </body>
</html>