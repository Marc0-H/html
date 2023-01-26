<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include 'connection';
require_once 'functions.php';
$email = mysqli_real_escape_string($connection, htmlspecialchars($_POST["email"]));

if (isset($_POST["reset_submit"])) {

    $email = $_POST["email"];
    if (userExists($connection, $email, $email) === NULL) {
        header("location: https://webtech-in07.webtech-uva.nl/~georgia/login_page.php?error=nouser");
    }
    else {
    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);

    $url = "https://webtech-in07.webtech-uva.nl/~georgia/reset_prompt_page.php?selector=" . $selector ."&validator=" . bin2hex($token);

    $expiration->date_modify("+15 minutes");

    $sql = "DELETE FROM reset WHERE resetEmail = ?";
    $stmt = mysqli_stmt_init($connection);
    if ($stmt === NULL) {
        header("location: https://webtech-in07.webtech-uva.nl/~georgia/login_page.php?error=stmtfailed");
    }
    else {
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
    }

    $sql = "INSERT INTO reset(resetEmail, pwdSelector, pwdToken, expirationDate) VALUES ? ? ? ?";
    $stmt = mysqli_stmt_init($connection);

    if ($stmt === NULL) {
        header("location: https://webtech-in07.webtech-uva.nl/~georgia/login_page.php?error=stmtfailed");
    }
    else {
        $hashedToken = password_hash($token, PASSWORD_DEFAULT);

        mysqli_stmt_bind_param($stmt, "ssss", $email, $selector, $hashedToken, $expiration);
        mysqli_stmt_execute($stmt);
    }
    mysqli_stmt_close($stmt);
    mysqli_close();

    
}
}
else {
    header("location: https://webtech-in07.webtech-uva.nl/~georgia/login_page.php");
}

?>