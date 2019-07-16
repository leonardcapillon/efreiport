<?php include('verif.php'); ?>
<!DOCTYPE html>
<?php
/* Connexion à la base de donnée */
include('../co.php');
?>
<html lang="fr">
<head>
	<?php include('../head.php'); ?>
	<title>EFREIPORT Web | Nouveau projet </title>
</head>
<body class="container" align="center">
	<h1>EFREIPORT | Création du ticket </h1>
	<br>
<?php

$sql = "INSERT INTO Ticket (TCK_CLI_ID, TCK_TITRE, TCK_DESC) VALUES (?, ?, ?)";
$sql1 = "INSERT INTO Etat (STA_TCK_ID, STA_USR_ID, STA_STATUT, STA_COM) VALUES(?, ?, ?, ?)";
          $stmt= $link->prepare($sql);
		  		$stmt1=$link->prepare($sql1);
          try {
		  			$stmt->execute([$_POST['client'], $_POST['titre'], $_POST['desc']]);

						$res2= $link->prepare("select TCK_ID from Ticket where TCK_TITRE=?");
						$res2->execute([$_POST['titre']]);
						if (isset($res2)) {
							$row=$res2->fetch();
							$stmt1->execute([$row['TCK_ID'],$_SESSION['id'], $_POST['statut'], $_POST['comentaire']]);
	            echo "<br>Le Ticket a bien été ajouté<br><br>";
						}
        	} catch (Exception $e) {
        		echo "<br>Il y a eu un problème lors de la création du ticket, merci de réessayer.";
            echo "<a class=\"btn btn-primary\" href=\"accueil.php\" role=\"butto\">Retour</a>";}
  ?>
  <br>
  <a class="btn btn-primary" href="../all_ticket.php" role="button">Retour aux Tickets</a><br><br>

</body>
</html>
