<?php
session_start();

require_once 'inc/secure.php';

require_once 'inc/secure-admin.php';

require_once 'inc/dbconnect.php';

$post = array();
$error = array();
$formValid = false;
$formError = false;
$maxFileSize = 1024 * 1000;
$mimeTypeAllowed = array('image/jpg','image/jpeg','image/png','image/gif');
$errorSql = array();

if(!empty($_POST)){
    $finfo = new finfo();
    foreach($_POST as $key => $value){
        $post[$key] = trim(strip_tags($value));
    }
    
    if(empty($post['nom'])){
        $error[] = 'Le nom ne peut être vide.';
    }
    
    if(empty($post['prenom'])){
        $error[] = 'Le prénom ne peut être vide.';
    }
    
    if(!preg_match('/^0+[0-9]{9}$/', $post['telephone'])){
        $error[] = 'Le téléphone doit contenir 10 chiffres.';
    }
    
    if (!preg_match('/^[\w.-]+@[\w.-]+\.[a-z]{2,}$/i', $post['email'])){
		$error[] = 'L\'adresse email est incorrecte';	
	}
    
    if(empty($post['titre'])){
        $error[] = 'Le titre ne peut être vide.';
    }
    
    if(empty($_FILES['avatar']['size'])){
        $error[] = 'L\'image ne peut être vide';        
    }
    elseif($_FILES['avatar']['size'] > $maxFileSize){
        $error[] = 'Le fichier image est trop gros !';
    }
    else{
        $fileMimeType = $finfo->file($_FILES['avatar']['tmp_name'], FILEINFO_MIME_TYPE);
        if(!in_array($fileMimeType, $mimeTypeAllowed)){
            $error[] = 'Le fichier n\'est pas une image';
        }
    }

    
    if(count($error) > 0){
        $formError = true;
    }
    else{
        $cheminImages = $_SERVER["DOCUMENT_ROOT"].'/Projetwf3-1/img/';
        
        $search = array('à','â','ä','é','è','ê','ë','ï','î','ô','ö','ù','ü',' ');
        $replace = array('a','a','a','e','e','e','e','i','i','o','o','u','u','');

        $post['avatar'] = str_replace($search, $replace, $_FILES['avatar']['name']);
        
        move_uploaded_file($_FILES['avatar']['tmp_name'], $cheminImages.$post['avatar']);
        
        $allowFieldsSQL = ['nom', 'prenom', 'telephone', 'email', 'titre', 'avatar'];
        foreach($post as $key => $value){
            if(in_array($key, $allowFieldsSQL) && !empty($value)){
                $req = $bdd->prepare('UPDATE options SET value=:value WHERE data=:data');
                $req->bindValue(':value', $value);
                $req->bindValue(':data', $key);
                if($req->execute()){
                }
                else{
                    $errorSql[] = 'nok : '.$key;
                }
            }

        }
        
    }
    
}

include_once 'inc/header.php';

?>
    <h3>Changement des informations du profil</h3>
    <form method="post"  enctype="multipart/form-data">
        <label for="nom">Nom</label>
        <input type="text" name="nom" id="nom">
        <label for="prenom">Prénom</label>
        <input type="text" name="prenom" id="prenom">
        <label for="telephone">Téléphone</label>
        <input type="text" name="telephone" id="telephone">
        <label for="email">Email</label>
        <input type="text" name="email" id="email">
        <label for="titre">Titre du blog</label>
        <input type="text" name="titre" id="titre">
        <label for="img">Avatar</label>
        <input type="file" name="avatar" id="img">
        <button type="submit">Envoyer</button>
    </form>
<?php
    if(!empty($errorSql)){
        echo '<p class="error">'.implode('<br>', $errorSql).'</p>';
    }
    var_dump($_FILES);
?>
<?php
    if($formError){
        echo '<p class="error">'.implode('<br>', $error).'</p>';
    }
?>
<?php include_once 'inc/footer.php'; ?>
