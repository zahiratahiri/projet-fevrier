<?php session_start();
// Include the database configuration file
// Database configuration
$mysqli = new mysqli("mariadb", "EDF", "edf", "EDF");


// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
$statusMsg = '';

// File upload path
$name = basename($_FILES["file"]["name"]);
$type = $_FILES["file"]["type"];
$taille = $_FILES["file"]["size"];
$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

if (isset($_POST["submit"]) && !empty($_FILES["file"]["name"])) {
    $name = basename($_FILES["file"]["name"]);
    $type = basename($_FILES["file"]["type"]);
    $taille = $_FILES["file"]["size"];
    $fileType = pathinfo($name, PATHINFO_EXTENSION);
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
    if (in_array($fileType, $allowTypes)) {
        $image = $_FILES['file']['tmp_name'];
        $imgContent = addslashes(file_get_contents($image));
        $requete = "INSERT INTO documents (nom,types,taille,paths) VALUES ('$name','$type','$taille','$imgContent')";
        $resultat = $mysqli->query($requete);
        $admin = $_SESSION['id'];
        $requete2 = "SELECT * FROM documents WHERE id=(SELECT max(id) FROM documents)";
        $resultat2 = $mysqli->query($requete2);
        $lignee = $resultat2->fetch_object();
        $admin2 = $lignee->id;;
        $requete3 = "INSERT INTO utilisateur_documents (id_utilisateur, id_documents, dates) VALUES ('$admin','$admin2',NOW())";
        $resultat3 = $mysqli->query($requete3);
        if ($requete && $requete3) {
            $statusMsg = "The file " . $name . " has been uploaded successfully.";
        } else {
            $statusMsg = "File upload failed, please try again.";
        }
    } else {
        $statusMsg = "Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.";
    }
} else {
    $statusMsg = 'Please select a file to upload.';
}

// Display status message
$_SESSION["error"] = $statusMsg;
header("location:home.php");
