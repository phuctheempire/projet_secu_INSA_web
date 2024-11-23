<?php
include_once ROOT_PATH . DS . "functions" . DS . "user" . DS . "user_info.php";
include_once ROOT_PATH . DS . "functions" . DS . "user" . DS . "cours_info.php";
// require ROOT_PATH . DS . "functions" . DS . "user" . DS . "cours_info.php";
if ( isset($_SESSION['user_id'])){
    $cours_id = $_GET['cours_id'];
    $user_info = getUserInfo($_SESSION['user_id']);
    $annonces =  getAnnonce( $cours_id );
    if ($user_info['role'] == "Students") {
        
    } else if ($user_info['role'] == "Professor") {

    }
} else {
    header('location: /pages/public/login.php');
}
    
        