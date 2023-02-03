<?php
    include '../connection.php';
    
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    /* Check if post has parameter */
    if (!isset($_GET["v"])) {
        ?><p>Post could not be found</p><?php
    } else {
        $session_id = "";

        // Vraag post info van database.
        $post_id = $_GET["v"];
        $post_query = "SELECT * FROM posts WHERE post_id = $post_id";
        $post_result = mysqli_fetch_assoc(mysqli_query($connection, $post_query));
        $post_tag = $post_result['post_tag'];

        // Vraag post maker info van database.
        $op_id = $post_result["user_id"];
        $op_query = "SELECT userUid, profile_image, tag FROM users WHERE userId = $op_id";
        $op_result = mysqli_fetch_assoc(mysqli_query($connection, $op_query));

        // Vraag comment info van database.
        $comment_count_query = "SELECT COUNT(post_id) FROM comments WHERE post_id = $post_id";
        $comment_count = mysqli_fetch_assoc(mysqli_query($connection, $comment_count_query));

        // Vraag like info van database.
        $like_count_query = "SELECT COUNT(post_id) FROM post_upvote_link WHERE post_id = $post_id";
        $like_count = mysqli_fetch_assoc(mysqli_query($connection, $like_count_query));

        // Vraag post tag info van database.
        $post_tags_query = "SELECT * FROM post_tags WHERE post_tag = '$post_tag'";
        $post_tags_result = mysqli_query($connection, $post_tags_query);
        $post_tag_row = mysqli_fetch_assoc($post_tags_result);

        if (isset($_SESSION["userId"])) {
            $session_id = $_SESSION["userId"];
            $user_like_query = "SELECT COUNT(user_id) FROM post_upvote_link WHERE user_id = $session_id AND post_id = $post_id";
            $user_like = mysqli_fetch_assoc(mysqli_query($connection, $user_like_query));
        }
?>

        <div class="post_container original_poster">
            <div class="post_title_container">
                <div class="post_title">
                    <span style="background-color: <?php echo $post_tag_row["tag_color"]?>;" class="post_tag tag-<?php echo $post_result["post_tag"]?>"><?php echo $post_result["post_tag"]?></span> 
                    <?php echo $post_result["post_title"]?>
                </div>
                <div class="button_container">
                    <?php if ($session_id == $op_id || $session_id == 1) {?>
                        <i id="delete-post-<?php echo $post_id?>" class="material-icons tooltip delete_button delete_post">delete<div class="tooltip_text">Delete post</div></i>
                    <?php }?>
                </div>
            </div>
            <div class="user_info_container">
                <?php if (!empty($op_result["profile_image"])) { ?>
                        <img src="data:image/png;base64,<?php echo $op_result["profile_image"]?>" alt="profile picture">
                <?php } else { ?>
                        <img src="images/default.png" alt="default picture">
                <?php } ?>
                <div class="username"><?php echo $op_result["userUid"]?></div>
                <div class="user_tag"><?php echo $op_result["tag"]?></div>
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
                <div class="comment_count"><?php echo $comment_count["COUNT(post_id)"]?></div>
                <div id="reply-post" class="reply_button">Reply</div>
            </div>
            <form id="form-reply-post" action="comment_upload.php?v=<?php echo $_GET["v"]?>" method="post">
                <textarea class="comment_box" name="comment_content" autocomplete="off" placeholder="Add a reply..." rows="1" required></textarea>
                <input type="hidden" name="post_id" value="<?php echo $_GET["v"]?>">
                <input type="hidden" name="parent_comment_id" value="">
                <input class="submit_button" type="submit" value="Submit">
            </form>
        </div>

        <?php
            // Vraag solution op van database als de post een solution heeft.
            
            $solution_id = 0; // Zero is not used as a possible id
            if (!is_null($post_result["solution_id"])) {
                $solution_id = $post_result["solution_id"];

                $comment_query = "SELECT * FROM comments WHERE post_id = $post_id AND id = $solution_id";
                $comment_row = mysqli_fetch_assoc(mysqli_query($connection, $comment_query));

                $user_id = $comment_row['user_id'];
                $user_query = "SELECT userUid, profile_image, tag FROM users WHERE userId = $user_id";
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
                <div class="solution_container">
                    <div class="solution_sign">
                        <div class="solution_bar"></div>
                        <i class="material-icons">check_mark</i>
                        <div class="solution_bar"></div>
                    </div>
                    <div class="comment_container <?php if ($user_id == $op_id) { echo 'original_poster'; }?>">
                        <div class="user_info_container">
                            <?php if (!empty($user_result["profile_image"])) { ?>
                                    <img src="data:image/png;base64,<?php echo $user_result["profile_image"]?>" alt="profile picture">
                            <?php } else { ?>
                                    <img src="images/default.png" alt="default picture">
                            <?php } ?>
                            <div class="username"><?php echo $user_result["userUid"]?></div>
                            <div class="user_tag"><?php echo $user_result["tag"]?></div>
                            <i class="material-icons">query_builder</i>
                            <div class="date"><?php echo $comment_row["comment_datetime"]?></div>
                            <div class="button_container">
                                <?php if ($session_id == $user_id || $session_id == 1) {?>
                                    <i id="delete-comment-<?php echo $comment_id?>" class="material-icons tooltip delete_button delete_comment">delete<div class="tooltip_text">Delete comment</div></i>
                                <?php }?>
                            </div>
                        </div>
                        <div class="comment_content">
                            <p><?php echo $comment_row["comment_content"]?></p>
                        </div>
                        <div class="interaction_container">
                            <i id="comment-like-<?php echo $comment_id ?>" class="material-icons tooltip like_button <?php if ($user_like["COUNT(user_id)"] > 0) { echo 'liked'; }?>">thumb_up<div class="tooltip_text">Like</div></i>
                            <div class="like_count"><?php echo $like_count["COUNT(comment_id)"]?></div>
                            <i id="subcomment-<?php echo $comment_id ?>" class="material-icons tooltip hide_replies">forum<div class="tooltip_text">Show replies</div></i>
                            <div class="comment_count"><?php echo $subcomment_count["COUNT(parent_comment_id)"]?></div>
                            <div id="reply-<?php echo $comment_id ?>" class="reply_button">Reply</div>
                        </div>
                        <form id="form-reply-<?php echo $comment_id ?>" action="comment_upload.php?v=<?php echo $_GET["v"]?>" method="post">
                            <textarea class="comment_box" name="comment_content" autocomplete="off" placeholder="Add a reply..." rows="1" required></textarea>
                            <input type="hidden" name="post_id" value="">
                            <input type="hidden" name="parent_comment_id" value="<?php echo $comment_row["id"] ?>">
                            <input class="submit_button" type="submit" value="Submit">
                        </form>
                    </div>
                </div>
            <?php
                // Vraag subcomments van solution op van database.

                $subcomment_query = "SELECT * FROM comments WHERE parent_comment_id = $comment_id ORDER BY comment_datetime ASC";
                $subcomment_result = mysqli_query($connection, $subcomment_query);

                while($subcomment_row = mysqli_fetch_assoc($subcomment_result)) {
                    $subcomment_id = $subcomment_row['id'];

                    $user_id = $subcomment_row['user_id'];
                    $user_query = "SELECT userUid, profile_image, tag FROM users WHERE userId = $user_id";
                    $user_result = mysqli_fetch_assoc(mysqli_query($connection, $user_query));

                    $like_count_query = "SELECT COUNT(comment_id) FROM comment_upvote_link WHERE comment_id = $subcomment_id";
                    $like_count = mysqli_fetch_assoc(mysqli_query($connection, $like_count_query));

                    if (isset($_SESSION["userId"])) {
                    $user_like_query = "SELECT COUNT(user_id) FROM comment_upvote_link WHERE user_id = $session_id AND comment_id = $subcomment_id";
                    $user_like = mysqli_fetch_assoc(mysqli_query($connection, $user_like_query));
                    }
            ?>
                    <div id="subcomment-container-<?php echo $subcomment_id ?>" class="subcomment_container subcomment-<?php echo $comment_id ?> <?php if ($user_id == $op_id) { echo 'original_poster'; }?>">
                        <div class="user_info_container">
                            <?php if (!empty($user_result["profile_image"])) { ?>
                                    <img src="data:image/png;base64,<?php echo $user_result["profile_image"]?>" alt="profile picture">
                            <?php } else { ?>
                                    <img src="images/default.png" alt="default picture">
                            <?php } ?>
                            <div class="username"><?php echo $user_result["userUid"]?></div>
                            <div class="user_tag"><?php echo $user_result["tag"]?></div>
                            <i class="material-icons">query_builder</i>
                            <div class="date"><?php echo $subcomment_row["comment_datetime"]?></div>
                            <div class="button_container">
                                <?php if ($session_id == $user_id || $session_id == 1) {?>
                                    <i id="delete-comment-<?php echo $subcomment_id?>" class="material-icons tooltip delete_button delete_comment">delete<div class="tooltip_text">Delete comment</div></i>
                                <?php }?>
                            </div>
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
        ?>


    <?php
        // Handel filteren van de comments gebaseerd op input van de filter sidebar.
        $roles_query = "";
        $comment_query = "";

        if (isset($_GET["filter-role"])) {
            $roles = array();

            foreach($_GET["filter-role"] as $filter) {
                $roles[] = $filter;
            }
    
            $roles_query = "AND tag IN ('".implode("','", $roles)."')";
        } else {
            $roles_query = "AND 2 = 1";
        }

        if (isset($_GET["filter-thread-sortby"])) {
            $sortby = $_GET["filter-thread-sortby"];
            if (!empty($sortby)) {
                if ($sortby == "latest") {
                    $comment_query = "SELECT * FROM comments JOIN users ON comments.user_id = users.userId WHERE post_id = $post_id " . $roles_query . " ORDER BY comment_datetime DESC";
                } else if ($sortby == "populairity") {
                    $comment_query = "SELECT comments.*, (SELECT COUNT(*) FROM comment_upvote_link JOIN users ON comments.user_id = users.userId WHERE comments.id = comment_upvote_link.comment_id) as upvotes, users.tag FROM comments JOIN posts ON comments.post_id = posts.post_id JOIN users ON comments.user_id = users.userId WHERE posts.post_id = $post_id AND NOT id = $solution_id " . $roles_query . " ORDER BY upvotes DESC";

                } else if ($sortby == "controversial") {
                    $comment_query = "SELECT comments.*, (SELECT COUNT(*) FROM comments as sub_comments WHERE sub_comments.parent_comment_id = comments.id) as sub_comment_count, users.tag FROM comments JOIN posts ON comments.post_id = posts.post_id JOIN users ON comments.user_id = users.userId WHERE comments.parent_comment_id IS NULL AND posts.post_id = $post_id AND NOT comments.id = $solution_id " . $roles_query . " ORDER BY sub_comment_count DESC";

                }
            }
        } else {
            $comment_query = "SELECT * FROM comments WHERE post_id = $post_id AND NOT id = $solution_id ORDER BY comment_datetime DESC";
        }

        // Alle comment resultaten.
        $comment_result = mysqli_query($connection, $comment_query);

        // Vraag comment data van de database op.
        while($comment_row = mysqli_fetch_assoc($comment_result)) {
            $user_id = $comment_row['user_id'];
            $user_query = "SELECT userUid, profile_image, tag FROM users WHERE userId = $user_id";
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
                    <?php if (!empty($user_result["profile_image"])) { ?>
                            <img src="data:image/png;base64,<?php echo $user_result["profile_image"]?>" alt="profile picture">
                    <?php } else { ?>
                            <img src="images/default.png" alt="default picture">
                    <?php } ?>
                    <div class="username"><?php echo $user_result["userUid"]?></div>
                    <div class="user_tag"><?php echo $user_result["tag"]?></div>
                    <i class="material-icons">query_builder</i>
                    <div class="date"><?php echo $comment_row["comment_datetime"]?></div>
                    <div class="button_container">
                        <?php
                        if ($session_id == $user_id || $session_id == 1) {?>
                            <i id="delete-comment-<?php echo $comment_id?>" class="material-icons tooltip delete_button delete_comment">delete<div class="tooltip_text">Delete comment</div></i>
                        <?php }
                        if ($session_id == $op_id && $session_id != $user_id) {?>
                            <i id="solution-<?php echo $comment_id?>" class="material-icons tooltip solution_button">done<div class="tooltip_text">Mark as solution</div></i>
                        <?php }?>
                    </div>
                </div>
                <div class="comment_content">
                    <p><?php echo $comment_row["comment_content"]?></p>
                </div>
                <div class="interaction_container">
                    <i id="comment-like-<?php echo $comment_id ?>" class="material-icons tooltip like_button <?php if ($user_like["COUNT(user_id)"] > 0) { echo 'liked'; }?>">thumb_up<div class="tooltip_text">Like</div></i>
                    <div class="like_count"><?php echo $like_count["COUNT(comment_id)"]?></div>
                    <i id="subcomment-<?php echo $comment_id ?>" class="material-icons tooltip hide_replies">forum<div class="tooltip_text">Show replies</div></i>
                    <div class="comment_count"><?php echo $subcomment_count["COUNT(parent_comment_id)"]?></div>
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
                // Vraag subcomment data bij elke comment van de database op.
                $subcomment_query = "SELECT * FROM comments WHERE parent_comment_id = $comment_id ORDER BY comment_datetime ASC";
                $subcomment_result = mysqli_query($connection, $subcomment_query);

                while($subcomment_row = mysqli_fetch_assoc($subcomment_result)) {
                    $subcomment_id = $subcomment_row['id'];

                    $user_id = $subcomment_row['user_id'];
                    $user_query = "SELECT userUid, profile_image, tag FROM users WHERE userId = $user_id";
                    $user_result = mysqli_fetch_assoc(mysqli_query($connection, $user_query));

                    $like_count_query = "SELECT COUNT(comment_id) FROM comment_upvote_link WHERE comment_id = $subcomment_id";
                    $like_count = mysqli_fetch_assoc(mysqli_query($connection, $like_count_query));

                    if (isset($_SESSION["userId"])) {
                    $user_like_query = "SELECT COUNT(user_id) FROM comment_upvote_link WHERE user_id = $session_id AND comment_id = $subcomment_id";
                    $user_like = mysqli_fetch_assoc(mysqli_query($connection, $user_like_query));
                    }
            ?>
                    <div id="subcomment-container-<?php echo $subcomment_id ?>" class="subcomment_container subcomment-<?php echo $comment_id ?> <?php if ($user_id == $op_id) { echo 'original_poster'; }?>">
                        <div class="user_info_container">
                            <?php if (!empty($user_result["profile_image"])) { ?>
                                    <img src="data:image/png;base64,<?php echo $user_result["profile_image"]?>" alt="profile picture">
                            <?php } else { ?>
                                    <img src="images/default.png" alt="default picture">
                            <?php } ?>
                            <div class="username"><?php echo $user_result["userUid"]?></div>
                            <div class="user_tag"><?php echo $user_result["tag"]?></div>
                            <i class="material-icons">query_builder</i>
                            <div class="date"><?php echo $subcomment_row["comment_datetime"]?></div>
                            <div class="button_container">
                                <?php if ($session_id == $user_id || $session_id == 1) {?>
                                    <i id="delete-comment-<?php echo $subcomment_id?>" class="material-icons tooltip delete_button delete_comment">delete<div class="tooltip_text">Delete comment</div></i>
                                <?php }?>
                            </div>
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