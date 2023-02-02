<?php
include '../connection.php';
session_start();
if (isset($_SESSION["userId"])) {
  if($_SESSION["userId"] != 1){
    exit;
  }
}
// define variables and set to empty values
$remove_user_tag =  "";

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $remove_user_tag = test_input($_POST["remove_user_tag"]);
}

try {
  $remove_user_tag_query = "DELETE FROM user_tags WHERE tag_name = '$remove_user_tag'";
  mysqli_query($connection, $remove_user_tag_query);

  echo "<script>window.alert('user-tag removal succes!');";
  echo "window.location.href='adminpage.php';";
  echo "</script>";

} catch (PDOException $e) {
  echo "ERROR!!!<br>";
  echo $remove_user_tag_query . "<br>" . $e->getMessage();
}

?>
