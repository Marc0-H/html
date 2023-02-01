<?php

function checkUid($name) {
    if (!preg_match("/^[a-zA-Z0-9 ]*$/", $name)) {
        return FALSE;
    }
    else if (strlen($name) <= 2) {
        return FALSE;
    }
    else {
        return TRUE;
    }
}
function checkEmail($email) {
    if (!preg_match("/^[a-zA-Z@0-9.]*$/", $email)) {
        return FALSE;
    }
    else return TRUE;

}

function checkPW($password) {
    if (strlen($password) < 6) {
        header("location: ../signup_page?error=pwshort");
        exit();
    }
}
function userExists($connection, $name, $email) {
    //using prepared statement as extra precaution to prevent sql injection
    //used this site as reference to using prepared statement: https://www.w3schools.com/php/php_mysql_prepared_statements.asp#:~:text=A%20prepared%20statement%20is%20a,(labeled%20%22%3F%22).

    $sql = "SELECT * FROM users WHERE userUid = ? OR userEmail = ?;";
    $stmt = mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location:  ../signup_page.php?error=stmtfailed");
        return NULL;
    }

    mysqli_stmt_bind_param($stmt, "ss", $name, $email);
    mysqli_stmt_execute($stmt);

    $returnData = mysqli_stmt_get_result($stmt);

    //check if the fetch returns any data. If so return it otherwise return false.
    if ($result = mysqli_fetch_assoc($returnData)) {
        return $result;
    }
    else {
        return FALSE;
    }
    mysqli_stmt_close($stmt);
}

//Remco's 'update_data' function used as base here
function update_pw($connection, $new_pass, $userid) {
    $hashed_pass = password_hash($new_pass, PASSWORD_DEFAULT);

    $prepare_update = mysqli_prepare($connection, "UPDATE users SET userPwd = ? WHERE userId = ?");
    mysqli_stmt_bind_param($prepare_update, "si", $hashed_pass, $userid);

    if (!mysqli_stmt_execute($prepare_update)) {
        die("Error: " . mysqli_stmt_error($prepare_update));
    }

    mysqli_stmt_close($prepare_update);
}

?>