<?php
session_start();
    include("Donnees.inc.php");
    if(isset($_GET['id'])) {
        $idRecette = $_GET['id'];
        $data = $Recettes[$idRecette];
        $data["id"] = $idRecette;
        if(isset($_SESSION['isLogin'])) {
            if($likes = unserialize(file_get_contents("likes.txt"))) {
                if(isset($likes[$_SESSION['login']])) {
                    array_push($likes[$_SESSION['login']], $data);
                } else {
                    $likes[$_SESSION['login']] = [$data];
                }
            } else {
                $likes[$_SESSION['login']] = [$data];
            }
            file_put_contents("likes.txt", serialize($likes));
            echo "La recette a bien été ajouté dans vos favoris";
        } else {
            if(isset($_SESSION['anonymous'])) {
                array_push($_SESSION['anonymous'], $data);
            } else {
                $_SESSION['anonymous'] = [$data];
            }
            echo "La recette a bien été ajouté dans vos favoris";
        }
    } else {
        echo "Un parametre est manquant";
    }

?>