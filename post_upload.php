<?php
include 'connection.php';
require_once("vendor/autoload.php");
include "config.php";

\Tinify\setKey(API_KEY); // robbysapikey
session_start();
// define variables and set to empty values
$post_title = $post_content = $post_tag = $post_image = "";
$error_msg = "unknown error";
date_default_timezone_set('Europe/Amsterdam');
$post_datetime = date('Y-d-m H:i', time());

// $file = $_FILES["new_post_image"];
$filename = $_FILES["new_post_image"]["name"];
$temp_file = $_FILES["new_post_image"]["tmp_name"];
$upload_ok = 0;
$image_file_type = strtolower(pathinfo($filename,PATHINFO_EXTENSION));

/* Prevents cross site scripting and sql injecting by 
   Testing if input is valid data and removing any special characters */
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $post_title = test_input($_POST["post_title"]);
  $post_content = test_input($_POST["post_content"]);
  $post_tag = test_input($_POST["post_tag"]);
    
  if($filename != NULL) {
    $check = getimagesize($_FILES["new_post_image"]["tmp_name"]);
    if($check !== false) {
      $upload_ok = 1;
    } else {
      $upload_ok = 0;
    }
    if ($_FILES["new_post_image"]["size"] > 5000000) {
      $error_msg = "file size incorrect, please select a smaller file";
      $upload_ok = 0;
    } 
    if($image_file_type != "png") {
      $error_msg = "file type incorrect, please use png";
      $upload_ok = 0;
    }
  }   
}


// upload is ok
if($upload_ok == 1) {
  $source = \Tinify\fromFile($temp_file);   //send to tinipng API
  $source->toFile($temp_file);
  $img = file_get_contents($temp_file);
  $post_image = base64_encode($img);
}

if (($upload_ok == 0 && $image_file_type != "png" )|| !$post_title || !$post_content || !$post_tag) {
  
  echo $error_msg . "<br><a href='newthread.php'>try again.</a><br>";
  die("Post upload failed.");
}




try {
  //userID from users
  $user_id = $_SESSION["userId"];
  $insert_post_query = "INSERT INTO posts (post_title, post_content, post_tag, post_datetime, post_image, user_id) 
          VALUES ('$post_title', '$post_content', '$post_tag', '$post_datetime', '$post_image', '$user_id')";
  mysqli_query($connection, $insert_post_query);
  // $post_id = mysqli_insert_id($connection);   

  echo "<script>window.alert('Post upload succes!');";
  echo "window.location.href='index.php';";
  echo "</script>";
  // header('location: newthread.html'); 
  
} catch (PDOExeption $e) {
  echo "ERROR!!!<br>";
  echo $insert_post_query . "<br>" . $e->getMessage();
}

?>




<!-- <html>   // testing
<body>

Welcome tipoeperstle:<?php echo $_POST["post_title"]; ?><br>
Post content: <?php echo $_POST["post_content"]; ?><br>
Post image: <?php echo $post_image; ?><br>
tag: <?php echo $_POST["post_tag"]; ?>

</body>
</html> -->

<?php 
$post_db = "Eduzone"
?>