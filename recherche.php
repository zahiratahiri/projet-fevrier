<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf8">
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
    <h3>Lorsque vous tapez plus d'informations, vous trouverez rapidement le livre dont vous avez besoin !</h3>
    <form action="utilisateur2.php" method="post"> 
        Nom de l'auteur : <input type="text" name="nom" placeholder="Entrez le nom de l'auteur">
        <br />
        Prenom de l'auteur: <input type="text" name="prenom" placeholder="Entrez le prenom de l'auteur">
        <br />
        Rubrique: <input type="text" name="rubrique" placeholder="Entrez le nom de la rubrique">
        <br />
        Titre: <input type="text" name="titre" placeholder="Entrez le titre du livre">
        <br />
        Sous_titre: <input type="text" name="sous_titre" placeholder="Entrez le sous_titre du livre">
        <br />
        Prix_max: <input type="text" name="prix" placeholder="Entrez le prix maximum">
        <br />
        <input type="submit" name="submit" value="Submit">


    </form>

    <?php
    $mysqli = new mysqli("mariadb", "EDF", "edf", "EDF");
    $mysqli->set_charset("utf8");

    if (isset($_POST['submit'])) { ?>
        <table class="center" border="2">
            <tr>
                <th>titre</th>
                <th>sous_titre</th>
                <th>nombre_pages</th>
                <th>isbn</th>
                <th>Détails sur le livre</th>

            </tr>
            <?php

            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $rubrique = $_POST['rubrique'];
            $titre = $_POST['titre'];
            $sous_titre = $_POST['sous_titre'];
            $prix = $_POST['prix'];
            if (trim($rubrique) != "" && trim($sous_titre) != "") {
                $requete = "SELECT t1.id, t1.titre, t1.sous_titre, t1.nombre_pages, t1.isbn FROM livre t1 INNER JOIN auteur_livre AS t2 ON t2.id_livre=t1.id INNER JOIN auteur t3 ON t3.id=t2.id_auteur INNER JOIN rubrique_livre t4 ON t4.id_livre = t1.id INNER JOIN rubrique t5 ON t5.id = t4.id_rubrique INNER JOIN collections t6 ON t6.id=t1.id_collection WHERE IF('$nom' != '' ,'$nom', t3.nom ) = t3.nom  AND IF('$prenom' != '' ,'$prenom' ,t3.prenom  ) = t3.prenom AND IF('$rubrique' != '' , '$rubrique', t5.titres ) = t5.titres AND IF('$titre' != '' , '$titre', t1.titre ) = t1.titre AND IF('$sous_titre' != '' , '$sous_titre', t1.sous_titre ) = t1.sous_titre AND IF('$prix' != '' , '$prix', ROUND(t6.prix_ht*(1+t6.frais_ht/100),2) ) >= ROUND(t6.prix_ht*(1+t6.frais_ht/100),2) GROUP BY t1.id";
                $resultat = $mysqli->query($requete);
            } elseif (trim($rubrique) == "" && trim($sous_titre) != "") {
                $requete = "SELECT t1.id, t1.titre, t1.sous_titre, t1.nombre_pages, t1.isbn FROM livre t1 INNER JOIN auteur_livre AS t2 ON t2.id_livre=t1.id INNER JOIN auteur t3 ON t3.id=t2.id_auteur INNER JOIN collections t4 ON t4.id=t1.id_collection WHERE IF('$nom' != '' ,'$nom', t3.nom ) = t3.nom  AND IF('$prenom' != '' ,'$prenom' ,t3.prenom  ) = t3.prenom AND IF('$titre' != '' , '$titre', t1.titre ) = t1.titre AND IF('$sous_titre' != '' , '$sous_titre', t1.sous_titre ) = t1.sous_titre AND IF('$prix' != '' , '$prix', ROUND(t4.prix_ht*(1+t4.frais_ht/100),2) ) >= ROUND(t4.prix_ht*(1+t4.frais_ht/100),2) GROUP BY t1.id";
                $resultat = $mysqli->query($requete);
            } elseif (trim($rubrique) != "" && trim($sous_titre) == "") {
                $requete = "SELECT t1.id, t1.titre, t1.sous_titre, t1.nombre_pages, t1.isbn FROM livre t1 INNER JOIN auteur_livre AS t2 ON t2.id_livre=t1.id INNER JOIN auteur t3 ON t3.id=t2.id_auteur INNER JOIN rubrique_livre t4 ON t4.id_livre = t1.id INNER JOIN rubrique t5 ON t5.id = t4.id_rubrique INNER JOIN collections t6 ON t6.id=t1.id_collection WHERE IF('$nom' != '' ,'$nom', t3.nom ) = t3.nom  AND IF('$prenom' != '' ,'$prenom' ,t3.prenom  ) = t3.prenom AND IF('$rubrique' != '' , '$rubrique', t5.titres ) = t5.titres AND IF('$titre' != '' , '$titre', t1.titre ) = t1.titre AND IF('$prix' != '' , '$prix', ROUND(t6.prix_ht*(1+t6.frais_ht/100),2) ) >= ROUND(t6.prix_ht*(1+t6.frais_ht/100),2) GROUP BY t1.id";
                $resultat = $mysqli->query($requete);
            } else {
                $requete = "SELECT t1.id, t1.titre, t1.sous_titre, t1.nombre_pages, t1.isbn FROM livre t1 INNER JOIN auteur_livre AS t2 ON t2.id_livre=t1.id INNER JOIN auteur t3 ON t3.id=t2.id_auteur INNER JOIN collections t4 ON t4.id=t1.id_collection WHERE IF('$nom' != '' ,'$nom', t3.nom ) = t3.nom  AND IF('$prenom' != '' ,'$prenom' ,t3.prenom  ) = t3.prenom AND IF('$titre' != '' , '$titre', t1.titre ) = t1.titre AND IF('$prix' != '' , '$prix', ROUND(t4.prix_ht*(1+t4.frais_ht/100),2) ) >= ROUND(t4.prix_ht*(1+t4.frais_ht/100),2) GROUP BY t1.id";
                $resultat = $mysqli->query($requete);
            }








            while ($ligne = $resultat->fetch_object()) {
            ?>
                <tr>
                    <td>
                        <b>
                            <font color="white"><?php echo $ligne->titre; ?>
                        </b>
                    </td>

                    <td><b>
                            <font color="green"><?php echo $ligne->sous_titre; ?>
                        </b>
                    </td>
                    <td><?php echo $ligne->nombre_pages; ?></td>
                    <td><?php echo $ligne->isbn; ?></td>
                    <td><a href="details.php?id=<?php echo $ligne->id; ?>">détails</a></td>



                </tr>
        <?php
            }
        }
        ?>
        </table>
</body>

</html>
