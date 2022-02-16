<?php session_start(); ?>
<?php header("location:groupe.php");

$mysqli = new mysqli("mariadb", "EDF", "edf", "EDF");
if (!$mysqli) {
    die("Connection failed: " . mysqli_connect_error());
}
$admin = $_SESSION['groupe'];
$checkboxl = $_POST['chk1'];
if ($_POST["Submit"] == "Submit") {
    for ($i = 0; $i < sizeof($checkboxl); $i++) {
        $requete2 = "INSERT INTO utilisateur_groupe (id_utilisateur,id_groupe) VALUES ('$checkboxl[$i]','$admin')";
        $resultat2 = $mysqli->query($requete2);
    }
   
    
}


?>
