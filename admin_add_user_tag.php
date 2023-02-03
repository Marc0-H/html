
<?php
include '../connection.php';
session_start();
if (isset($_SESSION["userId"])) {
  if($_SESSION["userId"] != 1){
    exit;
  }
}
// define variables and set to empty values
$user_tag = "";

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $user_tag = strtolower(test_input($_POST["new_user_tag_name"]));
}

try {
  $insert_user_tag_query = "INSERT INTO user_tags (tag_name)
          VALUES ('$user_tag')";
  mysqli_query($connection, $insert_user_tag_query);

  echo "<script>window.alert('user-tag upload succes!');";
  echo "window.location.href='adminpage.php';";
  echo "</script>";

} catch (PDOException $e) {
  echo "ERROR!!!<br>";
  echo $insert_user_tag_query . "<br>" . $e->getMessage();
}

?>
