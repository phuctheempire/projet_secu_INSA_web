<?php
function get_post_by_id( $post_id ) {
    global $conn;
    $query = "SELECT * FROM `Posts` WHERE post_id = $post_id;";
    $row = mysqli_fetch_assoc(mysqli_query($conn, $query));
    return $row;
}

function getComments($post_id) {
    global $conn;
    $query = "SELECT c.cmt_id AS cmt_id, c.author_id AS author_id, 
    c.post_id AS post_id, c.content AS content , c.date AS `date`, 
    u.nom AS nom_author, u.prenom AS prenom_author 
    FROM `Cmt_post` c JOIN `Users` u
    WHERE post_id = $post_id AND c.author_id = u.id 
    ORDER BY date;";
    $result = mysqli_query($conn, $query);
    $comments = array();
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($comments, $row);
    }
    return $comments;
}

function commit_cmt( $comment){
    global $conn;
    $query = "INSERT INTO `Cmt_post` (author_id, post_id, content, date) VALUES ($comment[author_id], $comment[post_id], '$comment[content]', '$comment[date]');"; ;
    $result = mysqli_query($conn, $query);
    return $result;
}

function add_post( $post){
    global $conn;
    $query = "INSERT INTO `Posts` (author_id, title, content, date) VALUES ($post[author_id], '$post[title]', '$post[content]', '$post[date]');";
    $result = mysqli_query($conn, $query);
    return $result;
}

function remove_post( $post_id ){
    global $conn;
    $query2 = "DELETE FROM `Cmt_post` WHERE post_id = $post_id;";
    $result2 = mysqli_query($conn, $query2);
    $query = "DELETE FROM `Posts` WHERE post_id = $post_id;";
    $result = mysqli_query($conn, $query);
    return $result;
}

function modify_post( $post ){
    global $conn;
    $query = "UPDATE `Posts` SET title = '$post[title]', content = '$post[content]', date = '$post[date]' WHERE post_id = $post[post_id];";
    $result = mysqli_query($conn, $query);
    return $result;
}


