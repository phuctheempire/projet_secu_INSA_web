<?php
include_once ROOT_PATH . DS . "functions" . DS . "public" . DS . "contact_info.php";

if (!isset($_GET["search"])) {
    try {
        $result = get_all_contact_info();
    } catch (Exception $e) {

    }
}

