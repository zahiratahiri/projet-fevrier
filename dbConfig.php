<?php
// Database configuration
$mysqli = new mysqli("mariadb", "EDF", "edf", "EDF");


// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>
