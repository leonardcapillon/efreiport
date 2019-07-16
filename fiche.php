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
	<title>EFREIPORT Web | Fiche client </title>
  </head>
<body class="container" align="center">
	<h1>EFREIPORT | Fiche du client <?php if ($trouve==true) { echo $nomcli; }?></h1>
  <br><a href="ScriptPHP/logout.php" class="deco"><img class="imgdeco" src="img/button.png" title="Déconnexion" alt="Déconnexion"></a>
  <br>
  <a class="btn btn-primary" href="accueil.php" role="button">Retour à l'accueil</a>
  <button class="btn btn-secondary" onClick="checkAll('cases[]', true);">Sélectionner tout</button>
  <button class="btn btn-secondary" onClick="checkNorris('cases[]', true);">Ne rien sélectionner</button>
  <br><br>
  <?php

  if($trouve==false ) {
    echo "<br><br>";
    echo "<p>Merci de choisir un client sur l'écran d'accueil</p>";

  } else {

    $cli=$_GET['client'];
    echo "<a class=\"btn btn-primary\" href=\"new_prj.php?client=$cli\" role=\"button\">Ajouter un projet</a>&nbsp;";
    echo "<a class=\"btn btn-info\" href=\"new_ticket.php?client=".$cli."\" role=\"button\">Nouveau ticket</a>";
    echo "<br><br><h2>Projets du client</h2>";
    /* Mise en place de la requête en fontion des arguments reçus et exécution */
    $res2 = $link->query("select prj_id, PRJ_NOM,PRJ_CLI_ID from Projet where PRJ_CLI_ID='".$cli."';");

    /* Definition du tableau en fonction du resultat obtenu lors de la requete précedente */
    if(isset($res2)) {
      echo "<form action='./ScriptPHP/del_prj.php' method='post'>";
      echo "<table class=\"table table-striped table-hover\">";
      echo "<thead>";
      echo "<tr>
      <th scope=\"col\">ID du projet</th>
      <th scope=\"col\">Nom du projet</th>
      <th scope=\"col\" id=\"sup\"><input type='submit' class=\"btn btn-danger\" value='Supprimer la selection'></th>
      </tr>
      <thead>
      <tbody>";
      foreach ($res2 as $prj) {
        echo "<tr id=\"scen\">
        <td onclick='DoNav(\"mod_prj.php?client=".$cli."&num=".$prj['prj_id']."\")'>".$prj['prj_id']."</td>
        <td onclick='DoNav(\"mod_prj.php?client=".$cli."&num=".$prj['prj_id']."\")'>".ucfirst($prj['PRJ_NOM'])."</td>
        <td><input type='checkbox' name='todelete[]' value='".$prj['prj_id']."''></td>
        </tr>";
      }
      echo "</tbody></table>";
      echo "</form>";

      echo "<br><br><h2>Tickets du client</h2>";
      $res2 = $link->query("SELECT t.TCK_ID, t.TCK_TITRE, a.STA_USR_DATETIME, a.STA_COM, a.STA_STATUT FROM Etat a JOIN ( SELECT STA_TCK_ID,MAX(STA_USR_DATETIME) as STA_USR_DATETIME FROM Etat group by STA_TCK_ID ) b on (a.STA_USR_DATETIME = b.STA_USR_DATETIME) AND (a.STA_TCK_ID = b.STA_TCK_ID) JOIN Ticket t on t.TCK_ID = a.STA_TCK_ID JOIN Client c on c.CLI_ID = t.TCK_CLI_ID WHERE c.CLI_ID ='".$cli."';");

    /* Definition du tableau en fonction du resultat obtenu lors de la requete précedente */
    if(isset($res2)) {
      echo "<table class=\"table table-striped table-hover\">";
      echo "<thead>";
      echo "<tr>
      <th scope=\"col\">ID du ticket</th>
      <th scope=\"col\">Date</th>
      <th scope=\"col\">Titre</th>
      <th scope=\"col\">Statut</th>
      <th scope=\"col\">Commentaire</th>
      </tr></thead>
      <tbody>";
      while($notif=$res2->fetch()) {
        $tab=$notif;
        echo "<tr id='scen' onclick='DoNav(\"fiche_ticket.php?ticket=".$notif['TCK_ID']."\")'>
        <td>".$notif['TCK_ID']."</td>".
        "<td>".ucfirst($notif['STA_USR_DATETIME'])."</td>".
        "<td>".ucfirst($notif['TCK_TITRE']).
        "<td>".ucfirst($notif['STA_STATUT'])."</td>".
        "<td>".ucfirst($notif['STA_COM'])."</td>".
        "</tr>";
      }
      echo "</table>";
    } else {
      echo "Erreur d'accès à la base de donnée";

    }
  } else {
      echo "Erreur d'accès à la base de donnée";

    }
  }
  ?>

</body>
</html>
<script type="text/javascript">
window.onload = checkNorris('cases[]', 'true');

function checkAll(name, checked){
  //On parcourt tous les inputs de la page
  var inputs = document.getElementsByTagName('input');
  for(var i=0; i<inputs.length; i++){
    //On regarde s'il s'agit d'une checkbox avec le nom souhaité
    if(inputs[i].type == 'checkbox' && inputs[i].name == 'todelete[]'){
      //On attribue à la case le même état (coché/décoché) que celui de la checkbox servant à tout cocher/décocher
      inputs[i].checked = checked;
    }
  }
}
function checkNorris(name, checked){
  //On parcourt tous les inputs de la page
  var inputs = document.getElementsByTagName('input');
  for(var i=0; i<inputs.length; i++){
    //On regarde s'il s'agit d'une checkbox avec le nom souhaité
    if(inputs[i].type == 'checkbox' && inputs[i].name == 'todelete[]'){
      //On attribue à la case le même état (coché/décoché) que celui de la checkbox servant à tout cocher/décocher
      inputs[i].checked = !checked;
    }
  }
}
function DoNav(theUrl) { document.location.href = theUrl; }
</script>
