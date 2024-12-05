<?php
function get_all_contact_info() {
    $conn = mysqli_connect("localhost", "root", "root", DB_NAME);
    $query = "SELECT id, email, nom, prenom FROM Users;";
    $result = mysqli_query($conn, $query);
    return $result;
}