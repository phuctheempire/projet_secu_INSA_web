<?php

function get_all_posts()
{
    global $conn;
    $query = "SELECT p.post_id AS post_id, u.id AS author_id, u.nom AS auth_nom, u.prenom AS auth_prenom, p.title AS title, p.content AS content, p.date AS date, p.image_path FROM Posts p JOIN Users u ON p.author_id = u.id ";
    $result = mysqli_query($conn, $query);
    $posts = [];
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($posts, $row);
    }
    return $posts;
}

function get_result_by_recherche($recherche)
{
    global $user1;
    $mots = explode(",", $recherche);
    $mots = array_map("trim", $mots);
    $queries = [];
    foreach ($mots as $mot) {
        $query = "SELECT p.post_id AS post_id, u.id AS author_id, u.nom AS auth_nom, u.prenom AS auth_prenom, p.title AS title, p.content AS content, p.date AS date, p.image_path FROM Posts p JOIN Users u ON p.author_id = u.id WHERE p.title LIKE '%$mot%' OR p.content LIKE '%$mot%' OR u.nom LIKE '%$mot%' OR u.prenom LIKE '%$mot%'";
        array_push($queries, $query);
    }
    $final_query = implode("; ", $queries);
    $posts = [];
    mysqli_multi_query($user1, $final_query);
    do {
        if ($result = mysqli_store_result($user1)) {
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($posts, $row);
            }
        }
    } while (mysqli_next_result($user1));
    return $posts;
}