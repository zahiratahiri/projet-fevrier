<?php
session_start(); 
$_SESSION['id_groupe_message2']=$_SESSION['id_groupe_message'];
$mysqli = new mysqli("mariadb", "EDF", "edf", "EDF");
$mysqli->set_charset("utf8");
$i=$_SESSION['id']; 
$j=$_POST['message'];
$k=$_SESSION['id_groupe_message'];
// Effectuer ici la requête qui insère le message
$requete="INSERT INTO messages (id_emetteur,messages,dates,id_groupe) VALUES ('$i','$j',NOW(),'$k')";
$resultat=$mysqli->query($requete);
// Puis rediriger vers minichat.php comme ceci :
header('Location: message.php');
?>
