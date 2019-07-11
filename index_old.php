<!DOCTYPE html>
<html lang="fr">
<head>
	<?php include('head.php'); ?>
	<title>EFREIPORT Web | Home</title>
</head>
<body class="container" align="center">
	<h1>EFREIPORT | Outil de ticketing Efreiport Web</h1>
	<br>
	<a class="btn btn-primary" href="all.php" role="button">Tous les tickets</a>
	<button class="btn btn-secondary" onClick="affichertout('select')">Afficher toutes les salles</button>
	<button class="btn btn-secondary" href="all_adm.php" onClick="affichertout('deselect')">Cacher toutes les salles</button>
	<br><br>

	<?php
	/* Connexion à la base de donnée */
	include('co.php');


	/* Recupération des différents départements et affichage */
	$res = $link->query("select Nom, SIGLE from Departement");
	$count=0;
	if(isset($res)) {
		foreach ($res as $departement) {
			?>
			<h2><a href=#<?php echo $departement['SIGLE'];?> onclick="cacher(getElementById('<?php echo $departement['SIGLE'];?>'),getElementById('<?php echo $count;?>'))" alt="cacher"><img src="./img/cacher.png" id='<?php echo $count;?>' class='fleche'>Département <?php echo $departement['SIGLE'];?></a></h2>
			Cliquez ici, enfin pas ici mais un peu au dessus, pour afficher les tickets par salles du département <?php echo $departement['Nom']; ?>
			<?php
			/*Affichage Types de salles et salles */
			$res2 = $link->query("select distinct Salle.type from Salle join Type_Salle on Salle.type = Type_Salle.type where Departement='".$departement['SIGLE']."' order by Type_Salle.id;");
			if(isset($res2)) {
				echo "<div id=\"".$departement['SIGLE']."\" class='cache' style=\"display: none;\">";
				foreach ($res2 as $typesal) {
					echo "&emsp;<h3>".$typesal['type']."</h3>";
					$res3 = $link->query("select distinct salle from Salle where Departement='".$departement['SIGLE']."' and Type='".$typesal['type']."' order by salle;");
					if(isset($res3)) {
						foreach ($res3 as $salle) {
							echo "<a class=\"btn btn-info\" href=\"notif.php?salle=".$salle['salle']."\" role=\"button\">".$salle['salle']."</a> &nbsp;";
						}
					} else {
						echo "<br>Erreur de connexion à la base de donnée";
					}
				}
				echo "</div>";
				?>
				<?php
				echo "<br><br>";
			} else {
				echo "<br><br>Erreur de connexion avec la base de donnée";
			}
			$count+=1;
		}
	} else {
		echo "Erreur de connexion à la base de donnée";
	}
	?>
	<br><br>
</body>
<script>
function cacher(el,ca) {
	if ( $(el).is( ":hidden") ) {
		$(el).show("fast");
		ca.src="./img/section.png";
	} else {
		$(el).hide("fast");
		ca.src="./img/cacher.png";
	}
};
function affichertout(critere) {
	var fl = document.getElementsByClassName('fleche');
	if (critere == 'select') {
		$('.cache').show("fast");
		for (var i = 0; i < fl.length; i++) {
			fl[i].src="./img/section.png";
		}
	}
	if (critere == 'deselect') {
		$('.cache').hide("fast");
		for (var i = 0; i < fl.length; i++) {
			fl[i].src="./img/cacher.png";
		}
	}
};
</script>
</html>
