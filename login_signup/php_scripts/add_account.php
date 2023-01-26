<?php
include 'connection.php';
require_once 'functions.php';

echo var_dump($_POST);
$name = mysqli_real_escape_string($connection, htmlspecialchars($_POST["username"]));
$password = mysqli_real_escape_string($connection, htmlspecialchars($_POST["uPassword"]));
$email = mysqli_real_escape_string($connection, htmlspecialchars($_POST["email"]));

if (checkUid($name) === FALSE) {
    header("location: https://webtech-in07.webtech-uva.nl/login_signup/signup_page.php?error=invalidusername");
    exit();
}
if (checkEmail($email) === FALSE) {
    header("location: https://webtech-in07.webtech-uva.nl/~georgia/signup_page.php?error=invalidemail");
    exit();
}
if (userExists($connection, $name, $email) === FALSE) {
    try {
        $hashed_pw = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (userEmail, userUid, userPwd) VALUES ('$email', '$name', '$hashed_pw')";
        mysqli_query($connection, $sql);
    } catch(PDOexception $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
}
else {
    header("location: https://webtech-in07.webtech-uva.nl/~georgia/signup_page.php?error=userexists");
}

?>