<?php
    $titrePage = 'Accueil';
    require_once 'inc/dbconnect.php';
    include_once 'inc/header.php'; 

	$rep = $bdd->prepare('SELECT * FROM news ORDER BY publication_date DESC LIMIT 6');
	$rep->execute();
	$art = $rep->fetchAll(PDO::FETCH_ASSOC);

?>


	<div id="slider">
		<img src="img/miamivice.jpg" alt="">
	</div>

	<section id="news">
		<h2>Les News</h2>
		<?php foreach ($art as $key => $value) { ?>
			<article>
				<a href="article.php?id=<?php echo $value['id']?>"><h3><?php echo $value['title'];?></h3></a>
				<p><?php echo mb_substr($value['content'], 0, 500); ?><a href="article.php?id=<?php echo $value['id']?>"> Lire la suite...</a></p>
			</article>
		<?php } ?>


	</section>

<?php include_once 'inc/footer.php'; ?>