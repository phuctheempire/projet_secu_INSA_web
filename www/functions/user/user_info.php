<?php

function getUserInfo($user_id) {
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $query = "SELECT nom, prenom, email, sexe, date_naissance, adresse, telephone, image_path, role From Users WHERE id = $user_id LIMIT 1";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $user_info = array(
        "nom" => $row['nom'],
        "prenom" => $row['prenom'],
        "email" => $row['email'],
        "sexe" => $row['sexe'],
        "date_naissance" => $row['date_naissance'],
        "adresse" => $row['adresse'],
        "telephone" => $row['telephone'],
        "image_path" => $row['image_path'],
        "role" => $row['role']
    );
    mysqli_close($conn);
    return $user_info;
}