<?php

setcookie('pseudo', $_POST['pseudo']);

// Connexion à la base de données "test"
try
{
	$PDO = new PDO('mysql:host=localhost;dbname=minichat;charset=utf8', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

// Préparation de la requête pour l'insertion du message dans la table "minichat"
$insert = $PDO->prepare('INSERT INTO minichat (pseudo, message) VALUES(?, ?)');

// Exécution de l'insertion
$insert -> execute(array($_POST['pseudo'], $_POST['message']));

// Redirection vers minichat.php
header('Location: minichat.php');
