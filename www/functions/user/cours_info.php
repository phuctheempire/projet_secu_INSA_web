<?php

function getAnnonce( $cours_id){
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $query = "SELECT * FROM `Annoncement` WHERE matier_id = $cours_id ORDER BY date;";
    $result = mysqli_query($conn, $query);
    $annonces = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $annonces[] = $row;
    }
    // var_dump($annonces);
    mysqli_close($conn);
    return $annonces;
}

function getDocuments( $cours_id){
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $query = "SELECT * FROM `Documents` WHERE matier_id = $cours_id ORDER BY date;";
    $result = mysqli_query($conn, $query);
    $documents = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $documents[] = $row;
    }
    
    mysqli_close($conn);
    return $documents;
}

function is_professeur($matier_id, $prof_id){
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $query = "SELECT * FROM `Classes` WHERE prof_id = $prof_id AND matier_id = $matier_id ;";
    $result = mysqli_query($conn, $query);
    if ( mysqli_num_rows($result) > 0){
        return true;
    }else{
        return false;
    }
}