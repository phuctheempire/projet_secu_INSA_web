<?php


function getAnnonceById( $annonce_id){
    global $conn;
    $query = "SELECT * FROM `Annoncement` WHERE annon_id = $annonce_id LIMIT 1;";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    // var_dump($annonces);
    return $row;
}

function getComments( $annonce_id){
    global $conn;
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
    
    return $comments;
}

function commit_comment($user_id, $annonce_id, $content, $date){
    global $conn;
    $query = "INSERT INTO `Comments` (author_id, annon_id, content, date) VALUES ($user_id, $annonce_id, '$content', '$date');";
    $result = mysqli_query($conn, $query);
    return $result;
}

function add_annonce($annonce){
    $query = "INSERT INTO `Annoncement` (author_id, matier_id, title, content, date) VALUES ($annonce[author_id], '$annonce[matier_id]', '$annonce[title]', '$annonce[content]', '$annonce[date]');";
    // var_dump($query);
    global $conn;
    $result = mysqli_query($conn, $query);
    return ($result);
}

function remove_annonce($annonce_id){
    global $conn;
    $query = "DELETE FROM `Annoncement` WHERE annon_id = $annonce_id;";
    $result = mysqli_query($conn, $query);
    $query2 = "DELETE FROM `Comments` WHERE annon_id = $annonce_id;";
    $result2 = mysqli_query($conn, $query2);
    return ($result);
}

function modify_annonce($annonce){
    global $conn;
    $query = "UPDATE `Annoncement` SET title = '$annonce[title]', content = '$annonce[content]', date = '$annonce[date]' WHERE annon_id = $annonce[annon_id];";
    $result = mysqli_query($conn, $query);
    return ($result);
}



function get_matier_id_by_annonce($annonce_id){
    global $conn;
    $query = "SELECT matier_id FROM `Annoncement` WHERE annon_id = '$annonce_id';";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['matier_id'];
}

function get_prof_id_by_matier($cours_id){
    global $conn;
    $query = "SELECT prof_id FROM `Classes` WHERE matier_id = $cours_id ;";
    $result = mysqli_query($conn, $query);
    if ($result){
        $row = mysqli_fetch_assoc($result);
        return $row["prof_id"];
    }else{
        return null;
    }
}

function is_professeur($professeur, $matier){
    global $conn;
    $query = "SELECT * FROM `Classes` WHERE prof_id = $professeur AND matier_id = $matier";
    $result = mysqli_query($conn, $query);
    return ( mysqli_num_rows($result) > 0);
}
// function getAuthorBy