<?php
require "../../controller/config.php";
require ROOT_PATH . DS . "controller" . DS . "api" . DS . "user_info.php";
include ROOT_PATH . DS . "components" . DS . "header.php";
require ROOT_PATH . DS . "components" . DS . "nav_bar.php";
?>

<body>
<div class="container">        
    <?php $user_id = $_GET['id'];
        if ($user_id != $_SESSION['user_id']) { ?>
            <h2> Can't access to user <?php echo $user_id ?> </h2>
        <?php } else { ?>
    <div class="card" id="user-profile-1">
        <h1 >Modify User Information</h1>
    <form action="/pages/user/user_mod.php?id=<?php $_GET['id']?>" method="POST">
    
        <div class="form-group">
            <label for="nom">Full Name:</label>
            <input class="form-input" type="text" id="nom" name="nom" placeholder="Enter your full name" value="<?php echo $user_info["nom"] ?>" required>
        </div>

        <div class="form-group">
            <label for="prenom">First Name:</label>
            <input class="form-input" type="text" id="prenom" name="prenom" placeholder="Enter your first name" value="<?php echo $user_info["prenom"] ?>" required>
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
            <select class="form-select" id="sexe" name="sexe" required>
                <option value="M">Male</option>
                <option value="F">Female</option>
            </select>
        </div>

        <div class="form-group">
            <label for="date_naissance">Date of Birth:</label>
            <input class="form-input" type="date" id="date_naissance" name="date_naissance" value="<?php echo $user_info["date_naissance"] ?>" required>
        </div>

        <div class="form-group">
            <label for="adressse">Address:</label>
            <input class="form-input" type="text" id="adresse" name="adresse" placeholder="Enter your address" value="<?php echo $user_info["adresse"] ?>" required>
        </div>

        <div class="form-group">
            <label for="telephone">Phone:</label>
            <input class="form-input" type="tel" id="telephone" name="telephone" placeholder="Enter your phone number" value="<?php echo $user_info["telephone"] ?>" required>
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
        <button type="submit" name="change-info" class="form-button">Submit Changes</button>
    </form>
    </div>
    <?php } ?>
    
</div>
</body>
