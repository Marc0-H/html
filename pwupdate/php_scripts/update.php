<?php
if ($_SERVER['HTTPS'] != 'on') {
    $url = "https://". $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    header("location: $url");
    exit;
}

include '../../../connection.php';
include_once 'functions.php';

$URLtoken = $_POST["URLtoken"];
$selector = $_POST["selector"];
$password = $_POST["uPassword"];

if (empty($URLtoken) || empty($selector) || empty($password)) {
    header("location: ../../index.php?error=" . "$URLtoken" . "&" . "$selector" . "&" . "$password");
    exit();
}
else {
    if (ctype_xdigit($URLtoken) && ctype_xdigit($selector) === TRUE) {
        $current_time = time();
        $stmt = mysqli_prepare($connection, "SELECT pwdToken, userId FROM `reset` WHERE pwdSelector = ? AND expirationDate >= $current_time");
        if($stmt === FALSE) {
           header("location: ../update_page?error=stmtfailed");
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", $selector);
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) > 0 ) {
                $DBaccess = mysqli_fetch_assoc($result);
                $DBtoken = $DBaccess['pwdToken'];
                $userId = $DBaccess['userId'];
                $compare_token = hex2bin($URLtoken);
            }
            else {
                header("location: ../update_page.php?error=novalidtoken");
                exit();
            }

            if (password_verify($compare_token, $DBtoken) === TRUE) {
                try {
                    update_pw($connection, $password, $userId);
                    header("location: ../update_page.php?error=noerror");
                }catch (Exception $e) {
                    header("location: ../update_page.php?error=updatefailed");
                }
            }
            else {
                header("location: ../update_page.php?error=token_missmatch");
            }
        }
    }
    else {
        header("location: ../update_page.php?error=token_missmatch");
    }
}
?>