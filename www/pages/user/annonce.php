<?php
require "../../controller/config.php";
require ROOT_PATH . DS . "controller" . DS . "api" . DS . "user" . DS . "annonce.php";
include ROOT_PATH . DS . "components" . DS . "header.php";
require ROOT_PATH . DS . "components" . DS . "nav_bar.php";
?>

<body>
    <div class="container">
        <div class="card">
            <h2 id="annonces-title">Annonces</h2>
            <h3 class="annonce-title"><?php echo $annonce_info["title"]; ?></h3>
            <p class="annonce-content"><?php echo $annonce_info["content"]; ?></p>
            <p class="annonce-date"><?php echo $annonce_info["date"]; ?></p>

            <h2 id="comments-title">Comments</h2>
            <?php foreach ($comments as $comment) { ?>
                <div class="comment-box">
                    <h3 class="comment-author"><?php echo $comment["nom_author"] . " " . $comment["prenom_author"]; ?></h3>
                    <p class="comment-content"><?php echo $comment["content"]; ?></p>
                    <p class="comment-date"><?php echo $comment["date"]; ?></p>
                </div>
            <?php } ?>
        </div>
    </div>
</body>