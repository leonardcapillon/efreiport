<?php include('verif.php'); ?>
<!DOCTYPE html>
<?php
/* Connexion à la base de donnée */
include('../co.php');
?>
<html lang="fr">
<head>
	<?php include('../head.php'); ?>
	<title>EFREIPORT Web | Nouveau utilisateur </title>
</head>
<body class="container" align="center">
	<h1>EFREIPORT | Création d'un utilisateur </h1>
	<br>
<?php
$sql = "INSERT INTO Utilisateur (USER_NOM, USER_PRENOM, USER_LOGIN, USER_MDP, USER_EMAIL, USER_ROLE) VALUES (?, ?, ?, ?, ?, ?)";
          $stmt= $link->prepare($sql);
          try {
		  $stmt->execute([$_POST['nom'], $_POST['prenom'], $_POST['login'], password_hash($_POST['pass'], PASSWORD_BCRYPT), $_POST['email'], $_POST['numero']]);
            echo "<br>Le client a bien été ajouté<br><br>";
        	} catch (Exception $e) {
        		echo "<br>Il y a eu un problème lors de la création du client, merci de réessayer.";
            echo "<a class=\"btn btn-primary\" href=\"add_user.php\" role=\"butto\">Retour</a>";}
?>

  <br>
  <a class="btn btn-primary" href="../user_adm.php" role="button">Retour aux utilisateurs</a><br><br>

</body>
</html>
