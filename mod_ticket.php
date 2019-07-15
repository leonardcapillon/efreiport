<?php include('./ScriptPHP/verif.php'); ?>
<!DOCTYPE html>
<?php
/* Connexion à la base de donnée */
include('co.php');
?>
<html lang="fr">
<head>
  <?php include('head.php'); ?>
	<title>EFREIPORT Web | Nouveau projet </title>
  </head>
<body class="container" align="center">
	<h1>EFREIPORT | Création du ticket </h1>
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

          if($trouve==false ) {
            echo "<br><br>";
            echo "<p>Merci de choisir un client sur l'écran precedent</p>";
          } else {


            $res = $link->query("select * from Ticket where TCK_ID=$tckid");
            if($res) {
          $row = $res->fetch();
          ?>
           <form method="post" name="formulaire" action="./ScriptPHP/action_ticket.php?ticket=<?php echo $tckid;?>">
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
             <br>
             <input class="btn btn-danger" name="submit" type="submit" value="Soumettre le ticket">

           </form>

</div>
			<?php }
		  }
		  
		  ?>
</body>
</html>