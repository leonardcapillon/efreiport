<?php include('verif.php'); ?>
<!DOCTYPE html>
<?php
/* Connexion à la base de donnée */
include('../co.php');
?>
<html lang="fr">
<head>
  <?php include('../head.php'); ?>
	<title>EFREIPORT Web | Modification ticket </title>
  </head>
<body class="container" align="center">
	<h1>EFREIPORT | Modification du ticket </h1>
  <br>
  <?php
          /* Vérification que l'argument existe */
          $trouve=false;
          $res = $link->query('select * from Ticket');
          if (isset($_GET['ticket'])) {
            $tckid = $_GET['ticket'];
            //$res = $dbs->query('select * from utilisateur');
            while ($row = $res->fetch()) {
              if ($row['TCK_ID']==$tckid) {
                $trouve=true;
                $user=$row['TCK_TITRE'];
              }
            }
          }
	?>
  
  <?php
  $sql = "UPDATE Ticket SET TCK_TITRE=?, TCK_DESC=?  WHERE TCK_ID=?";
          $stmt= $link->prepare($sql);
          try {
		  $stmt->execute([$_POST['titre'], $_POST['desc'],$tckid]);
            echo "<br>Le ticket a bien été modifié<br><br>";
        	} catch (Exception $e) {
        		echo "<br>Il y a eu un problème lors de la modification du ticket, merci de réessayer.";
            echo "<a class=\"btn btn-primary\" href=\"../mod_ticket.php?client=$tck\" role=\"butto\">Retour</a>";
          }
	?>
	
  <br>
  <a class="btn btn-primary" href="../all_ticket.php" role="button">Retour aux Tickets</a><br><br>		
  
</body>
</html>