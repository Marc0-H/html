<?php
    include 'connection.php';
    // $search = $_GET["search"];

    $query;
    $subjects_query = "";


    if (isset($_GET["filter-subject"])) {
        $subjects = array();
        foreach($_GET["filter-subject"] as $filter) {

            if (strpos($filter, "math") !== false) {
                $subjects[] = "math";
            }
            if (strpos($filter, "english") !== false) {
                $subjects[] = "english";
            }
            if (strpos($filter, "biology") !== false) {
                $subjects[] = "biology";
            }
            if (strpos($filter, "general") !== false) {
                $subjects[] = "general";
            }
        }
        if(count($subjects) > 0){
            $subjects_query = "WHERE post_tag IN ('".implode("','", $subjects)."')";

        }
    }

    if (isset($_GET["filter-sortby"])) {
        $sortby = $_GET["filter-sortby"];
        if (!empty($sortby)) {
            if ($sortby == "latest") {
                $query = "SELECT * FROM posts " . $subjects_query . " ORDER BY post_id DESC";
            } else if ($sortby == "populairity") {
                $query = "SELECT posts.*,COUNT(post_upvote_link.post_id) AS likes FROM posts LEFT JOIN post_upvote_link ON posts.post_id = post_upvote_link.post_id " . $subjects_query . " GROUP BY posts.post_id ORDER BY likes DESC";
            } else if ($sortby == "controversial") {
                $query = "SELECT posts.*, COUNT(comments.post_id) AS comments_count FROM posts LEFT JOIN comments ON posts.post_id = comments.post_id " . $subjects_query . " GROUP BY posts.post_id ORDER BY comments_count DESC";
            }
        } 
    } else {
        $query = "SELECT * FROM posts ORDER BY post_id DESC";
    }




    $stmt;
    
    if (!empty($_GET["search"])) {
        $search = "%" . $_GET["search"] . "%";
        $stmt = $connection->prepare("SELECT * FROM posts WHERE post_title LIKE ? OR post_content LIKE ?");
        
        $stmt->bind_param("ss", $search, $search);
    } else {
        $stmt = $connection->prepare($query);
    }
    $stmt->execute();
    $result = $stmt->get_result();
    $results = $result->fetch_all(MYSQLI_ASSOC);

    foreach($results as $row) {
        $user_id = $row['user_id'];
        $post_id = $row['post_id'];
        $user_query = "SELECT userUid, profile_image from users where userId = $user_id";
        $user_result = mysqli_query($connection, $user_query);
        $user_row = mysqli_fetch_assoc($user_result);

        $post_likes_query = "SELECT COUNT(post_upvote_link.post_id) AS likes FROM post_upvote_link WHERE post_id = $post_id";
        $post_likes_result = mysqli_query($connection, $post_likes_query);
        $post_like_row = mysqli_fetch_assoc($post_likes_result);

        $post_comments_query = "SELECT COUNT(comments.post_id) AS comments_count FROM comments WHERE post_id = $post_id";
        $post_comments_result = mysqli_query($connection, $post_comments_query);
        $post_comment_row = mysqli_fetch_assoc($post_comments_result);
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
                    <i class="like_btn material-icons">thumb_up</i>
                    <div class="like_count"><?php echo $post_like_row["likes"] ?></div>
                    <i class="material-icons">forum</i>
                    <div class="comment_count"><?php echo $post_comment_row["comments_count"] ?></div>
                </div>
            </div>
        </div>
        <?php
    }
?>