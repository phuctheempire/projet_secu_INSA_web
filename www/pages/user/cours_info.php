<?php
require "../../controller/config.php";
require ROOT_PATH . DS . "controller" . DS . "api" . DS . "user" . DS . "cours_info.php";
include ROOT_PATH . DS . "components" . DS . "header.php";
require ROOT_PATH . DS . "components" . DS . "nav_bar.php";
?>
<body>
    <div class="container">
        <div class="card">
            <h2 id="annonces-title">Annonces</h2>
            <?php foreach ($annonces as $annonce) { ?>
                <a href="annonce.php?annonce_id=<?php echo $annonce["annon_id"] ?>" style="text-decoration:none">
                    <div class="annonce-box">
                        <h3 class="annonce-title"><?php echo $annonce["title"]; ?></h3>
                        <p class="annonce-content"><?php echo $annonce["content"]; ?></p>
                        <p class="annonce-date"><?php echo $annonce["date"]; ?></p>
                    </div>
                </a>
            <?php } ?>
        </div>
        <div class="card">
            <h2 class="documents-title">Documents</h2>
            <div class="document-box">
                <h3 class="document-title">TP1</h3>
                <a href="/assets/documents/TP1.pdf" class="document-link">TP1</a>
            </div>
            <div class="document-box">
                <h3 class="document-title">TP2</h3>
                <a href="/assets/documents/TP2.pdf" class="document-link">TP2</a>
            </div>
            <div class="document-box">
                <h3 class="document-title">TP3</h3>
                <a href="/assets/documents/TP3.pdf" class="document-link">TP3</a>
            </div>
            <div class="document-box">
                <h3 class="document-title">TP4</h3>
                <a href="/assets/documents/TP4.pdf" class="document-link">TP4</a>
            </div>
            <div class="document-box">
                <h3 class="document-title">TP5</h3>
                <a href="/assets/documents/TP5.pdf" class="document-link">TP5</a>
            </div>
        </div>


    </div>
</body>