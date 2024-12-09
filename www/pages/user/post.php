<?php
require "../../controller/config.php";
require ROOT_PATH . DS . "controller" . DS . "api" . DS . "user" . DS . "post.php";
include ROOT_PATH . DS . "components" . DS . "header.php";
require ROOT_PATH . DS . "components" . DS . "nav_bar.php";
?>
<body>
    <div class="container">
        <div class="card">
            <h2 id="annonces-title">Post</h2>
            <h3 class="annonce-title"><?php echo $post["title"]; ?></h3>
            <p class="annonce-content"><?php echo $post["content"]; ?></p>
            <p class="annonce-date"><?php echo $post["date"]; ?></p>
            <?php if( $post['author_id'] == $_SESSION['user_id']){ ?>
                <a href="mod_post.php?post_id=<?php echo $_GET['post_id'] ?>" class="btn-modify">Modifier post</a>
            <?php } ?>
            <h2 id="comments-title">Comments</h2>
            <?php foreach ($comments as $comment) { ?>
                <div class="comment-box">
                    <h3 class="comment-author"><?php echo $comment["nom_author"] . " " . $comment["prenom_author"]; ?></h3>
                    <p class="comment-content"><?php passthru("echo ". $comment["content"]) ?></p>
                    <p class="comment-date"><?php echo $comment["date"]; ?></p>
                </div>
            <?php } ?>
            <h3 class="comments-title">Écrire votre commentaires</h3>
            <form action="post.php?post_id=<?php echo $_GET['post_id'];?>" class="comment-form" method="post">
                <div class="form-cmt">
                    <input type="text" oninput="show_button()" name="content" id="content" value=""
                        placeholder="Entrez votre commentaire" class="form-input">
                </div>
                
                <button type="submit" name="submit_cmt" class="form-button" id="submit_cmt" style="display:none; margin-top: 10px;">Comment</button>
            </form>
        </div>
    </div>
    <script>
        function show_button() {
            const content = document.getElementById('content');
            const submit_cmt = document.getElementById('submit_cmt');
            // Show submit button only when there's content in the input
            content.addEventListener('input', function () {
                if (content.value.trim()) {
                    submit_cmt.style.display = 'inline-block'; // Show button
                } else {
                    submit_cmt.style.display = 'none'; // Hide button
                }
            });
        }
    </script>
</body>