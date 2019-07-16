<?php
include('../co.php');
$log = $_POST['login'];
$mdp = $_POST['mdp'];

// Vérification des identifiants
$resultat = $link->prepare("SELECT USER_MDP, USER_ROLE, USER_ID FROM Utilisateur WHERE USER_LOGIN = ?");
$resultat->execute([$log]);
$pass = $resultat->fetch();

if (password_verify($mdp,$pass['USER_MDP']))
{
  session_start();
  $_SESSION['login'] = $log;
  $_SESSION['id'] = $pass['USER_ID'];

  if (isset($_SESSION['login_redirect'])) {
    header("Location: " . $_SESSION['login_redirect']."?client=".$_SESSION['client']);
    // And remember to clean up the session variable after
    // this is done. Don't want it lingering.
    unset($_SESSION['login_redirect']);
    unset($_SESSION['client']);
  }
  else {
    header('Location: ../accueil.php');
  }

} else {
  header("Location: ../index.php?err=1");
}
?>
