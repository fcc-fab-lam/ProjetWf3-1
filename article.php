<?php
require_once 'inc/dbconnect.php';
include_once 'inc/header.php'; 
	$rep = $bdd->prepare('SELECT * FROM news WHERE id = :idArticle');
	$rep->bindValue(':idArticle', $_GET['id'], PDO::PARAM_INT);
	$rep->execute();
	$art = $rep->fetchAll(PDO::FETCH_ASSOC);
?>

<head>
	<title>Article</title>
</head>

<body>
	<main>
	<?php foreach ($art as $key => $value) { ?>

		<h3><?php echo $value['title'];?></h3>
		<p><?php echo date('j F Y', strtotime($value['publication_date'])); ?></p> 


		<div id="image">
		<img src="#" alt="">
		</div>

		<article>
			<p><?php echo $value['content'];?></p>
		</article>

	
	<?php } ?>



<form method="get">
  		<label for="search">Votre recherche</label>
  		<input type="text" name="search" id="search">
  		<br><input type="submit" value="Envoyer"> 
</form>

<?php include_once 'inc/footer.php'; ?>