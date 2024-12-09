<?php

function get_all_notes_by_id($id) {
    global $conn;
    $query = "SELECT note, nom  FROM Cours_info c JOIN Matiere m WHERE stu_id = $id AND c.matier_id = m.matier_id";
    $result = mysqli_query($conn,$query);
    $notes = array();
    while($row = mysqli_fetch_array($result)) {
        array_push($notes, $row);
    }
    return $notes;
}


