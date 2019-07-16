<?php include('./ScriptPHP/verif.php'); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <?php include('head.php'); 
  /* Connexion à la base de donnée */
  include('co.php');
  
 /* Vérification que l'argument existe */
$trouve=false;
$res = $link->query("select * from Ticket");
if (isset($_GET['ticket'])) {
  foreach ($res as $ticket) {
    if ($ticket['TCK_ID']==$_GET['ticket']) {
      $nomtck=$ticket['TCK_TITRE'];
      $trouve=true;
    }
  }
}  
?>
	<title>EFREIPORT Web | Tous les tickets </title>
</head>
<body class="container" align="center">
	<h1>EFREIPORT | Fiche ticket <?php if ($trouve==true) { echo $nomtck; }?>
    <br>Interface Admin	<a href="ScriptPHP/logout.php" class="deco"><img  style="width:50px;height:50px;" class="imgdeco" src="img/button.png" title="Déconnexion" alt="Déconnexion"></a>
  </h1>
  <br>
  <a class="btn btn-primary" href=mod_ticket.php?ticket=<?php $ticket['TCK_ID'];?> role="button">Modifier le ticket</a>
  <a class="btn btn-primary" href="accueil.php" role="button">Retour à l'accueil</a>

  <br><br>

  <?php
  
  if($trouve==false ) {
    echo "<br><br>";
    echo "<p>Merci de choisir un client sur l'écran d'accueil</p>";

  } else {

    $tck=$_GET['ticket'];
  }

  /* Execution de la requête dans QRcode_History afin de récuperer l'historique */
  $res = $link->query("SELECT TCK_ID, CLI_ID, CLI_NOM, TCK_TITRE, STA_STATUT, STA_COM, STA_USR_DATETIME from Ticket join Client on (TCK_CLI_ID=CLI_ID) join Etat on (TCK_ID=STA_TCK_ID)  WHERE TCK_ID ='".$tck."';  ORDER BY STA_USR_DATETIME DESC ") ;
			
  /* Definition du tableau en fonction du resultat obtenu lors de la requete précedente */
  if(isset($res)) {
    echo "<form action='./ScriptPHP/del_ticket.php' method='post'>";
    echo "<table class=\"table\">";
    echo "<tr>
    <th>ID du ticket</th>
    <th>Nom du Client</th>
    <th>Nom du ticket</th>
	<th>Statut du ticket</th>
	<th>Commentaire</th>
	<th>Date de modification modification</th>

    </tr>";
    while($cli=$res->fetch()){
      echo "<tr><td>".$cli['TCK_ID']."</td>".
      "<td><a href=\"fiche.php?client=".$cli['CLI_ID']."\">".ucfirst($cli['CLI_NOM'])."</a></td>".
      "<td>".ucfirst($cli['TCK_TITRE']).
      "<td>".ucfirst($cli['STA_STATUT']).
	  "<td>".ucfirst($cli['STA_COM']).
	  "<td>".ucfirst($cli['STA_USR_DATETIME']).
      "</tr>";
    }
    echo "</table>";
  } else
  echo "erreur";
  ?>
</body>
</html>
