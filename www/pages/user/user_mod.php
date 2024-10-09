<?php
require "../../controller/config.php";
require ROOT_PATH . DS . "controller" . DS . "api" . DS . "user_info.php";
include ROOT_PATH . DS . "components" . DS . "header.php";
require ROOT_PATH . DS . "components" . DS . "nav_bar.php";
?>

<body>
<div class="container">
    <div class="card" id="user-profile-1">
        <h1 >Modify User Information</h1>
    <form action="/pages/user/user_mod.php" method="POST">
        
        <div class="form-group">
            <label for="nom">Full Name:</label>
            <input class="form-input" type="text" id="fullname" name="fullname" placeholder="Enter your full name" value="<?php echo $user_info["nom"] ?>" required>
        </div>

        <div class="form-group">
            <label for="prenom">First Name:</label>
            <input class="form-input" type="text" id="firstname" name="firstname" placeholder="Enter your first name" value="<?php echo $user_info["prenom"] ?>" required>
        </div>
        
        <div class="form-group">
            <label for="email">Email:</label>
            <input class="form-input" type="email" name="email" placeholder="Enter your email" value="<?php echo $user_info["email"] ?>" required>
        </div>
        
        <div class="form-group">
            <label for="role">Role:</label>
            <div  id="role" name="role"><?php echo $user_info["role"]?></div> 
        </div>

        <div class="form-group">
            <label for="gender">Gender:</label>
            <select class="form-select" id="gender" name="gender" required>
                <option value="<?php echo $user_info["sexe"] ?>" disabled selected><?php echo $user_info["sexe"] ?></option>
                <option value="M">Male</option>
                <option value="F">Female</option>
                <option value="O">Other</option>
            </select>
        </div>

        <div class="form-group">
            <label for="birthdate">Date of Birth:</label>
            <input class="form-input" type="date" id="birthdate" name="birthdate" value="<?php echo $user_info["date_naissance"] ?>" required>
        </div>

        <div class="form-group">
            <label for="address">Address:</label>
            <input class="form-input" type="text" id="address" name="address" placeholder="Enter your address" value="<?php echo $user_info["adresse"] ?>" required>
        </div>

        <div class="form-group">
            <label for="phone">Phone:</label>
            <input class="form-input" type="tel" id="phone" name="phone" placeholder="Enter your phone number" value="<?php echo $user_info["telephone"] ?>" required>
        </div>
        <?php if ($user_info["role"] == "Student") { ?>
        <div class="form-group">
            <label for="departement">Departement:</label>
            <div  id="role" name="role"><?php echo $user_info["departement"]?></div> 
        </div>

        <div class="form-group">
            <label for="promo">Promotion:</label>
            <div  id="role" name="role"><?php echo $user_info["promo"]?></div> 
        </div>

        <div class="form-group">
            <label for="group_td">Group TD:</label>
            <div  id="role" name="role"><?php echo $user_info["group_td"]?></div> 
        </div>

        <div class="form-group">
            <label for="group_tp">Group TP:</label>
            <div  id="role" name="role"><?php echo $user_info["group_tp"]?></div> 
        </div>

        <div class="form-group">
            <label for="group_anglais">Group Anglais:</label>
            <div  id="role" name="role"><?php echo $user_info["group_anglais"]?></div> 
        </div>
        <?php } elseif ($user_info["role"] == "Teacher") {?>
            <p class="user-info" id="user-departement">Department: <?php echo $user_info["departement"] ?></p>
        <?php } else {} ?>   
        <button type="submit" class="form-button">Submit Changes</button>
    </form>
    </div>
    
</div>
</body>
