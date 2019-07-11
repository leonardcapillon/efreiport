<!DOCTYPE html>
<?php
session_start();
if (!isset($_SESSION['login'])) {
	header('Location: ../index.php');
}
?>
<head>
	<meta charset="UTF-8" />
	<title>Report Bleau Admin | Supression d'un ticket</title>
	<link rel="stylesheet" media="screen" href="../css/SiteAppli.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
	<link rel="icon" href="../img/favicon.png" type="image/x-icon"/>
	<link rel="shortcut icon" href="../img/favicon.png" type="image/x-icon"/>
</head>
<?php
/* Connexion à la base de données */
try {
	$db = new PDO("mysql:host=127.0.0.1;charset=UTF8;dbname=effreport","root","leonard");
} catch(Exception $e) {
	die('Erreur : '.$e->getMessage());
}
/* Passage dans la boucle pour chaque case cochées */
$checkboxes = isset($_POST['todelete']) ? $_POST['todelete'] : array();
foreach($checkboxes as $value) {
	/* Selection de chaque tuples 'cochés' */
	$stmt = $db->prepare("DELETE FROM Ticket WHERE id=$value");
	try {
		$stmt->execute();
		echo "<br>Le ticket ".$value." a bien été supprimé<br><br>";

	} catch (Exception $e) {
		echo "<br>Il y a eu un problème lors de la suppression du Ticket, merci de réessayer.";
	}

}
/* Vérification que l'argument existe */
if (isset($_GET['salle'])) {
	echo "<a class=\"btn btn-primary\" href=\"../notif_adm.php?salle=".$_GET["salle"]."\" role=\"button\">Retour aux tickets de la salle</a>&nbsp;";
}
echo "<a class=\"btn btn-primary\" href=\"../all_adm.php\" role=\"button\">Retour à tous les tickets</a>&nbsp;";
echo "<a class=\"btn btn-primary\" href=\"../index_adm.php\" role=\"button\">Retour à l'accueil</a>";

?>
