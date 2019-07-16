<?php include('./ScriptPHP/verif.php'); ?>
<!DOCTYPE html>
<?php
/* Connexion à la base de donnée */
include('co.php');
/* Vérification que l'argument existe */
$trouve=false;
$res = $link->query("select * from Client");
?>
<html lang="fr">
<head>
  <?php include('head.php'); ?>
	<title>EFREIPORT Web | Nouveau Client </title>
  </head>
<body class="container" align="center">
	<h1>EFREIPORT | Création du client </h1>
  <br>
  <a class="btn btn-primary" href="accueil.php" role="button">Retour aux clients</a><br><br>
    <form method="post" name="formulaire" action="ScriptPHP/add_client.php">
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Nom*</span>
        </div>
        <input type="text" class="form-control" name="nom" required>
      </div>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Prénom*</span>
        </div>
        <input type="text" class="form-control" name="prenom" required>
      </div>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Email*</span>
        </div>
        <input type="text" class="form-control" name="email" required>
      </div>
      <br>
      <input class="btn btn-danger" name="submit" type="submit" value="Créer le client">
<br><br>
</body>
</html>
