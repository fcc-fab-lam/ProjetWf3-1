<?php
session_start();

require_once 'inc/dbconnect.php';

$post = array();
$err = array();

if(isset($_GET['token'])){
        $prep = $bdd->prepare('SELECT * FROM tokens WHERE token = :token');
        $prep->bindValue(':token',$_GET['token'], PDO::PARAM_STR);
        $prep->execute();
        $verifToken = $prep->fetch(PDO::FETCH_ASSOC);
        if (empty($verifToken)){
            echo var_dump($verifToken);
            header('Location: tokenpwd.php');
            die;
        } else {

            if (!empty($_POST)) {
                foreach ($_POST as $key => $value) {
                    $post[$key] = trim(strip_tags($value));
                }
                if(empty($post['email']) || !filter_var($post['email'], FILTER_VALIDATE_EMAIL)){
                    $err[]='tu n\'existes pas';
                } 			
                if(empty($post['password']) || strlen($post['password']) < 8){
                            $err[]='ton mode de passe doit avoir 8 caracteres minimum';
                } else {
                        $prep2 = $bdd->prepare('UPDATE users SET password=:password WHERE email=:email');
                        $prep2->bindValue(':email', $post['email'], PDO::PARAM_STR);
                        $prep2->bindValue(':password', password_hash($post['password'], PASSWORD_DEFAULT));
                        if($prep2->execute()){
                            $supp = $bdd->prepare('DELETE FROM tokens WHERE token=:token');
                            $supp->bindValue(':token', $_GET['token'], PDO::PARAM_STR);
                            $supp->execute();

                            header('Location: index.php');
                        }

                    }
            }
        }
} else{
    header('Location: tokenpwd.php');
}
include_once 'inc/header.php';
?>


	<h3>Nouveau mot de passe</h3>
		<form method="POST">
			<label for="email">Votre email :</label><br>
			<input type="email" name="email" id="email" placeholder="Votre email">

			<br><br>
			<label for="password">Votre nouveau mot de passe :</label><br>
			<input type="password" name="password" id="password" placeholder="votre mot de passe...">

			<br><br>
			<button type="submit">Envoyer</button>

		</form>
		<?php
			if(count($err) > 0){
				echo '<p class="error">'.implode('<br>', $err).'</p>';
			} 
		?>
<?php include_once 'inc/header.php'; ?>

