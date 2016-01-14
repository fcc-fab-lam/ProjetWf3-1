<?php
session_start();

require_once 'inc/secure.php';

require_once 'inc/secure-admin.php';

if(!isset($_SESSION['role'])){
    header('Location: index.php');
}

require_once 'inc/dbconnect.php';

// recuperation de la liste des roles
$req1 = $bdd->prepare('SELECT * FROM roles');
$req1->execute();
$roles = $req1->fetchAll(PDO::FETCH_ASSOC);

$formValid = false;
$errorsForm = false;
$error = array();
if(!empty($_POST)){
	foreach ($_POST as $key => $value) {
		$post[$key] = strip_tags(trim($value));
	}
    
	if(strlen($post['nickname']) < 3){
		$error[] = 'Le pseudo doit contenir au moins 3 caractères.';
	}
	
	if(empty($post['email'])){
		$error[] = 'L\'email ne peut être vide';
	}
	elseif(!filter_var($post['email'], FILTER_VALIDATE_EMAIL)){
			$error[] = 'L\'adresse email est incorrecte';	
	}
    else{
        $checkEmail = $bdd->prepare('SELECT * FROM users WHERE email = :email');
        $checkEmail->bindValue(':email', $post['email'], PDO::PARAM_STR);
        $checkEmail->execute();
        
        $foundEmail= $checkEmail->fetch(PDO::FETCH_ASSOC);
        
        if(isset($foundEmail) && !empty($foundEmail)){
            $error[] = 'L\'email existe déjà dans la base de données.';
        }
    }
    
	if(empty($post['password'])){
		$error[] = 'Le mot de passe ne peut être vide';
	}
	else { 
		if(strlen($post['password']) < 8){
			$error[] = 'Le mot de passe doit contenir au moins 8 caractères';
		}
	}
    if(empty($post['role'])){
        $error[] = 'Choisissez un rôle pour cet utilisateur.';
    }
	elseif(!is_numeric($post['role'])){
        $error[] = 'Merci de ne pas jouer au petit malin 1ere sommation !';		
	}
    elseif(!in_array($post['role'], $roles)){
        $error[] = 'Merci de ne pas jouer au petit malin 2eme sommation !';
    }
    
	if(count($error) > 0){
		$errorsForm = true;
	}
	else {
        // On stocke les données en base de données
        $req = $bdd->prepare('INSERT INTO users (email, nickname, password, role) VALUES(:email, :password, :role)');
        $req->bindValue(':email', $post['email'], PDO::PARAM_STR);
        $req->bindValue(':password', password_hash($post['password'], PASSWORD_DEFAULT), PDO::PARAM_STR);
        $req->bindValue(':role', $post['role'], PDO::PARAM_STR);
        if($req->execute()){
            $formValid = true;
        }
	}
}

include_once 'inc/header.php';

?>
    <h3>Ajout d'un nouvel utilisateur</h3>
    <form method="post">
        <label for="nickname">Pseudo</label>
        <input type="text" name="nickname" id="nickname">
        <label for="email">Adresse email</label>
        <input type="text" name="email" id="email">
        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password">
        <select name="role">
            <option value="">Choisir un rôle</option>
			<?php foreach($roles as $value): ?>
            <option value="<?=$value['id']; ?>"><?=$value['name']; ?></option>
			<?php endforeach; ?>
        </select>
        <button type="submit">Envoyer</button>
    </form>
    <?php 
        if($formValid){
            echo '<p class="success">Utilisateur ajouté avec succés.</p>';
        }
    ?>

    <?php 
    if($errorsForm){
		echo implode('<br>', $error);
	}
    ?>
<?php include_once 'inc/footer.php'; ?>
