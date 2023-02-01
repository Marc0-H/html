<?php
    include '../connection.php';
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
        $comment_id = test_input($_POST["comment_id"]);
        $post_id = test_input($_POST["post_id"]);
        $user_id = $_SESSION["userId"];

        if ($post_id != "") {
            $like_check_query = "SELECT COUNT(user_id) FROM post_upvote_link WHERE user_id = $user_id AND post_id = $post_id";
            $like_check = mysqli_fetch_assoc(mysqli_query($connection, $like_check_query));

            if ($like_check["COUNT(user_id)"] > 0) {
                $like_query = "DELETE FROM post_upvote_link WHERE user_id = $user_id AND post_id = $post_id";
            } else {
                $like_query = "INSERT INTO post_upvote_link (user_id, post_id)
                VALUES ('$user_id', '$post_id')";
            }
        } else if ($comment_id != "") {
            $like_check_query = "SELECT COUNT(user_id) FROM comment_upvote_link WHERE user_id = $user_id AND comment_id = $comment_id";
            $like_check = mysqli_fetch_assoc(mysqli_query($connection, $like_check_query));

            if ($like_check["COUNT(user_id)"] > 0) {
                $like_query = "DELETE FROM comment_upvote_link WHERE user_id = $user_id AND comment_id = $comment_id";
            } else {
                $like_query = "INSERT INTO comment_upvote_link (user_id, comment_id)
                VALUES ('$user_id', '$comment_id')";
            }
        }
    }

    try {
        $post_id = $_GET['v'];
        mysqli_query($connection, $like_query);
        header("Location: thread.php?v=$post_id");

    } catch (PDOExeption $e) {
        echo "ERROR!!!<br>";
        echo $like_query . "<br>" . $e->getMessage();
    }
?>