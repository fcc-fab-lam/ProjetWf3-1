<?php include_once 'inc/header.php'; ?>

<head>
	<title>Article</title>
</head>

<body>
	<main>
		<h2>Titre de l'article</h2>

		<div id="image">
		<img src="#" alt="">
		</div>

		<div id="art">
		<p>Ecrivez votre article</p>
		</div>
		<div id="date">
		<p> nous sommes le  et il est </p> 
		</div>


<form method="get">
  		<label for="search">Votre recherche</label>
  		<input type="text" name="search" id="search">
  		<br><input type="submit" value="Envoyer"> 
</form>

<?php include_once 'inc/footer.php'; ?>