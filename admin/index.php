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
		$post[$key] = trim(strip_tags($value)); 
	}
	if(empty($post['email'])){
		$error[] = 'L\'email ne peut être vide.';
	}
	elseif(!filter_var($post['email'], FILTER_VALIDATE_EMAIL)){
        $error[] = 'L\'email est incorrect.';	
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
            $error[] = 'L\'email n\'exite pas.';
        }
    }
	if(empty($post['password'])){
		$error[] = 'Le mot de passe ne peut être vide.';
	}
	elseif($emailExiste) {
        
		if (password_verify($post['password'], $user['password'])) {
            $_SESSION = array(
                'userId'  => $user['id'],
                'email'  => $user['email'],
                'pseudo'  => $user['nickname'],
            );
        
            $checkRole = $bdd->prepare('SELECT * FROM roles WHERE id = :roleId');
            $checkRole->bindValue(':roleId', $user['id_role']);
            $checkRole->execute();

            $role = $checkRole->fetch(PDO::FETCH_ASSOC);

            $_SESSION['role']  = $role['name'];
            
        } else {
            $error[] = 'Le mot de passe est incorrect.';
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
    <style>
        body{
            background-color: #046380;
            text-align: center;
            height: 100vh;
        }
        #connexion{
            width: 250px;
            height: 180px;
            padding: 15px;
            margin: auto;
            position: relative;
            top: calc(50% - 180px);
        }
        input{
            display: inline-block;
        }
        fieldset{
            color: white;
            text-align: center;
            border-radius: 5px;
        }
        a{
            color: white;
        }
        p{
            background-color: white;
            border-radius: 5px;
        }
        .error{
            color: red;
        }
        button{
            margin-top: 20px;
        }
    </style>
</head>
<body>
   <div id="connexion">
        <form method="post">
            <fieldset>
                <legend>Connexion</legend>
                <br><label for="email">Email</label>
                <br><input type="text" name="email" id="email">
                <br><label for="password">Mot de passe</label>
                <br><input type="password" name="password" id="password">
                <br><button type="submit">Envoyer</button>
            </fieldset>
        </form>
        <a href="tokenpwd.php">Mot de passe oublié ?</a>
        <?php
            if($errorsForm){
                echo '<p class="error">'.implode('<br>', $error).'</p>';
            }
        ?>
    </div>
</body>
</html>
