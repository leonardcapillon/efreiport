<!DOCTYPE html>
<html lang="fr">
<head>
  <?php include('head.php'); ?>
	<title>Report Bleau Web | Home</title>
</head>
<body class="container" align="center">
	<h1>EFREIPORT | Création d'un ticket</h1>
  <br>
  <a class="btn btn-primary" href="index.php" role="button">Retour à l'accueil</a>
  <a class="btn btn-primary" href="all.php" role="button">Tous les tickets</a>


  <?php
  /* Connexion à la base de donnée */
  include('co.php');

  /* Vérification que l'argument existe */
  $trouve=false;
  $sinfo=false;
  $res = $link->query("select * from Salle");
  if (isset($_GET['salle'])) {
    foreach ($res as $salle) {
      if ($salle['salle']==$_GET['salle']) {
        $trouve=true;
        if ($salle['type'] === 'Salles informatique') {
          $sinfo=true;
        }
      }
    }
  }

  if($trouve==false ) {
    echo "<br><br>";
    echo "<p>Merci de choisir une salle sur l'écran d'accueil</p>";

  } else {
    $sallew=$_GET['salle']; ?>
    <a class="btn btn-primary" href="notif.php?salle=<?php echo $sallew;?>">Retour aux tickets de la salle</a>
    <br><br>
    <form method="post" action="ScriptPHP/TicketAdd.php?salle=<?php echo $sallew;?>">
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Salle*</span>
        </div>
        <input type="text" class="form-control" value="<?php echo $sallew; ?>" name="salle" required disabled>
      </div>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <label class="input-group-text" for="inputGroupSelect01">Type de problème*</label>
        </div>
        <select name="type" class="custom-select" id="type" required>
          <option value="Matériel">Matériel</option>
          <option value="Logiciel">Logiciel</option>
          <option value="Réseau">Réseau</option>
          <option value="Autre">Autre</option>
        </select>
      </div>
      <div class="input-group mb-3" style="display:none;" id="ordinateur">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Ordinateur</span>
        </div>
        <input type="text" class="form-control" placeholder="ex: 01" name="pc">
      </div>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text">Commentaire*</span>
        </div>
        <textarea class="form-control" name="description" required></textarea>
      </div>
      <br>
      <input class="btn btn-danger" name="submit" type="submit" value="Soumettre le ticket">

      <script>
      $("select").change(function () {
        var str = "";
        var info = "<?php echo $sinfo;?>"
        var ordi = document.getElementById("ordinateur");
        $("select option:selected").each(function () {
          str += $(this).val();
        });

        if(str == 'Autre' | info == false ){
          ordi.style.display = 'none';
        }
        else{
          ordi.style.display = '';
        }
      })
      .change();
      </script>
    </form>


    <?php
  } ?>
</body>
</html>
