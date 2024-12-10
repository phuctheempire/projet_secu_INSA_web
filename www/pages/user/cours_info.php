<?php
require "../../controller/config.php";
require ROOT_PATH . DS . "controller" . DS . "api" . DS . "user" . DS . "cours_info.php";
include ROOT_PATH . DS . "components" . DS . "header.php";
require ROOT_PATH . DS . "components" . DS . "nav_bar.php";
?>
<body>
    <div class="container">
        <div class="card">
            <h2 id="annonces-title">Gestion des cours</h2>
            <h3 class="section-title" >Annonces</h3>
            <?php foreach ($annonces as $annonce) { ?>
                <a href="annonce.php?annonce_id=<?php echo $annonce["annon_id"] ?>" style="text-decoration:none">
                    <div class="annonce-box">
                        <h3 class="annonce-title"><?php echo $annonce["title"]; ?></h3>
                        <p class="annonce-content"><?php echo $annonce["content"]; ?></p>
                        <p class="annonce-date"><?php echo $annonce["date"]; ?></p>
                        <?php if ( $_SESSION['user_role'] == 'Professor' and is_professeur($_SESSION['user_id'],$_GET['cours_id'])){ 
                            // var_dump($_SESSION['user_id'], $_GET['cours_id'])
                            ?>
                            <a href="annonce_edit.php?annonce_id=<?php echo $annonce["annon_id"] ?>" class="btn-modify">Modifier annonce</a> 
                            <?php } ?>
                        
                    </div>
                </a>
                <?php } ?>
                <?php if ( $_SESSION['user_role'] == 'Professor' and is_professeur($_SESSION['user_id'],$_GET['cours_id'])){ 
                            // var_dump($_SESSION['user_id'], $_GET['cours_id'])
                            ?>
                <a href="annonce_add.php?cours_id=<?php echo $_GET['cours_id']?>" class="btn-modify">Ajoute un annonce</a>
                <?php } ?>
            <?php if ( $_SESSION['user_role'] == 'Professor' and is_professeur($_SESSION['user_id'],$_GET['cours_id'])){ 
                            // var_dump($_SESSION['user_id'], $_GET['cours_id'])
                            ?>
                            <h3 class="section-title">Notes</h3>
                            <a href="note_info.php?cours_id=<?php echo $_GET['cours_id'] ?>" class="btn-modify">Gestion des notes</a> 
            <?php } ?>
        </div>
    </div>
</body>