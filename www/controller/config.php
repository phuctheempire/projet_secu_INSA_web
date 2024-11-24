<?php

session_start();

define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_PORT', '3306');


define('DB_NAME', 'insa_db');
define('DB_USER', 'root');
define('DB_PASS', 'root');

define('FTP_HOST', 'localhost');
define('FTP_USER', 'myuser');
define('FTP_PASS', 'myuser');

define('REMOTE_PATH', '');
define('LOCAL_PATH', '/home/xpham/Public/ASPrjet/projet_secu_INSA_web/www/assets/files');


$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

const DS = DIRECTORY_SEPARATOR;
define('ROOT_PATH', realpath(dirname(__FILE__) . '/..'));
define('BASE_URL', 'http://localhost:2024/');