<?php
    include 'connection.php';
    if (!$connection) {
        die("Connection to server failed. !");
    }

    session_start();
    
    $comment_id = $post_id = "";

    /* Prevents cross site scripting and sql injecting by 
    Testing if input is valid data and removing any special characters */
    function test_input($data) {
        $data = preg_replace('/\D/', '', $data);
        return $data;
    }

    if (!isset($_SESSION["userId"])) {
        header("Location: login_signup/login_page.php");
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $post_id = test_input($_POST["post_id"]);
        $user_id = $_SESSION["userId"];

        $post_user_query = "SELECT user_id FROM posts WHERE post_id = $post_id";
        $post_user = mysqli_fetch_assoc(mysqli_query($connection, $post_user_query));

        /*Check if post actually belongs to user*/
        if ($post_user['user_id'] == $user_id || $user_id == 1) {
            $get_comments_query = "SELECT id FROM comments WHERE post_id = $post_id";
            $get_comments = mysqli_query($connection, $get_comments_query);

            while ($comment_row = mysqli_fetch_assoc($get_comments)) {
                $comment_id = $comment_row['id'];
                $delete_subcomments_query = "DELETE FROM comments WHERE parent_comment_id = $comment_id";
                mysqli_query($connection, $delete_subcomments_query);
            }

            $delete_comments_query = "DELETE FROM comments WHERE post_id = $post_id";
            mysqli_query($connection, $delete_comments_query);

            $delete_post_query = "DELETE FROM posts WHERE post_id = $post_id";
            mysqli_query($connection, $delete_post_query);


            header("Location: index.php");
        }
    }
?>