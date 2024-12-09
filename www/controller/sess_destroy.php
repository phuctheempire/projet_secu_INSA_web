<?php 
	
	session_start();
	unset($_SESSION['user_id']);
	unset($_SESSION['user_role']);
	unset($user_info);	
	session_destroy();
	header('location: /index.php');

?>