<?php
include('../co.php');
$log = $_POST['login'];
$mdp = $_POST['mdp'];

// Vérification des identifiants
$resultat = $link->prepare("SELECT user_mdp FROM Utilisateur WHERE user_login = ?");
$resultat->execute([$log]);
$pass = $resultat->fetch();

if (password_verify($mdp,$pass['user_mdp']))
{
  session_start();
  $_SESSION['login'] = $log;
  if (isset($_SESSION['login_redirect'])) {
    header("Location: " . $_SESSION['login_redirect']."?salle=".$_SESSION['salle']);
    // And remember to clean up the session variable after
    // this is done. Don't want it lingering.
    unset($_SESSION['login_redirect']);
    unset($_SESSION['salle']);
  }
  else {
    header('Location: ../accueil.php');
  }

} else {
  header("Location: ../index.php?err=1");
}
?>
