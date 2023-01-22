<?php
include 'connection.php';
// define variables and set to empty values
$post_title = $post_content = $post_tag = $post_id  = $post_image = "";
date_default_timezone_set('Europe/Amsterdam');
$post_date = date('m/d/Y h:i:s a', time());
echo $post_date;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $post_title = test_input($_POST["post_title"]);
  $post_content = test_input($_POST["post_content"]);
  $post_tag = test_input($_POST["post_tag"]);
  // $post_id = test_input($_POST["post_id"]);
  // $post_image = test_input($_POST["post_image"]);
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
  echo '<script>window.alert("Post uploade succes!")</script';
  header('location: newthread.html');
  
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