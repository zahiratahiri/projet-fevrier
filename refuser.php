<?php session_start(); ?>
<?php

$mysqli = new mysqli("mariadb", "EDF", "edf", "EDF");
$id = $_GET['id']; 
if(!$mysqli)
{
    die("Connection failed: " . mysqli_connect_error());
}

$requete="DELETE FROM utilisateur WHERE id = '$id'";
$resultat = $mysqli->query($requete); // delete query

if($resultat)
{
    $mysqli->close(); // Close connection
    header("location:utilisateurs.php"); // redirects to all records page
    
    exit;	
}
else
{
    echo "Error deleting record"; // display error message if not delete
}
