<?php

include_once ROOT_PATH . DS . "functions" . DS . "user" . DS . "notes.php";
include_once ROOT_PATH . DS . "functions" . DS . "public" . DS . "cours_list.php";

if(isset($_SESSION["user_id"])){
    if ( $_SESSION["user_role"] == "Student"){
        $notes = get_all_notes_by_id($_SESSION['user_id']);
    } else {
        header('location: /index.php');
    }
}else {
    header('location: /pages/public/login.php');
}