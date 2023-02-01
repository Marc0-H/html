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
    <title>update_password</title>
    <link href="../loginStyle.css" type="text/css" rel="stylesheet">
</head>
<body>
<?php
    $token = NULL;
    $selector = NULL;

    if (isset($_GET['selector']) && isset($_GET['token'])) {
        $token = $_GET['token'];
        $selector = $_GET['selector'];
    }
?>
    <div class="update_prompt">
    <h1> Enter your new password </h1>

    <form method="post" action="php_scripts/update.php">

    <div class="userInfo">
    <label for="uPassword">Password</label>
    <input required type="Password" id="uPassword" name="uPassword" placeholder="Enter a password" style="font-size:20px">
    </div>

    <div class="userInfo">
        <label for="uMatch">Re-enter</label>
        <input required type="password" id="uMatch" name="uMatch" placeholder="Re-enter your password" style="font-size:20px" autocomplete="off">
    </div>

     <button class="submit_button" name="reset_submit">submit</button>

    <?php if (isset($token) && isset($selector)): ?>
        <input type="hidden" name="URLtoken" value="<?php echo $token; ?>"></input>
        <input type="hidden" name="selector" value="<?php echo $selector; ?>"></input>
    <?php endif; ?>

    </form>
<?php
//error checking by checking url for error codes made by program.
if (isset($_GET["error"])) {
    if ($_GET["error"] === "token_validatorEmpty") {
        echo "<div class='error_message'>
        <p>No account associated with this email. </p>
        </div>";
    }
    else if ($_GET["error"] === "stmtfailed") {
        echo "<div class='error_message'>
        <p style='margin-left: 10px>Something went wrong. Try again. </p>
        </div>";
    }
    else if ($_GET["error"] === "updatefailed") {
        echo "<div class='error_message'>
        <p style='margin-left: 20px;'>Server issue. Try again. </p>
        </div>";
    }
    else if ($_GET["error"] === "token_missmatch") {
        echo "<div class='error_message'>
        <p>Something went wrong. Try again. </p>
        </div>";
    }
    else if ($_GET["error"] === "noerror") {
        echo "<div class='error_message'>
        <p style='color: green; margin-left:40px;'>Update succesful. </p>
        </div>";
        sleep(3);
        header("location: ../index.php");
    }
    else if ($_GET["error"] === "novalidtoken") {
        echo "<div class='error_message'>
        <p>Too late, please retry. </p>
        </div>";
    }
}
?>
</div>
</body>
<script>
    let pw = document.getElementById("uPassword");
    let re_pw = document.getElementById("uMatch");

    //sanitize inputs
    pw = htmlspecialchars(strip_tags(trim(pw)));
    re_pw = htmlspecialchars(strip_tags(trim(re_pw)));

    function checkMatch() {
        if (pw.value != re_pw.value) {
            uMatch.setCustomValidity("Passwords don't match.");
            uMatch.reportValidity();
        }
        else {
            uMatch.setCustomValidity('');
        }
    }
    pw.addEventListener("change", checkMatch);
    re_pw.addEventListener("keyup", checkMatch);
</script>
</html>