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
        $comment_id = test_input($_POST["comment_id"]);
        $post_id = test_input($_GET['v']);
        $user_id = $_SESSION["userId"];

        $mark_solution_query = "UPDATE posts SET solution_id = $comment_id WHERE post_id = $post_id AND user_id = $user_id";
    }

    try {
        mysqli_query($connection, $mark_solution_query);
        header("Location: thread.php?v=$post_id");
    } catch (PDOExeption $e) {
        echo "ERROR!!!<br>";
        echo $like_query . "<br>" . $e->getMessage();
    }
?>