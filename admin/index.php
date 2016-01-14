<?php
session_start();

require_once 'inc/dbconnect.php';

if(isset($_SESSION['email'])){
    header('Location: accueil.php');
    die;
}

$post =array();
$errorsForm = false;
$error = array();
$emailExiste = false;
if(!empty($_POST)){
	foreach ($_POST as $key => $value) {
        
        // On devrait plutôt faire l'inverse, c'est à dire : trim(strip_tags());
        
        // trim retire les espaces en début et fin de chaine, strip_tags le HTML / PHP
        // dans ton cas, une chaine type "<p> Hello </p>" sortira de cette manière : " Hello "
        
		$post[$key] = strip_tags(trim($value)); 
	}
	if(empty($post['email'])){
		$error[] = 'L\'adresse email est vide'.PHP_EOL;
	}
	elseif(!filter_var($post['email'], FILTER_VALIDATE_EMAIL)){
        $error[] = 'L\'adresse email est incorrecte'.PHP_EOL;	
	}
    else{
        $checkEmail = $bdd->prepare('SELECT * FROM users WHERE email = :email');
        $checkEmail->bindValue(':email', $post['email'], PDO::PARAM_STR);
        $checkEmail->execute();
        
        $user = $checkEmail->fetch(PDO::FETCH_ASSOC);
        
        if(isset($user) && !empty($user)){
            $emailExiste = true;
        }
        else{
            $error[] = 'L\'email n\'exite pas.'.PHP_EOL;
        }
    }
	if(empty($post['password'])){
		$error[] = 'Le mot de passe est vide.'.PHP_EOL;
	}
	elseif($emailExiste) {
        
		if (password_verify($post['password'], $user['password'])) {
            $_SESSION = array(
                'userId'  => $user['id'],
                'email'  => $user['email'],
            );
        
            $checkRole = $bdd->prepare('SELECT * FROM role WHERE id = :roleId');
            $checkRole->bindValue(':roleId', $user['id_role']);
            $checkRole->execute();

            $role = $checkRole->fetch(PDO::FETCH_ASSOC);

            $_SESSION['role']  = $role['type'];
            
        } else {
            $error[] = 'Le mot de passe est incorrect.'.PHP_EOL;
        }
	}

	if(count($error) > 0){
		$errorsForm = true;
	}
	else {
        header('Location: accueil.php');
	}
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <h1>Connexion</h1>
    <form method="post">
        <label for="email">Email</label>
        <input type="text" name="email" id="email">
        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password">
        <button type="submit">Envoyer</button>
    </form>
    <a href="tokenpwd.php">Mot de passe oublié ?</a>
    <?php
        if($errorsForm){
            echo '<p class="error">'.implode('<br>', $error).'</p>';
        }
    ?>
</body>
</html>
