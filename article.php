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
		
		</div>
		<div id="date">
		<label for="article">Article</label>
			<textarea name="article" placeholder="votre recherche"></textarea>
		</div>


<form method="get">
  		<label for="search">Votre recherche</label>
  		<input type="text" name="search" id="search" placeholder="votre recherche">
  		<br><input type="submit" value="Envoyer"> 
</form>

<?php include_once 'inc/footer.php'; ?>