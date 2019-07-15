<?php include('./ScriptPHP/verif.php'); ?>
<!DOCTYPE html>
<?php
/* Connexion à la base de donnée */
include('co.php');

/* Vérification que l'argument existe */
$trouve=false;
$res = $link->query("select * from Client");
$res2 = $link->query("select * from Projet");

if (isset($_GET['client'])) {
  foreach ($res as $client) {
    if ($client['CLI_ID']==$_GET['client']) {
      $nomcli=$client['CLI_NOM'];
      foreach ($res2 as $projet) {
        if ($projet['PRJ_ID']==$_GET['num']) {
          $prj = $_GET['num'];
          $nomproj = $projet['PRJ_NOM'];
          $trouve=true;
        }
      }
    }
  }
}
?>
<html lang="fr">
<head>
  <?php include('head.php'); ?>
	<title>EFREIPORT Web | Modification projet </title>
  </head>
<body class="container" align="center">
	<h1>EFREIPORT | Modification du projet <?php if ($trouve==true) { echo $nomproj; }?></h1>
  <br>
  <a class="btn btn-primary" href="accueil.php" role="button">Retour à l'accueil</a><br><br>
  <?php

  if($trouve==false ) {
    echo "<br><br>";
    echo "<p>Merci de choisir un client sur l'écran d'accueil ou un projet correct.</p>";

  } else {

    $cli=$_GET['client'];
    ?>
    <form method="post" name="formulaire" action="ScriptPHP/action_prj.php?client=<?php echo $cli;?>&num=<?php echo $prj;?>">
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Nom du projet*</span>
        </div>
        <input type="text" class="form-control" name="nom" value=<?php echo $nomproj;?> required>
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
      <input class="btn btn-danger" name="submit" type="submit" value="Modifier le projet">
<br><br>

<?php } ?>
</body>
</html>
