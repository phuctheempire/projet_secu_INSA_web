<?php
// Configuration de la connexion MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nom_de_ta_base";

// Connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Échec de connexion : " . $conn->connect_error);
}

// Récupération des données de la table Log
$sql = "SELECT * FROM Log";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Ouvrir un fichier en mode écriture
    $file = fopen("log_export.txt", "w");
    
    // Écrire les données dans le fichier
    while ($row = $result->fetch_assoc()) {
        $line = implode(" | ", $row) . "\n"; // Séparer les colonnes par " | "
        fwrite($file, $line);
    }
    fclose($file);
    echo "Données exportées avec succès dans 'log_export.txt'";
} else {
    echo "Aucune donnée à exporter.";
}

// Fermer la connexion
$conn->close();
?>
