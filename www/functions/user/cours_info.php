<?php

function getAnnonce( $cours_id){
    global $conn;
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
    global $conn;
    $query = "SELECT * FROM `Documents` WHERE matier_id = $cours_id ORDER BY date;";
    $result = mysqli_query($conn, $query);
    $documents = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $documents[] = $row;
    }
    
    mysqli_close($conn);
    return $documents;
}

function is_professeur($professeur, $matier){
    global $conn;
    $query = "SELECT * FROM `Classes` WHERE prof_id = $professeur AND matier_id = $matier";
    $result = mysqli_query($conn, $query);
    return ( mysqli_num_rows($result) > 0);
}