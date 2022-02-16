<?php
session_start();
$mysqli = new mysqli("mariadb", "EDF", "edf", "EDF");


// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
$names = $_POST["nom"];
$admin = $_SESSION['id'];
$mail=$_SESSION['mail'];
$requete = "INSERT INTO groupe (nom, admins,mail_admins, dates) VALUES ('$names','$admin','$mail',NOW())";
$resultat = $mysqli->query($requete);
$requete2 = "SELECT * FROM groupe WHERE id=(SELECT max(id) FROM groupe)";
$resultat2 = $mysqli->query($requete2);
$lignee = $resultat2->fetch_object();
$_SESSION["groupe"] = $lignee->id;
$admin2 = $_SESSION["groupe"];
$requete3 = "INSERT INTO utilisateur_groupe (id_utilisateur, id_groupe) VALUES ('$admin','$admin2')";
$resultat3 = $mysqli->query($requete3);
$_SESSION["nom_groupe"]=$names;
header("location:ajouter_utilisateur.php");?>
