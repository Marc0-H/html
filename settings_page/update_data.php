<?php
    require 'connection.php';
    require 'update_data_functions.php';

    // session_start();

    init_data_update();
    $columns = sanitize_input($connection);

    if (count($_FILES) > 0) {
      foreach ($_FILES as $file) {
        $filename = $file["name"];
        $filesize = $file["size"];
        $file_temp = $file["tmp_name"];
    }
        $upload_ok = 0;
        $image_file_type = strtolower(pathinfo($filename,PATHINFO_EXTENSION));

        if($filename != NULL) {
            $check = getimagesize($file_temp);
            if($check !== false) {
              $upload_ok = 1;
            } else {
              $upload_ok = 0;
            }
            if ($filesize > 5000000) { // $filesize > 5MB
              $error_msg = "file size incorrect, please select a smaller file";
              $upload_ok = 0;
            }
            if($image_file_type != "png") {
              $error_msg = "file type incorrect, please use png";
              $upload_ok = 0;
            }
          }

        if($upload_ok == 1) {
        $img = file_get_contents($file_temp);
        $post_image = base64_encode($img);
        }

        $userid = 4;

        update_data($connection, 'profile_image', $post_image, $userid);
        mysqli_close($connection);
    } else {
    list($updated_value, $column_to_be_updated) = determine_update($columns);

    $updated_value = optimize_data_before_update($column_to_be_updated, $connection, $updated_value);

    $userid = 4;

    update_data($connection, $column_to_be_updated, $updated_value, $userid);

    mysqli_close($connection);
    }

    http_response_code(200);
    header("HTTP/1.1 204 NO CONTENT");

?>