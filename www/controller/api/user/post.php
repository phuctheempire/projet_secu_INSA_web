<?php

include_once ROOT_PATH . DS . "functions" . DS . "user" . DS . "post.php";

if (isset($_SESSION['user_id'])){
    if (isset($_GET['post_id'])){
    $post = get_post_by_id( $_GET['post_id']);
    $comments = getComments($_GET['post_id']);
    }


    if(isset($_POST['submit_cmt'])){
        $comment = array(
            'author_id' => $_SESSION['user_id'],
            'post_id' => $_GET['post_id'],
            'content' => $_POST['content'],
            'date'=> date('Y-m-d'),
        );
        $result = commit_cmt($comment);
        if ($result){
            header('location: /pages/user/post.php?post_id='.$_GET['post_id']);
        }
    }

    if (isset($_POST['mod_post'])){
        $title = $_POST['title'];
        $content = $_POST['content'];
        $date = date('Y-m-d');
        $post = array(
            'post_id' => $_GET['post_id'],
            'title' => $title,
            'content' => $content,
            'date' => $date
        );
        $result = modify_post($post);
        if ($result){
            header('location: /pages/user/post.php?post_id='.$_GET['post_id']);
        } else {
            var_dump($result);
        }
    }

    if (isset($_POST['del_post'])){
        $result = remove_post($_GET['post_id']);
        if ($result){
            header('location: /pages/public/forum.php');
        }
    }

    if (isset($_POST['add_post'])){
        $title = $_POST['title'];
        $content = $_POST['content'];
        $date = date('Y-m-d');
        $post = array(
            'author_id' => $_SESSION['user_id'],
            'title' => $title,
            'content' => $content,
            'date' => $date
        );
        $result = add_post($post);
        if ($result){
            header('location: /pages/public/forum.php');
        } else {
            var_dump($result);
        }
    }
}
