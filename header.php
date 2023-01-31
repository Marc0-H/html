<header>
    <div class="header_container">
        <a href="./index.php"><img src="images/logo.png" alt="EDUZONE"></a>
        <div class="mobile_right">
            <button class="mobile_filter_btn">
                <i class="material-icons tooltip">filter_alt<div class="tooltip_text">Filter</div></i>
            </button>
            <button class="hamburger_menu_btn">
                <span class="bar" id="bar1"></span>
                <span class="bar" id="bar2"></span>
                <span class="bar" id="bar3"></span>
            </button>
        </div>
        <div class="header_content_right">
            <form class="search_form" method="get">
                <input name="search" class="searchbar" type="text" placeholder="Search topic..">
                <button class="searchbar_submit">
                    <i class="material-icons tooltip">search<div class="tooltip_text">Search</div></i>
                </button>
            </form>

            <?php
            if (!isset($_SESSION["userId"])) {
            // Show if not logged in.
            ?>
                <a href="login_signup/signup_page.php" class="register_button">Register</a>
                <a href="login_signup/login_page.php" class="login_button" >Login</a>

                <a href="login_signup/signup_page.php" class="mobile_button">Register</a>
                <a href="login_signup/login_page.php" class="mobile_button" >Login</a>
            <?php
            } else {
            // Show if logged in.
            ?>
                <i id="create_post" class="material-icons tooltip">add<div class="tooltip_text">Create post</div></i>

                <div class="dropdown_menu_profile">
                    <img src="./images/profile_img.png" alt="profile" class="profile_button">
                    <div class="dropdown_content">
                        <a href="#" class="settings_button">Settings</a>
                        <a href="login_signup/php_scripts/log_out.php" class="log_out_button">Log out</a>
                    </div>
                </div>

                <a href="newthread.php" class="mobile_button">Create post</a>
                <a href="#" class="mobile_button">Settings</a>
                <a href="login_signup/php_scripts/log_out.php" class="mobile_button">Log out</a>
            <?php
            }
            ?>
        </div>
    </div>
</header>'