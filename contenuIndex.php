
  
<!-- MAIN -->
<main>  
    <div class="container-fluid">
      <div class="row">
        <div class="col-2 border border-top-0">
          <div class="row">
            <span class="header-coktail">Aliment courant</span>
          </div>
          <?php
			include("Donnees.inc.php");
			$coktailsExtrait = array();
			$coktailsComplets = array(); 
			$coktailsSansSousCat= array();
			
            $sousCatExist = false;
            if (isset($_GET['superCat']) && isset($_GET['element'])) {
              $superCat = $_GET['superCat'];
              $element = $_GET['element'];
			  
			    if(isset($_GET['path'])){
					 $path=$_GET['path']."/".$element;
				  }else{
					$path=$element;
				  }
				  
               if($superCat != null && $element != null){
                    $sousCat = calculerSousCategories($Hierarchie,$element);
					//Il est nécessaire de bien représenter l'element(sans underscores)dans le fil d'ariane
					$dynamicPath="";
					$superLinks = explode("/",$path);
                    $affichage = '<div class="row">';
					
						foreach($superLinks as $key => $link){
								if($key>0){
								$holdString=$superLinks[$key-1] ."/";
								$dynamicSuperCat=$superLinks[$key-1];
								$dynamicPath.= $holdString;
								}
								
							if($link=="Aliment"){
								$affichage .= ' <span>
												<a href="index.php?p=contenuIndex&element='.$link.'">'.$link.'</a>
												/<span>';
								
							}else{
								$affichage .= '<span>
										<a href="index.php?p=contenuIndex&superCat='.$dynamicSuperCat.'&element='.$link.
																					'&path='.substr($dynamicPath,0,-1).'">'.str_replace('_',' ',$link).'</a>
												/<span>';
							}
						}
						$affichage=rtrim($affichage,"/<span>") . "<span>";
						
                    $affichage .='</div>
								  </br>
                                    <!-- Liste des sous-categories -->
                                  <div class="row">
                                    <span >Sous-categories: <span>
                                  </div>
                                  <div id=linkList class="row">
                                    <ul class="nav nav-pills flex-column">';
                    
                    if(count($sousCat) != 0){
                      $sousCatExist = true;
                      foreach($sousCat as $cat){
						  if(substr_count($cat,' ')>=1){
							  $replacedCat=str_replace(' ','_',$cat);
								$affichage .= 	  "<li class=nav-item>
												   <a class='nav-link' href=index.php?p=contenuIndex&superCat=$element&element=$replacedCat&path=$path>$cat</a>
												   </li>";
							  
						  }else{
							   $affichage .= "<li class=nav-item>
                                        <a class='nav-link' href=index.php?p=contenuIndex&superCat=$element&element=$cat&path=$path>$cat</a>
                                       </li>"; 
							  
						  }
                      
                      }
                      $affichage .=  ' </ul>
                                    </div>'; 
                      echo $affichage;     
					}
                  }

                } else {
						$element = "Aliment";
						$affichageStandard= '<div class="row">
												<a href="#">'.$element.'</a>
											</div>
											</br>
											
											<!-- Liste des sous-categories -->
											
											<div class="row">
												<span >Sous-categories: <span>
											</div>';
						
						
						$sousCat=calculerSousCategories($Hierarchie,"Aliment");
						
						$affichageStandard .=  '<div id=linkList class="row">
												<ul class="nav nav-pills flex-column">';
						  
						foreach($sousCat as $cat){
							if(substr_count($cat,' ')>=1){
								$replacedCat=str_replace(' ','_',$cat);
								$affichageStandard .= "<li class=nav-item>
												   <a class='nav-link' href=index.php?p=contenuIndex&superCat=$element&element=$replacedCat&path=$element>$cat</a>
												   </li>";
								
							}else{
								$affichageStandard .= "<li class=nav-item>
												   <a class='nav-link' href=index.php?p=contenuIndex&superCat=$element&element=$cat&path=$element>$cat</a>
												   </li>";
							}
							
						}
							$affichageStandard .=  ' </ul>
												   </div>'; 
                      echo $affichageStandard;   
                }
				
				if($sousCatExist==false && $element !="Aliment" ){
					$affichageFinal = '<div class="row">';
					foreach($superLinks as $key => $link){
						
						if($key>0){
							$affichageFinal.='<span>
										<a href="index.php?p=contenuIndex&superCat='.$superLinks[$key-1].'&element='.$link.
																					'&path='.$dynamicPath.'">'.str_replace('_',' ',$link).'</a>
										/<span>';	
						}else{
							$affichageFinal.='<span>
										<a href="index.php?p=contenuIndex&superCat='.$superLinks[$key].'&element='.$link.
																					'&path='.$dynamicPath.'">'.str_replace('_',' ',$link).'</a>
										/<span>';	
							
						}
										
                                  
					}
					$affichageFinal=rtrim($affichage,"/<span>") . "<span>";
					$affichageFinal .=  '   -> Non existantes !
								  </div>
								  </br>';
					echo $affichageFinal;
				}
          ?>    
        </div>
        <div class="col-10" id="display-zone">
          <div class="row-0">
            <div class="text-center">
              <h4 class="mt-1 mb-2">Vos recettes de coktails en details...</h4>
              <p>Bonne préparation!</p>
            </div>
          </div>

          <!-- Affichage des recettes selon la catégorie sélectionné | Génération avec php -->
          <?php
		 /* if($element=="Aliment"){
				$coktailsComplets=extraireToutCoktails($coktailsComplets,$Recettes);
                echo afficherListeRecettes($coktailsComplets);
            }   */ 
            if($sousCatExist) {
              $coktailsExtrait = extraireCoktails($coktailsExtrait,$Hierarchie,$Recettes,$sousCat, $element);
			  
              echo afficherListeRecettes($coktailsExtrait);

            }if($sousCatExist==false){
			  $coktailsSansSousCat=extraireDerniersCoktails($coktailsSansSousCat,$Recettes,$element);
			  
			  echo afficherListeRecettes($coktailsSansSousCat);
				
				
			}          
          ?>
          <!-- Fin de la génération PHP -->
        </div>
      </div>
      <hr class="d-sm-none">
    </div>
  </main>