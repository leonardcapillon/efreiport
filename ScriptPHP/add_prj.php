<?php include('verif.php'); ?>
<!DOCTYPE html>
<?php
/* Connexion à la base de donnée */
include('../co.php');

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
  <?php include('../head.php'); ?>
	<title>EFREIPORT Web | Nouveau projet </title>
  </head>
<body class="container" align="center">
	<h1>EFREIPORT | Nouveau projet du client <?php if ($trouve==true) { echo $nomcli; }?></h1>
  <br>
  <a class="btn btn-primary" href="accueil.php" role="button">Retour à l'accueil</a><br><br>
  <?php

  if($trouve==false ) {
    echo "<br><br>";
    echo "<p>Merci de choisir un client sur l'écran d'accueil</p>";

  } else {

    $cli=$_GET['client'];

    $sql = "INSERT INTO Projet (PRJ_NOM, PRJ_CLI_ID) VALUES (?, ?)";
          $stmt= $link->prepare($sql);
          try {
            $stmt->execute([$_POST['nom'],$cli]);
            echo "<br>Le projet a bien été ajouté<br><br>";
        	} catch (Exception $e) {
        		echo "<br>Il y a eu un problème lors de l'ajout du projet, merci de réessayer.";
            echo "<a class=\"btn btn-primary\" href=\"../project_add.php?client=$cli\" role=\"butto\">Retour</a>";
          }
        ?>

	<br><br>
    <a class="btn btn-primary" href="../fiche.php?client=<?php echo $cli;?>" role="button">Retour</a>
<?php } ?>
</body>
</html>
