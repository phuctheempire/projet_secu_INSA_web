<?php
require "../../controller/config.php";
require ROOT_PATH . DS . "controller" . DS . "api" . DS . "public" . DS . "forum.php";
include ROOT_PATH . DS . "components" . DS . "header.php";
require ROOT_PATH . DS . "components" . DS . "nav_bar.php";
?>
<body>
    <div class="container">
        <div class="card">
            <h1 class="card-title">Forum</h1>
            <form method="GET" action="forum.php">
            <h2 class="form-title">Recherche</h2> <!-- Added a title for the form -->
            <div class="form-group">
                <input type="text" name="recherche" placeholder="Enter what you want to search" class="form-input" id="recherche" required>
            </div>
            <button type="submit" name="search-btn" class="form-button">Search</button>
        </form>
            <?php if (isset($_GET["recherche"])){?>
                <h2>Resultat de recherche pour: <?php echo $_GET["recherche"] ?></h2>
            <?php } ?>
            <?php foreach ($posts as $post) { ?>
                <div class="post-card">
                    <h2 class="post-title"><?php echo $post['title']?></h2>
                    <h3 class="post-author"><?php echo $post['auth_nom']." ".$post['auth_prenom'] ?></h3>
                    <p class="post-date"><?php echo $post['date'] ?></p>
            <?php } ?>

        </div>
    </div>
</body>