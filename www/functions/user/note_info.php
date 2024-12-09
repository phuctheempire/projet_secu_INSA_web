<?php

function get_notes_by_cours( $cours_id ) {
    global $conn;
    $sql = "SELECT id, nom, prenom, note  FROM `Cours_info` JOIN `Users` WHERE matier_id = $cours_id and Cours_info.stu_id = Users.id;";
    $result = mysqli_query($conn, $sql);
    $notes = array();
    if ($result) {
        while ($row = mysqli_fetch_array($result)) {
            array_push($notes, $row);
        }
    }
    return $notes;
}

function mod_notes( $cours_id, $user_id, $note){
    global $conn;
    $sql = "UPDATE `Cours_info` SET note = $note WHERE matier_id = $cours_id and stu_id = $user_id;";
    $result = mysqli_query($conn, $sql);
    return $result;
}



?>