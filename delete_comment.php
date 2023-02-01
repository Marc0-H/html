<?php
    include '../connection.php';
    if (!$connection) {
        die("Connection to server failed. !");
    }

    session_start();

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
        $comment_id = test_input($_POST["comment_id"]);
        $user_id = $_SESSION["userId"];

        $comment_user_query = "SELECT user_id FROM comments WHERE id = $comment_id";
        $comment_user = mysqli_fetch_assoc(mysqli_query($connection, $comment_user_query));

        /*Check if comment actually belongs to user or admin*/
        if ($comment_user['user_id'] == $user_id || $user_id == 1) {
            $get_comment_query = "SELECT post_id FROM comments WHERE id = $comment_id";
            $get_comment = mysqli_fetch_assoc(mysqli_query($connection, $get_comment_query));

            if ($get_comment['post_id'] == NULL) {
                $delete_subcomment_query = "DELETE FROM comments WHERE id = $comment_id";
                mysqli_query($connection, $delete_subcomment_query);
            } else {
                $replace_comment_text = "UPDATE comments SET comment_content = '[Comment deleted]', user_id = 2 WHERE id = $comment_id";
                mysqli_query($connection, $replace_comment_text);
            }

            $post_id = $_GET['v'];

            header("Location: thread.php?v=$post_id");
        }
    }
?>