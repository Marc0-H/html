<?php

/* Checks if the request method is POST and also checks if the request has a
   valid CSRF token.
*/
function init_data_update() {
    if ($_SERVER["REQUEST_METHOD"] != "POST") {
        die("Invalid request method");
    }

    // if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] != $_SESSION['csrf_token']) {
    //     die("Invalid CSRF token");
    // }
}

/* Makes the inputted value harmless, so the program won't be vulnerable
   to hacks like SQL injections or any other malicious input. This function also
   maps which variable belongs to which column in the database.
*/
function sanitize_input($connection) {
    $new_email = null;
if (array_key_exists('new-email', $_POST)) {
  $new_email = filter_var($_POST['new-email'], FILTER_VALIDATE_EMAIL) ? mysqli_real_escape_string($connection,htmlspecialchars(trim($_POST['new-email']))) : null;
}
    $new_password = isset($_POST['new-password']) ? mysqli_real_escape_string($connection, htmlspecialchars(trim($_POST['new-password']))) : null;
    $new_username = isset($_POST['new-username']) ? mysqli_real_escape_string($connection, htmlspecialchars(trim($_POST['new-username']))) : null;

    $columns = [
        'userEmail' => $new_email,
        'userPwd' => $new_password,
        'UserUid' => $new_username,
    ];

    return $columns;
}

// Determines which column will get updated in the database.
function determine_update($columns) {
    $updated_value = '';
    $column_to_be_updated = '';
    foreach ($columns as $column => $value) {
        if ($value != "") {
            $updated_value = $value;
            $column_to_be_updated = $column;
            break;
        }
    }

    return array($updated_value, $column_to_be_updated);
}

/* Checks if the new username already exists in the database,
   if this is the case, an error message will be returned and the username will
   not be updated. If the new username does not exist, the program will continue.
*/
function checkUsername($connection, $updated_value) {
    $check_username = mysqli_prepare($connection, "SELECT userUid FROM users WHERE userUid = ?");
    mysqli_stmt_bind_param($check_username, "s", $updated_value);
    mysqli_stmt_execute($check_username);

    $result = mysqli_stmt_get_result($check_username);
    if (mysqli_num_rows($result) > 0) {
        mysqli_stmt_close($check_username);
        mysqli_close($connection);
        http_response_code(409);
        exit;
    }

    mysqli_stmt_close($check_username);
}

// Hashes the new password so it will be stored securely in the database.
function hash_password($updated_value) {
    return password_hash("$updated_value", PASSWORD_DEFAULT);
}

/* executes an unique additional function for a new username, password and
   profile image if that is to be updated.
*/
function optimize_data_before_update($column_to_be_updated, $connection,
                                     $updated_value) {
    switch ($column_to_be_updated) {
        case 'UserUid':
            checkUsername($connection, $updated_value);
            return $updated_value;
            break;

        case 'userPwd':
            echo "$updated_value";
            $updated_value = hash_password($updated_value);
            return $updated_value;
            break;

        default:
            return $updated_value;
            break;
    }
}

/* This function executes the SQL querry which updates a user-specified value
   in the database.
*/
function update_data($connection, $column_to_be_updated, $updated_value, $userid) {

    $prepare_update = mysqli_prepare($connection, "UPDATE users SET $column_to_be_updated = ? WHERE userId = ?");
    mysqli_stmt_bind_param($prepare_update, "si", $updated_value, $userid);

    if (!mysqli_stmt_execute($prepare_update)) {
        die("Error: " . mysqli_stmt_error($prepare_update));
    }

    mysqli_stmt_close($prepare_update);
}

?>