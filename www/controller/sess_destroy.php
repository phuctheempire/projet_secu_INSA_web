<?php 
	
	session_start();
	unset($_SESSION['user_id']);
	unset($user_info);	
	session_destroy();
	header('location: /index.php');

?>