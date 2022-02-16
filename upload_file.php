<?php
if ((($_FILES["file"]["type"] == "image/gif")
        || ($_FILES["file"]["type"] == "image/jpeg")
        || ($_FILES["file"]["type"] == "image/pjpeg"))
    && ($_FILES["file"]["size"] < 20000)
) {
    if ($_FILES["file"]["error"] > 0) {
        echo "Return Code: " . $_FILES["file"]["error"] . "<br
  />";
    } else {
        echo "Fichier à télécharger : " . $_FILES["file"]["name"] .
            "<br />";
        echo "Type: " . $_FILES["file"]["type"] . "<br />";
        echo "Taille: " . ($_FILES["file"]["size"] / 1024) . "
  Kb<br />";
        echo "Fichier temporaire : " . $_FILES["file"]["tmp_name"] .
            "<br />";

        if (file_exists("upload/" . $_FILES["file"]["name"])) {
            echo " Le fichier" . $_FILES["file"]["name"] . "  existe déjà
  à cette emplacement. ";
        } else {
            move_uploaded_file(
                $_FILES["file"]["tmp_name"],
                "upload/" . $_FILES["file"]["name"]
            );
            echo "Enregistré dans : " . "upload/" .
                $_FILES["file"]["name"];
        }
    }
} else {
    echo "Chemin invalide !!";
}
