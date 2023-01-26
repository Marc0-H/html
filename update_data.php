<?php
    require 'connection.php';
    require 'update_data_functions.php';

    // session_start();

    init_data_update();
    $columns = sanitize_input($connection);

    list($updated_value, $column_to_be_updated) = determine_update($columns);


    $updated_value = optimize_data_before_update($column_to_be_updated, $connection, $updated_value);

    $userid = 4;

    update_data($connection, $column_to_be_updated, $updated_value, $userid);

    deleteProfileImage($updated_value, $column_to_be_updated);
    mysqli_close($connection);

    header("HTTP/1.1 204 NO CONTENT");

?>