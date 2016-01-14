<?php 
session_start();

if(isset($_GET['logout']) && $_GET['logout'] == 'yes'){

	unset($_SESSION['userId'], $_SESSION['email'], $_SESSION['role']); 

	session_destroy(); 

}

//	header('Location:../index.php'); 
//	die;

 var_dump($_SESSION);

?> 

