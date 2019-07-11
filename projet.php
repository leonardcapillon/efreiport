<!DOCTYPE html>
<?php
/* Connexion à la base de donnée */
include('co.php');

/* Vérification que l'argument existe */
$trouve=false;
$res = $link->query("select * from Client");

if (isset($_GET['client'])) {
  foreach ($res as $client) {
    if ($client['CLI_ID']==$_GET['client']) {
      $nomcli=$client['CLI_NOM'];
      $trouve=true;
    }
  }
}
?>
<html lang="fr">
<head>
  <?php include('head.php'); ?>
	<title>EFREIPORT Web | Affichage </title>
  </head>
<body class="container" align="center">
	<h1>EFREIPORT | Projets du client <?php if ($trouve==true) { echo $nomcli; }?></h1>
  <br>
  <a class="btn btn-primary" href="index_adm.php" role="button">Retour à l'accueil</a>
  <a class="btn btn-primary" href="all.php" role="button">Tous les tickets</a>

  <?php

  if($trouve==false ) {
    echo "<br><br>";
    echo "<p>Merci de choisir un client sur l'écran d'accueil</p>";

  } else {

    $cli=$_GET['client'];
    echo "<a class=\"btn btn-info\" href=\"newtick.php?client=".$cli."\" role=\"button\">Nouveau ticket</a>";
    echo "<br><br>";
    /* Mise en place de la requête en fontion des arguments reçus et exécution */
    $res2 = $link->query("select prj_id, PRJ_NOM,PRJ_CLI_ID from Projet where PRJ_CLI_ID='".$cli."';");

    /* Definition du tableau en fonction du resultat obtenu lors de la requete précedente */
    if(isset($res2)) {
      echo "<table class=\"table\">";
      echo "<tr>
      <th>ID</th>
      <th>Nom du projet</th>
      </tr>";
      foreach ($res2 as $notif) {
        echo "<td>".$notif['prj_id']."</td>".
        "<td>".ucfirst($notif['PRJ_NOM'])."</td>
        </tr>";
      }
      echo "</table>";
      echo "</form>";


      $res2 = $link->query("select TCK_ID, TCK_TITRE, STA_USR_DATETIME, STA_COM, STA_STATUT from Ticket join Etat on (TCK_ID=STA_TCK_ID) join Client on (TCK_CLI_ID=CLI_ID) where CLI_ID='".$cli."';");

    /* Definition du tableau en fonction du resultat obtenu lors de la requete précedente */
    if(isset($res2)) {
      echo "<table class=\"table\">";
      echo "<tr>
      <th>Date</th>
      <th>Type de problème</th>";
      echo "<th>Description</th>
      </tr>";
      foreach ($res2 as $notif) {
        echo "<td>".$notif['TCK_ID']."</td>".
        "<td>".ucfirst($notif['STA_USR_DATETIME'])."</td>".
        "<td>".ucfirst($notif['TCK_TITRE']).
        "<td>".ucfirst($notif['STA_STATUT'])."</td>".
        "<td>".ucfirst($notif['STA_COM'])."</td>".
        "</tr>";
      }
      echo "</table>";
    } else {
      echo "Erreur d'accès à la base de donnée";

    }
  } else {
      echo "Erreur d'accès à la base de donnée";

    }
  }
  ?>

</body>
</html>
