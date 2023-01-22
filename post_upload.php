<?php
include 'connection.php';
// define variables and set to empty values
$post_title = $post_content = $post_tag = $post_id  = $post_image = "";
$post_date = date("Y/d/m");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $post_title = test_input($_POST["post_title"]);
  $post_content = test_input($_POST["post_content"]);
  $post_tag = test_input($_POST["post_tag"]);
  // $post_id = test_input($_POST["post_id"]);
  // $post_image = test_input($_POST["post_image"]);
}

if (!$post_title || !$post_content ||$post_tag) {
  die("Incorrect format.");
}

/* Prevents cross site scripting and sql injectini by 
   Testing if input is valid data and removing any special characters */
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return mysqli_real_escape_string($connection, $data);
}



try {
  $insert_post = "INSERT INTO posts (id, post_title, post_content, post_image, post_datetime, user_id, solution_id
          VALUES ('0', '$post_title', '$post_content', '0', '$post_date', '0', '0')";

  mysqli_query($connection, $insert_post);
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