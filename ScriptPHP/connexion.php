<?php
include('../co.php');
$log = $link->real_escape_string ($_POST['login']);
$mdp = $link->real_escape_string ($_POST['mdp']);
// Vérification des identifiants
$resultat = $link->query("SELECT user_mdp FROM Utilisateur WHERE user_login = '$log'");
$pass = $resultat->fetch_assoc();

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
    header('Location: ../index_adm.php');
  }

} else {
  header("Location: ../index.php?err=1");
}
?>
