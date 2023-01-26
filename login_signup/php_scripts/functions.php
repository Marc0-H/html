<?php

function checkUid($name) {
    if (!preg_match("/^[a-zA-Z0-9 ]*$/", $name)) {
        $result = FALSE;
        echo "returning FALSE";
        return $result;
    }
    else {
        $result = TRUE;
        echo "returning TRUE";
        return $result;
    }
}
function checkEmail($email) {
    if (!preg_match("/^[a-zA-Z@0-9.]*$/", $email)) {
        $result = FALSE;
        return $result;
    }
    else {
        $result = TRUE;
        return $result;
    }
}

function userExists($connection, $name, $email) {
    //using prepared statement as extra precaution to prevent sql injection
    //used this site as reference to using prepared statement: https://www.w3schools.com/php/php_mysql_prepared_statements.asp#:~:text=A%20prepared%20statement%20is%20a,(labeled%20%22%3F%22).

    $sql = "SELECT * FROM users WHERE userUid = ? OR userEmail = ?;";
    $stmt = mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location:  https://webtech-in07.webtech-uva.nl/~georgia/signup.html?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $name, $email);
    mysqli_stmt_execute($stmt);

    $returnData = mysqli_stmt_get_result($stmt);

    //check if the fetch returns any data. If so return it otherwise return false.
    if ($result = mysqli_fetch_assoc($returnData)) {
        return $result;
    }
    else {
        $result = false;
        return $result;
    }
    mysqli_stmt_close($stmt);
}

function addUser($connection, $name, $email, $password) {

    $sql = "SELECT * FROM users WHERE userUid = ? OR userEmail = ?;";
    $stmt = mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location:  https://webtech-in07.webtech-uva.nl/~georgia/signup.html?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $name, $email);
    mysqli_stmt_execute($stmt);

    $returnData = mysqli_stmt_get_result($stmt);


    if ($result = mysqli_fetch_assoc($returnData)) {
        return $result;
    }
    else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);

}
?>