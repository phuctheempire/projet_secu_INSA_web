<?php
require "../../controller/config.php";
require ROOT_PATH . DS . "controller" . DS . "api" . DS . "user" . DS . "annonce.php";
include ROOT_PATH . DS . "components" . DS . "header.php";
require ROOT_PATH . DS . "components" . DS . "nav_bar.php";
?>

<body>
    <div class="container">
        <div class="card">
            <h1 class="page-title">Modifier Annonce</h1>
            <form action="annonce_edit.php?annonce_id=<?php echo $_GET['annonce_id'] ?>" method="POST">
                <div class="form-group">
                    <label for="title">Titre</label>
                    <input class="form-input" type="text" name="title" id="title" value="<?php echo $annonce_info['title']; ?>">
                </div>
                <div class="form-group">
                    <label for="content">Contenu</label>
                    <textarea class="form-textarea" name="content" id="content" cols="30" rows="10"><?php echo $annonce_info['content']; ?></textarea>
                </div>
                <button type="submit" class="btn-submit" name="mod_annonce">Sauvegarder</button>
                <button type="submit" class="btn-delete" name="del_annonce">Supprimmer</button>
        </div>
    </div>
</body>