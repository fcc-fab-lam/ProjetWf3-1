<?php
    require_once 'inc/dbconnect.php';

	$rep = $bdd->prepare('SELECT * FROM news WHERE id = :idArticle');
	$rep->bindValue(':idArticle', $_GET['id'], PDO::PARAM_INT);
	$rep->execute();
	$art = $rep->fetch(PDO::FETCH_ASSOC);
    
    $titrePage = $art['title'];

    include_once 'inc/header.php'; 
?>

<head>
	<title>Article</title>
</head>

<body>
	<main>

		<h3><?php echo $art['title'];?></h3>
		<p><?php echo date('j F Y', strtotime($art['publication_date'])); ?></p> 


		<div id="image">
		<img src="#" alt="">
		</div>


		<article>
			<p><?php echo (htmlspecialchars_decode($art['content']));?></p>
		</article>
		
<?php include_once 'inc/footer.php'; ?>