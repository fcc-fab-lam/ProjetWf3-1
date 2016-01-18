<?php require_once  'inc/dbconnect.php';
session_start();

require_once 'inc/secure.php';

include_once 'inc/header.php';

		$req = $bdd->prepare('SELECT * FROM contact');
		$req->execute();
		$contacts = $req->fetchAll(PDO::FETCH_ASSOC);
?>
	<h3>Liste de contact</h3>
	<ul>
	<?php foreach ($contacts as $value): ?>
		<li<?php if($value['new'] == 'yes'){echo ' class="newContact"';}?>><a href="readcontact.php?id=<?php echo $value['id']; ?>">Message de : <?php echo $value['lastname'].' '.$value['firstname'].' Objet : '.$value['subject'].'<br> envoyé le '.date('j F Y \à H:i', strtotime($value['date'])); ?></a></li>	
	<?php endforeach; ?>
	</ul>


<?php include_once 'inc/footer.php'; ?>