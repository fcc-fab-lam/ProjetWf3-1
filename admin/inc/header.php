<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>BackOffice</title>
</head>
<body>
<header>
    <h1>BackOffice</h1>
    <nav>
        <ul>
            <?php if($_SESSION['role'] == 'admin'): ?>
            <li><a href="adduser.php">Ajouter un utilisateur</a></li>
            <li><a href="chgcover.php">Changer la couverture</a></li>
            <li><a href="chgprofil.php">Modifier le profil</a></li>
            <li><a href="readcontact.php">Voir les contacts</a></li>
            <?php endif; ?>
            <li><a href="chgpwd.php">Changer de mot de passe</a></li>
            <li><a href="addnews.php">Ajouter un article</a></li>
        </ul>
    </nav>
</header>