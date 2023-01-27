<header>
    <div class="header_container">
        <img src="" alt="EDUZONE">
        <button class="hamburger_menu_btn">
            <span class="bar" id="bar1"></span>
            <span class="bar" id="bar2"></span>
            <span class="bar" id="bar3"></span>
        </button>
        <div class="header_content_right">
            <input class="searchbar" type="text" placeholder="Search topic..">

            <?php
            if (!isset($_SESSION["userId"])) {
            // Show if not logged in.
            ?>
                <a href="login_signup/signup_page.php" class="register_button">Register</a>
                <a href="login_signup/login_page.php" class="login_button" >Login</a>
            <?php
            } else {
            // Show if logged in.
            ?>
                <i class="material-icons tooltip">add<div class="tooltip_text">Create post</div></i>

                <div class="dropdown_menu_profile">
                    <img src="./images/profile_img.png" alt="profile" class="profile_button">
                    <div class="dropdown_content">
                        <a href="#" class="settings_button">Settings</a>
                        <a href="login_signup/php_scripts/log_out.php" class="log_out_button">Log out</a>
                    </div>
                </div>

                <a href="#" class="mobile_create_post">Create post</a>
                <a href="#" class="mobile_profile_settings">Settings</a>
                <a href="login_signup/php_scripts/log_out.php" class="mobile_logout_button">Log out</a>
            <?php
            }
            ?>
        </div>
    </div>
</header>'