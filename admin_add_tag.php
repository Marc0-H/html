<?php
include '../connection.php';
session_start();
if (isset($_SESSION["userId"])) {
  if($_SESSION["userId"] != 1){
    exit;
  }
}
// define variables and set to empty values
$post_tag = $tag_color = "";

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $post_tag = strtolower(test_input($_POST["new_tag_name"]));
  $tag_color = $_POST["tag_color_picker"];
}

try {
  $insert_tag_query = "INSERT INTO post_tags (post_tag, tag_color)
          VALUES ('$post_tag', '$tag_color' )";
  mysqli_query($connection, $insert_tag_query);

  echo "<script>window.alert('tag upload succes!');";
  echo "window.location.href='adminpage.php';";
  echo "</script>";

} catch (PDOException $e) {
  echo "ERROR!!!<br>";
  echo $insert_tag_query . "<br>" . $e->getMessage();
}

?>
