<?php

$mysqli = new mysqli("mariadb", "EDF", "edf", "EDF");

if (isset($_POST['submit'])) {



    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];
    $requete0 = "SELECT * FROM utilisateur";
    $resultat0 = $mysqli->query($requete0);
    while ($ligne = $resultat0->fetch_object()) {
        if ($ligne->email != "$email") {
        } else {


            header("location:register2.php"); // redirects to all records page

            exit;
        }
    }
    $i = 0;
    $requete = "INSERT INTO utilisateur (nom,prenom,email,mdp,types) VALUES('$nom','$prenom','$email','$mdp','')";
    $resultat = $mysqli->query($requete);

    if ($resultat) {
        $mysqli->close(); // Close connection
        header("location:home0.php"); // redirects to all records page
        exit;
    } else {
        echo "Error insert record";
    }
} ?>


<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;

            text-align: center;
            background-image: url("splash.webp");


            background-repeat: no-repeat;
            background-size: cover;
        }

        table.center {
            margin-left: auto;
            margin-right: auto;
        }

        table,
        th,
        td {
            border: 3px solid black;
            /*border-collapse: collapse;*/
        }

        /*tr {
            color:  solid blanchedalmond;
        }*/

        .topnav {
            overflow: hidden;
            background-color: #333;
        }



        .topnav a {
            float: left;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;
        }

        .topnav a:hover {
            background-color: #ddd;
            color: black;
        }

        .topnav a.active {
            background-color: #04AA6D;
            color: white;
        }

        .topnav-right {
            float: right;
        }

        body {

            background-image: url(login3.jpeg);

        }
    </style>
</head>


<body>
    <div class="topnav">
        <a class="active" href="home0.php">Accueil</a>
    </div>
    <h3>Créer votre compte </h3>
    <form method="POST">
        <br>
        Votre Nom : <input type="text" name="nom" placeholder="Entrez votre nom " Required>
        <br />
        <br>
        Votre Prenom : <input type="text" name="prenom" placeholder="Entrez votre nom " Required>
        <br />
        <br>
        Votre email: <input type="text" name="email" placeholder="Entrez votre email" Required>
        <br />
        <br>
        Mot de passe: <input type="password" name="mdp" placeholder="Entrez votre mot de passe" Required>
        <br />
        <input type="submit" name="submit" value="S'identifier">


    </form>




</body>

</html>
