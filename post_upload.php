<?php
include '../connection.php';
require_once("vendor/autoload.php");
include "config.php";

\Tinify\setKey(API_KEY); // robbysapikey
session_start();

// define variables and set to empty values
$post_title = $post_content = $post_tag = $post_image = "";
$error_msg = "unknown error";
date_default_timezone_set('Europe/Amsterdam');
$post_datetime = date('Y-d-m H:i', time());

$filename = $_FILES["new_post_image"]["name"];
$temp_file = $_FILES["new_post_image"]["tmp_name"];
/* Prevents cross site scripting and sql injecting by
   Testing if input is valid data and removing any special characters */
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


// returns 1 if the file is of correct size and is a png
// returns -1 if there is no file selected
// return 0 otherwise
function check_file($filename) {
  GLOBAL $error_msg;
  $image_file_type = strtolower(pathinfo($filename,PATHINFO_EXTENSION));
  $file_ok = 0;
  if($filename == NULL) {
    return -1;
  } else {
    $check = getimagesize($_FILES["new_post_image"]["tmp_name"]);
    if($check !== false) {
      $file_ok = 1;
    } else {
      $file_ok = 0;
    }
    if ($_FILES["new_post_image"]["size"] > 5000000) {
      $error_msg = "file size incorrect, please select a smaller file";
      $file_ok = 0;
    }
    if($image_file_type != "png" && $image_file_type != "jpg") {
      $error_msg = "file type incorrect, please use png or jpg";
      $file_ok = 0;
    }
  }
  return $file_ok;
}

function canPost($id, $connection) {
    $query = "SELECT latestPost FROM users WHERE userId = $id";
    $result = mysqli_query($connection, $query);
    if (!$result) {
      die("failed to fetch");
    }
    $row = mysqli_fetch_assoc($result);

    $latestPost = $row['latestPost'];

    $current_time = time();

    if ($current_time - $latestPost < 60) {
        return FALSE;
    }
    else return TRUE;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $post_title = test_input($_POST["post_title"]);
  $post_content = test_input($_POST["post_content"]);
  $post_tag = test_input($_POST["post_tag"]);
  // $post_tag = check_tag($post_tag);

  if(check_file($filename) == 1) {
    if (\Tinify\compressionCount() <= 500) { //check if API has enough space
      $source = \Tinify\fromFile($temp_file);   //send to tinipng API
      $converted = $source->convert(array("type" => ["image/png"]));
      $extension = $converted->result()->extension();

      // $source->toFile($temp_file);
      $img = file_get_contents($temp_file);
      $post_image = base64_encode($img);
    } else {
      $img = file_get_contents($temp_file);
      $post_image = base64_encode($img);
    }
  }

  if (check_file($filename) == 0 || !$post_title || !$post_content || !$post_tag || $post_tag == -1) {
    echo $error_msg . "<br><a href='newthread.php'>try again.</a><br>";
    die("Post upload failed.");
  }
}

try {
  //userID from users
  $user_id = $_SESSION["userId"];
  if (!canPost($user_id, $connection)) {
    header("location: ../newthread.php?error=toomanyrequests");
    echo "<script>window.alert('You need to wait a bit before posting again.');
    </script>";
    exit();
  }
  else {
  $current_time = time();
  $update_user_query = "UPDATE users SET latestPost='$current_time' WHERE userId = $user_id";
  mysqli_query($connection, $update_user_query);

    $insert_post_query = "INSERT INTO posts (post_title, post_content, post_tag, post_datetime, post_image, user_id)
      VALUES ('$post_title', '$post_content', '$post_tag', '$post_datetime', '$post_image', '$user_id')";
    mysqli_query($connection, $insert_post_query);

    $post_id = mysqli_insert_id($connection);
    echo "<script>window.alert('Post upload succes!');";
    echo "window.location.href='thread.php?v=" . $post_id ."';";
    echo "</script>";
  }

} catch (PDOException $e) {
  echo "ERROR!!!<br>";
  echo $insert_post_query . "<br>" . $e->getMessage();
}

?>
