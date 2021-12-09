
  
<!-- MAIN -->
<main>  
    <div class="container-fluid">
      <div class="row">
        <div class="col-2 border border-top-0">
          <div class="row">
            <span class="header-coktail">Liste des Aliments</span>
          </div>
          <!-- Listes de liens dirigeant au menu -->
          <div class="row">
            <a href="#">Aliment</a>
          </div>
          <!-- Liste des sous-categories -->
          <div class="row">
            <span >Sous-categories: <span>
          </div>
          <?php
            $sousCatExist = false;
            if (isset($_GET['superCat']) && isset($_GET['element'])) {
              $superCat = $_GET['superCat'];
              $element = $_GET['element'];
              if($superCat != null && $element != null){

                $sousCat = calculerSousCategories($superCat, $element);
                $affichage = '<div class="row">
                                <a href="#">Aliment</a>
                              </div>
                                <!-- Liste des sous-categories -->
                              <div class="row">
                                <span >Sous-categories: <span>
                              </div>
                              <div class="row">
                                <ul class="nav nav-pills flex-column">';
                
                if(count($sousCat) != 0){
                  $sousCatExist = true;
                  foreach($sousCat as $cat){
                    $affichage .= "<li class=nav-item>
                                      <a class='nav-link' href=index.php?p=contenuIndex&superCat=$element&element=$cat>$cat</a>
                                    </li>";
                  }
                  $affichage .=  ' </ul>
                                </div>'; 
                  echo $affichage;   
                }       
              }

            } else {
              echo  '<div class="row">
                      <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                          <a class="nav-link" href="index.php?p=contenuIndex&superCat=Aliment&element=Fruit">Fruit</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="index.php?p=contenuIndex&superCat=Aliment&element=Legume">Légumes</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="index.php?p=contenuIndex&superCat=Aliment&element=Epices">Epices</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="index.php?p=contenuIndex&superCat=Aliment&element=Agrumes">Agrumes</a>
                        </li>
                      </ul>
                    </div>';
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
            if($sousCatExist) {
              $coktailsExtrait = extraireCoktails($superCat, $element);
              echo afficherListeRecettes($coktailsExtrait);

            } else {
              echo afficherListeRecettes($tableau);
            }              
          ?>
          <!-- Fin de la génération PHP -->
        </div>
      </div>
      <hr class="d-sm-none">
    </div>
  </main>