<?php
session_start();
$_SESSION['id'] = ' ';
$mysqli = new mysqli("mariadb", "EDF", "edf", "EDF");
if (isset($_POST['submit'])) {

    $email = $_POST['email'];
    $mdp = $_POST['mdp'];

    $requete = "SELECT * FROM utilisateur";
    $resultat = $mysqli->query($requete);
    while ($ligne = $resultat->fetch_object()) {
        if ($ligne->email == "$email" && $ligne->mdp == "$mdp" && $ligne->types != "") {
            $_SESSION['id'] = $ligne->id;
            $_SESSION['nom'] = $ligne->nom;
            $_SESSION['prenom'] = $ligne->prenom;
            $_SESSION['types'] = $ligne->types;
            $_SESSION['mail'] = $ligne->email;
            $mysqli->close(); // Close connection
            header("location:home.php");

            exit;
        }
    }
}

?>



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
        <div class="topnav-right">

            <a href="register.php">S'identifier</a>
        </div>
    </div>

    <div style="padding-left:16px">
        <h1>La Bibliothèque des documents</h1>
        <h2>Login</h2>
        <form method="POST">
            <br>
            Votre email: <input type="text" name="email" placeholder="Entrez votre email" Required>
            <br />
            <br>
            Mot de passe: <input type="password" name="mdp" placeholder="Entrez votre mot de passe" Required>
            <br />
            <input type="submit" name="submit" value="Connexion">


        </form>

    </div>
    <?php
    if ($mysqli && isset($_POST['submit'])) {
        echo "Cet utilisateur n'existe pas !";
    } ?>

</body>


</html>
