<<<<<<< HEAD
<!DOCTYPE html>
=======
<?php include('verif.php'); ?>
<!DOCTYPE html>	
<?php
/* Connexion à la base de donnée */
include('../co.php');
?>
>>>>>>> b5876c69b7d1da9cf7251fbb0a13766a5dc77230
<html lang="fr">
<head>
	<?php include('../head.php'); ?>
	<title>EFREIPORT Web | Nouveau projet </title>
</head>
<body class="container" align="center">
	<h1>EFREIPORT | Création du ticket </h1>
	<br>
<?php
<<<<<<< HEAD
session_start();
if (!isset($_SESSION['login'])) {
	header('Location: ../index.php');
}
$sql = "INSERT INTO Client (CLI_NOM, CLI_PRENOM) VALUES (?, ?)
		INSERT INTO Ticket (TCK_TITRE, TCK_DESC) VALUES (?, ?)";
          $stmt= $dbs->prepare($sql);
=======
$sql = "INSERT INTO Ticket (TCK_CLI_ID, TCK_TITRE, TCK_DESC) VALUES (?, ?, ?)";
          $stmt= $link->prepare($sql);
>>>>>>> b5876c69b7d1da9cf7251fbb0a13766a5dc77230
          try {
		  $stmt->execute([$_POST['client'], $_POST['titre'], $_POST['desc']]);
            echo "<br>Le Ticket a bien été ajouté<br><br>";
        	} catch (Exception $e) {
        		echo "<br>Il y a eu un problème lors de la création du ticket, merci de réessayer.";
            echo "<a class=\"btn btn-primary\" href=\"accueil.php\" role=\"butto\">Retour</a>";}
?>

  <br>
  <a class="btn btn-primary" href="../all_ticket.php" role="button">Retour aux Tickets</a><br><br>	

</body>
</html>







