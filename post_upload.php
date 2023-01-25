<?php
include 'connection.php';
// define variables and set to empty values
$post_title = $post_content = $post_tag = $post_image = "";
date_default_timezone_set('Europe/Amsterdam');
$post_date = date('m/d/Y h:i:s a', time());

// $file = $_FILES["new_post_image"];
$filename = $_FILES["new_post_image"]["name"];
$temp_file = $_FILES["new_post_image"]["tmp_name"];
$upload_ok = 0;
$image_file_type = strtolower(pathinfo($filename,PATHINFO_EXTENSION));

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $post_title = test_input($_POST["post_title"]);
  $post_content = test_input($_POST["post_content"]);
  $post_tag = test_input($_POST["post_tag"]);
  
  
  // stel filenaam is null, dan moet het gewoon uploaden. ez 
  // stel filenaam is niet null, maar file ttpe is niet png dan
  // moet het een verkeerde image tytpe zijn
  
  if($filename != NULL) {
    $check = getimagesize($_FILES["new_post_image"]["tmp_name"]);
    if($check !== false) {
      $upload_ok = 1;
    } else {
      $upload_ok = 0;
    }
    if ($_FILES["new_post_image"]["size"] > 500000) {
      $upload_ok = 0;
    } 
    if($image_file_type != "png") {
      $upload_ok = 0;
    }
  } else {
    echo "HELLO!!!";
  }
  
}


// upload is ok
if($upload_ok == 1) {
  $img = file_get_contents($temp_file);
  $post_image = base64_encode($img);
}

if ($image_file_type != "png" || !$post_title || !$post_content || !$post_tag) {
  echo "Incorrect format, please <a href='newthread.html'>try again.</a><br>";
  die("Post upload failed.");
}

/* Prevents cross site scripting and sql injecting by 
   Testing if input is valid data and removing any special characters */
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}



try {
  $insert_post = "INSERT INTO posts (post_title, post_content, post_tag, post_image)
          VALUES ('$post_title', '$post_content', '$post_tag', '$post_image')";

  mysqli_query($connection, $insert_post);
  echo "<script>window.alert('Post upload succes!');";
  echo "window.location.href='newthread.html';";
  echo "</script>";
  // header('location: newthread.html'); 
  
} catch (PDOExeption $e) {
  echo "ERROR!!!<br>";
  echo $insert_post . "<br>" . $e->getMessage();
}

?>




<html>
<body>

Welcome tipoeperstle:<?php echo $_POST["post_title"]; ?><br>
Post content: <?php echo $_POST["post_content"]; ?><br>
Post image: <?php echo $post_image; ?><br>
tag: <?php echo $_POST["post_tag"]; ?>

</body>
</html>

<?php 
$post_db = "Eduzone"

?>