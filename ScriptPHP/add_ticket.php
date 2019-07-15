<!DOCTYPE html>
<html lang="fr">
<body>
<?php
session_start();
if (!isset($_SESSION['login'])) {
	header('Location: ../index.php');
}
$sql = "INSERT INTO Client (CLI_NOM, CLI_PRENOM) VALUES (?, ?)
		INSERT INTO Ticket (TCK_TITRE, TCK_DESC) VALUES (?, ?)";
          $stmt= $dbs->prepare($sql);
          try {
            $stmt->execute([$_POST['CLI_NOM'], $_POST['CLI_PRENOM'], $_POST['TCK_TITRE'], $_POST['TCK_DESC']]);
            echo "<br>Le Ticket a bien été ajouté<br><br>";
        	} catch (Exception $e) {
        		echo "<br>Il y a eu un problème lors de la création du ticket, merci de réessayer.";
            echo "<a class=\"btn btn-primary\" href=\"utils.php\" role=\"butto\">Retour</a>";}
?>

	<br><br>
    <a class="btn btn-primary" href="index.adm.php" role="button">Retour à l'accueil</a>
    <br><br><br>

</div>
</body>
</html>
