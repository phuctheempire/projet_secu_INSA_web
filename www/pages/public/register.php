<?php
require "../../controller/config.php";
require ROOT_PATH . DS . "controller" . DS . "auth_session.php";
include ROOT_PATH . DS . "components" . DS . "header.php";
require ROOT_PATH . DS . "components" . DS . "nav_bar.php";
?>

<body>

    <div class="container">
        <?php include ROOT_PATH.DS.'components'.DS."error.php" ?>
        <form method="post" action="register.php" id="registration-form">
            <h2 class="form-title">Register</h2> <!-- Added a title for the form -->
            
            <div class="form-group">
                <input type="text" name="nom" placeholder="Nom" value="<?php echo htmlspecialchars($nom); ?>"
                    class="form-input" id="nom" required>
            </div>
            <div class="form-group">
                <input type="text" name="prenom" placeholder="Prenom" value="<?php echo htmlspecialchars($prenom); ?>"
                    class="form-input" id="prenom" required>
            </div>
            <div class="form-group">
                <input type="text" name="email" placeholder="Email"
                    value="<?php echo htmlspecialchars($email); ?>" class="form-input" id="email" required>
            </div>
            <div class="form-group">
                <label for="departement">Select Department:</label>
                <select name="departement" id="departement" class="form-select" required>
                    <option value="">-- Select Department --</option>
                    <option value="STI">STI</option>
                    <option value="MRI">MRI</option>
                    <option value="GSI">GSI</option>
                </select>
            </div>
            <div class="form-group">
                <label for="sexe">Sexe:</label>
                <select name="sexe" id="sexe" class="form-select" required>
                    <option value="">-- Select Sexe --</option>
                    <option value="M">M</option>
                    <option value="F">F</option>
                </select>
            </div>
            <div class="form-group">
                <label for="date_naissance">Date de Naissance:</label>
                <input type="date" name="date_naissance" class="form-input" id="date_naissance" required>
            </div>

            <div class="form-group">
                <input type="text" name="adresse" placeholder="Adresse" value="<?php echo htmlspecialchars($adresse); ?>"
                    class="form-input" id="adresse" required>
            </div>

            <div class="form-group">
                <input type="tel" name="telephone" placeholder="Telephone" value="<?php echo htmlspecialchars($telephone); ?>"
                    class="form-input" id="telephone" required>
            </div>

            <div class="form-group">
                <label for="annee">Année:</label>
                <select name="annee" id="annee" class="form-select" required>
                    <option value="">-- Select Année --</option>
                    <option value="1A">1</option>
                    <option value="2A">2</option>
                    <option value="3A">3</option>
                    <option value="4A">4</option>
                    <option value="5A">5</option>
                </select>
            </div>

            <div class="form-group">
                <input type="password" name="password1" placeholder="Password" class="form-input" id="password1"
                    required>
            </div>
            <div class="form-group">
                <input type="password" name="password2" placeholder="Password confirmation" class="form-input"
                    id="password2" required>
            </div>
            <button type="submit" name="register_btn" class="form-button">Register</button>
        </form>


    </div>
</body>