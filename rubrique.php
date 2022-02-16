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

            background-image: url(login.jpg);

        }
    </style>
</head>

<body>
    <div class="topnav">
        <?php if ($_SESSION['id'] == ' ') { ?>
            <a class="active" href="home0.php">Accueil</a> <?php } ?>
        <?php if ($_SESSION['id'] != ' ') { ?><a class="active" href="home.php">Accueil</a><?php } ?>
    </div>

    <h2>Informations sur nos auteurs</h2>


    <table class="center">
        <tr>
            <th>Nos rubriques </th>

        </tr>

        <?php


        $mysqli = new mysqli("mariadb", "EDF", "edf", "EDF");
        $mysqli->set_charset("utf8");


        if (!$mysqli) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $requete = "SELECT * FROM rubrique";
        $resultat = $mysqli->query($requete); // fetch data from database

        while ($ligne = $resultat->fetch_object()) {
        ?>
            <tr>
                <td><?php echo $ligne->titres; ?></td>



            </tr>
        <?php
        }

        ?>

    </table>

</body>

</html>
