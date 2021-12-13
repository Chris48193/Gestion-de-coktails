<?php
session_start();
    include("Donnees.inc.php");
    if(isset($_GET['id'])) {
        $idRecette = $_GET['id'];
        if(isset($_SESSION['isLogin'])) {
            if($likes = unserialize(file_get_contents("likes.txt"))) {
                if(isset($likes[$_SESSION['login']])) {
                    array_push($likes[$_SESSION['login']], $Recettes[$idRecette]);
                } else {
                    $likes[$_SESSION['login']] = [$Recettes[$idRecette]];
                }
            } else {
                $likes[$_SESSION['login']] = [$Recettes[$idRecette]];
            }
            // foreach($likes as $like) {

            // }
            // $recette = $Recettes[$idRecette];
            file_put_contents("likes.txt", serialize($likes));
            echo "La recette a bien été ajouté dans vos favoris";
        } else {
            if(isset($_SESSION['anonymous'])) {
                array_push($_SESSION['anonymous'], $Recettes[$idRecette]);
            } else {
                $_SESSION['anonymous'] = [$Recettes[$idRecette]];
            }
            echo "La recette a bien été ajouté dans vos favoris";
        }
    } else {
        echo "Un parametre est manquant";
    }

?>