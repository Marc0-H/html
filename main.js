function clearField(fieldname) {
    let name = document.getElementById(fieldname);
    name.value = '';
    name.setCustomValidity("Wijziging is aangebracht!");
}

function max_filesize() {
let uploadField = document.getElementById("myFile");
let maxsize = 520000;

uploadField.onchange = function() {
    if(this.files[0].size > maxsize){
    alert("Bestand mag niet groter zijn dan 500Kb!");
    this.value = "";
    };
};
}

// function submitUsernameForm() {
//     clearField('$new-username')
//     fetch ('update_data.php', {
//         method: 'POST',
//         body: new FormData(document.getElementById('username-form'))
//     })
//     .then(response => response.text())
//     .then(data => {
//         if(data.startsWith("Error")){
//             alert(data);
//         }else{
//             document.getElementById('new-username').setCustomValidity("Wijziging is aangebracht!");
//         }
//     })
//     .catch(error => console.error('Error:', error));
// }

function clearPasswordFields() {
    document.getElementById('password').value = '';
    document.getElementById('password-repeat').value = '';
}

function password_logic() {
    let password = document.getElementById("password"),
        confirm_password = document.getElementById("password-repeat");

    function validatePassword() {
        if (password.value != confirm_password.value) {
            confirm_password.setCustomValidity("Wachtwoorden komen niet overeen!");
            document.querySelector("#password").style.border = "1px solid red";
            document.querySelector("#password-repeat").style.border = "1px solid red";
        } else {
            confirm_password.setCustomValidity('');
            document.querySelector("#password").style.border = "";
            document.querySelector("#password-repeat").style.border = "";
            if (password.value === confirm_password.value) {
                sendData();
            }
        }
    }

    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;
}


function calculate_maxheight() {
    let collapsibleButtons = document.querySelectorAll(".collapsible-button");
    let collapsibleContents = document.querySelectorAll(".collapsible-content");

    collapsibleButtons.forEach(function(collapsibleButton, index) {
        collapsibleButton.addEventListener("click", function() {
            let collapsibleContent = collapsibleContents[index];
            if (collapsibleContent.style.maxHeight) {
                collapsibleContent.style.maxHeight = null;
            } else {
                collapsibleContent.style.maxHeight = collapsibleContent.scrollHeight + "px";
            }
        });
    });
}