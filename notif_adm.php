<?php include('./ScriptPHP/verif.php');
/* Connexion à la base de donnée */
include('../co.php');

/* Vérification que l'argument existe */
$trouve=false;
$info=false;
$res = $link->query("select * from Salle");
if (isset($_GET['salle'])) {
  foreach ($res as $salle) {
    if ($salle['salle']==$_GET['salle']) {
      $trouve=true;
      if ($salle['type'] === "Salles informatique") {
        $info=true;
      }
    }
  }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Report Bleau Admin | Tickets de la salle <?php if ($trouve==true) { echo $_GET['salle']; }?></title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
  <link rel="stylesheet" media="screen" href="../css/SiteAppli.css">
  <link rel="icon" href="../img/favicon.png" type="image/x-icon"/>
  <link rel="shortcut icon" href="../img/favicon.png" type="image/x-icon"/>
</head>
<body class="container">
  <h1>Report Bleau Admin | Tickets de la salle <?php if ($trouve==true) { echo $_GET['salle']; }?>
    <br>Interface Admin	<a href="ScriptPHP/logout.php" class="deco"><img class="imgdeco" src="../img/button.png" title="Déconnexion" alt="Déconnexion"></a>
  </h1>
  <br>
  <a class="btn btn-primary" href="index_adm.php" role="button">Retour à l'accueil</a>
  <a class="btn btn-primary" href="all_adm.php" role="button">Tous les tickets</a>
  <button class="btn btn-secondary" onClick="checkAll('cases[]', true);">Sélectionner tout</button>
  <button class="btn btn-secondary" href="all_adm.php" onClick="checkNorris('cases[]', true);">Ne rien sélectionner</button>
  <br><br>

  <?php
  if($trouve==false ) {
    echo "<p>Merci de choisir une salle sur l'écran d'accueil</p>";

  } else {

    $sallew=$_GET['salle'];

    /* Mise en place de la requête en fontion des arguments reçus et exécution */
    $res = $link->query("select id, date, salle, type, pc, description from Ticket where salle='".$sallew."';");

    /* Definition du tableau en fonction du resultat obtenu lors de la requete précedente */
    /* Ajout : Formulaire permettant la suppression de tuples directement sur le site */
    if(isset($res)) {
      echo "<form action='./ScriptPHP/TicketDelete.php?salle=".$sallew."' method='post'>";
      echo "<table class=\"table\">";
      echo "<tr>
      <th>ID du ticket</th>
      <th>Date</th>
      <th>Type de problème</th>";
      if ($info==true) {
        echo "<th>Numéro du poste</th>";
      }
      echo "<th>Description</th>
      <th><input class=\"btn btn-danger\" type='submit' value='Supprimer la selection'></th>
      </tr>";
      foreach ($res as $notif) {
        echo "<tr><td>".$notif['id']."</td>".
        "<td>".$notif['date']."</td>".
        "<td>".ucfirst($notif['type'])."</td>";
        if ($info==true) {
          echo "<td>".ucfirst($notif['pc'])."</td>";
        }
        echo "<td>".ucfirst($notif['description'])."</td>".
        "<td><input type='checkbox' name='todelete[]' value='".$notif['id']."''></td>".
        "</tr>";
      }
      echo "</table>";
      echo "</form>";
    } else {
      echo "erreur";

    }
  }
  ?>
  <script>

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
  </script>
</body>
</html>
