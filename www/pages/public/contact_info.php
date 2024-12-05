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
            <?php while( $row = $result->fetch_assoc() ) { ?>
            <div class="contact-info-card">
                <h2 class="contact-info-name"><?php echo $row['nom']." ".$row['prenom'] ?></h2>
                <p class="contact-info-email">Email: <?php echo $row['email'] ?></p>
            </div>
            <?php } ?>
    </div>
</body>