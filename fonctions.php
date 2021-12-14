<!-- Template d'array pour affichage de coktail  -->
<?php
//  Fonctions Utilitaires pour extraction de contenus 
// Extraction des ingredients du tableau
    function extraireIndex($tableau) {
        $index  = null;
        foreach($tableau as $key => $value) {
            $index .="<br/>$value" ;
        }
        return $index;
    }

    function makeCoktail($title , $colorLike, $index, $img,$preparation,$ingredients, $coktails){
      $coktail = '<div class="col-sm-3 mb-2">
                    <div class="card" style="width: 12rem;">
                    <div class="text-left">
                        <form class="d-flex" method="POST" action="index.php?p=detailsRecette" target="_blank">
						<input type="hidden" name="title" value="'.$title.'"/>
						<input type="hidden" name="like" value="'.$colorLike.'"/>
						<input type="hidden" name="index" value="'.$index.'"/>
						<input type="hidden" name="img" value="'.$img.'"/>
						<input type="hidden" name="ingredients" value="'.urlencode($ingredients).'"/>
						<input type="hidden" name="id" value="'.$coktails.'"/>
                        <button type="submit" class="btn ms-2 h4 coktail-title" name="preparation" value="'.urlencode($preparation).'">' . $title . ' </button>
                        <button class="btn mb-2 btn-yellow ms-2 heart" type="button"> ' .
                           displayHeart($colorLike, $coktails) .'
                        </button>
                        </form>
                    </div>
                    <img src="' . $img . '" class="card-img-top" alt="..." width="30" height="100">
                    <div class="card-body">
                        <p class="card-text">'. $index . '</p>
                    </div>
                    </div>
                  </div>' ;
      return $coktail;
    }

    function afficherListeRecettes($recettesExtraits){
        $row = 3;
        $rowDisplay = '<div class="row mb-2">';
        foreach($recettesExtraits as $coktails => $details){
            if($row >= 0) { 
              // On affiche quatre coktails par ligne bootstrap
              	$rowDisplay .= makeCoktail($details["titre"], $details["likeColor"],
                                          extraireIndex($details["index"]), $details["img"], $details["preparation"],$details["ingredients"], $details['id']); 
				$row--;      
          } else {
              $rowDisplay .= "</div>";
              // Il faut encore affiche que 3 coktails dans la div
              $row = 2;
              // On affiche la suite sur une nouvelle ligne
              $rowDisplay .= '<div class="row mb-2">' . 
                              makeCoktail($details["titre"], $details["likeColor"],
                              extraireIndex($details["index"]), $details["img"],$details["preparation"],$details["ingredients"], $details['id']);
          }
        }
        return $rowDisplay . "</div>";
    }

    function displayHeart($heartColor, $coktails) {
		include("Donnees.inc.php");
		$button = '<svg xmlns="http://www.w3.org/2000/svg" id="'.$coktails.'" width="16" height="16" fill="black" class="like bi bi-heart" viewBox="0 0 16 16">
			<path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
		</svg>';
		$fav = [];
		if(isset($_SESSION['isLogin'])) {
			if($likes = unserialize(file_get_contents("likes.txt"))) { 
				if(isset($likes[$_SESSION['login']])) {
					// print_r($Recettes[$coktails]);
					$data = $Recettes[$coktails];
					$data["id"] = $coktails;

					if(in_array($data, $likes[$_SESSION['login']])) {
						$button = '<svg xmlns="http://www.w3.org/2000/svg" id="'.$coktails.'" width="16" height="16" fill="red" class="dislike bi bi-heart-fill" viewBox="0 0 16 16">
							<path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
							</svg>';
					}
				}
			}
		} else if(isset($_SESSION['anonymous'])) {
				$fav = array_merge($fav, $_SESSION['anonymous']);
				$data = $Recettes[$coktails];
				$data["id"] = $coktails;
				if(in_array($data, $fav)) {
					$button = '<svg xmlns="http://www.w3.org/2000/svg" id="'.$coktails.'" width="16" height="16" fill="red" class="dislike bi bi-heart-fill" viewBox="0 0 16 16">
						<path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
						</svg>';
				}
		}
        return $button;

    }

    		
        /// Parcourir le tableau et afficher les sous-categories
        // retourner le tableau des sous catégories de l'élément
		
    function calculerSousCategories($Hierarchie,$element){
		
		//Re-enlever les underscores placés pour que le passage de la variable "$element" fonctionne
		if(substr_count($element,'_')>=1){
			$element=str_replace('_',' ',$element);
		}
		
		if($Hierarchie[$element]!=null){
			$array=$Hierarchie[$element];
			if(array_key_exists("sous-categorie",$array)){
				$array=array_values($array["sous-categorie"]);
				return $array;
			}	
		}else return false;
		
		
    }

    function extraireCoktails(&$coktailsExtrait,$Hierarchie,$Recettes,$sousCat,$element){

		if(calculerSousCategories($Hierarchie,$element)!=false){
		
			if(substr_count($element,'_')>=1){
				$element=str_replace('_',' ',$element);
			}
			
			$tableauDeFormattage = array();
			
			 
			
			foreach($Recettes as $receiptNr => $attributes){
				foreach($attributes as $attributeName => $value){
					if($attributeName=="index"){
						foreach($value as $key => $aliment){
								
								if($aliment==$element){
									$currentImg=trouverImageCorrespondante($Recettes[$receiptNr]["titre"]);
									$tableauDeFormattage["titre"]=$Recettes[$receiptNr]["titre"];
									$tableauDeFormattage["preparation"]=$Recettes[$receiptNr]["preparation"]; 
									$tableauDeFormattage["img"]=$currentImg;
									$tableauDeFormattage["likeColor"]="aliceblue";
									$tableauDeFormattage["index"]=$Recettes[$receiptNr]["index"];
									$tableauDeFormattage["ingredients"]=$Recettes[$receiptNr]["ingredients"];
									$tableauDeFormattage["id"]=$receiptNr;
									if(!in_array($tableauDeFormattage,$coktailsExtrait)){
										array_push($coktailsExtrait,$tableauDeFormattage);
									}
									
								}
								
								if(in_array($aliment,$sousCat)){
									$currentImg=trouverImageCorrespondante($Recettes[$receiptNr]["titre"]);
									$tableauDeFormattage["titre"]=$Recettes[$receiptNr]["titre"];
									$tableauDeFormattage["preparation"]=$Recettes[$receiptNr]["preparation"]; 
									$tableauDeFormattage["img"]=$currentImg;
									$tableauDeFormattage["likeColor"]="aliceblue";
									$tableauDeFormattage["index"]=$Recettes[$receiptNr]["index"];
									$tableauDeFormattage["ingredients"]=$Recettes[$receiptNr]["ingredients"];
									$tableauDeFormattage["id"]=$receiptNr;
									
									if(!in_array($tableauDeFormattage,$coktailsExtrait)){
										array_push($coktailsExtrait,$tableauDeFormattage);
									}
									
								}
								
								
								
						}
					
					}
					
					
				} 
			}
			
			foreach($sousCat as $newElementkey => $newElementValue){
				return extraireCoktails($coktailsExtrait,$Hierarchie,$Recettes,calculerSousCategories($Hierarchie,$newElementValue),$newElementValue);
			}
		}
   
      return $coktailsExtrait ;
        /// Parcourir le tableau et afficher les sous-categories
        // retourner le tableau des sous catégories de l'élément

    }
	
	function extraireToutCoktails(&$coktailsComplets,$Recettes){
		
		$tableauDeFormattage = array();
		
		foreach($Recettes as $receiptNr => $attributes){
			foreach($attributes as $attributeName => $value){
				if($attributeName=="index"){
					foreach($value as $key => $aliment){
						$currentImg=trouverImageCorrespondante($Recettes[$receiptNr]["titre"]);
						$tableauDeFormattage["titre"]=$Recettes[$receiptNr]["titre"];
						$tableauDeFormattage["preparation"]=$Recettes[$receiptNr]["preparation"]; 
						$tableauDeFormattage["img"]=$currentImg;
						$tableauDeFormattage["likeColor"]="aliceblue";
						$tableauDeFormattage["index"]=$Recettes[$receiptNr]["index"];
						$tableauDeFormattage["ingredients"]=$Recettes[$receiptNr]["ingredients"];
						$tableauDeFormattage["id"]=$receiptNr;
						if(!in_array($tableauDeFormattage,$coktailsComplets)){
							array_push($coktailsComplets,$tableauDeFormattage);
						}
					}
				}
			}
		}
		return $coktailsComplets;
	}
	
	function extraireDerniersCoktails(&$coktailsSansSousCat,$Recettes,$element){
		$tableauDeFormattage = array();
		if(substr_count($element,'_')>=1){
			$element=str_replace('_',' ',$element);
		}
		foreach($Recettes as $receiptNr => $attributes){
			foreach($attributes as $attributeName => $value){
				if($attributeName=="index"){
					foreach($value as $key => $aliment){	
						if($aliment==$element){
							$currentImg=trouverImageCorrespondante($Recettes[$receiptNr]["titre"]);
							$tableauDeFormattage["titre"]=$Recettes[$receiptNr]["titre"];
							$tableauDeFormattage["preparation"]=$Recettes[$receiptNr]["preparation"]; 
							$tableauDeFormattage["img"]=$currentImg;
							$tableauDeFormattage["likeColor"]="aliceblue";
							$tableauDeFormattage["index"]=$Recettes[$receiptNr]["index"];
							$tableauDeFormattage["ingredients"]=$Recettes[$receiptNr]["ingredients"];
							$tableauDeFormattage["id"]=$receiptNr;
							if(!in_array($tableauDeFormattage,$coktailsSansSousCat)){
								array_push($coktailsSansSousCat,$tableauDeFormattage);
							}
						}		
					}
				}
			}
		}
		return $coktailsSansSousCat;
	}
	
	function trouverImageCorrespondante($titre){
		$directory="Photos";

		if(substr_count($titre,' ')>=1){
			
			$titre = str_replace(' ','_',$titre);
		
		}elseif(strpos($titre,"ï")==true){
			
			$titre = str_replace("ï","i",$titre);
			
		}elseif(strpos($titre,"ñ")==true){
			
			$titre = str_replace("ñ","n",$titre);
			
		}elseif(strpos($titre,"'")==true){
			
			$titre =  str_replace("'","",$titre);
			
		}
		
		$check="$directory/$titre.jpg";
		
		if(file_exists($check)){
			
			return $check;
		}else{
			return "$directory/cocktail.png";
		}
	}
?>
