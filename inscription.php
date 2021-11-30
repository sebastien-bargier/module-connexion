<?php
require('index.php');
require('db.php');

// si une session existe, l'utilisateur sera renvoyer sur la page profil.
if(isset($_SESSION['user'])) {
    header('Location: profil.php');
}

$errors = [];
if(isset($_POST['ins']) && isset($_POST['ins']) == 'Inscription') {

    $login = htmlspecialchars($_POST['login']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $nom = htmlspecialchars($_POST['nom']);
    $pwd = password_hash($_POST['password'], PASSWORD_ARGON2ID);

    $sql = mysqli_query($db, "SELECT * FROM utilisateurs WHERE login = '".$_POST['login']."'");
    if(mysqli_num_rows($sql)) {
        array_push($errors, "ce login existe déjà!");

    } else if(!empty($_POST['login']) && !empty($_POST['prenom']) &&
    !empty($_POST['nom']) && !empty($_POST['password'])) {

        if ($_POST["password"] == $_POST["confirm-password"]) {
            
            $stmt = mysqli_prepare($db, "INSERT INTO utilisateurs (login, prenom, nom, password)
                    VALUES (?, ?, ?, ?)");
            mysqli_stmt_bind_param($stmt, "ssss", $login, $prenom, $nom, $pwd);
            mysqli_stmt_execute($stmt);
        
            header('Location: connexion.php');
        } else {
            array_push($errors, "Les mots de passe ne correspondent pas!");
        }

    } else {
        
        if(empty($_POST['nom'])) {
            array_push($errors, "Veuillez entrer un login.");
        }
    
        if(empty($_POST['prenom'])) {
            array_push($errors, "Veuillez entrer un prenom.");
        }
    
        if(empty($_POST['nom'])) {
            array_push($errors, "Veuillez entrer un nom.");
        }
        
        if(empty($_POST['password'])) {
            array_push($errors, "Veuillez entrer un mot de passe.");
        }
    
        if(empty($_POST['confirm-password'])) {
            array_push($errors, "Veuillez entrer la confirmation du mot de passe.");
        }
    }
}

?>

<form action='#' method='post'>
 
<?php foreach($errors as $error){ ?>
    <div class="error">
        <?php echo $error; ?>
    </div>
<?php } ?>

    <label for="login">Login</label>
    <input type="text" name="login">

    <label for="prenom">Prenom</label>
    <input type="text" name="prenom">

    <label for="nom">Nom</label>
    <input type="text" name="nom">

    <label for="password">Password</label>
    <input type="password" name="password">

    <label for="confirm-password">Confirm password</label>
    <input type="password" name="confirm-password">

    <input type="submit" class="btn" name="ins" value="Inscription"></input>

</form>