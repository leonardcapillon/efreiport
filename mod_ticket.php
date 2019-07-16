<?php include('./ScriptPHP/verif.php'); ?>
<!DOCTYPE html>
<?php
/* Connexion à la base de donnée */
include('co.php');

 /* Vérification que l'argument Ticket existe  */
$trouve=false;
$failed=false;
$ras = $link->query("select * from Ticket");
if (isset($_GET['ticket'])) {
  foreach ($ras as $ticket) {
    if ($ticket['TCK_ID']==$_GET['ticket']) {
      $nomtck=$ticket['TCK_TITRE'];
      $trouve=true;
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
  <?php
		    if($trouve==false ) {
    echo "<p>Merci de choisir un ticket.</p>";
    echo "<br><a class=\"btn btn-primary\" href=\"all_ticket.php\" role=\"button\">Retour aux Tickets</a><br><br>";

  } else {
      $tck=$_GET['ticket'];
      echo "<br><a class=\"btn btn-primary\" href=\"fiche_ticket.php?ticket=$tck\" role=\"button\">Retour a la fiche</a><br><br>";
      $sql = "select * from Ticket JOIN Etat on (TCK_ID=STA_TCK_ID) join Client on (TCK_CLI_ID=CLI_ID) where TCK_ID=? order by STA_USR_DATETIME desc";
      $stmt= $link->prepare($sql);
      $stmt->execute([$tck]);

          $row = $stmt->fetch();
          if(!$row) {
            $failed=true;
            $sql = "select * from Ticket join Client on (TCK_CLI_ID=CLI_ID) where TCK_ID=?";
            $stmt= $link->prepare($sql);
            $stmt->execute([$tck]);
            $row = $stmt->fetch();
          }
          if ($row) {
          ?>
           <form method="post" name="formulaire" action="./ScriptPHP/action_ticket.php?ticket=<?php echo $tck;?>">
	         <div class="input-group mb-3">
			   <div class="input-group-prepend">
			   <span class="input-group-text" id="basic-addon1">Client*</span>
				</div>
				<input type="text" class="form-control" name="client" value=<?php echo $row['CLI_NOM']; ?> disabled required>
			</div>
              <div class="input-group mb-3">
               <div class="input-group-prepend">
                 <span class="input-group-text" id="basic-addon1">Titre*</span>
               </div>
               <input type="text" class="form-control" value="<?php echo $row['TCK_TITRE']; ?>" name="titre" disabled required>
             </div>
             <div class="input-group mb-3">
               <div class="input-group-prepend">
                 <span class="input-group-text" id="basic-addon1">Description*</span>
               </div>
               <input type="text" class="form-control" value="<?php echo $row['TCK_DESC']; ?>" name="desc" disabled required>
             </div>
             <div class="input-group mb-3">
       	  <div class="input-group-prepend">
       		<label class="input-group-text" for="inputGroupSelect01">Statut*</label>
         </div>
       		<select name="statut" class="custom-select" id="statut" required>
       			<option selected>Choose...</option>
             <option value="Demarré">Demarré</option>
             <option value="En cours">En cours</option>
             <option value="Cloturé">Cloturé</option>
       		</select>
       		</div>
             <div class="input-group mb-3">
               <div class="input-group-prepend">
                 <span class="input-group-text" id="basic-addon1">Commentaire*</span>
               </div>
               <input type="text" class="form-control" value="<?php if(!$failed) echo $row['STA_COM']; ?>" name="comment" required>
             </div>
             <br><br>
             <input class="btn btn-danger" name="submit" type="submit" value="Soumettre le ticket">
           </form>

			<?php } else {
        echo "<p>Il y a eu un probleme lors de la lecture du ticket. Merci de reessayer";
      }
  }
			?>
</body>
</html>
