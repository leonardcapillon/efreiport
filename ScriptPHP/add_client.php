<?php include('verif.php'); ?>
<!DOCTYPE html>
<?php
/* Connexion à la base de donnée */
include('../co.php');
?>
<html lang="fr">
<head>
	<?php include('../head.php'); ?>
	<title>EFREIPORT Web | Nouveau client </title>
</head>
<body class="container" align="center">
	<h1>EFREIPORT | Création du client </h1>
	<br>
<?php
$sql = "INSERT INTO Client (CLI_NOM, CLI_PRENOM, CLI_EMAIL) VALUES (?, ?, ?)";
          $stmt= $link->prepare($sql);
          try {
		  $stmt->execute([$_POST['nom'], $_POST['prenom'], $_POST['email']]);
            echo "<br>Le client a bien été ajouté<br><br>";
        	} catch (Exception $e) {
        		echo "<br>Il y a eu un problème lors de la création du client, merci de réessayer.";
            echo "<a class=\"btn btn-primary\" href=\"accueil.php\" role=\"butto\">Retour</a>";}
?>

  <br>
  <a class="btn btn-primary" href="../accueil.php" role="button">Retour aux clients</a><br><br>

</body>
</html>
