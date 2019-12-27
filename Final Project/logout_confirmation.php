<?php 
session_start();
echo "hdkf";

session_destroy();

header("Location: login.php");
	
?>