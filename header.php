<?php
    include_once '../connection.php';

    if (isset($_SESSION["userId"])) {
        $session_id = $_SESSION["userId"];
        $user_result_query = "SELECT profile_image FROM users WHERE userId = $session_id";
        $user_result = mysqli_fetch_assoc(mysqli_query($connection, $user_result_query));
    }
?>

<script src="cookie.js"></script>
    <script>
            var test = "<?php echo $_SESSION['darkmode']; ?>";
            csPreference(test);
    </script>

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
                <div class="dropdown_menu_profile">
                    <?php if (!empty($user_result["profile_image"])) { ?>
                            <img src="data:image/png;base64,<?php echo $user_result["profile_image"]?>" alt="profile picture" class="profile_button">
                    <?php } else { ?>
                            <img src="images/default.png" alt="default picture" class="profile_button">
                    <?php } ?>
                    <div class="dropdown_content">
                        <a href="profilepage.php" class="profile_button">Your posts</a>
                        <a href="settings.php" class="settings_button">Settings</a>
                        <a href="login_signup/logout.php" class="log_out_button">Log out</a>
                    </div>
                </div>

                <a href="newthread.php" class="mobile_button">Create post</a>
                <a href="settings.php" class="mobile_button">Settings</a>
                <a href="login_signup/logout.php" class="mobile_button">Log out</a>
            <?php
            }
            ?>
        </div>
    </div>
</header>'