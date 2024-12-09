<?php
function get_all_contact_info()
{
    global $conn;
    $query = "SELECT id, email, nom, prenom FROM Users;";
    $result = mysqli_query($conn, $query);
    return $result;
}


function get_contact_by_recherche($recherche)
{
    global $user1;
    $mots = explode(",", $recherche);
    $mots = array_map("trim", $mots);
    $queries = [];
    foreach ($mots as $mot) {
        $query = "SELECT id, nom, prenom, email from Users Where nom LIKE '%$mot%' OR prenom LIKE '%$mot%' OR email LIKE '%$mot%'";
        array_push($queries, $query);
    }
    $query = implode("; ", $queries);
    // var_dump(value: $query);
    $info = [];
    mysqli_multi_query($user1, $query);
    do {
        // var_dump("here");
        if ($result = mysqli_store_result($user1)) {
            while ($row = mysqli_fetch_assoc($result)) {
                array_push($info, $row);
                // var_dump($row);
            }
        }
    } while (mysqli_next_result($user1));
    return $info;
}