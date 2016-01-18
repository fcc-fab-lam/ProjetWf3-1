<?php
session_start();

require_once 'inc/secure.php';

require_once 'inc/dbconnect.php';

include_once 'inc/header.php';

?>
<?php
$error = array();
$post = array();
$formValid = false;
$formError = false;

$categories = array();
// recuperation de toutes les catégories
$reqCat = $bdd->prepare('SELECT * FROM categories');
$reqCat->execute();
$categories = $reqCat->fetchAll(PDO::FETCH_ASSOC);

if(!empty($_POST)){
	foreach($_POST as $key => $value){
		$post[$key] = trim(strip_tags($value));
	 }
	 if(!preg_match('/.{4,255}/', $post['title'])){
   		$error[] = 'Le titre est obligatoire';	 }

	 if(!preg_match('/.{20,}/', htmlspecialchars($_POST['content']))){
   		$error[] = 'Le contenu est obligatoire';
	}
    if($post['category'] == 5){
        $category = '4,5';
    }
    else{
        $category = $post['category'];
    }

	if(count($error) > 0){
		$formError = true;
	}
	else {

		$req = $bdd->prepare('INSERT INTO news (title, content, publication_date, id_user, category) VALUES(:title, :content, NOW(), :userId, :category)');
		$req->bindValue(':title', $post['title'], PDO::PARAM_STR);
		$req->bindValue(':content', htmlspecialchars($_POST['content']), PDO::PARAM_STR);
		$req->bindValue(':userId', $_SESSION['userId'], PDO::PARAM_STR);
		$req->bindValue(':category', $category, PDO::PARAM_STR);
		if($req->execute()){
			$formValid = true;
		}
		else{
			echo 'nok';
		}
	}
}
?>
<h3>Ajout d'un nouvel article</h3>

<form method="POST">
		<label for="title">Votre Titre</label>
  		<br><input type="title" name="title" id="title" placeholder ="Ecrivez votre titre">

		<br><label for="content">Votre article</label>
		<br><textarea name="content" placeholder ="Ecrivez votre article"></textarea>
		
		<br><label for="category">Catégorie</label>
  		<br><select name="category" id="category">
        <?php foreach($categories as $value): ?>
  		    <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
  		<?php endforeach; ?>
  		</select>

  		<br><button type="submit">Envoyer</button>
 </form>
 
 <?php
 	echo '<p>tinyMCE : '.$_POST['content'].'</p>';
 	echo '<p>Normal : '.$post['content'].'</p>';

 	if($formError){
 		echo '<p class="error">'.implode('<br>', $error).'</p>';
 	}
 	if($formValid){
 		echo '<p class="success">L\'article a bien été enregistré.</p>';
 	}
?>
<?php include_once 'inc/footer.php'; ?>
