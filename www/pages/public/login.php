<?php
require "../../controller/config.php";
require ROOT_PATH . DS . "controller" . DS . "auth_session.php";
include ROOT_PATH . DS . "components" . DS . "header.php";
require ROOT_PATH . DS . "components" . DS . "nav_bar.php";
?>

<body>

    <div class="container">
        <?php include ROOT_PATH.DS.'components'.DS."error.php" ?>
        <form method="post" action="login.php" id="login-form">
            <h2 class="form-title">Login</h2> <!-- Added a title for the form -->
            <div class="form-group">
                <input type="text" name="email" placeholder="Email"
                    value="<?php echo htmlspecialchars($email); ?>" class="form-input" id="email" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Password" class="form-input" id="password"
                    required>
            </div>
            <button type="submit" name="login_btn" class="form-button">Login</button>
        </form>
        </div>
        </body>