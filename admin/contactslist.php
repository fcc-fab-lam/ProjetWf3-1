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
		<li><?php echo $value['email'].' envoyé le '.date('j F Y \à H:i', strtotime($value['date'])).' '.$value['new']; ?></li>	
	<?php endforeach; ?>
	</ul>

<?php include_once 'inc/footer.php'; ?>