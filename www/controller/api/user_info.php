<?php
include_once ROOT_PATH . DS . "functions" . DS . "admin" . DS . "admin_functions.php";
// require ROOT_PATH . DS . "controller" . DS . "config.php";

if ( isset($_GET['error'])){

} else{
if (isset($_SESSION['user_id'])) {
    $user_id = $_GET['id'];
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $query = "SELECT nom, prenom, email, sexe, date_naissance, adresse, telephone, image_path, role From Users WHERE id = $user_id LIMIT 1";
    try {
        $result = mysqli_query($conn, $query);
        // echo "<h2>".$result."</h2>";
    } catch (Exception $e) {
        header('location: /pages/user/user_page.php?error=1');
    }
        $row = mysqli_fetch_assoc($result);
        if ( !$row){
            header('location: /pages/user/user_page.php?error=1');
        }
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
        if ($row['role'] == "Student") {
            $query = "SELECT * From Students WHERE stu_id = $user_id LIMIT 1";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            $user_info["departement"] = $row['departement'];
            $user_info["promo"] = $row['promo'];
            $user_info["group_td"] = $row['group_td'];
            $user_info["group_tp"] = $row['group_tp'];
            $user_info["group_anglais"] = $row['group_anglais'];
        } else if ($row['role'] == "Professor") {
            $query = "SELECT * From Professeurs WHERE prof_id = $user_id LIMIT 1";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            $user_info["departement"] = $row['departement'];

    }
} else {
    header('location: /pages/public/login.php');
}
}

if (isset($_POST['change-info'])) {
    $user_id = $_SESSION['user_id'];
    // echo "<h2> User ID: " . $user_id . "</h2>";
    $nom = ($_POST['nom']);
    $prenom = ($_POST['prenom']);
    $email = ($_POST['email']);
    $sexe = ($_POST['sexe']);
    $date_naissance = ($_POST['date_naissance']);
    $adresse = ($_POST['adresse']);
    $telephone = ($_POST['telephone']);
    // Validate form inputs
    // Check if username or email already exists
    $sql = "UPDATE Users SET email = '$email', nom = '$nom', prenom = '$prenom', sexe = '$sexe', date_naissance = '$date_naissance', adresse = '$adresse', telephone = '$telephone' WHERE id = '$user_id';";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $_SESSION['message'] = "User info updated successfully";
        header('location: /pages/user/user_page.php?id=' . $user_id);
        // exit();
    } else {
        // array_push($errors, "Failed to update user info");
        // die("Database Query Failed: " . mysqli_error($conn));
    }

}

if (isset($_GET['change_email'])) {
    $new_email = $_GET['new_email'];
    $user_id = $_GET['id']; // ID de l'utilisateur connecté (présumé dans l'URL)
    // Appeler la fonction pour changer l'email
    $message = change_email($user_id, $new_email);
    echo "<p>$message</p>";
}


// If no errors, register user

?>