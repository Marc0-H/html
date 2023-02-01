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
    header("location: ../../index.php");
    exit();
}
else {
    if (ctype_xdigit($URLtoken) && ctype_xdigit($selector) === TRUE) {
        $current_time = time();
        $stmt = mysqli_prepare($connection, "SELECT pwdToken, userId FROM `reset` WHERE pwdselector = ? AND expirationDate <= $current_time");
        if($stmt === FALSE) {
           header("location: ../update_page?error=stmtfailed");
        }
        else {
            mysqli_stmt_bind_param($stmt, "si", $selector, $current_time);
            mysqli_stmt_execute($stmt);

            $DBaccess = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
            if (mysqli_num_rows($DBaccess) > 0 ) {
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