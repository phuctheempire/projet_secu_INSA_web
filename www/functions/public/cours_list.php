<?php

function getCoursList() {
    // Your logic to fetch the list of courses
    global $conn;
    $query = "SELECT * FROM Matiere;";
    $result = mysqli_query($conn, $query);
    $courses = array();
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($courses, $row);
    }
    return $courses;
}

// function getCoursById($id) {
//     $conn = mysqli_connect("localhost", "root", "root", DB_NAME);
//     $query = "SELECT * FROM Matiere WHERE matier_id = $id LIMIT 1;";
//     $result = mysqli_query($conn, $query);
//     $row = mysqli_fetch_assoc($result);
//     return $row;
// }

?>