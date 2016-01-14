<?php
session_start();

require_once 'inc/secure.php';

require_once 'inc/dbconnect.php';

include_once 'inc/header.php';

?>
<?php
$error = array();
$post = array();
$formValid = false;
$formError = false;

if(!empty($_POST)){
	foreach($_POST as $key => $value){
		$post[$key] = trim(strip_tags($value));
	 }
	 if(empty($post['title'])){
	 	$error[] = 'Le titre est obligatoire';
	 }

	if(empty($post['content'])){
		$error[] = 'Le contenu est obligatoire';
	}

	if(count($error) > 0){
		$formError = true;
	}
	else {

		$req = $bdd->prepare('INSERT INTO news (title, content, publication_date, id_user) VALUES(:title, :content, NOW(), :userId)');
		$req->bindValue(':title', $post['title'], PDO::PARAM_STR);
		$req->bindValue(':content', $post['content'], PDO::PARAM_STR);
		$req->bindValue(':userId', $_SESSION['userId'], PDO::PARAM_STR);
		if($req->execute()){
			$formValid = true;
		}
		else{
			echo 'nok';
		}
	}
}
?>
<h3>Ajout d'un nouvel article</h3>

<form method="POST">
		<label for="title">Votre Titre</label>
  		<br><input type="title" name="title" id="title" placeholder ="Ecrivez votre titre">

		<br><label for="content">Votre article</label>
		<br><textarea name="content" placeholder ="Ecrivez votre article"></textarea>

  		<br><input type="submit" value="Envoyer">
 </form>
 
 <?php 
 	echo var_dump($_SESSION);
 	if($formError){
 		echo '<p class="error">'.implode('<br>', $error).'</p>';
 	}
 	if($formValid){
 		echo '<p class="success">L\'article a bien été enregistré.</p>';
 	}
?>
<?php include_once 'inc/footer.php'; ?>
