<?php
    $titrePage = 'Résultats de recherche';
    require_once 'inc/dbconnect.php';
    include_once 'inc/header.php';
	
	$search = '';
	$error = array();
	if(!isset($_GET['search'])){
		$error[] = 'Elément de recherche absent.';
	}
	else{
		$search = trim(strip_tags($_GET['search']));
        $replace = '<u>'.$search.'</u>';
		if(!empty($search)){
			$rep = $bdd->prepare('SELECT * FROM news WHERE title like :search OR content like :search');
			$rep->bindValue(':search', '%'.$search.'%');
			$rep->execute();
			$art2 = $rep->fetchAll(PDO::FETCH_ASSOC);
		}
		else{
			$error[] = 'Elément de recherche erroné.';
		}
	}
?>
<h3>Résultats pour la recherche : <?php echo $replace; ?></h3>
	<?php 
	if(count($error) > 0){
		echo '<p class="error">'.implode('<br>', $error).'</p>';
	}
	else{
		foreach ($art2 as $key => $value){
	?>
		
		<article>
			<h3><?php echo str_replace($search, $replace, $value['title']);?></h3>
			<p><?php echo date('j F Y \à H:i', strtotime($value['publication_date'])); ?></p> 
			<div id="image">
				<img src="#" alt="">
			</div>
			<p><?php echo str_replace($search, $replace, $value['content']);?></p>
		</article>
		
	<?php 
		}// fin du foreach
	}// fin du else
	?>

<?php include_once 'inc/footer.php'; ?>