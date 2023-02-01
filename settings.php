<?php
session_start();

if (!isset($_SESSION['userId'])) {
    header("Location: https://webtech-in07.webtech-uva.nl/index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="instellingen-style.css">
        <link rel="stylesheet" href="togglebutton.css">
        <link rel="stylesheet" href="stylesheet.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="settings.js"></script>
        <script src="cookie.js"></script>
    </head>
    <body>
        <?php
        include 'header.php';
        ?>
        <div class="instellingen-container">
            <div class="rand"></div>
            <div class="instellingen-page">
                <div><h1 class="instellingen-header">Settings</h1></div>
                <div class="instellingen-underline"></div>
                <div class="standard-container">
                    <div style="flex:1; max-width: 350px;"><p class="darkmode-text" style="margin-bottom: 15px;">Dark mode</p></div>
                    <div style="width: 125px;">
                      <label class="toggle-container">
                        <input type="checkbox" id="toggle-button" onchange="sendColorData()">
                        <span class="toggle-label" style="top: -29px; left: -24px;"></span>
                      </label>
                    </div>
                </div>
                <div class="standard-container">
                    <div class="collapsible">
                        <button class="collapsible-button"><p>Change username <strong>+</strong></p></button>
                        <div class="collapsible-content">
                            <div class="E-mail-wijzig-container">
                                <div style="margin-top: 20px;"><p style="margin-left: 87px;">New Username:</p></div>
                                <div style="margin-top: 20px;">
                                    <form action="update_data.php" method="post" id="username-form">
                                        <input type="text" id="new-username" name="new-username">
                                        <input type="submit" value="Submit" id="submit-btn" onclick="sendData('username-form', 'new-username', event)">
                                      </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="standard-container">
                    <div class="collapsible">
                        <button class="collapsible-button"><p>Change profilepicture <strong>+</strong></p></button>
                        <div class="collapsible-content">
                            <div class="E-mail-wijzig-container">
                                <div style="margin-left: 41px; margin-top: 20px;"><p>New profilepicture:</p></div>
                                <div style="margin-top: 20px;">
                                    <form action="update_data.php" method="post" id="file-form">
                                        <input type="file" id="myFile" name="myFile" accept=".png" style="margin-left: 25px; margin-bottom: 12px; margin-top: 20px;">
                                        <input type="submit" value="Submit" onclick="sendFileData('file-form', 'myFile', event)">
                                      </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="standard-container">
                    <div class="collapsible">
                        <button class="collapsible-button"><p>Change e-mail <strong>+</strong></p></button>
                        <div class="collapsible-content">
                            <div class="E-mail-wijzig-container">
                                <div style="margin-left: 60px; margin-top: 20px;"><p style="margin-left: 57px;">New e-mail:</p></div>
                                <div style="margin-top: 20px;">
                                    <form action="update_data.php" method="post" id="email-form">
                                        <input type="email" id="new-email" name="new-email">
                                        <input type="submit" value="Submit" id="submit-btn" onclick="sendData('email-form', 'new-email', event)">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="standard-container">
                    <div class="collapsible">
                        <button class="collapsible-button">
                            <p>Change password <strong>+</strong></p>
                        </button>
                        <div class="collapsible-content">
                            <div class="wachtwoord-wijzig-container" style="padding-bottom: 90px;">
                                <div style="margin-left: 30px; margin-top: 20px;"><p style="margin-left: 64px;">New password:</p></div>
                                <div style="margin-top: 20px;">
                                    <form action="update_data.php" method="post" id="password-form">
                                        <input type="password" id="password" name="new-password">
                                        <p class="wachtwoord-herhalen" style="margin-left: 54px;">Repeat password:</p>
                                        <input type="password" id="password-repeat" name="new-password">
                                        <input type="submit" id="submit-btn" value="Submit" onclick="sendData('password-form', 'password', event)">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div style="width: 100px; height: 30px; display: block;"></div>
            </div>
            <div class="rand"></div>
        </div>

        <script>
            function sendColorData(event) {
                var colorMode = switchColorScheme();

                $.ajax({
                type: 'POST',
                url: 'settingscookies.php',
                data: colorMode,
            });
            }
        </script>

        <script>
        function sendFileData(formId, fileId, event) {
            event.preventDefault();
            var formData = new FormData();
            formData.append('file', $('#' + fileId)[0].files[0]);
            $.ajax({
                type: 'POST',
                url: 'update_data.php',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    alert("Wijziging is aangebracht!");
                }
            });
            }
        </script>


        <script>
    function sendData(formtype, dataId, event) {
        event.preventDefault();
        $(document).ready(function() {
        var form = $("#" + formtype);
        var submitBtn = $(document);
        let formData = $("#" + dataId).serialize();

        if (formtype == 'password-form') {
            let password = document.getElementById("password"),
             confirm_password = document.getElementById("password-repeat");

            if (password.value != confirm_password.value || password.value == "" && confirm_password.value == "") {
                confirm_password.setCustomValidity("Wachtwoorden komen niet overeen!");
                document.querySelector("#password").style.border = "1px solid red";
                document.querySelector("#password-repeat").style.border = "1px solid red";
                return;
            } else {
                confirm_password.setCustomValidity('');
                document.querySelector("#password").style.border = "";
                document.querySelector("#password-repeat").style.border = "";
            }
        }

        if (document.getElementById(dataId).value == "" && formtype != 'password-form') {
            document.querySelector("#" + dataId).style.border = "1px solid red";
            return;
        }

            $.ajax({
                type: "POST",
                url: "update_data.php",
                data: formData,
                success: function(response) {
                    document.getElementById(dataId).value = "";
                    if (formtype == 'password-form') {
                        document.getElementById('password-repeat').value = "";
                    }
                    alert("Wijziging is aangebracht!");
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    if (jqXHR.status == 409) {
                        console.log("error 409!");
                        alert("Error: The username already exists");
                    } else {
                        alert("An error occurred: " + errorThrown);
                    }
                }
            });
        });
    };
        </script>


        <script>
            var test = "<?php echo $_SESSION['darkmode']; ?>";
            calculate_maxheight();
            colorSchemePreference(test);
            password_logic();
        </script>
    </body>
</html>
