<?php include('./ScriptPHP/verif.php'); ?>
<!DOCTYPE html>
<?php
/* Connexion à la base de donnée */
include('co.php');
 /* Vérification que l'argument Client existe */
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

 /* Vérification que l'argument Ticket existe  */
$trouve1=false;
$ras = $link->query("select * from Ticket");
if (isset($_GET['ticket'])) {
  foreach ($ras as $ticket) {
    if ($ticket['TCK_ID']==$_GET['ticket']) {
      $nomtck=$ticket['TCK_TITRE'];
      $trouve1=true;
    }
  }
}
?>
<html lang="fr">
<head>
  <?php include('head.php'); ?>
	<title>EFREIPORT Web | Modification du ticket </title>
  </head>
<body class="container" align="center">
	<h1>EFREIPORT | Modification du ticket </h1>
  <br>
          <?php
		  
		    if($trouve1==false ) {
    echo "<br><br>";
    echo "<p>Merci de choisir un client sur l'écran d'accueil</p>";

  } else {

    $tck=$_GET['ticket'];

		  
		  $sql = $link->query("select * from Ticket JOIN Etat on (TCK_ID=STA_TCK_ID) join Client on (TCK_CLI_ID=CLI_ID) where TCK_ID='".$tck."' AND CLI_ID='".$cli."'");
          if($sql) {
          $row = $sql->fetch();
          ?>
           <form method="post" name="formulaire" action="./ScriptPHP/action_ticket.php?ticket=<?php echo $tckid;?>">
	         <div class="input-group mb-3">
			   <div class="input-group-prepend">
			   <span class="input-group-text" id="basic-addon1">Client*</span>
				</div>
				<input type="text" class="form-control" name="client" <?php if ($trouve==true) {
				echo "value=".$nomcli." disabled";
				}?> required>
			</div>
              <div class="input-group mb-3">
               <div class="input-group-prepend">
                 <span class="input-group-text" id="basic-addon1">Titre*</span>
               </div>
               <input type="text" class="form-control" value="<?php echo $row['TCK_TITRE']; ?>" name="titre" required>
             </div>
             <div class="input-group mb-3">
               <div class="input-group-prepend">
                 <span class="input-group-text" id="basic-addon1">Description*</span>
               </div>
               <input type="text" class="form-control" value="<?php echo $row['TCK_DESC']; ?>" name="desc" required>
             </div>
			<div class="input-group-prepend">
				<label class="input-group-text" for="inputGroupSelect01">Statut*</label>
			<select name="statut" class="custom-select" id="statut" required>
				<option selected>Choose...</option>
					<?php
						$eta = $link->query("select  DISTINCT STA_STATUT from Etat");
						if(isset($eta)) {
							while($message=$eta->fetch()){
								echo "<option value=\"".ucfirst($message[0])."\">".ucfirst($message[0])."</option>";
								}
							} else
							echo "erreur";
					?>
			</select>
			</div>
			<br>
             <div class="input-group mb-3">
               <div class="input-group-prepend">
                 <span class="input-group-text" id="basic-addon1">Commentaire*</span>
               </div>
               <input type="text" class="form-control" value="<?php echo $row['STA_COM']; ?>" name="comment" required>
             </div>
             <br><br>
             <input class="btn btn-danger" name="submit" type="submit" value="Soumettre le ticket">
			  <a class="btn btn-primary" href="all_ticket.php" role="button">Retour aux Tickets</a><br><br>

           </form>

			<?php }
  }
			?>
</body>
</html>