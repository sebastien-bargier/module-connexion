<?php
require('index.php');
require('db.php');

// si aucune session utilisateur, il sera renvoyé sur la page connexion.
if(!isset($_SESSION["user"])) {
   header('Location: connexion.php');
}

if(isset($_POST['mod']) && isset($_POST['mod']) == 'Modifier') {

    $login = htmlspecialchars($_POST['login']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $nom = htmlspecialchars($_POST['nom']);
    $pwd = password_hash($_POST['password'], PASSWORD_ARGON2ID);

    $sql = "UPDATE utilisateurs
                    SET login = '$login',
                    prenom = '$prenom',
                    nom = '$nom',
                    password = '$pwd'
                    WHERE login = '".$_SESSION['user']."' ";
    $req = mysqli_query($db,$sql);
    mysqli_close($db);

    if($req) {
        $_SESSION['user'] = $_POST['login'];
        $_SESSION['prenom'] = $_POST['prenom'];
        $_SESSION['nom'] = $_POST['nom'];

        if ($_POST["password"] == $_POST["confirm-password"]) {
            $_SESSION['password'] = $_POST['password'];

            header('refresh:2;');
            $message = "Votre profil à été mis à jour avec succès.";
        } else {
            $message = "Les mots de passe ne correspondent pas!";
        }
    }
}

?>
<form action='#' method='post'>

    <?php if(!empty($message)) : ?>
        <p class="error"><?php echo $message; ?></p>
    <?php endif; ?>

    <label for="login">Login</label>
    <input type="text" name="login" value="<?php echo $_SESSION['user']; ?>">

    <label for="prenom">Prenom</label>
    <input type="text" name="prenom" value="<?php echo $_SESSION['prenom']; ?>">

    <label for="nom">Nom</label>
    <input type="text" name="nom" value="<?php echo $_SESSION['nom']; ?>">

    <label for="password">Password</label>
    <input type="password" name="password" value="<?php echo $_SESSION["password"]; ?>">

    <label for="confirm-password">Confirm password</label>
    <input type="password" name="confirm-password" value="<?php echo $_SESSION['password']; ?>">

    <input type="submit" class="btn" name="mod" value="Modifier"></input>
</form>