<?php

include '../../../connection.php';
require_once 'functions.php';

$email = mysqli_real_escape_string($connection, htmlspecialchars($_POST["email"]));

if (isset($_POST["reset_submit"])) {

    $email = $_POST["email"];

    if (userExists($connection, $email, $email) === FALSE) {
        header("location: ../reset_page.php?error=nouser");
        exit();
    }
    //if there was an error in the function, exit the script
    else if (userExists($connection, $email, $email) === NULL) {
        exit();
    }
    else {
        $selector = bin2hex(random_bytes(8));

        $token = random_bytes(32);

        //Create url for user to access update page. Selector used to find token in database to compare to token in URL.
        //Done to authenticate user identity through email.
        $url = "https://webtech-in07.webtech-uva.nl/pwupdate/update_page.php?selector=" . $selector ."&token=" . bin2hex($token);

        $expiration = date("U") + 900;

        //remove any tokens still saved, to avoid errors
        $sql = "DELETE FROM reset WHERE resetEmail = ?";
        $stmt = mysqli_stmt_init($connection);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../reset_page.php?error=stmtfailed");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
        }

        $userUid = findUid($connection, $email);
        if ($userUid === NULL) exit();

        $sql = "INSERT INTO reset(resetEmail, userId, pwdSelector, pwdToken, expirationDate) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($connection);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../reset_page.php?error=stmtfailed");
            exit();
        }
        else {
            $hashedToken = password_hash($token, PASSWORD_DEFAULT);

            mysqli_stmt_bind_param($stmt, "sssss", $email, $userUid, $selector, $hashedToken, $expiration);
            mysqli_stmt_execute($stmt);

            mysqli_stmt_close($stmt);
        }
    }
    $to = "$email";
    $title = "Password reset";
    $message = "<p> We've received a password reset request from your account at Eduzone.
    Please click the link below to reset. If you didn't attempt to reset, ignore this email";
    $message .= '<a href=" '. $url . ' "> '. $url . ' </a>';
    $header = "From: <eduzoneinfo565@gmail.com>\r\nContent-Type: text/html \r\nReply-To: <eduzone565@gmail.com\r\n";

    if (mail($to, $title, $message, $header) === TRUE) {
        header("location: ../reset_page.php?error=noerror");
    } else {
        header("location: ../reset_page.php?error=mailfail");
    }

}
else {
    header("location: ../../login_signup/login_page.php");
}
?>