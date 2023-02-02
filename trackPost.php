<?php
include '../connection.php';

function canPost($id) {
    $query = "SELECT lastPosted FROM users WHERE id = $id";
    $latestPost = mysqli_query($connection, $query);
    $current_time = time();

    if ($current_time - $latestPost < 180) {
        return FALSE;
    }
    else return TRUE;
}
?>