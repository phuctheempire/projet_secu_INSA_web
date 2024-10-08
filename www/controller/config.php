<?php

session_start();

define('DB_TYPE', 'mysql');
define('DB_HOST', 'db');
define('DB_PORT', '3306');


define('DB_NAME', 'insa_db');
define('DB_USER', 'root');
define('DB_PASS', 'test');

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

const DS = DIRECTORY_SEPARATOR;
define('ROOT_PATH', realpath(dirname(__FILE__) . '/..'));
define('BASE_URL', 'http://localhost:2024/');