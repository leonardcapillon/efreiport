<!DOCTYPE html>
<?php
session_start();
if (!isset($_SESSION['login'])) {
	header('Location: ../index.php');
}
/* Connexion à la base de donnée */
include('../co.php');

?>
<html lang="fr">
<head>
  <?php include('../head.php'); ?>
	<title>EFREIPORT Web | Suppression de projet </title>
  </head>
<body class="container" align="center">
	<h1>EFREIPORT | Suppression de projet</h1>
  <br>
  <a class="btn btn-primary" href="../accueil.php" role="button">Retour à l'accueil</a><br><br>
  <?php
/* Passage dans la boucle pour chaque case cochées */
	$checkboxes = isset($_POST['todelete']) ? $_POST['todelete'] : array();
	foreach($checkboxes as $value) {
	/* Selection de chaque tuples 'cochés' */
	$stmt = $link->prepare("DELETE FROM Projet WHERE PRJ_ID=$value");
	try {
		$stmt->execute();
		echo "<br>Le Projet ".$value." a bien été supprimé<br><br>";

	} catch (Exception $e) {
		echo "<br>Il y a eu un problème lors de l'ajout du projet, merci de réessayer.";
	}
?>

<br><br>
<?php } ?>
</body>
</html>
