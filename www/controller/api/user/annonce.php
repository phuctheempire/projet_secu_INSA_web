<?php

require ROOT_PATH . DS . "functions" . DS . "user" . DS . "annonce.php";

if ( isset($_SESSION['user_id'])){
    if (isset($_GET['annonce_id'])){
        $annonce_id = $_GET['annonce_id'];
        $annonce_info = getAnnonceById($annonce_id);
        $comments =  getComments( $annonce_id );
    }

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

    if ( isset( $_POST['mod_annonce'])){
        $title = $_POST['title'];
        $content = $_POST['content'];
        $date = date('Y-m-d');
        $annonce = array(
            'annon_id'=> $_GET['annonce_id'],
            'title' => $title,
            'content' => $content,
            'date' => $date
        );
        $result = modify_annonce($annonce);
        if ($result) {
            header('location: /pages/user/cours_info.php?cours_id=' . $annonce_info['matier_id']);
        } else {
            echo "Erreur lors de l'ajout de l'annonce";
        }
    }

    if ( isset( $_POST["submit_cmt"] ) ){
        $content = $_POST['content'];
        $date = date('Y-m-d');
        $author_id = $_SESSION['user_id'];
        $result = commit_comment($author_id, $annonce_id, $content, $date);
        if ($result) {
            header('location: /pages/user/annonce.php?annonce_id=' . $annonce_id);
        } else {
            echo "Tu me casses les couilles";
        }
    }

    if( isset( $_POST["add_annonce_btn"] ) ){
        $author_id = get_prof_id_by_matier($_GET['cours_id']);
        $title = $_POST['title'];
        $content = $_POST['content'];
        $date = date('Y-m-d');
        $annonce = array(
            'title' => $title,
            'content' => $content,
            'date' => $date,
            'author_id'=> $author_id,
            'matier_id' => $_GET['cours_id']
        );
        $result = add_annonce( $annonce );
        if ($result) {
            header('location: /pages/user/cours_info.php?cours_id=' . $_GET['cours_id']);
        } else {
            echo "Erreur lors de l'ajout de l'annonce";
        }
    }

    if ( isset($_POST['del_annonce'])){
        $result = remove_annonce($_GET['annonce_id']);
        if ($result) {
            header('location: /pages/user/cours_info.php?cours_id=' . $annonce_info['matier_id']);
        } else {
            echo "Erreur lors de la suppression de l'annonce";
        }
    }


} else {
    header('location: /pages/public/login.php');
}
