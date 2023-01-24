<?php
include 'connection.php';
// define variables and set to empty values
$post_title = $post_content = $post_tag = $post_image = "";
date_default_timezone_set('Europe/Amsterdam');
$post_date = date('m/d/Y h:i:s a', time());

$image_folder = "images/";
$image_file = $image_folder . basename($_FILES["new_post_image"]["name"]);
$upload_ok = 1;
$image_file_type = strtolower(pathinfo($image_file,PATHINFO_EXTENSION));

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $post_title = test_input($_POST["post_title"]);
  $post_content = test_input($_POST["post_content"]);
  $post_tag = test_input($_POST["post_tag"]);
  // $post_image = test_input($_POST["post_image"]);
  $check = getimagesize($_FILES["new_post_image"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $upload_ok = 1;
  } else {
  echo "File is not an image.";
    $upload_ok = 0;
  }
  if (file_exists($image_file)) {
    echo "Sorry, file already exists.";
    $upload_ok = 0;
  } 
  if ($_FILES["new_post_image"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $upload_ok = 0;
  } 
  if($image_file_type != "jpg" && $image_file_type != "png" && $image_file_type != "jpeg"
      && $image_file_type != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
  }
  if ($upload_ok == 0) {
      echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
      if (move_uploaded_file($_FILES["new_post_image"]["tmp_name"], $image_file)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["new_post_image"]["name"])). " has been uploaded.";
      } else {
        echo "Sorry, there was an error uploading your file.";
      }
    }
}

if (!$post_title || !$post_content || !$post_tag) {
  echo $post_title,'poep <br', $post_content, 'poep 2<br', $post_tag;
  die("Incorrect format.");
}

/* Prevents cross site scripting and sql injectini by 
   Testing if input is valid data and removing any special characters */
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}



try {
  $insert_post = "INSERT INTO posts (post_title, post_content, post_tag)
          VALUES ('$post_title', '$post_content', '$post_tag')";

  mysqli_query($connection, $insert_post);
  echo '<script>window.alert("Post upload succes!"); window.location.href="newthread.html";</script>';
  // header('location: newthread.html');
  
} catch (PDOExeption $e) {
  echo $insert_post . "<br>" . $e->getMessage();
}

?>




<html>
<body>

Welcome tipoeperstle:<?php echo $_POST["post_title"]; ?><br>
Post content: <?php echo $_POST["post_content"]; ?><br>
tag: <?php echo $_POST["post_tag"]; ?>

</body>
</html>

<?php 
$post_db = "Edu"

?>