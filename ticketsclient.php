<!DOCTYPE html>
<?php
/* Connexion à la base de donnée */
include('co.php');

/* Vérification que l'argument existe */
$trouve=false;
$res = $link->query("select * from Client, Projet");
echo $_GET['client'];
if (isset($_GET['client'])) {
  foreach ($res as $client) {
    if ($client['CLI_ID']==$_GET['client']) {
      /*if ($client['PRJ_ID']==$_GET['prj']) {
        // code...
      }*/
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
	<h1>EFREIPORT | Projets du client <?php if ($trouve==true) { echo $_GET['client']; }?></h1>
  <br>
  <a class="btn btn-primary" href="index_adm.php" role="button">Retour à l'accueil</a>
  <a class="btn btn-primary" href="all.php" role="button">Tous les tickets</a>

  <?php

  if($trouve==false ) {
    echo "<br><br>";
    echo "<p>Merci de choisir un projet sur l'écran precedent</p>";

  } else {

    $proj=$_GET['projet'];
    echo "<a class=\"btn btn-info\" href=\"newtick.php?salle=".$proj."\" role=\"button\">Nouveau ticket</a>";
    echo "<br><br>";
    /* Mise en place de la requête en fontion des arguments reçus et exécution */
    $res2 = $link->query("select TCK_ID, TCK_TITRE, STA_USR_DATETIME, STA_COM, STA_STATUT from Ticket natural join Etat where TCK_CLI_ID='".$cli."';");

    /* Definition du tableau en fonction du resultat obtenu lors de la requete précedente */
    if(isset($res2)) {
      echo "<table class=\"table\">";
      echo "<tr>
      <th>Date</th>
      <th>Type de problème</th>";
      if ($info==true) {
        echo "<th>Numéro du poste</th>";
      }
      echo "<th>Description</th>
      </tr>";
      foreach ($res2 as $notif) {
        echo "<td>".$notif['date']."</td>".
        "<td>".ucfirst($notif['type'])."</td>";
        if ($info==true) {
          echo "<td>".ucfirst($notif['pc']);
        }
        echo "<td>".ucfirst($notif['description'])."</td>".
        "</tr>";
      }
      echo "</table>";
      echo "</form>";
    } else {
      echo "Erreur d'accès à la base de donnée";

    }
  }
  ?>

</body>
</html>
