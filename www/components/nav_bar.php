<div id="navbar">
    <a id="a-link-header" href="/">
        <img src="https://www.aefinfo.fr/assets/medias/documents/4/4/448703_prv.jpeg" alt="School Icon" id="school-icon">
    </a>
    <div id="nav-left">
        <div class="nav_button"><a href="/pages/public/cours.php">Cours</a></div>
        <div class="nav_button"><a href="/pages/public/forum.php">Forum</a></div>
        <div class="nav_button"><a href="/pages/public/contact_info.php">Contact info</a></div>
    </div>
    <div id="nav-right">
        <?php 
            if ( isset($_SESSION['user_id'])){
            ?>  
                <div class="nav_button"><a href="/pages/user/mail.php?id=<?php echo $_SESSION["user_id"];?>">Mail Box</a></div>
                <div class="nav_button"><a href="/pages/user/user_page.php?id=<?php echo $_SESSION["user_id"];?>">Gestion de compte</a></div>
                <?php if( $_SESSION['user_role'] == "Student"){ ?> 
                <div class="nav_button"><a href="/pages/user/note.php">Mes notes</a></div>
                <?php } ?>
                <div class="nav_button"><a href="/controller/sess_destroy.php">Logout</a></div>
            <?php
            }
            else{?>
                <div class="nav_button"><a href="/pages/public/register.php">Register</a></div>
                <div class="nav_button"><a href="/pages/public/login.php">Login</a></div>
            <?php
            }
        ?>

    </div>
</div>
