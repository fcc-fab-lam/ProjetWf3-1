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
    if(!is_numeric($post['telephone'])){
        $error[] = 'Le téléphone doit contenir des chiffres.';
    }
    elseif(strlen($post['telephone']) < 10){
        $error[] = 'Le téléphone doit comporter au moins 10 chiffres.';
    }
    if(empty($_FILES['avatar']['size'])){
        $err[] = 'L\'image ne peut être vide';        
    }
    elseif($_FILES['avatar']['size'] > $maxFileSize){
        $err[] = 'Le fichier image est trop gros !';
    }
    else{
        $fileMimeType = $finfo->file($_FILES['avatar']['tmp_name'], FILEINFO_MIME_TYPE);
        if(!in_array($fileMimeType, $mimeTypeAllowed)){
            $err[] = 'Le fichier n\'est pas une image';
        }
    }
    
    if(count($error) > 0){
        $formError = true;
    }
    else{
        $cheminImages = $_SERVER["DOCUMENT_ROOT"].'/Projetwf3-1/img/';
        
        $search = array('à','â','ä','é','è','ê','ë','ï','î','ô','ö','ù','ü',' ');
        $replace = array('a','a','a','e','e','e','e','i','i','o','o','u','u','');
        
        $imgUploaded = str_replace($search, $replace, $_FILES['avatar']['name']);
        
        move_uploaded_file($_FILES['avatar']['tmp_name'], $cheminImages.$imgUploaded);
        
        $allowFieldsSQL = ['nom', 'prenom', 'telephone', 'email', 'avatar'];

        $post['avatar'] = $imgUploaded;
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
        <label for="avatar">Avatar</label>
        <input type="file" name="avatar" id="avatar">
        <button type="submit">Envoyer</button>
    </form>
<?php
    if(!empty($errorSql)){
        echo '<p class="error">'.implode('<br>', $errorSql).'</p>';
    }
?>
<?php
    if($formError){
        echo '<p class="error">'.implode('<br>', $error).'</p>';
    }
?>
<?php include_once 'inc/footer.php'; ?>
