<?php
require "../../controller/config.php";
require ROOT_PATH . DS . "controller" . DS . "api" . DS . "admin" . DS . "ad_user.php";
include ROOT_PATH . DS . "components" . DS . "header.php";
require ROOT_PATH . DS . "components" . DS . "nav_bar.php";
?>

<body>
    <div class="container">
        <h1 class="page-title">Edit User Information</h1>
        <form action="user_edit.php?id=<?php echo $user['id']; ?>" method="POST">
            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">

            <label for="nom">Nom:</label>
            <input type="text" id="nom" name="nom" value="<?php echo $user['nom']; ?>" required>

            <label for="prenom">Prenom:</label>
            <input type="text" id="prenom" name="prenom" value="<?php echo $user['prenom']; ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" value="<?php echo $user['password']; ?>">

            <label for="role">Role:</label>
            <select id="role" name="role" required>
                <option value="Student" <?php echo $user['role'] === 'Student' ? 'selected' : ''; ?>>Student</option>
                <option value="Professor" <?php echo $user['role'] === 'Professor' ? 'selected' : ''; ?>>Teacher</option>
            </select>

            <label for="sexe">Gender:</label>
            <input type="text" id="sexe" name="sexe" value="<?php echo $user['sexe']; ?>">

            <label for="date_naissance">Date of Birth:</label>
            <input type="date" id="date_naissance" name="date_naissance" value="<?php echo $user['date_naissance']; ?>">

            <label for="adresse">Address:</label>
            <input type="text" id="adresse" name="adresse" value="<?php echo $user['adresse']; ?>">

            <label for="telephone">Phone:</label>
            <input type="text" id="telephone" name="telephone" value="<?php echo $user['telephone']; ?>">

            <label for="image_path">Image Path:</label>
            <input type="text" id="image_path" name="image_path" value="<?php echo $user['image_path']; ?>">

            <button type="submit" class="btn-save" name="save_btn">Save</button>
        </form>

        <?php if (isset($error_message)) { ?>
            <p class="error-message"><?php echo $error_message; ?></p>
        <?php } ?>
    </div>
</body>