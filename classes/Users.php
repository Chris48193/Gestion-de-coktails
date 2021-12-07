<?php
session_start();

class Users {

    private $login="";
    private $mdp="";
    private $nom="";
    private $prenom="";
    private $sexe="";
    private $email="";
    private $naissance="";
    private $nomAdresse="";
    private $codePostal="";
    private $ville="";
    private $telephone="";
    private $ancienMdp="";
    private $errors=[];
    private $erreursEnregistrement=[];
    private $users=[];

    public function __construct() {

        $this->loadData();
        
    }

    public function loadData() {
        //if() {
            print_r($_POST);
            //if(isset($_POST['login']) && trim($_POST['login']) != "" && isset($_POST['mdp']) && trim($_POST['mdp']) != "") {
            // if(isset($_POST['login']) && trim($_POST['login']) != "" && isset($_POST['mdp'])) {
            $this->login = trim($_POST['login']);
            $this->mdp = trim($_POST['mdp']);

            if(isset($_POST['nom'])) {
                $this->nom = trim($_POST['nom']);
            }
            if(isset($_POST['prenom'])) {
                $this->prenom = trim($_POST['prenom']);
            }
            if(isset($_POST['sexe'])) {
                $this->sexe = trim($_POST['sexe']);
            }
            if(isset($_POST['email'])) {
                $this->email = trim($_POST['email']);
            }
            if(isset($_POST['naissance'])) {
                $this->naissance = trim($_POST['naissance']);
            }
            if(isset($_POST['nomAdresse'])) {
                $this->nomAdresse = trim($_POST['nomAdresse']);
            }
            if(isset($_POST['codePostal'])) {
                $this->codePostal = trim($_POST['codePostal']);
            }
            if(isset($_POST['ville'])) {
                $this->ville = trim($_POST['ville']);
            }
            if(isset($_POST['telephone'])) {
                $this->telephone = trim($_POST['telephone']);
            }
            if(isset($_POST['ancienMdp'])) {
                $this->ancienMdp = trim($_POST['ancienMdp']);
            }

            if($this->users = unserialize(file_get_contents("users.txt"))) {

            } else {
                $this->users = [];
            }
        //}
    }

    public function verifDonnees() {
        //Verif login
        if(preg_match("/[^A-Za-z0-9]/", $this->login)) {
            array_push($this->errors, "Le login ne doit que contenir des lettres non accentués et des chiffres");
        }

        // if($this->nom != "" && $this->prenom != "" && $this->naissance != "" && $this->telephone != "") {
        if($this->nom != "") {
            //Verif nom
            if(preg_match("/[^A-Za-z0-9- ']/", $this->nom)) {
                array_push($this->errors, "Le nom ne peut contenir que des majuscules et/ou minuscules et les charactères - espace et '");
            }
        }

        if($this->prenom != "") {
            //Verif prenom
            if(preg_match("/[^A-Za-z0-9- ']/", $this->prenom)) {
                array_push($this->errors, "Le prenom ne peut contenir que des majuscules et/ou minuscules et les charactères - espace et '");
            }
        }

        if($this->telephone != "") {
            // Verif numero telephone
            if(strlen($this->telephone) != 10) {
                array_push($this->errors, "Le numéro de telephone doit commencer par 0 et doit etre suivi de 9 chiffres");
                
            } else if(!preg_match("/0[0-9]{9}/", $this->telephone)) {
                array_push($this->errors, "Le numéro de telephone doit commencer par 0 et doit etre suivi de 9 chiffres");
            }
        }

        if($this->naissance != "") {
            //Verif date de naissance
            $parsedDate = date_parse($this->naissance);
            if(!$parsedDate['year'] || !$parsedDate['month'] || !$parsedDate['day']) {
                array_push($this->errors, "La date entrée n'est pas valide. Veillez rentrer la date au format AAAA/MM/JJ");
            } else {
                $dateDiff = (array)date_diff(date_create_from_format('Y-m-d', $parsedDate['year'].'-'.$parsedDate['month'].'-'.$parsedDate['day']), date_create_from_format('Y-m-d', date('Y-m-d')));
                if($dateDiff['y'] < 18) {
                    array_push($this->errors, "Vous devez avoir plus de 18 ans pour avoir accès à ce site");
                }
            }

        }

        //Verif date de naissance
        if(count($this->errors) > 0) {
            return false;
        }
        return true;
    }

