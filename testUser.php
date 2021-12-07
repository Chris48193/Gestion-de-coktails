<?php

require "classes/Users.php";
//$_POST['login'] = "chris";

$user = new Users();

//Section concernant l'enregistrement et la connection
if(isset($_POST['login']) && trim($_POST['login']) != "" && isset($_POST['mdp']) && trim($_POST['mdp']) != "" && isset($_GET['function'])) {
    $user = new Users();
    if($_GET['function'] == "signup") {
        //Registration
        $user->register("./index.php?p=contenuIndex", "./index.php?p=signup");
    } else if ($_GET['function'] == "login") {
        //Login
        $user->login("./index.php?p=contenuIndex","./index.php?p=login");
    } else {
        // Modification des données
    }
    
        
    
} else {
    
    $error = $user->displayErrors(["Le login, le mot de passe ou un parametre est manquant"]);

    if(isset($_GET['function'])) {
        if($_GET['function'] == "signup") {
            //Registration
            header('Location: ./index.php?p=signup&error='.$error);
        } else if ($_GET['function'] == "login") {
            //Login
            header('Location: ./index.php?p=login&error='.$error);
        } else if($_GET['function'] == "modifProfil") {

        } else {
            header('Location: ./index.php?p=modifierProfil&error='.$error);
        }
    }
    // header('Location: ./index.php?error='.$error);
    //Redirection vers page d'enregistrement avec message d'erreur ci-dessous

    
}


/*if($user->register()) {
    //Redirection vers la page d'acceil
    foreach($user->getErreursEnregistrement() as $error) {
        echo $error."<br/>";
    }
    foreach($user->getErrors() as $error) {
        echo $error."<br/>";
    }

    
} else {
    //Redirection vers la page d'enregistrement avec affichage d'erreur;
    foreach($user->getErreursEnregistrement() as $error) {
        echo $error."<br/>";
    }
    foreach($user->getErrors() as $error) {
        echo $error."<br/>";
    }
}

/*$user->login();
foreach($user->getErreursEnregistrement() as $error) {
    echo $error."<br/>";
}
foreach($user->getErrors() as $error) {
    echo $error."<br/>";
}*/

// $users = [];
// file_put_contents("users.txt", serialize($users));
echo "<br/>";
echo "<br/>";
$users = unserialize(file_get_contents("users.txt"));
foreach($users as $user) {
    print_r($user);
    echo "<br/>";
}