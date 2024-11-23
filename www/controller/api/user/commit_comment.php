<?php
require ROOT_PATH . DS . "functions" . DS . "user" . DS . "annonce.php";
if ( isset($_SESSION['user_id'])){
    if (isset($_POST('comment_btn'))) {
        $annonce_id = $_GET['annonce_id'];
        $author_id = $_SESSION['user_id'];
        $date = date('d-m-Y');
        $content = $_POST['content'];
        var_dump($content, $date, $author_id, $annonce_id);
        commit_comment($user_id, $annonce_id, $content, $date);
    }


} else {
    header('location: /pages/public/login.php');

}