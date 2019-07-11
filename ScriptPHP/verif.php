<?php
session_start();
if (!isset($_SESSION['login'])) {
	$_SESSION['login_redirect'] = $_SERVER['PHP_SELF'];
	if (isset($_GET['client'])) {
		$_SESSION['client'] = $_GET['client'];
	}
	header('Location: ../index.php');
}
?>
