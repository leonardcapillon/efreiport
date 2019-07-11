<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <title>Report Bleau Web | Creation d'un ticket</title>
  <link rel="stylesheet" media="screen" href="../css/SiteAppli.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
  <link rel="icon" href="../img/favicon.png" type="image/x-icon"/>
  <link rel="shortcut icon" href="../img/favicon.png" type="image/x-icon"/>
</head>
<?php
/* Connexion à la base de donnée */
include('../co.php');
/* Vérification que l'argument existe */
$trouve=false;
$res = $link->query("select * from Salle");
if (isset($_GET['salle'])) {
  foreach ($res as $salle) {
    if ($salle['salle']==$_GET['salle']) {
      $trouve=true;
    }
  }
}

if($trouve==false ) {
  echo "<br>";
  echo "<p>Merci de choisir une salle sur l'écran d'accueil</p>";

} else {
  $req = $link->prepare('INSERT INTO Ticket (salle,pc,type,date,description) VALUES (?, ?, ?, NOW(), ?)');

  $salle=$link->real_escape_string($_GET['salle']);

  $poste=$link->real_escape_string($_POST['pc']);

  $type=$link->real_escape_string($_POST['type']);

  $desc=$link->real_escape_string($_POST['description']);

  $req->bind_param('ssss',$salle,$pc,$type,$desc);

  try {
    $req->execute();

    //Envoi du mail
    $mail = 'leonardcapillon@gmail.com'; // Déclaration de l'adresse de destination.

    if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) { // On filtre les serveurs qui présentent des bogues.
        $passage_ligne = "\r\n";
    }
    else {
        $passage_ligne = "\n";
    }

    //=====Déclaration des messages au format texte et au format HTML.
    $message_html = "<html><head></head><body>
      <b>Bonjour,</b><br>
      Un nouveau ticket a été créé pour la salle ".$salle.", ".
      "<br><br>Accéder à la liste des tickets de la salle : <a href=\"http://dwarves.iut-fbleau.fr/~poire/Report_Bleau/admin/notif_adm.php?salle=".$salle."\">Salle ".$salle."</a><br><br>Cordialement,
      <br>L'équipe de Report Bleau</body></html>";

    //=====Création de la boundary.
    $boundary = "-----=".md5(rand());
    $boundary_alt = "-----=".md5(rand());

    //=====Définition du sujet.
    $sujet = "Nouveau ticket signalé sur Report Bleau";

    //=====Création du header de l'e-mail.
    $header = "From: \"ReportBleau\"<nepasrepondre.reportbleau@gmail.com>".$passage_ligne;
    $header.= "Reply-to: \"ReportBleau\" <nepasrepondre.reportbleau@gmail.com>".$passage_ligne;
    $header.= "MIME-Version: 1.0".$passage_ligne;
    $header.= "Content-Type: multipart/mixed;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;

    //=====Création du message.
    $message = $passage_ligne."--".$boundary.$passage_ligne;
    $message.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary_alt\"".$passage_ligne;
    $message.= $passage_ligne."--".$boundary_alt.$passage_ligne;

    //=====Ajout du message au format HTML.
    $message.= "Content-Type: text/html; charset=\"UTF-8\"".$passage_ligne;
    $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
    $message.= $passage_ligne.$message_html.$passage_ligne;

    //=====On ferme la boundary alternative.
    $message.= $passage_ligne."--".$boundary_alt."--".$passage_ligne;

    //=======
    $message.= $passage_ligne."--".$boundary.$passage_ligne;
    //==========

    //=====Envoi de l'e-mail.
    mail($mail,$sujet,$message,$header);

    //==========

    echo "<br>Le ticket a bien été envoyé.<br><br>";

  } catch (Exception $f) {
    die('<br>Il y a eu une erreur lors de la publication du ticket, merci de réessayer.');
  }
  echo "<a class=\"btn btn-primary\" href=\"../notif.php?salle=".$_GET["salle"]."\" role=\"button\">Retour aux tickets de la salle</a>&nbsp;";
  echo "<a class=\"btn btn-primary\" href=\"../index.php\" role=\"button\">Retour à l'accueil</a>";
}
?>
</html>
