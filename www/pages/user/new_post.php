<?php
require "../../controller/config.php";
require ROOT_PATH . DS . "controller" . DS . "api" . DS . "user" . DS . "post.php";
include ROOT_PATH . DS . "components" . DS . "header.php";
require ROOT_PATH . DS . "components" . DS . "nav_bar.php";
?>


<body>
    <div class="container">
        <div class="card">
            <h1 class="page-title">New Post</h1>
            <form action="new_post.php?" method="POST">
                <div class="form-group">
                    <label for="title">Titre</label>
                    <input class="form-input" type="text" name="title" id="title" value="<?php echo $post['title']; ?>">
                </div>
                <div class="form-group">
                    <label for="content">Contenu</label>
                    <textarea class="form-textarea" name="content" id="content" cols="30" rows="10"><?php echo $post['content']; ?></textarea>
                </div>
                <button type="submit" class="btn-submit" name="add_post">Sauvegarder</button>
            </form>
        </div>
    </div>
</body>