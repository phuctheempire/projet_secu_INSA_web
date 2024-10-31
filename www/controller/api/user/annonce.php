<?php

require ROOT_PATH . DS . "functions" . DS . "user" . DS . "annonce.php";

if ( isset($_SESSION['user_id'])){
    $annonce_id = $_GET['annonce_id'];
    $annonce_info = getAnnonceById($annonce_id);
    $comments =  getComments( $annonce_id );
    // if ($user_info['role'] == "Students") {
        
    // } else if ($user_info['role'] == "Professor") {

    // }
} else {
    header('location: /pages/public/login.php');
}