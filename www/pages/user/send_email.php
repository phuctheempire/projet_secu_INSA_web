<?php
require "../../controller/config.php";
require ROOT_PATH . DS . "controller" . DS . "api" . DS . "user" . DS . "mail.php";
include ROOT_PATH . DS . "components" . DS . "header.php";
require ROOT_PATH . DS . "components" . DS . "nav_bar.php";

?>

<body>
    <div class="container">
        <div class="card">
            <h1 class="page-title"> Send an email</h1>
            <form method="post" action="mail.php?id=<?php echo $_SESSION['user_id'] ?>" id="send-email-form">
                <div class="form-group">
                    <label for="receiver_emails">Receiver emails:</label>
                    <input type="text" name="receiver_emails" class="form-input" id="receiver_email" required>
                </div>
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" name="title" class="form-input" id="title" required>
                </div>
                <div class="form-group">
                    <label for="content">Content:</label>
                    <textarea name="content" class="form-textarea" id="content" required></textarea>
                </div>
                <button type="submit" class="btn-submit" name="send_email">Send</button>
            </form>
        </div>
</body>