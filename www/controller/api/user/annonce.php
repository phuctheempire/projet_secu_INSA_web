<?php

require ROOT_PATH . DS . "functions" . DS . "user" . DS . "annonce.php";

if ( isset($_SESSION['user_id'])){
    $annonce_id = $_GET['annonce_id'];
    $annonce_info = getAnnonceById($annonce_id);
    $comments =  getComments( $annonce_id );
    // if ($user_info['role'] == "Students") {
    // if (isset($_POST['commit_btn'])) {
    //     $annon_id = $_GET['annonce_id'];
    //     $author_id = $_SESSION['user_id'];
    //     $date = date('Y-m-d');
    //     $content = $_POST['content'];
    //     var_dump($content, $date, $author_id, $annonce_id);
    //     commit_comment($user_id, $annon_id, $content, $date);
    // }
    
    // } else if ($user_info['role'] == "Professor") {

    // }
} else {
    header('location: /pages/public/login.php');
}