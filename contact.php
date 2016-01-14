<?php 

    $titrePage = 'Contact';
	require_once  'inc/dbconnect.php';
	include_once 'inc/header.php';
?>

<h1> Contactez-nous!</h1>

<?php

$error = array();
$post = array();
$formValid = true;

if(!empty($_POST)){
	foreach($_POST as $key => $value){
		$post[$key] = trim(strip_tags($value));
	 }
	if(empty($post['email'])){
		$error[] = 'L\'adresse email est obligatoire';
	}
	elseif(!filter_var($post['email'], FILTER_VALIDATE_EMAIL)){
		$error[] = 'L\'adresse email est invalide';
	}

	if(empty($post['message']))	{
			$error[] ='le message est obligatoire'; 
	}

	if(count($error) > 0){
		$formError = true;
	}
	else {
		$req = $bdd->prepare('INSERT INTO contact (email, message, new) VALUES(:email, :message, "yes")');
		$req->bindValue(':email', $post['email'], PDO::PARAM_STR);
		$req->bindValue(':message', $post['message'], PDO::PARAM_STR);
		if($req->execute()){
			echo 'ok';
		}else{
			echo 'nok';
		}
	}	
}

 ?>
<?php 
		if(isset($formError) && $formError){
			echo '<p class="error">'.implode('<br>', $error).'</p>';
		}
?>
<form method="post">
  		<label for="email">Votre email</label>
  		<br><input type="email" name="email" id="email" placeholder ="Ecrivez votre Email">

  		<br><label for="textarea">Votre message</label>
  		<br><textarea name="message" placeholder ="Ecrivez votre Message"></textarea>
  		

  		<br><input type="submit" value="Envoyer"> 
</form>


<?php include_once 'inc/footer.php'; ?>
