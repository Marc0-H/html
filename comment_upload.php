<?php
    include '../connection.php';
    session_start();
    date_default_timezone_set('Europe/Amsterdam');

    $comment_datetime = date('Y-d-m H:i', time());
    $comment_content = $post_id = $parent_comment_id = "";

    /* Prevents cross site scripting and sql injecting by
    Testing if input is valid data and removing any special characters */
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if (!isset($_SESSION["userId"])) {
        header("Location: login_signup/login_page.php");
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $comment_content = test_input($_POST["comment_content"]);
        $post_id = test_input($_POST["post_id"]);
        $parent_comment_id = test_input($_POST["parent_comment_id"]);
        $user_id = $_SESSION["userId"];

        if ($parent_comment_id == "") {
            $insert_comment_query = "INSERT INTO comments (post_id, comment_content, comment_datetime, user_id)
            VALUES ('$post_id', '$comment_content', '$comment_datetime', '$user_id')";
        } else if ($post_id == "") {
            $insert_comment_query = "INSERT INTO comments (comment_content, comment_datetime, user_id, parent_comment_id)
            VALUES ('$comment_content', '$comment_datetime', '$user_id', '$parent_comment_id')";
        }
    }

    try {
        $post_id = $_GET['v'];
        mysqli_query($connection, $insert_comment_query);
        header("Location: thread.php?v=$post_id");
    } catch (PDOExeption $e) {
        echo "ERROR!!!<br>";
        echo $insert_comment_query . "<br>" . $e->getMessage();
    }
?>