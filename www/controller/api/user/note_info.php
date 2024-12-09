<?php
include_once ROOT_PATH . DS . "functions" . DS . "user" . DS . "note_info.php";


if(isset($_SESSION["user_id"])){
    if ( $_SESSION["user_role"] == "Professor"){
        $notes = get_notes_by_cours($_GET['cours_id']);
    } else {
        header('location: /index.php');
    }
    if ( isset($_POST['mod_note_btn'])){
        try {
        foreach ($_POST['note'] as $key => $value) {
            mod_notes($_GET['cours_id'],$key,$value);   
        }
    } catch (Exception $e) {
    }
        header ('location: /pages/user/note_info.php?cours_id='.$_GET['cours_id']);
    }

}else {
    header('location: /pages/public/login.php');
}