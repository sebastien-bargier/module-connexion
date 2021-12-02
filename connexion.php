<?php
require('index.php');
require('db.php');

if($_SESSION) {
    header('Location: index.php');
}

$errors = [];

if(isset($_POST['co']) && $_POST['co'] == 'Connexion') {

    if (empty($_POST['login'])) {
        array_push($errors, "Veuillez entrer votre login.");
    }

    if (empty($_POST['password'])) {
        array_push($errors, "Veuillez entrer votre mot de passe.");
    }
    
    if (!empty($_POST['login']) && !empty($_POST['password'])) {

        $sql = "SELECT * FROM utilisateurs WHERE login='" . htmlspecialchars($_POST['login']) .  "'";
        $request = mysqli_query($db,$sql);
        $user = mysqli_fetch_all($request,MYSQLI_ASSOC);

        if(count($user)) {
            if(password_verify($_POST['password'], $user[0]['password'])){
                session_start();
                $_SESSION['user'] = $user[0]['login'];
                $_SESSION['prenom'] = $user[0]['prenom'];
                $_SESSION['nom'] = $user[0]['nom'];
                $_SESSION['password'] = $user[0]['password'];

                header('Location: index.php');
            } else {
                array_push($errors, "Le mot de passe est incorrect.");
            }
        } else {
            array_push($errors, "Le login est inconnu.");
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

    <label for="password">Password</label>
    <input type="password" name="password">

    <input type="submit" class="btn" name="co" value="Connexion"></input>
</form>