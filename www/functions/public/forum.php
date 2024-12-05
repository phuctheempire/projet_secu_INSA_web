<?php

function get_all_posts(){
    $conn = mysqli_connect("localhost", "root", "root", DB_NAME);
    $query = "SELECT p.post_id AS post_id, u.id AS author_id, u.nom AS auth_nom, u.prenom AS auth_prenom, p.title AS title, p.content AS content, p.date AS date, p.image_path FROM Posts p JOIN Users u ON p.author_id = u.id ";
    $result = mysqli_query($conn, $query);
    $posts = [];
    while ($row = mysqli_fetch_assoc($result)){
        array_push($posts, $row);
    }
    mysqli_close($conn);
    return $posts;
}

function get_result_by_recherche($recherche){
    $conn = mysqli_connect("localhost", "root", "root", DB_NAME);
    $mots = explode(",", $recherche);
    $mots = array_map("trim", $mots);
    $queries = [];
    for ($i = 0; $i < count($mots); $i++){
        $query = "SELECT p.post_id AS post_id, u.id AS author_id, u.nom AS auth_nom, u.prenom AS auth_prenom, p.title AS title, p.content AS content, p.date AS date, p.image_path FROM Posts p JOIN Users u ON p.author_id = u.id WHERE p.title LIKE '%$mots[0]%' OR p.contenu LIKE '%$mots[0]%' OR u.nom LIKE '%$mots[0]%' OR u.prenom LIKE '%$mots[0]%'";
        array_push($queries, $query);
    }
    $final_query = implode("; ", $queries);
    $posts = [];
    mysqli_multi_query($conn, $final_query);
    do {
        if ( $result = mysqli_store_result($conn)){
            while ($row = mysqli_fetch_assoc($result)){
                array_push($posts, $row);
            }}
    } while (mysqli_next_result($conn));
    return $posts;
}