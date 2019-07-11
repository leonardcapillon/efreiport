<!DOCTYPE html>
<html lang="fr">
<head>
  <?php include('head.php'); ?>
	<title>EFREIPORT Web | Tous les tickets</title>
</head>
<body class="container" align="center">
	<h1>EFREIPORT | Outil de ticketing Efreiport Web</h1>
	<br>
  <a class="btn btn-primary" href="index.php" role="button">Retour à l'accueil</a>
  <br><br>

  <?php
  /* Connexion à la base de donnée */
  include('co.php');

  /* Execution de la requête dans QRcode_History afin de récuperer l'historique */
  $res = $link->query("select id, date, salle, type, pc, description from Ticket");

  /* Definition du tableau en fonction du resultat obtenu lors de la requete précedente */
  if(isset($res)) {
    echo "<table class=\"table\">";
    echo "<tr>
    <th>Date</th>
    <th>Salle</th>
    <th>Type de problème</th>
    <th>Numéro du poste</th>
    <th>Description</th>
    </tr>";
    while($notif=mysqli_fetch_assoc($res)){
      echo "<td>".$notif['date']."</td>".
      "<td><a href=\"notif.php?salle=".$notif['salle']."\">".ucfirst($notif['salle'])."</a></td>".
      "<td>".ucfirst($notif['type']).
      "<td>".ucfirst($notif['pc'])."</td>".
      "<td>".$notif['description']."</td>".
      "</tr>";
    }
    echo "</table>";
  } else
  echo "erreur";
  ?>

</body>
</html>
