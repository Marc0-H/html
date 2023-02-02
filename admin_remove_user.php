<?php
include '../connection.php';
session_start();
if (isset($_SESSION["userId"])) {
  if($_SESSION["userId"] != 1){
    exit;
  }
}
// define variables and set to empty values
$remove_user =  "";

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $remove_user = test_input($_POST["remove_user"]);
}

try {
  $remove_user_query = "DELETE FROM users WHERE userUid = '$remove_user'";
  mysqli_query($connection, $remove_user_query);

  echo "<script>window.alert('tag removal succes!');";
  echo "window.location.href='adminpage.php';";
  echo "</script>";

} catch (PDOException $e) {
  echo "ERROR!!!<br>";
  echo $remove_user_query . "<br>" . $e->getMessage();
}

?>
