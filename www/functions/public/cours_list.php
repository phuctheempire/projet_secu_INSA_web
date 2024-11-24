<?php

function getCoursList() {
    // Your logic to fetch the list of courses
    $conn = mysqli_connect("localhost", "root", "root", DB_NAME);
    $query = "SELECT * FROM Matiere;";
    $result = mysqli_query($conn, $query);
    $courses = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $courses[] = $row;
    }
    mysqli_close($conn);
    return $courses;
}

?>