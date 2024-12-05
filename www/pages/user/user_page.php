<?php
require "../../controller/config.php";
require ROOT_PATH . DS . "controller" . DS . "api" . DS . "user_info.php";
include ROOT_PATH . DS . "components" . DS . "header.php";
require ROOT_PATH . DS . "components" . DS . "nav_bar.php";
?>


<body>
    <div class="container">
        <?php
        if (isset($_GET['error'])){ ?>
            <h2> Can't access to user <?php echo $user_id?> </h2>
        <?php } else { ?>
        <div class="card" id="user-profile-1">
            <h1 class="page-title">User Profile</h1> <!-- Added Page Title -->
            <div class="user-image" id="user-image">
                <img src="/assets/images/PHAM_Xuan_Phuc.jpg" alt="User Image">
            </div>
            <h2 class="user-fullname" id="user-fullname"><?php echo $user_info["nom"]." ".$user_info["prenom"]; ?></h2>
            <p class="user-info" id="user-id">ID: <?php echo $_GET["id"]?></p>
            <p class="user-info" id="user-email">Email: <?php echo $user_info["email"] ?> </p>
            <p class="user-info" id="user-role">Role: <?php echo $user_info["role"] ?></p>
            <p class="user-info" id="user-gender">Gender: <?php echo $user_info["sexe"] ?></p>
            <p class="user-info" id="user-birthdate">Date of Birth: <?php echo $user_info["date_naissance"] ?></p>
            <p class="user-info" id="user-address">Address: <?php echo $user_info["adresse"] ?></p>
            <p class="user-info" id="user-phone">Phone: <?php echo $user_info["telephone"] ?></p>
            <?php if ($user_info["role"] == "Student") { ?>
                <p class="user-info" id="user-departement">Department: <?php echo $user_info["departement"] ?></p>
                <p class="user-info" id="user-promo">Promo: <?php echo $user_info["promo"] ?></p>
                <p class="user-info" id="user-group-td">Group TD: <?php echo $user_info["group_td"] ?></p>
                <p class="user-info" id="user-group-tp">Group TP: <?php echo $user_info["group_tp"] ?></p>
                <p class="user-info" id="user-group-anglais">Group Anglais: <?php echo $user_info["group_anglais"] ?></p>
            <?php } elseif ($user_info["role"] == "Teacher") {?>
                <p class="user-info" id="user-departement">Department: <?php echo $user_info["departement"] ?></p>
            <?php } else {} ?>    
            <a href="user_mod.php?id=<?php echo $_GET["id"]?>" class="btn-modify">Modify User</a> <!-- Added Button -->
        </div>
        <?php } ?>
    </div>
</body>
