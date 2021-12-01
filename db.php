<?php

$db = mysqli_connect('localhost','root','','moduleconnexion');

if (!$db) {
    die("La connexion a échoué: " . mysqli_connect_error());
}