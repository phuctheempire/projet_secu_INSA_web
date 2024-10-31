<?php
require "../../controller/config.php";
include ROOT_PATH . DS . "components" . DS . "header.php";
require ROOT_PATH . DS . "components" . DS . "nav_bar.php";
require ROOT_PATH . DS . "functions" . DS . "public" . DS . "cours_list.php";
?>
<body>
    <div class="container">
        <div class="course-grid">
        <?php $courses = getCoursList();
        foreach ($courses as $course) {?>
            <div class="course-item">
                <a href="../user/cours_info.php?cours_id=<?php echo $course["matier_id"];?>"><?php echo $course["nom"];?> </a>
        </div>
            <?php
        }?>
        </div>


    </div>
</body>