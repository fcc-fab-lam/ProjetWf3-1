<?php
	session_start();

	require_once  'inc/dbconnect.php';

	require_once 'inc/secure.php';

	include_once 'inc/header.php';

	//je recupere la variable id passée en URL verifier qu'elle n'est pas vide, dans ce cas là; je la nettoie, et je fais ma requete pour atteindre le message correspondant, et j'affiche.. Requete du message lu. 

    if(!isset($_GET['id']) || empty($_GET['id']) || !is_numeric($_GET['id'])){
    	header('Location: contactslist.php');
    	die;
    }
    else{
    	$contactId = (int) trim(strip_tags($_GET['id']));

		$req = $bdd->prepare('SELECT * FROM contact WHERE id=:contactId');
		$req->bindValue(':contactId', $contactId, PDO::PARAM_INT);
		$req->execute();
		$contact = $req->fetch(PDO::FETCH_ASSOC);
		if(!empty($contact)){
			$req2 = $bdd->prepare('UPDATE contact SET new=:no WHERE id=:contactId');
			$req2->bindValue(':no', 'no');
			$req2->bindValue(':contactId', $contactId, PDO::PARAM_INT);
			$req2->execute();
		}

    }

?>
	<h3><?php echo 'Message de '.$contact['lastname'].' '.$contact['firstname'].' envoyé le '.date('j F Y \à H:i', strtotime($contact['date'])); ?></h3>
	<p><?php echo $contact['email']; ?></p>
	<p><?php echo $contact['subject']; ?></p>
	<p><?php echo nl2br($contact['message']); ?></p>


<?php include_once 'inc/footer.php'; ?>