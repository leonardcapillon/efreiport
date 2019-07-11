<?php
$link=mysqli_connect("127.0.0.1","root","leonard","efreiport");
mysqli_set_charset($link, "utf8");
if(!$link){
  die("<p>connexion impossible</p>");
}
?>
