<?php session_start(); ?>
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
        <a class="active" href="home.php">Accueil</a>
        <div class="topnav-right">
            <?php if ($_SESSION['types'] == 'admin') { ?>
                <a href="utilisateurs.php">Demande d'inscription dans le site</a> <?php } ?>
            <a href="Nosauteurs.php">Nos auteurs</a>
            <a href="rubrique.php">Nos rubriques</a>
            <a href="recherche.php">Recherche d'un livre</a>
            <a href="groupe.php">Groupes</a>
            <a class="active" href="home0.php">Deconnexion</a>


        </div>
    </div>

    <h2>Choisir les utilisateurs de votre groupe <?php echo $_SESSION["nom_groupe"] ?></h2>


    <table class="center">
        <tr>
            <th>nom</th>
            <th>prenom</th>
            <th>email</th>
            <th>ajouter</th>
        </tr>

        <?php


        $mysqli = new mysqli("mariadb", "EDF", "edf", "EDF");
        $mysqli->set_charset("utf8");


        if (!$mysqli) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $s = $_SESSION["groupe"];
        $k = $_SESSION["id"];
        $requete = "SELECT * FROM utilisateur WHERE (types = 'restreint' OR types = 'admin') AND id!='$k' ";
        $resultat = $mysqli->query($requete); // fetch data from database
        ?>
        <form action="ajouter_utilisateur2.php" method="post">
            <?php 
            while ($ligne = $resultat->fetch_object()) {
                $j = $ligne->id;
            ?>
                <tr>
                    <td><?php echo $ligne->nom; ?></td>
                    <td><?php echo $ligne->prenom; ?></td>
                    <td><?php echo $ligne->email; ?></td>
                    <td><label><input type="checkbox" name="chk1[]" value="<?php echo $j ?>"> </label></td>



                </tr>
            <?php
            }

            ?>
            <br>
            <input type="submit" name="Submit" value="Submit">
        </form>
    </table>


</body>

</html>
