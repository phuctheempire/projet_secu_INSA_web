<?php
require "../../controller/config.php";
require ROOT_PATH . DS . "controller" . DS . "api" . DS . "user" . DS . "mail_detail.php";
include ROOT_PATH . DS . "components" . DS . "header.php";
require ROOT_PATH . DS . "components" . DS . "nav_bar.php";

?>

<body>
    <div class="container">
        <div class="card">
            <h1 class="page-title"> Email Detail</h1>
            <?php
            if ( $email['sender_id'] != $_SESSION['user_id'] && $email['receiver_id'] != $_SESSION['user_id']){
            ?>
            <h2> Vous ne pouvez pas acceder a ce mail </h2>
            <?php
            } else {
            ?>
            <div class="email-detail">
                <div class="email-header">
                    <h2 class="email-title"><?php echo $email['title']; ?></h2>
                    <p class="email-sender">From: <?php echo get_email_by_id($email['sender_id']); ?></p>
                    <p class="email-receiver">To: <?php echo get_email_by_id($email['receiver_id']); ?></p>
                    <p class="email-date">Date: <?php echo $email['date']; ?></p>
                </div>
                <div class="email-content">
                    <p><?php echo $email['content']; ?></p>
            </div>
            <?php
            } ?>
    </div>
</body>