<?php include('./ScriptPHP/verif.php'); ?>
<!DOCTYPE html>
<?php
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

<html lang="fr">
<head>
  <?php include('head.php'); ?>
	<title>EFREIPORT Web | Nouveau utilisateur </title>
  </head>
<body class="container" align="center">
	<h1>EFREIPORT | Création d'un utilisateur </h1>
  <br>
  <a class="btn btn-primary" href="user_adm.php" role="button">Retour aux utilisateurs</a><br><br>
  <?php if($trouve==false ) {
    echo "<br><br>";
    echo "<p>Vous n'avez pas le droit d'etre ici..... Reessayer en admin.</p>";

  } else {
    ?>
    <form method="post" name="formulaire" action="ScriptPHP/add_user.php">
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
          <span class="input-group-text" id="basic-addon1">Login*</span>
        </div>
        <input type="text" class="form-control" name="login" required>
      </div>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Mot de passe*</span>
        </div>
        <input type="text" class="form-control" name="pass" required>
      </div>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Email*</span>
        </div>
        <input type="text" class="form-control" name="email" required>
      </div>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <label class="input-group-text" for="inputGroupSelect01">Role*</label>
        </div>
        <select name="numero" class="custom-select" required>
          <option selected>Choose...</option>
          <option value=0>Administrateur</option>
          <option value=1>Reporteur</option>
          <option value=2>Developpeur</option>
        </select>
      </div>
      <br>
      <input class="btn btn-danger" name="submit" type="submit" value="Créer l'utilisateur">
<br><br><?php }?>
</body>
</html>
