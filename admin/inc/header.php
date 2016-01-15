<?php
$pseudo = '';
if(isset($_SESSION['pseudo'])){
    $pseudo = '('.$_SESSION['pseudo'].')';
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <title>BackOffice</title>
</head>
<body>
<header>
    <div id="search">
        <form method="get" action="searchresults.php">
            <input type="text" name="search" id="search" placeholder="votre recherche">
            <button type="submit"><i class="fa fa-search"></i></button>
        </form>
        <p>Bienvenue <?php echo $pseudo; ?></p>
        <a href="admin"><i class="fa fa-user"></i></a>
    </div>

    <div id="sommaire">
        <?php if(isset($_SESSION['role'])): ?>
            <nav>
                <ul id="sommAcc"> 
                    <li><a href="../index.php">accueil</a></li>
                    <li><a href="../articles.php">les news</a></li>
                    <li><a href="../contact.php">contact</a></li>
                </ul>
                <hr>
                <ul id="sommAdmin">
                    <?php if($_SESSION['role'] == 'admin'): ?>
                    <li><a href="adduser.php">Ajouter un utilisateur</a></li>
                    <li><a href="chgcover.php">Changer la couverture</a></li>
                    <li><a href="chgprofil.php">Modifier le profil</a></li>
                    <li><a href="contactslist.php">Voir les contacts</a></li>
                    <li><a href="userslist.php">Voir les utilisateurs</a></li>
                    <?php endif; ?>
                    <li><a href="chgpwd.php">Changer de mot de passe</a></li>
                    <li><a href="addnews.php">Ajouter un article</a></li>
                    <li><a href="logout.php">Déconnexion</a></li>
                </ul>
            </nav>
        <?php endif; ?>
    </div>
</header>
<main>