    public function register($successRedirectionPage, $failureRedirectionPage) {
        if($this->verifDonnees()) {
            foreach($this->users as $user) {
                if ($user['login'] == $this->login) {
                    // L'utilisateur est existant. Redirection vers la page de connection avec message d'erreur: Utilisateur existant.
                    $error = "L'utilisateur est existant, veillez vous <a href=\"index.php?p=login\">connecter</a>";
                    echo "<br/> ".$error;
                    array_push($this->erreursEnregistrement, $error);
                    $error = $this->displayErrors($this->erreursEnregistrement);
                    header('Location: '.$failureRedirectionPage.'&error='.$error.'');
                    return false;
                }
            }
            $user = array(
                "login" => $this->login,
                "mdp" => $this->mdp,
                "nom" => $this->nom,
                "prenom" => $this->prenom,
                "sexe" => $this->sexe,
                "email" => $this->email,
                "naissance" => $this->naissance,
                "nomAdresse" => $this->nomAdresse,
                "codePostal" => $this->codePostal,
                "ville" => $this->ville,
                "telephone" => $this->telephone
            );
            //$this->users = unserialize(file_get_contents("users.txt"));
            array_push($this->users, $user);
            file_put_contents("users.txt", serialize($this->users));
            $error = "L'utilisateur a bien été crée, Vous avez été redirigé vers la page d'acceuil";
            echo "<br/> ".$error;
            array_push($this->erreursEnregistrement, $error);
            $error = $this->displayErrors($this->erreursEnregistrement);
            $_SESSION['isLogin'] = true;
            $_SESSION['prenom'] = $this->prenom;
            $_SESSION['login'] = $this->login;
            header('Location: '.$successRedirectionPage.'&error='.$error.'');
            return true;
        }
        $error = "Les données suivantes ne sont pas correctes: ";
        echo "<br/> ".$error;
        foreach($this->errors as $error) {
            echo "<br/> ".$error;
        }
        array_push($this->erreursEnregistrement, $error);
        $error = $this->displayErrors($this->erreursEnregistrement);
        header('Location: '.$failureRedirectionPage.'&error='.$error.'');
        return false;
    }

    public function login($successRedirectionPage, $failureRedirectionPage) {
        $this->users = unserialize(file_get_contents("users.txt"));
        foreach($this->users as $user) {
            if ($user['login'] == $this->login) {
                if($user['mdp'] == $this->mdp) {
                    //On login l'utilisateur
                    $error = "L'utilisateur est bien connecté";
                    echo "<br/> ".$error;
                    array_push($this->erreursEnregistrement, $error);
                    $error = $this->displayErrors($this->erreursEnregistrement);
                    $_SESSION['isLogin'] = true;
                    $_SESSION['prenom'] = $this->prenom;
                    $_SESSION['login'] = $this->login;
                    header('Location: '.$successRedirectionPage.'&error='.$error.'');
                    return true;
                } else {
                    $error = "Le mot de passe n'est pas correct";
                    echo "<br/> ".$error;
                    array_push($this->erreursEnregistrement, $error);
                    $error = $this->displayErrors($this->erreursEnregistrement);
                    header('Location: '.$failureRedirectionPage.'&error='.$error.'');
                    return false;
                }
                break;
            }
        }
        $error = "Aucun utilisateur associé au nom d'utilisateur fourni, veillez vous <a href=\"index.php?p=signup\">enregistrer</a>";
        echo "<br/> ".$error;
        array_push($this->erreursEnregistrement, $error);
        $error = $this->displayErrors($this->erreursEnregistrement);
        header('Location: '.$failureRedirectionPage.'&error='.$error.'');
        return false;

    }

    public function modifDonnees() {
        $this->users = unserialize(file_get_contents("users.txt"));
        foreach($this->users as $user) {
            if ($user['login'] == $this->login) { // Utilisateur existant
                if($this->ancienMdp != "" || $this->mdp != "") {
                    if($user['mdp'] == $this->ancienMdp) {
                        //On Modifie son mot de passe
                        $error = "Le mot de passe a été modifié";
                        echo "<br/> ".$error;
                        array_push($this->erreursEnregistrement, $error);
                    } else {
                        $error = "Le mot de passe n'est pas correct";
                        echo "<br/> ".$error;
                        array_push($this->erreursEnregistrement, $error);
                        return false;
                    }
                }
            }
        }
        $error = "Aucun utilisateur associé au nom d'utilisateur fourni, veillez vous <a href=\"index.php?p=signup\">enregistrer</a>";
        echo "<br/> ".$error;
        array_push($this->erreursEnregistrement, $error);
        return false;
    }

    public function displayErrors($errors) {
        $errorText = "<h6><div class=\"bg-warning text-success\">";
        foreach($errors as $error) {
          $errorText .= $error . "</br>";
        }
        $errorText .= "</div></h6>";
        return $errorText;
    }

    // Getters
    public function getErreursEnregistrement() {
        return $this->erreursEnregistrement;
    }

    public function getErrors() {
        return $this->errors;
    }

    public function getlogin() {
        return $this->login;
    }

    public function getMdp() {
        return $this->mdp;
    }

    public function getNom() {
        return $this->nom;

    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function getSexe() {
        return $this->sexe;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getNaissance() {
        return $this->naissance;
    }

    public function getNomAdresse() {
        return $this->nomAdresse;
    }

    public function getCodePostal() {
        return $this->codePostal;
    }

    public function getVille() {
        return $this->ville;
    }

    public function getTelephone() {
        return $this->telephone;
    }



    // Setters
    public function setlogin() {
        

    }

    public function setMdp() {
        
    }

    public function setNom($nom) {

    }

    public function setPrenom($prenom) {

    }

    public function setSexe($sexe) {

    }

    public function setEmail($email) {

    }

    public function setNaissance($naissance) {

    }

    public function setNomAdresse($nomAdresse) {

    }

    public function setCodePostal($codePostal) {

    }

    public function setVille($ville) {

    }

    public function setTelephone($telephone) {

    }

}