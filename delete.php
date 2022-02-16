<?php

$mysqli = new mysqli("mariadb", "UU", "UU", "UU");
$id = $_GET['id']; 
if(!$mysqli)
{
    die("Connection failed: " . mysqli_connect_error());
}

$requete="DELETE FROM UU WHERE id = '$id'";
$resultat = $mysqli->query($requete); // delete query

if($resultat)
{
    $mysqli->close(); // Close connection
    header("location:insert.php"); // redirects to all records page
    
    exit;	
}
else
{
    echo "Error deleting record"; // display error message if not delete
}
