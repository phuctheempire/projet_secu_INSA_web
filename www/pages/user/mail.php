<?php
require "../../controller/config.php";
require ROOT_PATH . DS . "controller" . DS . "api" . DS . "user". DS ."mail.php";
include ROOT_PATH . DS . "components" . DS . "header.php";
require ROOT_PATH . DS . "components" . DS . "nav_bar.php";

?>
<body>
    <div class="container">
        <div class="card">
            <h1 class="page-title">Mail Box</h1>
            <a class="send-email-link" href="send_email.php">Write a new email</a>
            <div class="mail-list">
                <?php foreach ($email_list as $email) { ?> 
                    <a class="mail-card" href="mail_detail.php?id=<?php echo $email['mail_id'] ?>" >
                    <?php if ($email['sender_id'] == $_GET['id']){ ?>
                        <h2 class="mail-info">Sent to: <?php echo get_email_by_id($email['receiver_id'])?></h2>
                        <h2 class="mail-title"><?php echo $email['title'] ?></h2>
                        <p class="mail-date"><?php echo $email['date']?></p>
                    <?php }
                    if($email['receiver_id'] == $_GET['id']){ ?>
                        <h2 class="mail-info">Sent to: <?php echo get_email_by_id($email['sender_id'])?></h2>
                        <h2 class="mail-title"><?php echo $email['title'] ?></h2>
                        <p class="mail-date"><?php echo $email['date']?></p>
                    <?php } ?>
                    </a>
                <?php } ?>
        </div>
    </div>
</body>