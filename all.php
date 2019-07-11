<?php include('./ScriptPHP/verif.php'); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <?php include('head.php'); ?>
	<title>EFREIPORT Web | Tous les tickets</title>
</head>
<body class="container" align="center">
	<h1>EFREIPORT | Outil de ticketing Efreiport Web | Tous les tickets
    <br>Interface Admin	<a href="ScriptPHP/logout.php" class="deco"><img class="imgdeco" src="img/button.png" title="Déconnexion" alt="Déconnexion"></a>
  </h1>
  <br>
  <a class="btn btn-primary" href="index_adm.php" role="button">Retour à l'accueil</a>
  <button class="btn btn-secondary" onClick="checkAll('cases[]', true);">Sélectionner tout</button>
  <button class="btn btn-secondary" href="all_adm.php" onClick="checkNorris('cases[]', true);">Ne rien sélectionner</button>
  <br><br>

  <?php
  /* Connexion à la base de donnée */
  include('co.php');

  /* Execution de la requête dans QRcode_History afin de récuperer l'historique */
  $res = $link->query("select id, date, salle, type, pc, description from Ticket");

  /* Definition du tableau en fonction du resultat obtenu lors de la requete précedente */
  if(isset($res)) {
    echo "<form action='./ScriptPHP/TicketDelete.php' method='post'>";
    echo "<table class=\"table\">";
    echo "<tr>
    <th>ID du ticket</th>
    <th>Date</th>
    <th>Salle</th>
    <th>Type de problème</th>
    <th>Numéro du poste</th>
    <th>Description</th>
    <th><input type='submit' class=\"btn btn-danger\" value='Supprimer la selection'></th>
    </tr>";
    while($notif=mysqli_fetch_assoc($res)){
      echo "<tr><td>".$notif['id']."</td>".
      "<td>".$notif['date']."</td>".
      "<td><a href=\"notif_adm.php?salle=".$notif['salle']."\">".ucfirst($notif['salle'])."</a></td>".
      "<td>".ucfirst($notif['type']).
      "<td>".ucfirst($notif['pc'])."</td>".
      "<td>".$notif['description']."</td>".
      "<td><input type='checkbox' name='todelete[]' value='".$notif['id']."''></td>".
      "</tr>";
    }
    echo "</table>";
  } else
  echo "erreur";
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
