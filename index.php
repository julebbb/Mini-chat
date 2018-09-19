<!doctype html>


<html class="no-js" lang="fr">

<head>
  <?php
    include("../../mdp/mdp.php");

    try
    {
      $bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', $mdp);    }
    catch(Exception $e)
    {
            die('Erreur : '.$e->getMessage());
    }
   ?>

  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Mini-chat</title>
  <meta name="description" content="C'est un mini chat fait pour ma formation Yes We Web">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="manifest" href="site.webmanifest">
  <link rel="apple-touch-icon" href="icon.png">
  <!-- Place favicon.ico in the root directory -->
  <!--32x32 le favicon -->

  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/main.css">
</head>

<body>
  <!--[if lte IE 9]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  <![endif]-->

  <!-- Add your site or application content here -->
  <form class="" action="miniChatPost.php" method="post">
    <label for="pseudo">Pseudo: </label>
    <input type="text" name="pseudo" required
    <?php if (isset($_COOKIE['pseudo'])) {
      echo 'value="' . $_COOKIE['pseudo'] . '"' ;
    } ?>>

    <label for="message">Message : </label>
    <input type="text" name="message" required>

    <input type="submit" name="envoyer" value="Envoyer">
  </form>

  <a href="index.php">Réactualiser</a>

  <?php

    $content = $bdd ->query('SELECT pseudo, message,
      DATE_FORMAT(date_create, "%d/%m/%Y") AS date_day,
      DATE_FORMAT(date_create, "%H:%i:%s") AS date_time
      FROM miniChat
      ORDER BY id
      DESC LIMIT 0, 10');

    //display element the 10 more recent messages
    while ($donnees = $content->fetch()) {

  ?>
    <p><?php echo 'Ecris le ' . $donnees['date_day'] . " à " . $donnees['date_time'] . " par " . $donnees['pseudo'] . " :";?></p>
    <p> <?php echo $donnees['message'] ; ?></p>
  <?php
    }
    $content->closeCursor();


   ?>

   <a href="index."></a>

  <script src="js/vendor/modernizr-3.6.0.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script>window.jQuery || document.write('<script src="js/vendor/jquery-3.3.1.min.js"><\/script>')</script>
  <script src="js/plugins.js"></script>
  <script src="js/main.js"></script>

  <!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
  <script>
    window.ga = function () { ga.q.push(arguments) }; ga.q = []; ga.l = +new Date;
    ga('create', 'UA-XXXXX-Y', 'auto'); ga('send', 'pageview')
  </script>
  <script src="https://www.google-analytics.com/analytics.js" async defer></script>
</body>

</html>
