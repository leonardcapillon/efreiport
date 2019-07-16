<?php include('./ScriptPHP/verif.php'); ?>
<!DOCTYPE html>
<?php
/* Connexion à la base de donnée */
include('co.php');

/* Vérification que l'argument existe */
$trouve=false;
$res = $link->query("select * from Client");

if (isset($_GET['client'])) {
  foreach ($res as $client) {
    if ($client['CLI_ID']==$_GET['client']) {
      $nomcli=$client['CLI_NOM'];
      $trouve=true;
    }
  }
}
?>
<html lang="fr">
<head>
  <?php include('head.php'); ?>
	<title>EFREIPORT Web | Nouveau projet </title>
  </head>
<body class="container" align="center">
	<h1>EFREIPORT | Nouveau projet du client <?php if ($trouve==true) { echo $nomcli; }?></h1>
  <br>
  <a class="btn btn-primary" href="accueil.php" role="button">Retour à l'accueil</a><br><br>
  <?php

  if($trouve==false ) {
    echo "<br><br>";
    echo "<p>Merci de choisir un client sur l'écran d'accueil</p>";

  } else {

    $cli=$_GET['client'];
    ?>
    <form method="post" name="formulaire" action="ScriptPHP/add_prj.php?client=<?php echo $cli;?>">
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Nom du projet*</span>
        </div>
        <input type="text" class="form-control" name="nom" required>
      </div>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Client*</span>
        </div>
        <input type="text" class="form-control" name="client" <?php if ($trouve==true) {
          echo "value=".$nomcli." disabled";
        }?> required>
      </div>

      <br>
      <input class="btn btn-danger" name="submit" type="submit" value="Créer le projet">
<br><br>

<?php } ?>
</body>
</html>
