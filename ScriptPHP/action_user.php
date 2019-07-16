<?php include('verif.php'); ?>
<!DOCTYPE html>
<?php
/* Connexion à la base de donnée */
include('../co.php');
/* Vérification que l'id est Administrateur */
$trouve=false;
if (isset($_GET['num'])) {
  $res = $link->query("select * from Utilisateur");
  while($user=$res->fetch()) {
    if ($user['USER_ID']==$_GET['num']) {
      $usrid=$_GET['num'];
      $trouve=true;
    }
  }
}
?>
<html lang="fr">
<head>
	<?php include('../head.php'); ?>
	<title>EFREIPORT Web | Modifier utilisateur </title>
</head>
<body class="container" align="center">
	<h1>EFREIPORT | Modification d'un utilisateur </h1>
	<br>
<?php
if($trouve==false ) {
    echo "<br><br>";
    echo "<p>Vous n'avez pas le droit d'etre ici ou l'utilisateur n'existe pas..... Reessayer.</p>";

  } else {
    try {
            if ($_POST['pass']=='') {
              echo $_POST['numero'];
              $sql = "UPDATE Utilisateur set USER_NOM=?, USER_PRENOM=?, USER_LOGIN=?, USER_EMAIL=?, USER_ROLE=? where USER_ID = ?;)";
              $stmt= $link->prepare($sql);
              $stmt->execute([$_POST['nom'], $_POST['prenom'], $_POST['login'], $_POST['email'], $_POST['numero'], $usrid]);
            } else {
              $sql = "UPDATE Utilisateur set USER_NOM=?, USER_PRENOM=?, USER_LOGIN=?, USER_MDP=?, USER_EMAIL=?, USER_ROLE=? where USER_ID = ?;)";
                        $stmt= $link->prepare($sql);
                        $stmt->execute([$_POST['nom'], $_POST['prenom'], $_POST['login'], password_hash($_POST['pass'], PASSWORD_BCRYPT), $_POST['email'], $_POST['numero'], $usrid]);
            }
            echo "<br>Le client a bien été modifié<br><br>";
        	} catch (Exception $e) {
        		echo "<br>Il y a eu un problème lors de la modification du client, merci de réessayer.";
            echo "<a class=\"btn btn-primary\" href=\"add_user.php\" role=\"butto\">Retour</a>";
          }
        }
?>

  <br>
  <a class="btn btn-primary" href="../user_adm.php" role="button">Retour aux utilisateurs</a><br><br>

</body>
</html>
