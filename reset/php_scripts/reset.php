<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'vendor/autoload.php';


// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

// require 'path/to/PHPMailer/src/Exception.php';
// require 'path/to/PHPMailer/src/PHPMailer.php';
// require 'path/to/PHPMailer/src/SMTP.php';


include 'connection.php';
require_once 'functions.php';

$email = mysqli_real_escape_string($connection, htmlspecialchars($_POST["email"]));

if (isset($_POST["reset_submit"])) {
    $email = $_POST["email"];
    if (userExists($connection, $email, $email) === NULL) {
        header("location: ../reset_page.php?error=nouser");
    }
    else {

        $selector = bin2hex(random_bytes(8));

        $token = random_bytes(32);

        $url = "https://webtech-in07.webtech-uva.nl/~georgia/login_signupPersonal/login_signup/update_page.php?selector=" . $selector ."&token=" . bin2hex($token);
        // $url = "https://webtech-in07.webtech-uva.nl/login_signup/update_page.php?selector=" . $selector ."&token=" . bin2hex($token);

        $expiration = time() + 900;
        //remove any tokens still saved, to avoid errors
        $sql = "DELETE FROM reset WHERE resetEmail = ?";
        $stmt = mysqli_stmt_init($connection);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../reset_page.php?error=stmtfailed");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
        }
        $userUid = findUid($connection, $email);

        $sql = "INSERT INTO reset(resetEmail, userId, pwdSelector, pwdToken, expirationDate) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($connection);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../reset_page.php?error=stmtfailed");
            exit();
        }
        else {
            $hashedToken = password_hash($token, PASSWORD_DEFAULT);

            mysqli_stmt_bind_param($stmt, "sssss", $email, $userUid, $selector, $hashedToken, $expiration);
            mysqli_stmt_execute($stmt);

            mysqli_stmt_close($stmt);
        }

        //stuck :(
    }
    $to = "$email";
    $title = "Password reset";
    $message = "<p> We've received a password reset request from your account at Eduzone.
    Please click the link below to reset. If you didn't attempt to reset, ignore this email";
    $message .= '<a href=" '. $url . ' "> '. $url . ' </a>';
    $header = "From: <eduzoneinfo565@gmail.com>\r\nContent-Type: text/html \r\nReply-To: <eduzone565@gmail.com\r\n";

    if (mail($to, $title, $message, $header) === TRUE) {
        header("location: ../reset_page.php?error=noerror");
    } else {
        header("location: ../reset_page.php?error=mailfail");
    }


    // $to = "$email";
    // $title = "Password reset";
    // $message = "<p> We've received a password reset request from your account at Eduzone.
    // Please click the link below to reset. If you didn't attempt to reset, ignore this email</p>";
    // $message .= '<a href=" '. $url . ' "> '. $url . ' </a>';
    // $header = "From: eduzoneinfo565@gmail.com \r\n Content-type: text/html \r\n";

    // try {
    //     mail($to, $title, $message, $header);
    //     header("location ../reset_page.php?status=succes");
    // }catch(Exception $e) {
    //     echo "fail" . $e;
    //     // header("location ../reset_page.php?error=emailfail");
    // }

// $mail = new PHPMailer(true);

// try {
//     //Server settings
//     // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
//     $mail->isSMTP();                                            //Send using SMTP

//     $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
//     $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
//     $mail->Username = 'eduzoneinfo565@gmail.com';
//     $mail->Password   = 'tDvMUWjhDgjARkJDydoBgYpLdFxPh1QB2kzBy';                               //SMTP password
//     $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
//     $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

//     //Recipients
//     $mail->setFrom('eduzoneinfo565@gmail.com', 'Geogi Arushanov');
//     $mail->addAddress($email);     //Add a recipient


//     //Content
//     $mail->isHTML(true);                                  // Set email format to HTML
//     $mail->Subject = 'Password reset';
//     $mail->Body    = "<p> We've received a password reset request from your account at Eduzone.
//     Please click the link below to reset. If you didn't attempt to reset, ignore this email</p>
//     </br>";
//     $mail->Body .= '<a href=" '. $url . ' "> '. $url . ' </a>';


//     $mail->send();
//     echo 'Message has been sent';
// }catch (Exception $e) {
//     echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
// }
// }
}
else {
    header("location: ../login_page.php");
}

?>