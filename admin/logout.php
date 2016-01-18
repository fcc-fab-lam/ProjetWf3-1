<?php 
session_start();

require_once 'inc/secure.php';

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
		$error = '<strong> Don\'t fuck with me asshole !</strong>';
	}
}

include_once 'inc/header.php';
?>
    <?php if(isset($_SESSION['userId']) && isset($_SESSION['role'])): ?>
    <p>Voulez-vous vraiment vous deconnecter ?</p>
    <p><a href="logout.php?logout=yes">Oui, je souhaite me déconnecter</a></p>
    <p><a href="logout.php?logout=no">Non, je ne souhaite pas me déconnecter</a></p>
    <?php endif; ?>
    <?php 
    if(isset($error)){echo '<p class="error">'.$error.'</p>';} ?>

<?php include_once 'inc/footer.php'; ?>