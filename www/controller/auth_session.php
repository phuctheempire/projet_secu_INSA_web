<?php
// variable declaration
$username = "";
$email = "";
$errors = array();

if (isset($_POST['login_btn'])) {
    $email = ($_POST['email']);
    $password = ($_POST['password']);
    if (empty($email)) {
        array_push($errors, "Email required");
    }
    if (empty($password)) {
        array_push($errors, "Password required");
    }
    if (empty($errors)) {
        $sql = "CALL login('$email', '$password')";
        $result = mysqli_query($conn, $sql);
        // var_dump($result);
        // echo mysqli_num_rows($result);
        if (mysqli_num_rows($result) > 0) {
            // get id of created user
            $reg_user_id = mysqli_fetch_assoc($result)['id'];
            // die();
            // put logged in user into session array
            $_SESSION['user_id'] = $reg_user_id;
            // if user is admin, redirect to admin area
            // redirect to public area
            header('location: /pages/user/user_page.php?id='.urlencode($reg_user_id));
            exit(0);
        } else {
            array_push($errors, 'Wrong credentials');
        }
    }
}

if (isset($_POST['register_btn'])) {
    // Get form inputs]
    $nom = strtoupper($_POST['nom']);
    $prenom = ($_POST['prenom']);
    $email = ($_POST['email']);
    $departement = ($_POST['departement']);
    $sexe = ($_POST['sexe']);
    $date_naissance = ($_POST['date_naissance']);
    $adresse = ($_POST['adresse']);
    $telephone = ($_POST['telephone']);
    $annee = ($_POST['annee']);
    $password1 = ($_POST['password1']);
    $password2 = ($_POST['password2']);

    // Validate form inputs
    if (empty($nom)) { array_push($errors, "Nom required"); }
    if (empty($prenom)) { array_push($errors, "Prenom required"); }
    if (empty($email)) { array_push($errors, "Email required"); }
    if (empty($departement)) { array_push($errors, "Departement required"); }
    if (empty($sexe)) { array_push($errors, "Sexe required"); }
    if (empty($date_naissance)) { array_push($errors, "Date de Naissance required"); }
    if (empty($adresse)) { array_push($errors, "Adresse required"); }
    if (empty($telephone)) { array_push($errors, "Telephone required"); }
    if (empty($annee)) { array_push($errors, "Annee required"); }
    if (empty($password1)) { array_push($errors, "Password required"); }
    if (empty($password2)) { array_push($errors, "Password confirmation required"); }
    if ($password1 != $password2) { array_push($errors, "Passwords do not match"); }

    // Check if username or email already exists
    $user_check_query = "SELECT * FROM students WHERE email='$email' LIMIT 1";
    $result = mysqli_query($conn, $user_check_query);

    if ($user) { // If user exists
        if ($user['email'] === $email) {
            array_push($errors, "Email already exists");
        }
    }

    // If no errors, register user
    if (empty($errors)) {
        $password = md5($password1); // Encrypt password before saving in database
        $img = $nom."_".strtolower(str_replace(" ", "_", $prenom)).".jpg";
        $query = "CALL insert_student('$email', '$password', '$nom', '$prenom' , '$sexe','$date_naissance','$adresse', '$telephone' , '$img' ,  '$departement' ,  '$annee' );";
        mysqli_query($conn, $query);

        // // Get the ID of the newly registered user
        // $reg_id = mysqli_insert_id($conn);

        // Set user information in session
        // $_SESSION['user'] = getUserById($reg_id);

        // Redirect user based on role
        // if ($_SESSION['user']['role'] == "Admin") {
        //     header('location: dashboard.php');
        // } else {
        header('location: /index.php');
        // }
        exit();
    }
}

function getUserById($id)
{
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    // global $conn;
    $sql = "SELECT * FROM Users WHERE id=$id"; //requête qui récupère le user et son rôle
    $result = mysqli_query($conn, $sql) ;//la fonction php-mysql
    $user = mysqli_fetch_assoc($result) ;//je met $result au format associatif
    return $user;
}

?>