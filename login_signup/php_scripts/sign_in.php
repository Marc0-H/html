<?php

include '../../../connection.php';
include 'functions.php';

function loginUser($connection, $name, $password) {
    $user = userExists($connection, $name, $name);
    if ($user === FALSE) {
        header("location: ../login_page.php?error=wrongcombination");
        exit();
    }

    $hashedPW = $user["userPwd"];

    $checkPW = password_verify($password, $hashedPW);
    if ($checkPW === FALSE) {
        header("location: ../login_page.php?error=wrongcombination");
    }
    else if ($checkPW === TRUE) {
        session_start();
        $_SESSION["userId"] = $user["userId"];
        $_SESSION["userUid"] = $user["userUid"];
        $_SESSION["userPfp"] = $user["profile_image"];
        $_SESSION["darkmode"] = "lightmodeSession";

        header("location: ../../index.php");
        exit();
    }
    else {
        header("location: ../login_page.php?error=unknownerror");
        exit();
    }
}

if (isset($_POST["submit"])) {
    $name = mysqli_real_escape_string($connection, htmlspecialchars($_POST["username"]));
    $password = mysqli_real_escape_string($connection, htmlspecialchars($_POST["password"]));
    loginUser($connection, $name, $password);
}
?>