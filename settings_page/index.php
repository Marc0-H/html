<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="instellingen-style.css">
        <link rel="stylesheet" href="togglebutton.css">
        <link rel="stylesheet" href="stylesheet.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="main.js"></script>
        <script src="cookie.js"></script>
    </head>
    <body>
        <?php
        include 'header.php';
        ?>
        <div class="instellingen-container">
            <div class="rand"></div>
            <div class="instellingen-page">
                <div><h1 class="instellingen-header">Instellingen</h1></div>
                <div class="instellingen-underline"></div>
                <div class="standard-container">
                    <div style="flex:1; max-width: 350px;"><p class="darkmode-text">Donkere modus</p></div>
                    <div style="width: 125px;">
                      <label class="toggle-container">
                        <input type="checkbox" id="toggle-button" onchange="switchColorScheme()">
                        <span class="toggle-label" style="top: -29px; left: -24px;"></span>
                      </label>
                    </div>
                </div>
                <div class="standard-container">
                    <div class="collapsible">
                        <button class="collapsible-button"><p>Gebruikersnaam wijzigen <strong>+</strong></p></button>
                        <div class="collapsible-content">
                            <div class="E-mail-wijzig-container">
                                <div style="margin-top: 20px;"><p>Nieuwe gebruikersnaam:</p></div>
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
                        <button class="collapsible-button"><p>Profielfoto wijzigen <strong>+</strong></p></button>
                        <div class="collapsible-content">
                            <div class="E-mail-wijzig-container">
                                <div style="margin-left: 35px; margin-top: 20px;"><p>Nieuwe profielfoto:</p></div>
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
                        <button class="collapsible-button"><p>E-mail wijzigen <strong>+</strong></p></button>
                        <div class="collapsible-content">
                            <div class="E-mail-wijzig-container">
                                <div style="margin-left: 60px; margin-top: 20px;"><p>Nieuwe e-mail:</p></div>
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
                            <p>Wachtwoord wijzigen <strong>+</strong></p>
                        </button>
                        <div class="collapsible-content">
                            <div class="wachtwoord-wijzig-container" style="padding-bottom: 90px;">
                                <div style="margin-left: 30px; margin-top: 20px;"><p>Nieuw wachtwoord:</p></div>
                                <div style="margin-top: 20px;">
                                    <form action="update_data.php" method="post" id="password-form">
                                        <input type="password" id="password" name="new-password">
                                        <p class="wachtwoord-herhalen">Wachtwoord herhalen:</p>
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
        $(document).ready(function() {
        var form = $("#" + formtype);
        var submitBtn = $(document);
        let formData = $("#" + dataId).serialize();

        if (formtype == 'password-form') {
            let password = document.getElementById("password"),
             confirm_password = document.getElementById("password-repeat");

            if (password.value != confirm_password.value) {
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

            event.preventDefault();
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
            calculate_maxheight();
            colorSchemePreference();
            password_logic();
        </script>
    </body>
</html>
