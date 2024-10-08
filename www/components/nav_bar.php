<div id="navbar">
    <a id="a-link-header" href="/">
        <img src="https://www.aefinfo.fr/assets/medias/documents/4/4/448703_prv.jpeg" alt="School Icon" id="school-icon">
    </a>
    <div id="nav-left">
        <div class="nav_button"><a href="/pages/public/cours.php">Cours</a></div>
        <div class="nav_button"><a href="/pages/public/forum.php">Forum</a></div>
        <div class="nav_button"><a href="/pages/public/programs.php">Programs</a></div>
    </div>
    <div id="nav-right">
        <?php 
            if ( isset($_SESSION['user'])){
            ?>
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
