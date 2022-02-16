<?php session_start();

$mysqli = new mysqli("mariadb", "EDF", "edf", "EDF");
$mysqli->set_charset("utf8"); ?>

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
        <h1>Les Groupes</h1>

    </div>

    <form action="ajouter_utilisateur3.php" method="POST">
        <br>
        Ajouter un groupe : <input type="text" name="nom" placeholder="Entrez le nom du groupe">
        <br />
        <br>
        <input type="submit" name="submit" value="Construire">
        <br />


    </form>
    <?php if (isset($_POST['submit'])) {
    } ?>


    <table class="center" border="2" style="border:1px solid black;margin-left:auto;margin-right:auto;">
        <tr>
            <th>Nom du groupe</th>
            <th>L'administrateur</th>
            <th>Date de construction</th>
            <th>Messages</th>

        </tr>
        <?php
        $i = $_SESSION['id'];
        $requete = "SELECT t1.id, t1.nom, t1.dates, t1.mail_admins FROM groupe t1 INNER JOIN utilisateur_groupe t2 ON t2.id_groupe=t1.id INNER JOIN utilisateur t3 ON t3.id=t2.id_utilisateur WHERE t3.id='$i' GROUP BY t1.id";

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
                        <font color="green"><?php echo $ligne->mail_admins; ?>
                    </b>
                </td>
                <td><?php echo $ligne->dates; ?></td>
                <td><a href="message.php?id=<?php echo $ligne->id; ?>">messages</a></td>



            </tr>
        <?php
        }

        ?>
    </table>

</body>

</html>
