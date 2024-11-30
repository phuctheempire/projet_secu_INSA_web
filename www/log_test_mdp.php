<?php
// Connexion à la base de données
$servername = "db";
$username = "root";
$password = "root";
$dbname = "insa_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Échec de connexion : " . $conn->connect_error);
}

// Charger le dictionnaire
$dictionnaire = file("/var/www/html/dict1.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

// Récupérer les mots de passe des utilisateurs
$sql = "SELECT id, email, password FROM Users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $user_id = $row['id'];
        $email = $row['email'];
        $password = $row['password'];

        // Test avec le dictionnaire
        $is_weak = false;
        foreach ($dictionnaire as $word) {
            // Vérification pour les mots de passe non hachés
            if ($word === $password) {
                echo "Mot de passe faible (non haché) trouvé pour l'utilisateur $email (ID: $user_id): $word\n";
                $is_weak = true;
                break;
            }

            // Vérification pour les mots de passe hachés
            if (password_verify($word, $password)) {
                echo "Mot de passe faible (haché) trouvé pour l'utilisateur $email (ID: $user_id): $word\n";
                $is_weak = true;
                break;
            }
        }

        if (!$is_weak) {
            echo "Mot de passe robuste pour l'utilisateur $email (ID: $user_id)\n";
        }
    }
} else {
    echo "Aucun utilisateur trouvé.";
}

// Fermer la connexion
$conn->close();
?>
