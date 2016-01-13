<?php
require_once 'inc/dbconnect.php';
include_once 'inc/header.php';

$post = array();
		$err = array();
		$erreursForm = false;
		$formValid = false;

		if (!empty($_POST)) {
			foreach ($_POST as $key => $value) {
				$post[$key] = trim(strip_tags($value));
			}
			if(!empty($post['email']) && filter_var($post['email'], FILTER_VALIDATE_EMAIL)){
					$prep = $bdd->prepare('SELECT * FROM users WHERE email = :email LIMIT 1');
					$prep->bindValue(':email', $post['email'], PDO::PARAM_STR);
					$prep->execute();
					$user = $prep->fetch(PDO::FETCH_ASSOC);
					if (!empty($user)){
						$token = md5(uniqid());
						$req = $bdd->prepare('INSERT INTO tokens (email, token, date_inserted) VALUES (:email,:token, NOW())');
						$req->bindValue('email', $post['email'], PDO::PARAM_STR);
						$req->bindValue('token', $token, PDO::PARAM_STR);
						$req->execute();
						
						$formValid = true;
					
						} else{
							$erreursForm = true;
							$err[] = 'ton email est inexistant!';
						}
					}
			}
		
?>



	<h3>Mot de passe oublié</h3>
	
		<form method="POST">
			<label for="email">Votre email :</label><br>
			<input type="email" name="email" id="email" placeholder="Votre email">

			<br><br>
			<button type="submit">Envoyer</button>

		</form>

		<?php
			if($erreursForm){
				echo '<p class="error">'.implode('<br>', $err).'</p>';
			} 
		?>

		<pre>
			<?php 
				if($formValid){
					echo '<a href="initpwd.php?token='.$token.'">Reinitialise ton mot de passe</a>';
				} 
			?>
		</pre>





<?php include_once 'inc/footer.php'; ?>
