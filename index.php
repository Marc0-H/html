<?php
session_start();

header('Cache-Control: max-age=900');
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" defer></script>
        <script src="filter.js" defer></script>
        <script src="masonry.js" defer></script>
        <script src="header.js" defer></script>
        <script src="cards.js" defer></script>
        <script src="user_info_resize.js" defer></script>
    </head>
    <body>
        <?php
            include 'connection.php';
            if (!$connection) {
                die("Connection to server failed. !");
            }

            include 'header.php';
        ?>
        <main>
            <div class="main_container">

                <div class="sidebar_container">
                    <div class="sidebar_description">
                        <h2>Find your Study Buddy</h2>
                        <p>Welcome to our community! Here you can connect with fellow students and share knowledge and resources. Whether you need help with a specific subject or just want to discuss your coursework with others, our forum is the place to be. Join now and start building your support network!<br><br> Made with ❤️ by the brainy-bunch.</p>
                    </div>
                    <div class="sidebar_filter">
                        <form class="filter_form" method="get">
                            <button id="filter-option-subject" class="dropdown-button" type="button">
                                Subject
                                <svg class="dropdown-button-icon" viewBox="0 0 96 96" xmlns="http://www.w3.org/2000/svg"><title/><path d="M81.8457,25.3876a6.0239,6.0239,0,0,0-8.45.7676L48,56.6257l-25.396-30.47a5.999,5.999,0,1,0-9.2114,7.6879L43.3943,69.8452a5.9969,5.9969,0,0,0,9.2114,0L82.6074,33.8431A6.0076,6.0076,0,0,0,81.8457,25.3876Z"/></svg>
                            </button>
                            <div class="dropdown" id="dropdown-subject">
                                <label class="dropdown-label">
                                    <input name="filter-subject[]" value="math" type="checkbox" checked>Math
                                </label>
                                <label  class="dropdown-label">
                                    <input name="filter-subject[]" value="biology" type="checkbox" checked>Biology
                                </label>
                                <label class="dropdown-label">
                                    <input name="filter-subject[]" value="english" type="checkbox" checked>English
                                </label>
                                <label class="dropdown-label">
                                    <input name="filter-subject[]" value="history" type="checkbox" checked>History
                                </label>
                                <label class="dropdown-label">
                                    <input name="filter-subject[]" value="physics" type="checkbox" checked>Physics
                                </label>
                                <label class="dropdown-label">
                                    <input name="filter-subject[]" value="science" type="checkbox" checked>Science
                                </label>
                                
                                <label class="dropdown-label">
                                    <input name="filter-subject[]" value="general" type="checkbox" checked>General
                                </label>
                            </div>
                            <button id="filter-option-sortby" class="dropdown-button" type="button">
                                Sort by
                                <svg class="dropdown-button-icon" viewBox="0 0 96 96" xmlns="http://www.w3.org/2000/svg"><title/><path d="M81.8457,25.3876a6.0239,6.0239,0,0,0-8.45.7676L48,56.6257l-25.396-30.47a5.999,5.999,0,1,0-9.2114,7.6879L43.3943,69.8452a5.9969,5.9969,0,0,0,9.2114,0L82.6074,33.8431A6.0076,6.0076,0,0,0,81.8457,25.3876Z"/></svg>
                            </button>
                            <div class="dropdown" id="dropdown-sortby">
                                <label class="dropdown-label">
                                    <input name="filter-sortby" value="latest" type="radio" checked>Latest
                                </label>
                                <label class="dropdown-label">
                                    <input name="filter-sortby" value="populairity" type="radio">Populairity
                                </label>
                                <label class="dropdown-label">
                                    <input name="filter-sortby" value="controversial" type="radio">Controversial
                                </label>
                            </div>
                            <button id="filter-option-user-role" class="dropdown-button" type="button">
                                User role
                                <svg class="dropdown-button-icon" viewBox="0 0 96 96" xmlns="http://www.w3.org/2000/svg"><title/><path d="M81.8457,25.3876a6.0239,6.0239,0,0,0-8.45.7676L48,56.6257l-25.396-30.47a5.999,5.999,0,1,0-9.2114,7.6879L43.3943,69.8452a5.9969,5.9969,0,0,0,9.2114,0L82.6074,33.8431A6.0076,6.0076,0,0,0,81.8457,25.3876Z"/></svg>
                            </button>
                            <div class="dropdown" id="dropdown-user-role">
                                <label class="dropdown-label">
                                    <input name="filter-role[]" value="student" type="checkbox" checked>Student
                                </label>
                                <label  class="dropdown-label">
                                    <input name="filter-role[]" value="teacher" type="checkbox" checked>Teacher
                                </label>
                            </div>
                            <input type="submit" value="Apply" class="filter-button">
                        </form>
                    </div>
                </div>

                <div class="main_content_container">
                    <div class="main_content_title">The latest posts...</div>
                    <div class="main_content_posts">
                        <?php include 'filtered_results.php'  ?>
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>
