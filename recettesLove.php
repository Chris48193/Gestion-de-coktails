<h4>Afficher les recettes que l'utilisateur aime. </h4>
<?php
    $recettesRequete = [];
    if(isset($_SESSION['isLogin'])) {
        if($likes = unserialize(file_get_contents("likes.txt"))) {
            if(isset($likes[$_SESSION['login']])) {
                foreach($likes[$_SESSION['login']] as $recette) {
                    $nouvelleStructure = [
                        "titre" => $recette["titre"],
                        "preparation" => $recette["preparation"],
                        "img" => trouverImageCorrespondante($recette["titre"]),
                        "likeColor" => "red",
                        "index" => $recette["index"],
                        "ingredients" => ""
                     ];
                    array_push($recettesRequete, $nouvelleStructure);
                }
                echo afficherListeRecettes($recettesRequete);
            } else {
                echo "Vous n'avez pas encore de recettes préférées";
            }
        } else {
            echo "Vous n'avez pas encore de recettes préférées";
        }
    } else {
        if(isset($_SESSION['anonymous'])) {
            foreach($_SESSION['anonymous'] as $recette) {
                $nouvelleStructure = [
                    "titre" => $recette["titre"],
                    "preparation" => $recette["preparation"],
                    "img" => trouverImageCorrespondante($recette["titre"]),
                    "likeColor" => "red",
                    "index" => $recette["index"],
                    "ingredients" => ""
                 ];
                array_push($recettesRequete, $nouvelleStructure);
            }
            echo afficherListeRecettes($recettesRequete);;
        } else {
            echo "Vous n'avez pas encore de recettes préférées";
        }
    }

?>