<?php
    $titrePage = 'Articles';
    require_once 'inc/dbconnect.php';
    include_once 'inc/header.php'; 
	$rep = $bdd->prepare('SELECT * FROM news');
	$rep->execute();
	$art2 = $rep->fetchAll(PDO::FETCH_ASSOC);

?>

	<?php foreach ($art2 as $key => $value) { ?>
		<article>
			<h3><?php echo $value['title'];?></h3>
			<p><?php echo date('j F Y \à H:i', strtotime($value['publication_date'])); ?></p> 
			<div id="image">
				<img src="#" alt="">
			</div>
			<p><?php echo $value['content'];?></p>
		</article>

	
	<?php } ?>

<?php include_once 'inc/footer.php'; ?>