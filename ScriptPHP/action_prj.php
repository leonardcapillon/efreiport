<!DOCTYPE html>
<?php
session_start();
if (!isset($_SESSION['login'])) {
	header('Location: ../index.php');
}
/* Connexion à la base de donnée */
include('../co.php');

/* Vérification que l'argument existe */
$trouve=false;
$res = $link->query("select * from Client");
$res2 = $link->query("select * from Projet");

if (isset($_GET['client'])) {
  foreach ($res as $client) {
    if ($client['CLI_ID']==$_GET['client']) {
      $nomcli=$client['CLI_NOM'];
      foreach ($res2 as $projet) {
        if ($projet['PRJ_ID']==$_GET['num']) {
          $prj = $_GET['num'];
          $nomproj = $projet['PRJ_NOM'];
          $trouve=true;
        }
      }
    }
  }
}

?>
<html lang="fr">
<head>
  <?php include('../head.php'); ?>
	<title>EFREIPORT Web | Modification projet </title>
  </head>
<body class="container" align="center">
	<h1>EFREIPORT | Modification du projet <?php if ($trouve==true) { echo $nomproj; }?></h1>
  <br>
  <a class="btn btn-primary" href="../accueil.php" role="button">Retour à l'accueil</a><br><br>
  <?php
  if($trouve==false ) {
    echo "<br><br>";
    echo "<p>Merci de choisir un client sur l'écran d'accueil</p>";

  } else {

    $cli=$_GET['client'];

    $sql = "UPDATE Projet SET PRJ_NOM=?  WHERE PRJ_ID=?";
          $stmt= $link->prepare($sql);
          try {
            $stmt->execute([$_POST['nom'],$prj]);
            echo "<br>Le projet a bien été modifié<br><br>";
        	} catch (Exception $e) {
        		echo "<br>Il y a eu un problème lors de la modification du projet, merci de réessayer.";
            echo "<a class=\"btn btn-primary\" href=\"../fiche.php?client=$cli\" role=\"butto\">Retour</a>";
          }
        ?>

	<br><br>
    <a class="btn btn-primary" href="../fiche.php?client=<?php echo $cli;?>" role="button">Retour</a>
<?php } ?>
</body>
</html>
