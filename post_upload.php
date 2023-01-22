<?php
// define variables and set to empty values
$post_title = $post_content = $post_tag = "";
// $post_id  = $post_image =

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

/* Test if input is valid data, remove any special characters */
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
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