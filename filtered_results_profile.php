<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION["userId"])) { 
    ?> <div>Create an account to view your profile page</div>
    <?php
    } else {

    include '../connection.php';
    $userId = $_SESSION["userId"];

    $start = 0;
    $rowperpage = 6;
    if(isset($_GET['start'])){
        $start = mysqli_real_escape_string($connection,$_GET['start']); 
    }
    if(isset($_GET['rowperpage'])){
        $rowperpage = mysqli_real_escape_string($connection,$_GET['rowperpage']); 
    }

    $query = "SELECT * FROM posts WHERE user_id = $userId ORDER BY post_id DESC LIMIT $start, $rowperpage";
    $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) == 0) {
      ?> <p>You dont have any posts yet!</p><?php
    }
    while ($row = mysqli_fetch_assoc($result)) {
        $user_id = $row['user_id'];
        $post_id = $row['post_id'];
        $post_tag = $row['post_tag'];
        $user_query = "SELECT userUid, profile_image, tag from users where userId = $user_id";
        $user_result = mysqli_query($connection, $user_query);
        $user_row = mysqli_fetch_assoc($user_result);

        $post_likes_query = "SELECT COUNT(post_upvote_link.post_id) AS likes FROM post_upvote_link WHERE post_id = $post_id";
        $post_likes_result = mysqli_query($connection, $post_likes_query);
        $post_like_row = mysqli_fetch_assoc($post_likes_result);

        $post_comments_query = "SELECT COUNT(comments.post_id) AS comments_count FROM comments WHERE post_id = $post_id";
        $post_comments_result = mysqli_query($connection, $post_comments_query);
        $post_comment_row = mysqli_fetch_assoc($post_comments_result);

        $post_tags_query = "SELECT * FROM post_tags WHERE post_tag = '$post_tag'";
        $post_tags_result = mysqli_query($connection, $post_tags_query);
        $post_tag_row = mysqli_fetch_assoc($post_tags_result);
        ?>
        <div id="<?php echo $row["post_id"]?>" class="post_container">
            <div class="post_image_container">
                <?php
                    if (!empty($row["post_image"])) {
                ?>
                        <img src="data:image/png;base64,<?php echo $row["post_image"]?>" alt="post image">
                <?php
                    }
                ?>

            </div>
            <div class="post_content_container">
                <div class="post_title">
                    <span style="background-color: <?php echo $post_tag_row["tag_color"]?>;" class="post_tag tag-<?php echo $row["post_tag"]?>">
                    <?php echo $row["post_tag"]?></span> <?php echo $row["post_title"]?></div>
                <div class="user_info_container">
                    <?php if (!empty($user_row["profile_image"])) { ?>
                            <img src="data:image/png;base64,<?php echo $user_row["profile_image"]?>" alt="profile picture">
                    <?php } else { ?>
                            <img src="images/default.png" alt="default picture">
                    <?php } ?>
                    <div class="username" title="<?php echo $user_row["userUid"]?>"><?php echo $user_row["userUid"]?></div>
                    <div class="user_tag"><?php echo $user_row["tag"]?></div>
                    <i class="material-icons">query_builder</i>
                    <div class="date" title="<?php echo $row["post_datetime"]?>"><?php echo $row["post_datetime"]?></div>
                </div>
                <div class="post_content">
                    <p><?php echo $row["post_content"]?></p>
                </div>
                <div class="interaction_container">
                    <i class="like_btn material-icons">thumb_up</i>
                    <div class="like_count"><?php echo $post_like_row["likes"] ?></div>
                    <i class="material-icons">forum</i>
                    <div class="comment_count"><?php echo $post_comment_row["comments_count"] ?></div>
                </div>
            </div>
        </div>
        <?php
    }
  }
?>
