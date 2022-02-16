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

            background-image: url(login.jpg);

        }
    </style>
</head>


<body>
    <div class="topnav">
        <a class="active" href="home.php">Accueil</a>
    </div>
    <h3>Détails de livre</h3>


    <?php
    $mysqli = new mysqli("mariadb", "EDF", "edf", "EDF");
    $mysqli->set_charset("utf8");
    $id = $_GET['id'];
    if ($id != "7") {
        $requete = "SELECT t1.titre, t1.sous_titre, t1.nombre_pages, t1.isbn, t1.annee_parution, t1.niveau, t1.couverture, t3.nom, t3.prenom, t5.titres, t6.prix_ht, t6.frais_ht FROM livre t1 INNER JOIN auteur_livre AS t2 ON t2.id_livre=t1.id INNER JOIN auteur t3 ON t3.id=t2.id_auteur INNER JOIN rubrique_livre t4 ON t4.id_livre = t1.id INNER JOIN rubrique t5 ON t5.id = t4.id_rubrique INNER JOIN collections t6 ON t6.id=t1.id_collection  WHERE t1.id='$id'";
        $resultat = $mysqli->query($requete);
        $ligne = $resultat->fetch_object();
    } else {
        $requete = "SELECT t1.titre, t1.sous_titre, t1.nombre_pages, t1.isbn, t1.annee_parution, t1.niveau, t1.couverture, t3.nom, t3.prenom , t6.prix_ht, t6.frais_ht FROM livre t1 INNER JOIN auteur_livre AS t2 ON t2.id_livre=t1.id INNER JOIN auteur t3 ON t3.id=t2.id_auteur INNER JOIN collections t6 ON t6.id=t1.id_collection  WHERE t1.id='$id'";
        $resultat = $mysqli->query($requete);
        $ligne = $resultat->fetch_object();
    }

    ?>
    <table class="center" border="2">
        <tr>
            <th>titre</th>
            <td><?php echo $ligne->titre; ?></td>
        </tr>
        <tr>
            <th>sous_titre</th>
            <td><?php echo $ligne->sous_titre; ?></td>
        <tr>
            <th>nombre_pages</th>
            <td><?php echo $ligne->nombre_pages; ?></td>
        </tr>
        <tr>
            <th>isbn</th>
            <td><?php echo $ligne->isbn; ?></td>
        </tr>
        <tr>
            <th>nom de l'auteur</th>
            <td><?php echo $ligne->nom; ?></td>
        </tr>
        <tr>
            <th>prenom de l'auteur</th>
            <td><?php echo $ligne->prenom; ?></td>
        </tr>
        <tr>
            <th>Rubrique</th>
            <td><?php echo $ligne->titres; ?></td>
        </tr>
        <tr>
            <th>Annee parution</th>
            <td><?php echo $ligne->annee_parution; ?></td>
        </tr>
        <tr>
            <th>Niveau</th>
            <td><?php echo $ligne->niveau; ?></td>
        </tr>
        <tr>
            <th>Prix HT</th>
            <td><?php echo $ligne->prix_ht; ?></td>
        </tr>
        <tr>
            <th>Prix TTC</th>
            <td><?php echo ROUND($ligne->prix_ht * (1 + $ligne->frais_ht / 100), 2); ?></td>
        </tr>




    </table>
    <?php



    echo '<img src="' . $id . '.gif" width="350">';

    ?>

</body>

</html>
