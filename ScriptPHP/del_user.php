<?php include('verif.php'); ?>
<?php
/* Connexion à la base de donnée */
include('../co.php');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <?php include('../head.php'); ?>
	<title>EFREIPORT Web | Supprimer utilisateur</title>
</head>
<body class="container" align="center">
	<h1>EFREIPORT | Supprimer un utilisateur</h1>
  <a class="btn btn-primary" href="../accueil.php" role="button">Retour à l'accueil</a><br><br>

  <?php
  /* Vérification que l'argument existe */
  $trouve=false;
  $res = $link->query('select * from Utilisateur');
  if (isset($_GET['num'])) {
    $usrid = $_GET['num'];
    while ($row = $res->fetch()) {
      if ($row['USER_ID']==$usrid) {
        $trouve=true;
      }
    }
  }

  if($trouve==false ) {
    echo "<br><br>";
    echo "<p>Merci de choisir un utilisateur sur l'écran precedent</p>";
    echo "<a class=\"btn btn-primary\" href=\"../user_adm.php\" role=\"butto\">Retour</a>";
} else {
  $sql = "delete from Utilisateur WHERE USER_ID=?";
  $stmt= $link->prepare($sql);
  try {
    $sql2 = "delete FROM Etat WHERE ( SELECT USER_ID FROM Utilisateur AS T1 WHERE T1.USER_ID = Etat.STA_USR_ID) = $usrid";
    $stmt2= $link->prepare($sql2);

    $stmt2->execute([$usrid]);
    $stmt->execute([$usrid]);
    echo "<br>L'utilisateur a bien été supprimé<br><br>";
    echo "<a class=\"btn btn-primary\" href=\"../user_adm.php\" role=\"butto\">Retour</a>";
  } catch (Exception $e) {
    echo "<br>Il y a eu un problème lors de la supression de l'utilisateur, merci de réessayer.";
    echo "<a class=\"btn btn-primary\" href=\"../user_adm.php\" role=\"butto\">Retour</a>";
  }
}
    ?>
  <br>
</body>
</html>
