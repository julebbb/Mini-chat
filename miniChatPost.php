<?php

  include("../../mdp/mdp.php");

try
{
  $bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', $mdp, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

$pseudo = htmlspecialchars($_POST['pseudo']);
$message = htmlspecialchars($_POST['message']);

//if elements exist and not empty
if (isset($pseudo) AND ! empty($pseudo) AND isset($message) AND ! empty($message)) {
  setcookie('pseudo', $pseudo);
  //add element in sql
  $req = $bdd->prepare('INSERT INTO miniChat(pseudo, message) VALUES(:pseudo, :message)');
  $req->execute(array(
    'pseudo' => $pseudo,
    'message' => $message
  ));

}

//stop request
$req->closeCursor();

//return to index.php
header('Location: index.php');


 ?>
