<?php include('verif.php'); ?>
<?php
/* Connexion à la base de donnée */
include('../co.php');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <?php include('../head.php'); ?>
	<title>EFREIPORT Web | Tous les tickets</title>
</head>
<body class="container" align="center">
	<h1>EFREIPORT | Tous les tickets </h1>

  <?php
  $checkboxes = isset($_POST['todelete']) ? $_POST['todelete'] : array();
	foreach($checkboxes as $value) {
	/* Selection de chaque tuples 'cochés' */
	$stmt = $link->prepare("DELETE FROM Ticket WHERE TCK_ID=$value");
	try {
		$stmt->execute();
		echo "<br>Le Ticket ".$value." a bien été supprimé<br><br>";

	} catch (Exception $e) {
		echo "<br>Il y a eu un problème lors de la supression du ticket, merci de réessayer.";
	}
}	
   ?>

  <br>
  <a class="btn btn-primary" href="../accueil.php" role="button">Retour à l'accueil</a>
  
</body>
</html>