<?php
    session_start();
    include("Donnees.inc.php");
    if(isset($_GET['id'])) {
        $idRecette = $_GET['id'];
        if(isset($_SESSION['isLogin'])) {
            if($likes = unserialize(file_get_contents("likes.txt"))) {
                if(isset($likes[$_SESSION['login']])) {
                    unset($likes[$_SESSION['login']][array_search($Recettes[$idRecette], $likes[$_SESSION['login']])]);
                }
            } else {
                $likes = [];
            }
            // foreach($likes as $like) {

            // }
            // $recette = $Recettes[$idRecette];
            file_put_contents("likes.txt", serialize($likes));
            echo "La recette a bien été retirée de vos favoris";
        } else {
            if(isset($_SESSION['anonymous'])) {
                unset($_SESSION['anonymous'][array_search($Recettes[$idRecette], $_SESSION['anonymous'])]);
            }
            echo "La recette a bien été retirée de vos favoris";
        }
    } else {
        echo "Un parametre est manquant";
    }
?>