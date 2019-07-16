<?php include('./ScriptPHP/verif.php');

/* Connexion à la base de donnée */
include('co.php');


/* Vérification que l'id est Administrateur */
$trouve=false;
if (isset($_SESSION['id'])) {
  $res = $link->query("select * from Utilisateur where USER_ID = ".$_SESSION['id']);
  $user=$res->fetch();
    if ($user['USER_ROLE']==0) {
      $usr=$user['USER_LOGIN'];
      $trouve=true;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <?php include('head.php'); ?>
	<title>EFREIPORT Web | Tous les tickets</title>
</head>
<body class="container" align="center">
	<h1>EFREIPORT | Outil de ticketing Efreiport Web
		<br><a href="ScriptPHP/logout.php" class="deco"><img class="imgdeco" src="img/button.png" title="Déconnexion" alt="Déconnexion"></a>
	</h1>
	<br>
  <?php   if($trouve==true) {
      echo "<a class=\"btn btn-danger\" href=\"user_adm.php\" role=\"button\">Gestion des utilisateurs</a>";

    } ?>
	<a class="btn btn-primary" href="all_ticket.php" role="button">Tous les tickets</a>
	<a class="btn btn-primary" href="new_client.php" role="button">Nouveau Client</a>
  <br><br>
	<?php
	/* Recupération des différents départements et affichage */
	$res = $link->query("select CLI_Nom,  CLI_ID from Client");
	if(isset($res)) {
		foreach ($res as $logiciel) {
			?>
			<h2><a href=fiche.php?client=<?php echo $logiciel['CLI_ID'];?>>Client <?php echo $logiciel["CLI_Nom"];?></a></h2>
  <?php
  			}
				echo "</div>";
				echo "<br><br>";
	} else {
		echo "Erreur de connexion à la base de donnée";
	}
	?>
	<br><br>
</body>
</html>
