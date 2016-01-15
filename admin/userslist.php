<?php
session_start();

require_once 'inc/secure.php';
require_once 'inc/secure-admin.php';
require_once 'inc/dbconnect.php';
include_once 'inc/header.php';

	$sql = 'SELECT u.email, r.name
			FROM users AS u
			LEFT JOIN role AS r
			ON u.id_role=r.id';


	$rep = $bdd->prepare($sql);
	$rep->execute();
	$utilisateurs = $rep->fetchAll(PDO::FETCH_ASSOC);




?>
<h3>Liste des utilisateurs</h3>
	<ol>
	<?php foreach ($utilisateurs as $key => $value) { ?>
		<li><?php echo $value['email'].' : '.$value['name']; ?></li>
	
	<?php } ?>


<?php include_once 'inc/footer.php'; ?>
