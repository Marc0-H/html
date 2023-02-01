<?php

//find the id associated with the email in the database.
function findUid($connection, $email) {
    $current_url = $_SERVER['REQUEST_URI'];

    $sql = "SELECT userId FROM users WHERE userEmail = ?;";
    $stmt = mysqli_stmt_init($connection);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../reset_page?error=stmtfailed");
        return NULL;
    }

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    if(!mysqli_stmt_bind_result($stmt, $userId)){
        header("location: ../reset_page?error=bindfailed");
        return NULL;
    }
    if(!mysqli_stmt_fetch($stmt)) {
        header("location: ../reset_page?error=fetchfailed");
        return NULL;
    }
    mysqli_stmt_close($stmt);

    if ($userId === NULL) return NULL;
    else return $userId;
}
//return true if there is a user with a given name or email. Either can be
//checked.
function userExists($connection, $name, $email) {
    //using prepared statement as extra precaution to prevent sql injection
    //used this site as reference to using prepared statement: https://www.w3schools.com/php/php_mysql_prepared_statements.asp#:~:text=A%20prepared%20statement%20is%20a,(labeled%20%22%3F%22).

    $sql = "SELECT * FROM users WHERE userUid = ? OR userEmail = ?;";
    $stmt = mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../reset_page.php?error=stmtfailed");
        return NULL; 
    }

    mysqli_stmt_bind_param($stmt, "ss", $name, $email);
    mysqli_stmt_execute($stmt);

    $returnData = mysqli_stmt_get_result($stmt);

    if ($result = mysqli_fetch_assoc($returnData)) {
        return $result;
    }
    else {
        return FALSE;
    }

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