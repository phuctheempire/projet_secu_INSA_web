<?php
if (isset($_SESSION['user_id'])) {
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $user_id = $_SESSION['user_id'];
    // var_dump($user_id);
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
    if ($row['role'] == "Students") {
        $query = "SELECT * From Students WHERE id = $user_id LIMIT 1";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        $user_info["departement"] = $row['departement'];
        $user_info["promo"] = $row['promo'];
        $user_info["group_td"] = $row['group_td'];
        $user_info["group_tp"] = $row['group_tp'];
        $user_info["group_anglais"] = $row['group_anglais'];
    } else if ($row['role'] == "Professor") {
        $query = "SELECT * From Professeurs WHERE id = $user_id LIMIT 1";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        $user_info["departement"] = $row['departement'];
    } else {

    }
} else {
    header('location: /pages/public/login.php');
}