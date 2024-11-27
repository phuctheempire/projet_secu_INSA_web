<?php
include_once ROOT_PATH . DS . "functions" . DS . "user" . DS . "mail.php";


if (isset($_SESSION['user_id'])){
    $user_id = $_GET['id'];
    if ($user_id == $_SESSION['user_id']){
        $email_list = getAllMailsByID($user_id);
    }
}
if (isset($_POST['send_email'])){
    $receiver_emails = $_POST['receiver_emails'];
    $receiver_emails = explode(',', $receiver_emails);
    $receiver_emails = array_map('trim', $receiver_emails);
    $title = $_POST['title'];
    $content = $_POST['content'];
    $sender_id = $_SESSION['user_id'];
    $email = array(
        'emails'=> $receiver_emails,
        'title' => $title,
        'content'=> $content,
        'sender_id' => $sender_id,
        'date' => date('Y-m-d')
    );
    $success = send_email($email);
    header("Location: mail.php?id=".$_SESSION['user_id']);
    exit;
}