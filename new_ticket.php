<?php include('./ScriptPHP/verif.php'); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <?php include('head.php'); ?>
	<title>EFREIPORT Web | Création d'un Ticket</title>
</head>
<body class="container" align="center">
	<h1>EFREIPORT | Outil de ticketing Efreiport Web | Création les ticket
    <br>Interface Admin	<a href="ScriptPHP/logout.php" class="deco"><img class="imgdeco" src="img/button.png" title="Déconnexion" alt="Déconnexion"></a>
  </h1>
  <br>
<div class="container">
          </div>
           <form method="post" name="formulaire" action="ScriptPHP/add_ticket.php">
             <div class="input-group mb-3">
               <div class="input-group-prepend">
                 <label class="input-group-text" for="inputGroupSelect01">Client*</label>
			   </div>
			 <select name="message" class="custom-select" id="CLI_ID" required>
			 <option selected>Choose...</option>
				<?php
					$res = $link->query("select CLI_NOM from Client");
					if(isset($res)) {
						while($message=$res->fetch()){
							echo "<option value=\"".ucfirst($message[0])."\">".ucfirst($message[0])."</option>";
							}
						} else
						echo "erreur";


				?>
			 </select>
			 </div>
             <div class="input-group mb-3">
               <div class="input-group-prepend">
                 <span class="input-group-text" id="basic-addon1">Titre du Ticket*</span>
               </div>
               <input type="text" class="form-control" name="Titre" required>
             </div>
             <div class="input-group mb-3">
               <div class="input-group-prepend">
                 <span class="input-group-text" id="basic-addon1">Description du problème*</span>
               </div>
               <input type="text" class="form-control" name="probleme" required>
             </div>
             <br>
             <input class="btn btn-danger" name="submit" type="submit" value="Créer le Ticket">
			 <br><br>

			 <a class="btn btn-primary" href="all_ticket.php" role="button">Retour aux Tickets</a>
			 <br><br><br>
           </form>







</div>
</body>
</html>
