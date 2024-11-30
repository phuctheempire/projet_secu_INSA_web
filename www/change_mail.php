function change_email($user_id, $new_email) {
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    // Échapper les variables pour éviter les injections SQL
    $user_id = mysqli_real_escape_string($conn, $user_id);
    $new_email = mysqli_real_escape_string($conn, $new_email);

    // Mettre à jour l'adresse email dans la base de données
    $query = "UPDATE Users SET email = '$new_email' WHERE id = '$user_id'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $message = "Email changé avec succès.";
    } else {
        $message = "Erreur lors du changement d'email : " . mysqli_error($conn);
    }

    mysqli_close($conn);
    return $message;
}
