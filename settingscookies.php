<?php
session_start();
require '../connection.php';

$data = file_get_contents('php://input');

switch ($data) {
    case 'darkmodeSession':
        $_SESSION["darkmode"] = "true";
        break;

    case 'lightmodeSession':
        $_SESSION["darkmode"] = "false";
        break;
}

// $color_mode = isset($_POST['new-password']) ? mysqli_real_escape_string($connection, htmlspecialchars(trim($_POST['new-password']))) : null;
?>