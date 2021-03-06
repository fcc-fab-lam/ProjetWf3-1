<?php
    session_start();

    require_once 'inc/secure.php';
    require_once 'inc/secure-admin.php';
    require_once 'inc/dbconnect.php';
    include_once 'inc/header.php';

    $post = array();
    $error = array();
    $erreursForm = false;
    $formValid = false;
    $formSuccess = false;
    $maxImages = 4;

    $maxSize = 1024 * 1000; 
    $dirUpload = '../img/';
    $mimeTypeAllowed = array('image/jpg', 'image/jpeg', 'image/png', 'image/gif');

    if(!empty($_POST)){
        $finfo = new finfo();

        foreach($_POST as $key => $value){
            $post[$key] = trim(strip_tags($value));
        }

        for($i=1;$i<=$maxImages;$i++){
            if(empty($_FILES['image_'.$i]['size'])){ 
                $error[] = 'L\'image ne peut être vide';
            }
            elseif($_FILES['image_'.$i]['size'] > $maxSize) { 
                $error[] = 'L\'image excède le poids autorisé';
            }
            $fileMimeType = $finfo->file($_FILES['image_'.$i]['tmp_name'], FILEINFO_MIME_TYPE);
            if(!in_array($fileMimeType, $mimeTypeAllowed)){ // 
                $error[] = 'Le fichier n\'est pas une image';
            }
        }

        if (count($error) > 0) {
            $erreursForm = true;
        }
        else {
            $search = array(' ', 'é', 'è', 'à');
            $replace = array('-', 'e', 'e', 'a', 'u');
            for($i=1;$i<=$maxImages;$i++){
                $newFileName = str_replace($search, $replace, time().'-'.$_FILES['image_'.$i]['name']);
                $monImgUpload = $dirUpload.$newFileName;
                if(move_uploaded_file($_FILES['image_'.$i]['tmp_name'], $monImgUpload)){

                    $insertImage = $bdd->prepare('UPDATE options SET value=:value WHERE data=:data');
                    $insertImage->bindValue(':value', $newFileName, PDO::PARAM_STR);
                    $insertImage->bindValue(':data', 'slider_'.$i, PDO::PARAM_STR);

                    if($insertImage->execute()){
                        $formSuccess = true;

                    }
                    else {
                        $errorShow = true;
                        $error[] = 'Une erreur est survenue lors de l\'enregistrement dans la bdd de votre image';
                    }
                }
                else { 
                    $errorShow = true;
                    $error[] = 'Une erreur est survenue lors de l\'envoi de votre image';
                }
            }
        }
    }
?>

	<h3>Changer la photo de couverture</h3>

	<form method="POST" enctype="multipart/form-data">
	<?php for($i=1;$i<=$maxImages;$i++):?>
		<label>Nouvelle image <?php echo $i; ?></label>
		<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $maxSize; ?>">
		<input type="file" id="image" name="image_<?php echo $i; ?>">
	<?php endfor; ?>
		<br>
		<button type="submit">Envoyer</button>
	</form>
	<?php if($formSuccess){
		echo 'bravo !';
	} if(count($error) > 0){
		echo implode('<br>',$error);
	}
	?>

<?php include_once 'inc/footer.php'; ?>
