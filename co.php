<?php
$link=new PDO('mysql:host=localhost;dbname=efreireport', 'root', '');
$link->exec('SET NAMES utf8');
if(!$link){
  die("<p>connexion impossible</p>");
}
?>
