<?php

include '../../../connection.php';
require_once 'functions.php';

echo var_dump($_POST);
$name = mysqli_real_escape_string($connection, htmlspecialchars($_POST["username"]));
$password = mysqli_real_escape_string($connection, htmlspecialchars($_POST["uPassword"]));
$email = mysqli_real_escape_string($connection, htmlspecialchars($_POST["email"]));
$tag = mysqli_real_escape_string($connection, htmlspecialchars($_POST["select"]));

function check_tag($user_tag) {
  if (in_array($user_tag, array('MBO','HAVO','VWO','teacher','HBO/WO'))) {
  return TRUE;
  }
  return FALSE;
}


if (!in_array($user_tag, array('MBO','HAVO','VWO','teacher','HBO/WO'))) {
    echo check_tag($tag) . "true of false and tag = " . $tag;
    // header("location: ../signup_page.php?error=invalidusertag");
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

?>