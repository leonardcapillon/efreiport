<?php include('./ScriptPHP/verif.php'); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <?php include('head.php'); ?>
	<title>EFREIPORT Web | Tous les tickets</title>
</head>
<body class="container" align="center">
	<h1>EFREIPORT | Outil de ticketing Efreiport Web | Tous les tickets
    <br><a href="ScriptPHP/logout.php" class="deco"><img class="imgdeco" src="img/button.png" title="Déconnexion" alt="Déconnexion"></a>
  </h1>
  <br><br>
  <a class="btn btn-primary" href="accueil.php" role="button">Retour à l'accueil</a>
  <a class="btn btn-secondary" href="new_ticket.php" role="button">Créer un nouveau Ticket</a>
  <br><br>

  <?php
  /* Connexion à la base de donnée */
  include('co.php');

  /* Execution de la requête dans QRcode_History afin de récuperer l'historique */
  $res = $link->query("select Ticket.TCK_ID, Client.CLI_ID, Client.CLI_NOM, Ticket.TCK_TITRE from Ticket join Client on (TCK_CLI_ID=CLI_ID)");

  /* Definition du tableau en fonction du resultat obtenu lors de la requete précedente */
  if(isset($res)) {
    echo "<table class=\"table table-striped table-hover\">";
    echo "<thead>";
    echo "<tr>
    <th scope=\"col\">ID du ticket</th>
    <th scope=\"col\">Nom du Client</th>
    <th scope=\"col\">Nom du ticket</th>
    </tr>
    </thead>
    <tbody>";
    while($cli=$res->fetch()){
      echo "<tr id='scen' onclick='DoNav(\"fiche_ticket.php?ticket=".$cli['TCK_ID']."\")'>
      <td>".$cli['TCK_ID']."</td>".
      "<td><a href=\"fiche.php?client=".$cli['CLI_ID']."\">".ucfirst($cli['CLI_NOM'])."</a></td>".
      "<td><a href=\"fiche_ticket.php?ticket=".$cli['TCK_ID']."\">".ucfirst($cli['TCK_TITRE']).
      "</tr>";
    }
    echo "</tbody></table>";
  } else
  echo "erreur";
  ?>
  <script>

  </script>
</body>
</html>
<script>
function DoNav(theUrl) { document.location.href = theUrl; }
</script>
