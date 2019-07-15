<?php include('./ScriptPHP/verif.php'); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <?php include('head.php'); ?>
	<title>EFREIPORT Web | Tous les tickets</title>
</head>
<body class="container" align="center">
	<h1>EFREIPORT | Outil de ticketing Efreiport Web
		<br>Interface Admin	<a href="ScriptPHP/logout.php" class="deco"><img class="imgdeco" src="img/button.png" title="Déconnexion" alt="Déconnexion"></a>
	</h1>
	<br>
	<a class="btn btn-primary" href="all_ticket.php" role="button">Tous les tickets</a>
	<br><br>
	<?php
	/* Connexion à la base de donnée */
	include('co.php');

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
