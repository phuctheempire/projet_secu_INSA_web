
<?php
$servername = "db";        // Nom du service MySQL défini dans docker-compose.yml
$username = "root";        // Utilisateur défini dans environment
$password = "test";        // Mot de passe défini
$dbname = "insa_db";       // Nom de la base de données cible

// Connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}
echo "Connexion réussie à la base de données insa_db !\n";
?>
