<?php
include_once ROOT_PATH . DS . "functions" . DS . "public" . DS . "contact_info.php";

if (!isset($_GET["recherche_info"])) {
    try {
        $result = get_all_contact_info();
    } catch (Exception $e) {
        header("Location: /pages/public/contact_info.php");
    }
} else {
    try {
        $result = get_contact_by_recherche($_GET["recherche_info"]);
    } catch (Exception $e) {
        header("Location: /pages/public/contact_info.php");
}

}