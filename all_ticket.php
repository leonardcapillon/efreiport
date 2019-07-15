<?php include('./ScriptPHP/verif.php'); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <?php include('head.php'); ?>
	<title>EFREIPORT Web | Tous les tickets</title>
</head>
<body class="container" align="center">
	<h1>EFREIPORT | Outil de ticketing Efreiport Web | Tous les tickets
    <br>Interface Admin	<a href="ScriptPHP/logout.php" class="deco"><img  style="width:50px;height:50px;" class="imgdeco" src="img/button.png" title="Déconnexion" alt="Déconnexion"></a>
  </h1>
  <br>
  <a class="btn btn-primary" href="accueil.php" role="button">Retour à l'accueil</a>
  <a class="btn btn-primary" href="new_ticket.php" role="button">Créer un nouveau Ticket</a>
  <button class="btn btn-secondary" onClick="checkAll('cases[]', true);">Sélectionner tout</button>
  <button class="btn btn-secondary" onClick="checkNorris('cases[]', true);">Ne rien sélectionner</button>
  <br><br>

  <?php
  /* Connexion à la base de donnée */
  include('co.php');

  /* Execution de la requête dans QRcode_History afin de récuperer l'historique */
  $res = $link->query("select Ticket.TCK_ID, Client.CLI_ID, Client.CLI_NOM, Ticket.TCK_TITRE from Ticket join Client on (TCK_CLI_ID=CLI_ID)");

  /* Definition du tableau en fonction du resultat obtenu lors de la requete précedente */
  if(isset($res)) {
    echo "<form action='./ScriptPHP/del_ticket.php' method='post'>";
    echo "<table class=\"table\">";
    echo "<tr>
    <th>ID du ticket</th>
    <th>Nom du Client</th>
    <th>Nom du ticket</th>
    <th><input type='submit' class=\"btn btn-danger\" value='Supprimer la selection'></th>
    </tr>";
    while($cli=$res->fetch()){
      echo "<tr><td>".$cli['TCK_ID']."</td>".
      "<td><a href=\"fiche.php?client=".$cli['CLI_ID']."\">".ucfirst($cli['CLI_NOM'])."</a></td>".
      "<td><a href=\"mod_ticket.php?ticket=".$cli['TCK_ID']."\">".ucfirst($cli['TCK_TITRE']).
      "<td><input type='checkbox' name='todelete[]' value='".$cli['TCK_ID']."''></td>".
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
