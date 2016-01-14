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
    <title>BackOffice</title>
</head>
<body>
<header>
    <h1>Bienvenue <?php echo $pseudo; ?></h1>
    <?php if(isset($_SESSION['role'])): ?>
    <nav>
        <ul>
            <?php if($_SESSION['role'] == 'admin'): ?>
            <li><a href="adduser.php">Ajouter un utilisateur</a></li>
            <li><a href="chgcover.php">Changer la couverture</a></li>
            <li><a href="chgprofil.php">Modifier le profil</a></li>
            <li><a href="contactlist.php">Voir les contacts</a></li>
            <li><a href="userslist.php">Voir les utilisateurs</a></li>
            <?php endif; ?>
            <li><a href="chgpwd.php">Changer de mot de passe</a></li>
            <li><a href="addnews.php">Ajouter un article</a></li>
            <li><a href="logout.php">Déconnexion</a></li>
        </ul>
    </nav>
    <?php endif; ?>
</header>