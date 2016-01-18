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
$verifRoles = array();
foreach($roles as $value){
    $verifRoles[] = $value['id'];
}

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
	
	if(!preg_match('/^[\w.-]+@[\w.-]+\.[a-z{2,}$/i]')){
		$error[] = 'L\'email ne peut être vide';
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
    
	if(!preg_match('/^[\w]{8,20}$/')){
		$error[] = 'Le mot de passe ne peut être vide';
	}
    
    if(empty($post['role'])){
        $error[] = 'Choisissez un rôle pour cet utilisateur.';
    }
	elseif(!is_numeric($post['role'])){
        $error[] = 'Merci de ne pas jouer au petit malin 1ere sommation !';		
	}
    elseif(!in_array($post['role'], $verifRoles)){
        $error[] = 'Merci de ne pas jouer au petit malin 2eme sommation !';
    }
    
	if(count($error) > 0){
		$errorsForm = true;
	}
	else {
        // On stocke les données en base de données
        $req = $bdd->prepare('INSERT INTO users (email, nickname, password, id_role) VALUES(:email, :nickname, :password, :role)');
        $req->bindValue(':email', $post['email']);
        $req->bindValue(':nickname', $post['nickname']);
        $req->bindValue(':password', password_hash($post['password'], PASSWORD_DEFAULT), PDO::PARAM_STR);
        $req->bindValue(':role', $post['role'], PDO::PARAM_INT);
        if($req->execute()){
            $formValid = true;
            echo 'ok';
            var_dump($_POST);
        }
        else{
            echo 'nok';
            var_dump($_POST);
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
		echo '<p class="error">'.implode('<br>', $error).'</p>';
	}
    ?>
<?php include_once 'inc/footer.php'; ?>
