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
      $res2 = $link->query("select * from Utilisateur;");
      while ($id = $res2->fetch()) {
        if ($_GET['num']==$id['USER_ID']) {
          $userid=$_GET['num'];
          $trouve=true;
        }
      }
    }
}
?>

<html lang="fr">
<head>
  <?php include('head.php'); ?>
	<title>EFREIPORT Web | modification utilisateur </title>
  </head>
<body class="container" align="center">
	<h1>EFREIPORT | modification d'un utilisateur </h1>
  <br>
  <a class="btn btn-primary" href="user_adm.php" role="button">Retour aux utilisateurs</a><br><br>
  <?php   if($trouve==false ) {
      echo "<br><br>";
      echo "<p>Vous n'avez pas le droit d'etre ici ou l'utiisateur n'existe pas..... Reessayer.</p>";

    } else {
    $res=$link->query("Select * from Utilisateur where USER_ID=$userid");
    if($res) {
    $row = $res->fetch();
      ?>
    <form method="post" name="formulaire" action="ScriptPHP/action_user.php?num=<?php echo $userid;?>">
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Nom*</span>
        </div>
        <input type="text" class="form-control" name="nom" value="<?php echo $row['USER_NOM'];?>" required>
      </div>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Prénom*</span>
        </div>
        <input type="text" class="form-control" name="prenom" value="<?php echo $row['USER_PRENOM'];?>" required>
      </div>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Login*</span>
        </div>
        <input type="text" class="form-control" name="login" value="<?php echo $row['USER_LOGIN'];?>" required>
      </div>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Mot de passe*</span>
        </div>
        <input type="text" class="form-control" name="pass">
      </div>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Email*</span>
        </div>
        <input type="text" class="form-control" name="email" value="<?php echo $row['USER_EMAIL'];?>" required>
      </div>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <label class="input-group-text" for="inputGroupSelect01">Role*</label>
        </div>
        <select name="numero" class="custom-select" value="<?php echo $row['USER_ROLE'];?>" required>
          <option>Choose...</option>
          <option value=0>Administrateur</option>
          <option value=1>Reporteur</option>
          <option value=2>Developpeur</option>
        </select>
      </div>
      <br>
      <input class="btn btn-danger" name="submit" type="submit" value="Modifier l'utilisateur">
<br><br><?php }} ?>
</body>
</html>
