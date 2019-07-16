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
	<title>EFREIPORT Web | Utilisateurs </title>
  </head>
<body class="container" align="center">
	<h1>EFREIPORT | Gestion des utilisateurs</h1>
  <br><a href="ScriptPHP/logout.php" class="deco"><img class="imgdeco" src="img/button.png" title="Déconnexion" alt="Déconnexion"></a><br>
  <a class="btn btn-primary" href="accueil.php" role="button">Retour à l'accueil</a>
  <?php

  if($trouve==false ) {
    echo "<br><br>";
    echo "<p>Vous n'avez pas le droit d'etre ici..... Reessayer en admin.</p>";

  } else {
    $res = $link->query('select * from Utilisateur');
    echo "<a class=\"btn btn-primary\" href=\"new_user.php\" role=\"button\">Ajouter un utilisateur</a><br><br>";
    /* Definition du tableau en fonction du resultat obtenu lors de la requete précedente */
    if(isset($res)) {
      echo "Vous pouvez cliquer n'importe ou sur le tableau pour acceder a la modification de l'utilisateur.<br>
      /!\ Attention ! Supprimer un utilisateur supprimera les interractions qu'il a eu avec des tickets (etat)<br><br>";
	     echo "<table class=\"table table-striped table-hover\">";
      echo "<thead>
      <tr>
      <th scope=\"col\">ID</th>
      <th scope=\"col\">Nom</th>
      <th scope=\"col\">Prénom</th>
      <th scope=\"col\">Login</th>
      <th scope=\"col\">Mail</th>
      <th scope=\"col\">Role</th>
      <th scope=\"col\">Supression</th>
	  </tr>
      <thead>
      <tbody>";
      while($user=$res->fetch()){
		echo "<tr id=\"scen\">
      <td onclick='DoNav(\"mod_user.php?num=".$user['USER_ID']."\")'>".$user['USER_ID']."</td>".
        "<td onclick='DoNav(\"mod_user.php?num=".$user['USER_ID']."\")'>".ucfirst($user['USER_NOM'])."</a></td>".
        "<td onclick='DoNav(\"mod_user.php?num=".$user['USER_ID']."\")'>".ucfirst($user['USER_PRENOM'])."</td>".
		    "<td onclick='DoNav(\"mod_user.php?num=".$user['USER_ID']."\")'>".ucfirst($user['USER_LOGIN'])."</td>".
        "<td onclick='DoNav(\"mod_user.php?num=".$user['USER_ID']."\")'>".ucfirst($user['USER_EMAIL'])."</td>";

        switch ($user['USER_ROLE']) {
          case 0:
            echo "<td onclick='DoNav(\"mod_user.php?num=".$user['USER_ID']."\")'>Administrateur</td>";
            break;

          case 1:
            echo "<td onclick='DoNav(\"mod_user.php?num=".$user['USER_ID']."\")'>Reporteur</td>";
            break;

          case 2:
            echo "<td onclick='DoNav(\"mod_user.php?num=".$user['USER_ID']."\")'>Developpeur</td>";
            break;

          default:
            echo "<td onclick='DoNav(\"mod_user.php?num=".$user['USER_ID']."\")'>".ucfirst($user['USER_ID'])."</td>";
            break;
        }

        echo "<td class=\"btn btn-danger\" onclick='DoNav(\"ScriptPHP/del_user.php?num=".$user['USER_ID']."\")'>Supprimer utilisateur</td>".
		  "</tr>";

      }
      echo "</tbody></table>";
    } else
    echo "erreur";
}
    ?>
</body>
</html>
<script type="text/javascript">
function DoNav(theUrl) { document.location.href = theUrl; }
</script>
