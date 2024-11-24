<?php
require "../../controller/config.php";
require ROOT_PATH . DS . "controller" . DS . "upload.php";
include ROOT_PATH . DS . "components" . DS . "header.php";
require ROOT_PATH . DS . "components" . DS . "nav_bar.php";
?>
<body>
    <div class="container">
        <form action="upload.php" method="POST" enctype="multipart/form-data">
            <input type="file" name="file">
            <button type="submit" name="upload_btn">UPLOAD</button>
        </form>
    </div>
    
</body>