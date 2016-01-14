<?php 
session_start();

if(isset($_GET['logout'])){
	if($_GET['logout'] == 'yes'){
		session_destroy();		
		header('Location: ../index.php');
		die;
 	}
 	elseif($_GET['logout'] == 'no'){		
		header('Location: accueil.php');
		die;
	}
	else{
		$error = '<strong> Don\'t Fuck with me asshole !</strong>';
	}
}

include_once 'inc/header.php';
?>
<?php if(isset($_SESSION['logout']) && isset($_SESSION['userId']) && isset($_SESSION['role']));
echo 'Voulez-vous vraiment vous deconnecter ?'
?>
 
<a href="logout.php?logout=yes">Oui, je souhaite me déconnecter</a>
<a href="logout.php?logout=no">Non, je ne souhaite pas me déconnecter</a>
<?php 
if(isset($error)){
	echo '<p class="error">'.$error.'</p>';
}

?>

<?php include_once 'inc/footer.php'; ?>