<?php session_start(); ?>

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
        <h1>La Bibliothèque des documents </h1>
        <h2>Bonjour <?php echo $_SESSION['nom'] . " " . $_SESSION['prenom']; ?> </h2>
    </div>

    <form action="upload.php" method="post" enctype="multipart/form-data">
        Sélectionnez le fichier à télécharger :
        <input type="file" name="file">
        <input type="submit" name="submit" value="télécharger">
    </form>
    <?php echo $_SESSION["error"];
    $_SESSION["error"] = " ";
    $admin=$_SESSION['id'];

    ?>

    <table class="center" border="2" style="border:1px solid black;margin-left:auto;margin-right:auto;">
        <tr>
            <th>Nom</th>
            <th>Type</th>
            <th>Taille</th>
            <th>Date</th>
            <th>Voir</th>

        </tr>
        <?php
        $mysqli = new mysqli("mariadb", "EDF", "edf", "EDF");
        $mysqli->set_charset("utf8");
        $requete = "SELECT t1.id, t1.nom, t1.types, t1.taille, t2.dates FROM documents t1 INNER JOIN utilisateur_documents t2 ON t2.id_documents=t1.id WHERE t2.id_utilisateur='$admin' GROUP BY t2.dates ";
        $resultat = $mysqli->query($requete);
        while ($ligne = $resultat->fetch_object()) {
        ?>
            <tr>
                <td>
                    <b>
                        <font color="white"><?php echo $ligne->nom; ?>
                    </b>
                </td>

                <td><b>
                        <font color="green"><?php echo $ligne->types; ?>
                    </b>
                </td>
                <td><?php echo $ligne->taille; ?></td>
                <td><?php echo $ligne->dates; ?></td>
                <td><a href="view.php?id=<?php echo $ligne->id; ?>">voir</a></td>



            </tr>
        <?php
        }

        ?>
    </table>

</body>

</html>
