<?php session_start();

$mysqli = new mysqli("mariadb", "EDF", "edf", "EDF");
$mysqli->set_charset("utf8");
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    $id = $_SESSION['id_groupe_message2'];
}

$_SESSION['id_groupe_message'] = $id;
$requete0 = "SELECT * FROM groupe WHERE id='$id'";
$resultat0 = $mysqli->query($requete0);
$ligne = $resultat0->fetch_object();
$j = $ligne->nom;
?>

<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            text-align: center;
            background-image: url(login3.jpeg);


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
    </style>
</head>

<body>

    <div class="topnav">
        <a class="active" href="home.php">Accueil</a>
        <div class="topnav-right">
            <?php if ($_SESSION['types'] == 'admin') { ?>
                <a href="utilisateurs.php">Demande d'inscription dans le site</a> <?php } ?>

            <a href="groupe.php">Groupes</a>
            <a class="active" href="home0.php">Deconnexion</a>


        </div>
    </div>

    <div style="padding-left:16px">
        <h1>Les Messages du groupe <?php echo "(" . $j . ")"; ?></h1>

    </div>

    <form action="message_post.php" method="post">
        <p>

            <label for="message">Message</label> : <input type="text" name="message" id="message" /> </br>
            <input type="submit" value="Envoyer" />
        </p>
    </form>

    <?php

    // Connexion à la base de données
    $mysqli = new mysqli("mariadb", "EDF", "edf", "EDF");
    $mysqli->set_charset("utf8");

    // Récupération des 10 derniers messages
    $requete = "SELECT t2.email, t1.messages, t1.dates FROM messages t1 INNER JOIN utilisateur t2 ON t2.id=t1.id_emetteur WHERE t1.id_groupe='$id' ORDER BY t1.dates DESC";
    $resultat = $mysqli->query($requete);
    // Affichage de chaque message (toutes les données sont protégées par htmlspecialchars)
    while ($ligne = $resultat->fetch_object()) {
        echo '<p><strong>' . htmlspecialchars($ligne->email) . '</strong> : ' . htmlspecialchars($ligne->messages) . '</strong> : ' . htmlspecialchars($ligne->dates) . '</p>';
    }



    ?>
</body>

</html>
