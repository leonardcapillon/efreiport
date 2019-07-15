<?php include('./ScriptPHP/verif.php'); ?>
<!DOCTYPE html>
<?php
/* Connexion à la base de donnée */
include('co.php');
/* Vérification que l'argument existe */
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
?>
<html lang="fr">
<head>
  <?php include('head.php'); ?>
	<title>EFREIPORT Web | Nouveau projet </title>
  </head>
<body class="container" align="center">
	<h1>EFREIPORT | Création du ticket </h1>
  <br>
  <a class="btn btn-primary" href="all_ticket.php" role="button">Retour aux Tickets</a><br><br>
    <form method="post" name="formulaire" action="ScriptPHP/add_ticket.php">
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Titre du Ticket*</span>
        </div>
        <input type="text" class="form-control" name="titre" required>
      </div>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Description du Ticket*</span>
        </div>
        <input type="text" class="form-control" name="desc" required>
      </div>	  
	  <div class="input-group mb-3">
        <div class="input-group-prepend">
            <label class="input-group-text" for="inputGroupSelect01">Client*</label>
		</div>
		<select name="client" class="custom-select" id="CLI_ID" required>
			<option selected>Choose...</option>
				<?php
					$res = $link->query("select CLI_NOM, CLI_ID from Client");
					if(isset($res)) {
						while($message=$res->fetch()){
							echo "<option value=\"".ucfirst($message[1])."\">".ucfirst($message[0])."</option>";
							}
						} else
						echo "erreur";
				?>
		</select>
	  </div>
      <br>
      <input class="btn btn-danger" name="submit" type="submit" value="Créer le Ticket">
<br><br>
</body>
</html>
