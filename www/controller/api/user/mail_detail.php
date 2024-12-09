<?php
include_once ROOT_PATH . DS . "functions" . DS . "user" . DS . "mail.php";

if (isset($_SESSION['user_id'])){
    $mail_id = $_GET['id'];
    $email = get_email_detail($mail_id);
}else {
    header('location: /pages/public/login.php');
}