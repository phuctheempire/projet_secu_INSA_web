<?php
require "../../controller/config.php";
require ROOT_PATH . DS . "controller" . DS . "api" . DS . "public" . DS . "contact_info.php";
include ROOT_PATH . DS . "components" . DS . "header.php";
require ROOT_PATH . DS . "components" . DS . "nav_bar.php";
?>

<body>
    <div class="container">
        <div class="card">
            <h1 class="card-title">Contact Informations</h1>
            <form method="GET" action="contact_info.php">
                <h2 class="form-title">Recherche d'information</h2> <!-- Added a title for the form -->
                <div class="form-group">
                    <input type="text" name="recherche_info" placeholder="Enter who you want to search" class="form-input"
                        id="recherche" required>
                </div>
                <button type="submit" name="search-btn" class="form-button">Search</button>
            </form>
            <?php if (isset($_GET["recherche_info"])){?>
                <h2>Resultat de recherche pour: <?php echo $_GET["recherche_info"] ?></h2>
            <?php } ?>
            <?php foreach ( $result as $row) { ?>
                <div class="contact-info-card">
                    <h2 class="contact-info-name"><?php echo $row['nom'] . " " . $row['prenom'] ?></h2>
                    <p class="contact-info-email">Email: <?php echo $row['email'] ?></p>
                </div>
            <?php } ?>
        </div>
</body>