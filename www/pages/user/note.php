<?php
require "../../controller/config.php";
require ROOT_PATH . DS . "controller" . DS . "api" . DS . "user" . DS . "note.php";
include ROOT_PATH . DS . "components" . DS . "header.php";
require ROOT_PATH . DS . "components" . DS . "nav_bar.php";
?>

<body>
    <div class="container">
        <div class="card">
            <h1 class="page-title">Mes notes</h1>
            <?php foreach ( $notes as $note ) { ?>
            <div class = note-card>
            <p class=name-class><?php echo $note['nom'];?></p>
            <p class=note><?php echo $note['note'] ?></p>
            </div>
            <?php } ?>
        </div>
    </div>
</body>