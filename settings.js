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
        }
    }

    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;
}

function validatePassword() {
    let password = document.getElementById("password"),
    confirm_password = document.getElementById("password-repeat");

    if (password.value != confirm_password.value) {
        confirm_password.setCustomValidity("Wachtwoorden komen niet overeen!");
        document.querySelector("#password").style.border = "1px solid red";
        document.querySelector("#password-repeat").style.border = "1px solid red";
    } else {
        confirm_password.setCustomValidity('');
        document.querySelector("#password").style.border = "";
        document.querySelector("#password-repeat").style.border = "";
        if (password.value === confirm_password.value) {
            sendData('password-form', 'password', event);
        }
    }
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

function switchColorScheme() {
    var button = document.getElementById("toggle-button");
    var root = document.documentElement;
    if (button.checked) {
        // darkmode colorscheme
        root.style.setProperty('--primary_color', '#309eed');
        root.style.setProperty('--primary_background_color', '#2D2D2D');
        root.style.setProperty('--secondary_background_color', '#4A4A4A');
        root.style.setProperty('--details_color', '#0000001a');
        root.style.setProperty('--shadow_color', '#2d2b2b');
        root.style.setProperty('--tooltip_background_color', '#4B4B4B');
        root.style.setProperty('--title_font_color', '#ECECEC');
        root.style.setProperty('--text_font_color', '#EEE');
        root.style.setProperty('--details_font_color', '#B9B9B9');
        root.style.setProperty('--post_interaction_color', '#f0f0f00d');
        root.style.setProperty('--filter_hover_color', '#0000000d');
        root.style.setProperty('--primary_complement_hover', '#2386cc');
        root.style.setProperty('--tag_font_color', '#FFFFFF');
        root.style.setProperty('--tag_color', '#d35400');
            return "darkmodeSession";
    } else {
        // lightmode colorscheme
        root.style.setProperty('--primary_color', '#309eed');
        root.style.setProperty('--primary_background_color', '#E5E5E5');
        root.style.setProperty('--secondary_background_color', '#F8F8F8');
        root.style.setProperty('--details_color', '#0000001a');
        root.style.setProperty('--shadow_color', '#DEDEDE');
        root.style.setProperty('--tooltip_background_color', '#4B4B4B');
        root.style.setProperty('--title_font_color', '#7E7E7E');
        root.style.setProperty('--text_font_color', '#4B4B4B');
        root.style.setProperty('--details_font_color', '#B9B9B9');
        root.style.setProperty('--post_interaction_color', '#0000000d');
        root.style.setProperty('--filter_hover_color', '#0000000d');
        root.style.setProperty('--primary_complement_hover', '#2386cc');
        root.style.setProperty('--tag_font_color', '#FFFFFF');
        root.style.setProperty('--tag_color', '#d35400');
            return "lightmodeSession";
    }
}

function checkCookie(name) {
    var cookieValue = getCookie(name);
    if (cookieValue != "") {
        return true;
    } else {
        return false;
    }
}

function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return "";
}

function setCookie(name, value, days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days*24*60*60*1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "")  + expires + "; path=/";
}

function deleteCookie(name) {
    document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}

function checkCookieConsent() {
    var cookieConsent = getCookie("cookie_consent");
    if (cookieConsent == "") {
        // Show cookie consent pop-up
        // ...
    } else {
        // Do not show cookie consent pop-up
        // ...
    }
}