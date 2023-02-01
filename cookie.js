function colorSchemePreference(test) {
    var button = document.getElementById("toggle-button");
    var darkmode = test;
    var root = document.documentElement;
    var modeCookie = getCookie("dark_mode");
    if (modeCookie == 'true' || darkmode == "true") {
        // darkmode colorscheme
        button.checked = true;
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
    }
}

function csPreference(test) {
    var root = document.documentElement;
    var darkmode = test;
    var modeCookie = getCookie("dark_mode");
    if (modeCookie == 'true' || darkmode == "true") {
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