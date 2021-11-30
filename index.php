<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="style.css" />
    <title>Document</title>
</head>
<body>
    <header>
        <nav id="titre">
            <li><a href="index.php">Acceuil</a></li>
            <?php 
            
            if($_SESSION) {
                echo ('
                    <li><a href="profil.php">Profil</a></li>
                    <li><a href="deconnexion.php">Déconnexion</a></li>
                ');
                if($_SESSION['user'] == 'admin') {
                    echo '<li><a href="admin.php">Admin</a></li>';
                }
            } else {
                echo ('
                    <li><a href="inscription.php">Inscription</a></li>
                    <li><a href="connexion.php">Connexion</a></li>
                ');
            }

            ?>
        </nav>
    </header>

    <?php 
    if($_SESSION) {
        echo "<div class='info'><h1>Bonjour : " . $_SESSION['prenom'] . " " . $_SESSION['nom'] . "</h1></div>"; 
    }?>

    <div id="container">
        <a class="github" href="https://github.com/sebastien-bargier/module-connexion">Mon lien Github vers module-connexion</a>
    </div>
</body>
</html>