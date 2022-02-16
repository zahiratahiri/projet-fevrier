<?php

$mysqli = new mysqli("mariadb", "UU", "UU", "UU");
$id = $_GET['id']; // get id through query string
$requete = "select * from UU where id='$id'";
$resultat = $mysqli->query($requete); // select query

$ligne = $resultat->fetch_object(); // fetch data

if (isset($_POST['update'])) // when click on Update button
{
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $requete2 = "update UU set nom='$nom', prenom='$prenom' where id='$id'";
    $resultat2 = $mysqli->query($requete2);

    if ($resultat2) {
        $mysqli->close(); // Close connection
        header("location:insert.php"); // redirects to all records page
        exit;
    } else {
        echo "Error updating record";
    }
}
?>
<h3>Mettre à jour les informations</h3>
<style>
    body {
        text-align: center;
        background-image: url("splash.webp");
        background-repeat: no-repeat;
        background-size: cover;
    }
</style>

<form method="POST">
    Nom :<input type="text" name="nom" value="<?php echo $ligne->nom ?>" placeholder="Entrez le nom" Required>
    <br />
    Prenom :<input type="text" name="prenom" value="<?php echo $ligne->prenom ?>" placeholder="Entrez le prenom" Required>
    <br />
    <input type="submit" name="update" value="Update">
</form>
