<?php


function getAnnonceById( $annonce_id){
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $query = "SELECT * FROM `Annoncement` WHERE annon_id = $annonce_id LIMIT 1;";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    // var_dump($annonces);
    mysqli_close($conn);
    return $row;
}

function getComments( $annonce_id){
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $query = "SELECT Comments.comment_id AS comment_id, Comments.author_id AS author_id, 
    Comments.annon_id AS annon_id, Comments.content AS content , Comments.date AS `date`, 
    Users.nom AS nom_author, Users.prenom AS prenom_author 
    FROM `Comments` JOIN `Users` 
    WHERE annon_id = $annonce_id AND Comments.author_id = Users.id 
    ORDER BY date;";
    $result = mysqli_query($conn, $query);
    $comments = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $comments[] = $row;
    }
    // var_dump($comments);
    
    mysqli_close($conn);
    return $comments;
}

function commit_comment($user_id, $annonce_id, $content, $date){
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $query = "INSERT INTO `Comments` (author_id, annon_id, content, date) VALUES ($user_id, $annonce_id, '$content', '$date');";
    mysqli_query($conn, $query);
    mysqli_close($conn);
}

function add_annonce($annonce){
   $query = "INSERT INTO `Annoncement` (author_id, matier_id, title, content, date) VALUES ($annonce[author_id], '$annonce[matier_id]', '$annonce[title]', '$annonce[content]', '$annonce[date]');";
}



// function getAuthorBy