<?php

if (isset($_POST["upload_btn"])) {
    $file = $_FILES["file"];
    $file_name = $file["name"];
    $file_tmp_name = $file["tmp_name"];
    $file_size = $file["size"];
    $file_error = $file["error"];
    
    $file_ext = explode(".", $file_name);
    $file_actual_ext = strtolower(end($file_ext));
    $allowed = array('txt', 'pdf');
    if ( in_array($file_actual_ext, $allowed)){
        if ($file_error === 0) {
            if ($file_size < 100000) {
                // $file_name_new = uniqid('', true) . "." . $file_actual_ext;
                $file_destination = ROOT_PATH . DS . "upload" . DS . $file_name_new;
                move_uploaded_file($file_tmp_name, $file_destination);
                echo "File uploaded successfully";
            } else {
                echo "File too big";
            }
        } else {
            echo "Error uploading file";
        }

    } else {
        echo "Invalid type";
    }

}

?>
