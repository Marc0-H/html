<?php

include '../../../connection.php';
require_once 'functions.php';

if (isset($_POST['submit'])) {

    $secretKey = "6LdHu0ckAAAAAOaOQUXDPIJV2_jaNc7BnMyrTpSV";
    $responseKey = $_POST['g-recaptcha-response'];
    $remoteAddr = $_SERVER['REMOTE_ADDR'];

    $URL = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$remoteAddr";

    $response = file_get_contents($URL);
    $parsedRes = json_decode($response);

    if ($parsedRes->success) {
        $name = mysqli_real_escape_string($connection, htmlspecialchars($_POST["username"]));
        $password = mysqli_real_escape_string($connection, htmlspecialchars($_POST["uPassword"]));
        $email = mysqli_real_escape_string($connection, htmlspecialchars($_POST["email"]));
        $tag = mysqli_real_escape_string($connection, htmlspecialchars($_POST["select"]));
    }
    else {
        header("location: ../signup_page.php?error=recaptchafailed");
        exit();
    }

if (!in_array($tag, array('MAVO','HAVO','VWO','teacher','HBO/WO'))) {
    header("location: ../signup_page.php?error=invalidusertag");
    exit();
}
if (checkUid($name) === FALSE) {
    header("location: ../signup_page.php?error=invalidusername");
    exit();
}
if (checkEmail($email) === FALSE) {
    header("location: ../signup_page.php?error=invalidemail");
    exit();
}
if (checkPW($password) === FALSE) {
    header("location: ../signup_page.php?error=pwshort");
    exit();
}

if (userExists($connection, $name, $email) === FALSE) {
    try {
        $sql = "INSERT INTO users (userEmail, userUid, userPwd, tag) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($connection);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../signup_page.php?error=stmtfailed");
            exit();
        }
        else {
            $hashed_pw = password_hash($password, PASSWORD_DEFAULT);
            mysqli_stmt_bind_param($stmt, "ssss", $email, $name, $hashed_pw, $tag);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            header("location: ../../index.php");
        }
    }catch(PDOexception $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
}
// if there was an error in the function exit the script.
else if (userExists($connection, $name, $email) === NULL) {
    exit();
}
else {
    header("location: ../signup_page.php?error=userexists");
}
}
?>