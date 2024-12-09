<?php
require "../../controller/config.php";
require ROOT_PATH . DS . "controller" . DS . "api" . DS . "user" . DS . "annonce.php";
include ROOT_PATH . DS . "components" . DS . "header.php";
require ROOT_PATH . DS . "components" . DS . "nav_bar.php";
?>

<body>
    <div class="container">
        <div class="card">
            <h1 class="page-title">Add Annonce</h1>
            <form action="annonce_add.php?cours_id=<?php echo $_GET['cours_id'] ?>" method="POST">
                <div class="form-group">
                    <label for="title">Titre</label>
                    <input class="form-input" type="text" name="title" id="title" value="">
                </div>
                <div class="form-group">
                    <label for="content">Contenu</label>
                    <textarea class="form-textarea" name="content" id="content" cols="30" rows="10"></textarea>
                </div>
                <button type="submit" class="btn-submit" name="add_annonce_btn">Ajouter annonce</button>
        </div>
    </div>
</body>