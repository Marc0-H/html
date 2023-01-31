<?php
if ($_SERVER['HTTPS'] != 'on') {
    $url = "https://". $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    header("location: $url");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link href="test.css" rel="stylesheet">
</head>

<body>
    <div class="login_prompt">
        <h1>Login</h1>
        <form method="post" action="php_scripts/sign_in.php">
            <div class="userInfo">
                <label for="username" style="margin-left: -80px;">Username</label>
                <input required type="text" id="username" name="username">
            </div>
            <div class="userInfo">
                <label for="password" style="margin-left: -80px;">Password</label>
                <input required type="password" id="password" name="password">
            </div>
            <button class="submit_button" name="submit">submit</button>

            <div class="external">
                <div class="pass-reset"> Forgot your password? <a href="../reset/reset_page.php">Reset here</a></div>
                <div class="signup"> Need an account? <a href="signup_page.php">Sign-up here</a></div>
            </div>
            <?php
            if (isset($_GET["error"])) {
                if ($_GET["error"] === "wrongcombination") {
                    echo "<div class='login_error_message'>
                    <p> Incorrect username/password. Try again. </p>
                    </div>";
                }
                else if ($_GET["error"] === "unkownerror") {
                    echo "<div class='login_error_message'>
                    <p> Verification error occured. Try again. </p>
                    </div>";
                }
            }
            ?>
            </div>
    </div>

    </form>

</body>

</html>