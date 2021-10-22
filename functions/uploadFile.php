<?php
    session_start();
    function checkUploadFile($target_file, $nama_form){

        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        $check = TRUE; 

        // Check if file already exists
        if (file_exists($target_file)) {
        $_SESSION['file'] = "Sorry, file already exists";
            $check = false;
        }

        // Check file size
        if ($_FILES[$nama_form]["size"] > 500000) {
        $_SESSION['file'] = "Sorry, your file is too large";
            $check = false;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        $_SESSION['file'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed";
            $check = false;
        }
        return $check;
    }
?>