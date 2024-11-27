<?php
require "../../controller/config.php";
require ROOT_PATH . DS . "controller" . DS . "api" . DS . "admin" . DS . "ad_user.php";
include ROOT_PATH . DS . "components" . DS . "header.php";
require ROOT_PATH . DS . "components" . DS . "nav_bar.php";

// Fetch all users
$users = getAllUsers();
?>

<body>
    <div class="container">
        <h1 class="page-title">Admin - Manage Users</h1> <!-- Page Title -->
        <div class="users-list">
            <?php foreach ($users as $user) { ?>
                <div class="card user-card">
                    <div class="user-image">
                        <img src="<?php echo $user["profile_image"] ?? '/assets/images/default_user.jpg'; ?>" alt="User Image">
                    </div>
                    <h2 class="user-fullname"><?php echo $user["nom"] . " " . $user["prenom"]; ?></h2>
                    <p class="user-info">ID: <?php echo $user["id"]; ?></p>
                    <p class="user-info">Email: <?php echo $user["email"]; ?></p>
                    <p class="user-info">Role: <?php echo $user["role"]; ?></p>
                    <a href="user_edit.php?id=<?php echo $user["id"]; ?>" class="btn-modify">Modify</a> <!-- Link to edit page -->
                </div>
            <?php } ?>
        </div>
    </div>
</body>
