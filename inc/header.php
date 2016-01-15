<?php
	$rep = $bdd->prepare('SELECT * FROM options');
	$rep->execute();
	$option = $rep->fetchAll(PDO::FETCH_ASSOC);
	$options = array();
	foreach ($option as $value) {
		$options[$value['data']] = $value['value'];
	}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/flexslider.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <title><?php echo $titrePage; ?></title>
</head>
<body>
	<div id="search">
		<form method="get" action="searchresults.php">
	  		<input type="text" name="search" id="search" placeholder="votre recherche">
	  		<button type="submit"><i class="fa fa-search"></i></button>
		</form>
		<a href="admin"><i class="fa fa-user"></i></a>

	</div>
	<div id="sommaire">
		<div id= "avatar">
			<a href="index.php"><img src="img/<?php echo $options['avatar']; ?>"></a>
			<p><?php echo $options['prenom'].' '.$options['nom']; ?></p>
			<p><?php echo $options['telephone']; ?></p>
			<p class="smallText"><?php echo $options['email']; ?></p> 
		</div>
			<nav>
				<ul> 
					<li><a href="index.php">accueil</a></li>
					<li><a href="articles.php">les news</a></li>
					<li><a href="contact.php">contact</a></li>
				</ul>
			</nav>	
	</div>

<main>
	<h1><?php echo $options['titre']; ?></h1>