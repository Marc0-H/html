<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>EduZone</title>
        <link rel="stylesheet" href="stylesheet.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <script src="filter.js" defer></script>
        <script src="header.js" defer></script>
    </head>
    <body>
        <?php
            include 'connection.php';
            if (!$connection) {
                die("Connection to server failed. !");
            }

        ?>
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
        </header>
        <main>
            <div class="main_container">
                <div class="sidebar_container">

                    <div class="sidebar_description">
                        <h2>Yo yo yo</h2>
                        <p>Tempora maxime similique cum iure architecto fuga libero labore ullam tenetur delectus deserunt, nihil porro est nesciunt magnam repellat qui quos!  <br><br> Tempora quasi itaque in natus vero incidunt consectetur nihil veritatis debitis doloremque aperiam. Neque, ut.</p>
                    </div>
                    <div class="sidebar_filter">

                        <button id="filter-option-subject" class="dropdown-button">
                            Subject
                            <svg class="dropdown-button-icon" viewBox="0 0 96 96" xmlns="http://www.w3.org/2000/svg"><title/><path d="M81.8457,25.3876a6.0239,6.0239,0,0,0-8.45.7676L48,56.6257l-25.396-30.47a5.999,5.999,0,1,0-9.2114,7.6879L43.3943,69.8452a5.9969,5.9969,0,0,0,9.2114,0L82.6074,33.8431A6.0076,6.0076,0,0,0,81.8457,25.3876Z"/></svg>
                        </button>
                        <div class="dropdown" id="dropdown-subject">
                            <label class="dropdown-label">
                                <input type="checkbox">Math
                            </label>
                            <label  class="dropdown-label">
                                <input type="checkbox">Biology
                            </label>
                            <label class="dropdown-label">
                                <input type="checkbox">Chemistry
                            </label>
                        </div>
                        <button id="filter-option-sortby" class="dropdown-button">
                            Sort by
                            <svg class="dropdown-button-icon" viewBox="0 0 96 96" xmlns="http://www.w3.org/2000/svg"><title/><path d="M81.8457,25.3876a6.0239,6.0239,0,0,0-8.45.7676L48,56.6257l-25.396-30.47a5.999,5.999,0,1,0-9.2114,7.6879L43.3943,69.8452a5.9969,5.9969,0,0,0,9.2114,0L82.6074,33.8431A6.0076,6.0076,0,0,0,81.8457,25.3876Z"/></svg>
                        </button>
                        <div class="dropdown" id="dropdown-sortby">
                            <label class="dropdown-label">
                                <input type="radio" name="sortby">Newest
                            </label>
                            <label  class="dropdown-label">
                                <input type="radio" name="sortby">Relevance
                            </label>
                            <label class="dropdown-label">
                                <input type="radio" name="sortby">Likes
                            </label>
                            <label class="dropdown-label">
                                <input type="radio" name="sortby">Answered
                            </label>
                        </div>
                        <button id="filter-option-user-role" class="dropdown-button">
                            User role
                            <svg class="dropdown-button-icon" viewBox="0 0 96 96" xmlns="http://www.w3.org/2000/svg"><title/><path d="M81.8457,25.3876a6.0239,6.0239,0,0,0-8.45.7676L48,56.6257l-25.396-30.47a5.999,5.999,0,1,0-9.2114,7.6879L43.3943,69.8452a5.9969,5.9969,0,0,0,9.2114,0L82.6074,33.8431A6.0076,6.0076,0,0,0,81.8457,25.3876Z"/></svg>
                        </button>
                        <div class="dropdown" id="dropdown-user-role">
                            <label class="dropdown-label">
                                <input type="checkbox">PhD.
                            </label>
                            <label  class="dropdown-label">
                                <input type="checkbox">Student
                            </label>
                            <label class="dropdown-label">
                                <input type="checkbox">Teacher
                            </label>
                        </div>
                        <button class="filter-button">
                            Apply
                        </button>
                    </div>
                </div>
                <div class="thread_content_container">

                    <?php
                        if (isset($_GET["v"])) {
                            $id = $_GET["v"];
                            $post_sql = "SELECT * FROM posts WHERE post_id = $id";
                            $post_result = mysqli_query($connection, $post_sql);
                            $post_result = mysqli_fetch_assoc($post_result);
                            ?>

                            <div class="post_container original_poster">
                                <div class="post_title"><span class="post_tag"><?php echo $post_result["post_tag"]?></span><?php echo $post_result["post_title"]?></div>
                                <div class="user_info_container">
                                    <img src="images/profile_img.png">
                                    <div class="username">The Bridgekeeper</div>
                                    <div class="user_tag">PhD.</div>
                                    <i class="material-icons">query_builder</i>
                                    <div class="date"><?php echo $post_result["post_datetime"]?></div>
                                </div>
                                <div class="post_content"><?php echo $post_result["post_content"]?></div>
                                <div class="interaction_container">
                                    <i class="material-icons tooltip">thumb_up<div class="tooltip_text">Like</div></i>
                                    <div class="post_like_count">12</div>
                                    <i class="material-icons tooltip">forum<div class="tooltip_text">Go to replies</div></i>
                                    <div class="post_comment_count">4</div>
                                    <div class="reply_button">Reply</div>
                                </div>
                                <form>
                                    <textarea class="comment_box" name="comment_content" autocomplete="off" placeholder="Add a reply..." rows="1" required></textarea>
                                    <input type="submit" class="submit_button" value="Submit">
                                </form>
                            </div>

                        <?php
                        }
                    ?>



                    <div class="solution_container">
                        <div class="solution_sign">
                            <div class="solution_bar"></div>
                            <i class="material-icons">check_mark</i>
                            <div class="solution_bar"></div>
                        </div>
                        <div class="comment_container">
                            <div class="user_info_container">
                                <img src="images/profile_img.png">
                                <div class="username">Arthur</div>
                                <div class="user_tag">King of the Britons</div>
                                <i class="material-icons">query_builder</i>
                                <div class="date">2 hours ago</div>
                            </div>
                            <div class="comment_content">
                                <p>What do you mean? An African or European swallow? </p>
                            </div>
                            <div class="interaction_container">
                            <i class="material-icons tooltip">thumb_up<div class="tooltip_text">Like</div></i>
                                <div class="post_like_count">12</div>
                                <i class="material-icons tooltip">forum<div class="tooltip_text">Show replies</div></i>
                                <div class="post_comment_count">4</div>
                                <div class="reply_button">Reply</div>
                            </div>
                        </div>
                    </div>

                    <div class="comment_container">
                        <div class="user_info_container">
                            <img src="images/profile_img.png">
                            <div class="username">Arthur</div>
                            <div class="user_tag">King of the Britons</div>
                            <i class="material-icons">query_builder</i>
                            <div class="date">2 hours ago</div>
                        </div>
                        <div class="comment_content">
                            <p>What do you mean? An African or European swallow? </p>
                        </div>
                        <div class="interaction_container">
                            <i class="material-icons tooltip">thumb_up<div class="tooltip_text">Like</div></i>
                            <div class="post_like_count">12</div>
                            <i class="material-icons tooltip">forum<div class="tooltip_text">Show replies</div></i>
                            <div class="post_comment_count">4</div>
                            <div class="reply_button">Reply</div>
                        </div>
                    </div>

                    <div class="subcomment_container original_poster">
                        <div class="user_info_container">
                            <img src="images/profile_img.png">
                            <div class="username">The Bridgekeeper</div>
                            <div class="user_tag">PhD.</div>
                            <i class="material-icons">query_builder</i>
                            <div class="date">2 hours ago</div>
                        </div>
                        <div class="comment_content">
                            <p>Huh? I-- I don't know that.</p>
                        </div>
                        <div class="interaction_container">
                            <i class="material-icons tooltip">thumb_up<div class="tooltip_text">Like</div></i>
                            <div class="post_like_count">12</div>
                        </div>
                    </div>

                </div>
            </div>
        </main>
    </body>
</html>