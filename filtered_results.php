<?php
    include '../connection.php';
    // $search = $_GET["search"];

    $query;
    $subjects_query = "";
    $role_query = "";

    if (isset($_GET['filter-subject']) && !empty($_GET['filter-subject'])) {
        $subjects = array();


        foreach($_GET["filter-subject"] as $filter) {
            $subjects[] = $filter;
        }
    

        $subjects_query = "WHERE post_tag IN ('".implode("','", $subjects)."')";

    } else {
        $subjects_query = "WHERE 2 = 1";
    }

    if (isset($_GET["filter-role"])) {
        ?>
            <script>console.log("WOWOFOWOFJ");</script>

        <?php
        $roles = array();
        foreach($_GET["filter-role"] as $filter) {

            if (strpos($filter, "MAVO") !== false) {
                $roles[] = "MAVO";
            }
            if (strpos($filter, "HAVO") !== false) {
                $roles[] = "HAVO";
            }
            if (strpos($filter, "VWO") !== false) {
                $roles[] = "VWO";
            }
            if (strpos($filter, "HBO/WO") !== false) {
                $roles[] = "HBO/WO";
            }
            if (strpos($filter, "teacher") !== false) {
                $roles[] = "Teacher";
            }
        }


        $role_query = "AND tag IN ('".implode("','", $roles)."')";

    } else {
        $role_query = "AND 2 = 1";
    }


    if (isset($_GET["filter-sortby"])) {
        $sortby = $_GET["filter-sortby"];
        if (!empty($sortby)) {
            if ($sortby == "latest") {
                $query = "SELECT * FROM posts JOIN users ON posts.user_id = users.userId " . $subjects_query . " " . $role_query . " ORDER BY post_id DESC";
            } else if ($sortby == "populairity") {
                $query = "SELECT posts.*,COUNT(post_upvote_link.post_id) AS likes FROM posts LEFT JOIN post_upvote_link ON posts.post_id = post_upvote_link.post_id JOIN users ON posts.user_id = users.userId " . $subjects_query . " " . $role_query . " GROUP BY posts.post_id ORDER BY likes DESC";
            } else if ($sortby == "controversial") {
                $query = "SELECT posts.*, COUNT(comments.post_id) AS comments_count FROM posts LEFT JOIN comments ON posts.post_id = comments.post_id JOIN users ON posts.user_id = users.userId " . $subjects_query . " " . $role_query . " GROUP BY posts.post_id ORDER BY comments_count DESC";
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
?>