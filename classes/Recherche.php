<?php

/**
 * Class Recherche
 * Permet de rechercher un cocktail dans une liste de cocktails
 */
class Recherche {
    private $erreur=[];
    private $mots=[];
    private $hierarchie_simple = [];
    private $recap = [
        "alimentsSouhaites" => [],
        "alimentsNonSouhaites" => [],
        "alimentsNonSouhaitesAvecSousCategorie" => [],
        "alimentsSouhaitesAvecSousCategorie" => [],
        "elementsNonReconnus" => []
    ];
    private $request_text; //Texte de la requete
    private $Hierarchie;
    private $Recettes;
    private $scoreRecettes;

    public function __construct($text) {
        include "Donnees.inc.php";

        $this->request_text = $text;
        $this->Hierarchie = $Hierarchie;
        $this->Recettes = $Recettes;
        //Création d'un array hiérachiquement plat
        foreach ($this->Hierarchie as $key => $value) {
            array_push($this->hierarchie_simple, $key);
            //echo $key."<br/>";
        }
    }

    /**
     * Vérifie la syntaxe de la chaine de requete
     * @return boolean Si la syntaxe est correcte ou pas
     */
    public function verifSyntaxeRequete() {

        //Vérification du nombre de double quotes
        $nombre_double_quotes = substr_count($this->request_text, '"');
        $request_text = $this->request_text;
        
        if(($nombre_double_quotes % 2) != 0) {
            array_push($this->erreur, "Problème de syntaxe dans votre requête: nombre impair de double-quotes");
        }

        //Vérification d'un espace avant les siges + et -
        /*for($i = 0; $i < strlen($request_text); $i++) {
            if($i != 0 && ($request_text[$i] == '+' || $request_text[$i] == '-') && ($request_text[$i-1] != ' ')) {
                array_push($this->erreur, "Problème de syntaxe dans votre requête: aucun espace avant un signe + ou -");
            }
        }*/

        //Test s'il y a eu une erreur
        if(count($this->erreur) > 0) {
            return false;
        }

        return true;
    }

    /**
     * Analyse la chaine de la requete
     * @return array Le tableau des mots contenus dans la requete
     */
    public function analyseRequete() {

        $mots_composes = array();
        $mots_simples = array();
        $mots = array();
        $request_text = $this->request_text;

        //Récupération des mots composés
        preg_match('/[+-]?".*"/', $request_text, $mots_composes);

        //Elimination des mots composés dans la requete
        $request_text=trim(preg_replace('/[+-]?".*"/', "", $request_text));

        //Récupération des mots simples
        $mots_simples = explode(' ', $request_text);

        //Combinaison des mots simples et composés dans un seul array
        foreach($mots_composes as $mot) {
            $mot = str_replace('"', '', $mot);
            if(strlen(trim($mot)) > 0) {
                array_push($this->mots, $mot);
            }
        }
        
        foreach($mots_simples as $mot) {
            if(strlen(trim($mot)) > 0) {
                array_push($this->mots, $mot);
            }
        }

        return $this->mots;
    }

    /**
     * Permet de classifier les aliments en fonction de s'ils ont été reconnus ou pas
     * @return recap Le récapitulatif de la classification
     */
    public function separationAliments() {
        $alimentsSouhaites = array();
        $alimentsNonSouhaites = array();
        $alimentsSouhaitesAvecSousCategorie = array();
        $alimentsNonSouhaitesAvecSousCategorie = array();
        $elementsNonReconnus = array();
        
        foreach($this->mots as $mot) {
            if(!in_array(preg_replace('/^[+-]/', '', $mot), $this->hierarchie_simple)) {
                // Si le mot n'est pas reconnu
                array_push($elementsNonReconnus, preg_replace('/^[+-]/', '', $mot));
                
            } else {
                if($mot[0] == '-') {
                    // Si on ne souhaite pas un mot, on l'ajoute dans le array des non souhaits
                    array_push($alimentsNonSouhaites, str_replace('-', '', $mot));
                    array_push($alimentsNonSouhaitesAvecSousCategorie, str_replace('-', '', $mot));
                    if(isset($this->Hierarchie[str_replace('-', '', $mot)]['sous-categorie'])) {
                        foreach($this->Hierarchie[str_replace('-', '', $mot)]['sous-categorie'] as $sous_cat) {
                            array_push($alimentsNonSouhaitesAvecSousCategorie, str_replace('-', '', $sous_cat));
                        }
                    }
                } else {
                    // Si on souhaite un mot, on l'ajoute dans l'array des souhaits
                    array_push($alimentsSouhaites, str_replace('+', '', $mot));
                    array_push($alimentsSouhaitesAvecSousCategorie, str_replace('+', '', $mot));
                    if(isset($this->Hierarchie[str_replace('+', '', $mot)]['sous-categorie'])) {
                        foreach($this->Hierarchie[str_replace('+', '', $mot)]['sous-categorie'] as $sous_cat) {
                            array_push($alimentsSouhaitesAvecSousCategorie, str_replace('+', '', $sous_cat));
                        }
                    }
                    
                }
            }
        }

        //Récapitulatif et stockage dans un array
        $this->recap = [
            "alimentsSouhaites" => $alimentsSouhaites,
            "alimentsNonSouhaites" => $alimentsNonSouhaites,
            "alimentsNonSouhaitesAvecSousCategorie" => $alimentsNonSouhaitesAvecSousCategorie,
            "alimentsSouhaitesAvecSousCategorie" => $alimentsSouhaitesAvecSousCategorie,
            "elementsNonReconnus" => $elementsNonReconnus
        ];
        return $this->recap;
    }

    /**
     * Classification des recettes en fonction de leurs scores
     */
    public function recuperationRecettes() {

        if(count($this->recap["alimentsSouhaites"]) > 0 || count($this->recap["alimentsNonSouhaites"]) > 0) {
            if(count($this->recap["alimentsSouhaites"]) == 0 && count($this->recap["alimentsNonSouhaites"]) > 0) {
                foreach($this->Recettes as $index => $recette) {
                    $score = 10;
                    foreach($recette["index"] as $categorie) {
                        if (in_array($categorie, $this->recap["alimentsNonSouhaitesAvecSousCategorie"])) {
                            $score=0;
                            break;
                        }
                    }
                    $this->scoreRecettes[$index] = $score;
                }
                arsort($this->scoreRecettes);
                return $this->scoreRecettes;
            }

            //Parcours des catégories des différentes recettes
            //Nous créons ici une structure où les clés du array sont les index de chaque recette et la valeure est le score de recherche de cet recette. Nous trions en fin le array
            foreach($this->Recettes as $index => $recette) {
                $score = 0;
                foreach($recette["index"] as $categorie) {
                    if(in_array($categorie, $this->recap["alimentsSouhaitesAvecSousCategorie"])){
                        $score+=10;
                    } else if (in_array($categorie, $this->recap["alimentsNonSouhaitesAvecSousCategorie"])) {
                        $score=0;
                        break;
                    }
                }
                $this->scoreRecettes[$index] = $score;
            }
            //Trie du array
            arsort($this->scoreRecettes);
            return $this->scoreRecettes;
        }
        return false;
    }

    public function getRecettes() {
        return $this->Recettes;
    }

    public function getHierarchie() {
        return $this->hierarchie_simple;
    }

    public function getErreur() {
        return $this->erreur;
    }

}