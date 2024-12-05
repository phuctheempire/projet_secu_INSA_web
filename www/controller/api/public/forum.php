<?php
include_once ROOT_PATH . DS . "functions" . DS . "public" . DS . "forum.php";

if(!isset($_GET["recherche"])) {
    try {
        $posts = get_all_posts();
    } catch (Exception $e) {
        header("Location: /pages/public/forum.php");
    }
} else {
    try {
        $posts = get_result_by_recherche($_GET['recherche']);
    } catch (Exception $e) {
        // header("Location: /pages/public/forum.php");
    }
}