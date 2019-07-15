<?php include('./ScriptPHP/verif.php'); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <?php include('head.php'); ?>
	<title>EFREIPORT Web | Tous les tickets</title>
</head>
<body class="container" align="center">
	<h1>EFREIPORT | Outil de ticketing Efreiport Web
	<br>Connexion à l'interface Admin
	</h1>
	<br>

	<?php
	/* Connexion à la base de donnée */
	include('co.php');

  // Verification de la presence de la variable err (echec de la connexion precedente)
  if(isset($_GET['err'])) {
    echo "<h2 id='ech'> Echec de connexion, reessayer..... </h2>";
  }
	/* Recupération des différents départements et affichage */
	$res = $link->query("select user_Login, user_mdp from Utilisateur");
	if(isset($res)) {
		?>
		<form method="post" action="./ScriptPHP/connexion.php">
			<div class="input-group mb-3" id="ordinateur">
				<div class="input-group-prepend">
					<span class="input-group-text" id="basic-addon1">Login</span>
				</div>
				<input type="text" class="form-control" placeholder="ex: superoot" name="login" required>
			</div>
			<div class="input-group mb-3" id="ordinateur">
				<div class="input-group-prepend">
					<span class="input-group-text" id="basic-addon1">Mot de passe</span>
				</div>
				<input type="password" class="form-control" placeholder="Ex: ******" name="mdp" required>
			</div>
			<input class="btn btn-primary" name="submit" type="submit" value="Connexion">
		</form>
		<?php
	} else {
		echo "Erreur de connexion à la base de donnée";
	}
	?>
	<br><br>
</body>
</html>
