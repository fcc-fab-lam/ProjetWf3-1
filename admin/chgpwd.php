<?php
session_start();

require_once 'inc/dbconnect.php';

include_once 'inc/header.php';

$post = array();
$err = array();

if (!empty($_POST)) {
	foreach ($_POST as $key => $value) {
		$post[$key] = trim(strip_tags($value));
	}
	if(empty($post['oldpwd'])){
		$err[]='le mot de passe est obligatoire';
	} 			
	if(empty($post['password']) || strlen($post['password']) < 8){
		$err[]='ton mode de passe doit avoir 8 caracteres minimum';
	} else{
			$prep = $bdd->prepare('SELECT * FROM users WHERE password = :password');
			$prep->bindValue(':password', password_hash($post['oldpwd'], PASSWORD_DEFAULT), PDO::PARAM_STR);
			$prep->execute();
			$verifPwd = $prep->fetch(PDO::FETCH_ASSOC);
			if (empty($verifPwd)){
				$err[]= 'ton mot de passe est incorrect';
			} else{
					$prep2 = $bdd->prepare('UPDATE users SET password=:password WHERE id=:userId');
					$prep2->bindValue(':userId', $_SESSION['userId'], PDO::PARAM_STR);
					$prep2->bindValue(':password', password_hash($post['password'], PASSWORD_DEFAULT));
					if($prep2->execute()){
						header('Location: index.php');
					}
				}
		}
}

?>


	<h3>Nouveau mot de passe</h3>
		<form method="POST">
			<label for="oldpwd">Votre mot de passe actuel :</label><br>
			<input type="password" name="oldpwd" id="oldpwd" placeholder="Votre mot de passe">

			<br><br>
			<label for="password">Votre nouveau mot de passe :</label><br>
			<input type="password" name="password" id="password" placeholder="votre nouveau mot de passe...">

			<br><br>
			<button type="submit">Envoyer</button>

		</form>

		<?php
			if(count($err) > 0){
				echo '<p class="error">'.implode('<br>', $err).'</p>';
			} 
		?>

<?php include_once 'inc/footer.php'; ?>
