<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="test.css" rel="stylesheet">
</head>
<body>
    <form method="post" action="php_scripts/reset.php">
    <div class="reset_prompt">
        <h1>Enter your email to reset.</h1>

    <div class="userInfo" style="margin-top: 19px;">
    <label for="email" style="margin-right: 275px"></label>
    <input required type="email" id="email" name="email" placeholder="Enter your email">

    </div>
     <button class="submit_button" name="reset_submit">submit</button>


<?php
//error checking by checking url for error codes made by program.
if (isset($_GET["error"])) {
    if ($_GET["error"] === "nouser") {
        echo "<div class='error_message'>
        <p>No account associated with this email. </p>
        </div>";
    }
}
?>
</body>
</html>