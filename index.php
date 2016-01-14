<?php
    $titrePage = 'Accueil';
    require_once 'inc/dbconnect.php';
    include_once 'inc/header.php'; 
	
	// Pagination
	$artParPage = 4;

	$reqPage = $bdd->prepare('SELECT COUNT(*) FROM news');
	if($reqPage->execute()){
		$nbArticles = $reqPage->fetchColumn();
	}

	$nbTotalPages = ceil($nbArticles / $artParPage);
	
	if(isset($_GET['page']) && is_numeric($_GET['page'])){
		$pageCourante = (int) $_GET['page'];

		if($pageCourante > $nbTotalPages){
			$pageCourante = $nbTotalPages;
		}
	}
	else {
		$pageCourante = 1;
	}
	$start = ($pageCourante - 1) * $artParPage;

	$rep = $bdd->prepare('SELECT * FROM news ORDER BY publication_date DESC LIMIT :start, :maxi');
	$rep->bindParam(':start', $start, PDO::PARAM_INT);
	$rep->bindParam(':maxi', $artParPage, PDO::PARAM_INT);
	if($rep->execute()){
		$art = $rep->fetchAll(PDO::FETCH_ASSOC);
	}
	else {
		echo '<p class="error">Une erreur est survenue. Veuillez réessayer plus tard.</p>';
	}

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
	
	<?php //if($nbTotalPages > 1): ?>
	<nav id="pagination">
		<ul>
		<?php 
			for($i=1; $i<=$nbTotalPages; $i++){
				if($i == $pageCourante){
					echo '<li class="active">'.$i.'</li>'; 
				}
				else {
					echo '<li><a href="index.php?page='.$i.'">'.$i.'</a></li>';
				}
			}
		?>
		</ul>
	</nav>
	<?php //endif; ?>

<?php include_once 'inc/footer.php'; ?>