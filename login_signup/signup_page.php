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
    <title>signup</title>
    <link href="../loginStyle.css" type="text/css" rel="stylesheet">
</head>
<body>

    <form method="post" action="php_scripts/add_account.php">
    <div class="signup_prompt">
        <h1> Create your account</h1>

    <div class="userInfo">
    <label for="username" style="margin-right: 275px">Username</label>
    <input required type="text" id="username" name="username" placeholder="Enter a username">
    </div>

    <div class="userInfo">
    <label for="uPassword" style="margin-right: 279px;">Password</label>
    <input required type="Password" id="uPassword" name="uPassword" placeholder="Enter a password">
    </div>

    <div class="userInfo">
        <label for="uMatch" style="margin-right: 283px;" >Re-enter</label>
        <input required type="password" id="uMatch" name="uMatch" placeholder="Re-enter your password" autocomplete="off">
    </div>

    <div class="userInfo">
    <label for="email" style="margin-right: 305px">Email</label>
    <input required type="email" id="email" name="email" placeholder="Enter your email">
    </div>

    <div class="userInfo">
    <label for="tag"></label>
        <select name="select" class="select">
        <option value="MAVO"> MAVO student</option>
        <option value="HAVO"> HAVO student</option>
        <option value="VWO"> VWO student</option>
        <option value="HBO/WO"> HBO/WO student </option>
        <option value="teacher"> teacher </option>
    </select>
    </div>

    <div>
        <button class="submit_button" style="transform: translateY(10px); transform:translateX(5px)" type="submit" name="submit">submit</a>
    </div>
<?php
//error checking by checking url for error codes made by program.
    if (isset($_GET["error"])) {
        if ($_GET["error"] === "userexists") {
            echo "<div class='error_message'>
            <p> Username/email taken. Try again. </p>
            </div>";
        }
        else if ($_GET["error"] === "invalidusername") {
            echo "<div class='error_message'>
            <p> Invalid username. Try again. </p>
            </div>";
        }
        else if ($_GET["error"] === "invalidemail") {
            echo "<div class='error_message'>
            <p> Invalid email. Try again. </p>
            </div>";
        }
        else if ($_GET["error"] === "stmtfailed") {
            echo "<div class='error_message'>
            <p> Something went wrong. Try again. </p>
            </div>";
        }
        else if ($_GET["error"] === "fetchfailed") {
            echo "<div class='error_message'>
            <p> No account to reset. Make one here. </p>
            </div>";
        }
        else if ($_GET["error"] === "invalidusertag") {
            echo "<div class='error_message'>
            <p> Invalid tag entered. Try again. </p>
            </div>";
        }
        else if ($_GET["error"] === "pwshort") {
            echo "<div class='error_message'>
            <p> Your password is too short.</p>
            </div>";
        }

}
?>
    </div>
    </form>

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
</body>
</html>
