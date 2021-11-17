<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="icon" type="image/png" sizes="16x16" href="PhotosSite/logo_trans.png">
    <title>Coin des coktails</title>
    <script>
      function detailsRecette(){
        document.getElementById("display-zone").style.display ="none";
        //console.log(document.getElementById("display-zone").style);

      }
    </script>
</head>
<body>
    <!-- Barre de navigation -->
    <nav class="navbar navbar-expand-sm navbar-dark" style="background-color: #e2edf5;">
        <div class="container-fluid mb-10">
          <a class="navbar-brand" href="javascript:void(0)"> <img src="PhotosSite/logo_trans.png" alt="Logo Site de coktails" width="100px" height="70px"></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="mynavbar">
            <form class="d-flex">
                <button class="btn btn-yellow ms-2" type="button">Navigation</button>
            </form>
            <form class="d-flex">
                <button class="btn btn-yellow ms-2" type="button">Recettes
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-heart-fill" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                  </svg>
                </button>
            </form>


            <form class="d-flex">
              <input class="form-control ms-2 large-search" type="text" placeholder="Chercher un aliment">
              <button class="btn border ms-2" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                </svg>
              </button>
            </form>
            <form class="d-flex" action="login.html?p=login" method="">
                <button class="btn btn-yellow ms-2" type="submit">Zone de Connexion</button>
            </form>
          </div>
        </div>
      </nav>

      <!-- MAIN -->
      <main>  
      <!-- Inclusions des differentes parties de la page -->
      if (isset($_GET['p'])) { 
        $fichier=$_GET['p'].'.php';
          if (file_exists($fichier))   include($fichier) ;
          else  echo "Erreur 404: la page demandée n'existe pas";
      }else{
        if (file_exists('ContenuIndex.php')) include('ContenuIndex.php');
        else  echo "Erreur 404: la page demandée n'existe pas";
      }
?>
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
  
              <div class="row">
                <ul class="nav nav-pills flex-column">
                  <li class="nav-item">
                    <a class="nav-link" href="#">Fruit</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Légumes</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Epices</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Disabled</a>
                  </li>
                </ul>
              </div>    
            </div>

            <div class="col-10" id="display-zone">
              <div class="row-0">
                <div class="text-center">
                  <h4 class="mt-1 mb-2">Vos recettes de coktails en details...</h4>
                  <p>Bonne préparation!</p>
                </div>
              </div>
              
              <div class="row mb-2">
                <div class="col-sm-3">
                  <div class="card" style="width: 12rem;">
                    <div class="text-left">
                      <form class="d-flex">
                        <h5 class="mt-1 pb-1 ps-2" action="">Body Mary</h5>
                        <button class="btn mb-2 btn-yellow ms-2" type="submit">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-suit-heart" viewBox="0 0 16 16">
                            <path d="m8 6.236-.894-1.789c-.222-.443-.607-1.08-1.152-1.595C5.418 2.345 4.776 2 4 2 2.324 2 1 3.326 1 4.92c0 1.211.554 2.066 1.868 3.37.337.334.721.695 1.146 1.093C5.122 10.423 6.5 11.717 8 13.447c1.5-1.73 2.878-3.024 3.986-4.064.425-.398.81-.76 1.146-1.093C14.446 6.986 15 6.131 15 4.92 15 3.326 13.676 2 12 2c-.777 0-1.418.345-1.954.852-.545.515-.93 1.152-1.152 1.595L8 6.236zm.392 8.292a.513.513 0 0 1-.784 0c-1.601-1.902-3.05-3.262-4.243-4.381C1.3 8.208 0 6.989 0 4.92 0 2.755 1.79 1 4 1c1.6 0 2.719 1.05 3.404 2.008.26.365.458.716.596.992a7.55 7.55 0 0 1 .596-.992C9.281 2.049 10.4 1 12 1c2.21 0 4 1.755 4 3.92 0 2.069-1.3 3.288-3.365 5.227-1.193 1.12-2.642 2.48-4.243 4.38z"/>
                          </svg>
                        </button>
                    </form>
                    </div>
                    <img src="Photos/cocktail.png" class="card-img-top" alt="..." width="30px" height="100px">
                    <div class="card-body">
                      <h5 class="card-title">Card title</h5>
                      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                      <a href="#" onclick="detailsRecette()" class="btn btn-primary">Details</a>
                    </div>
                  </div>
                </div> 

                <div class="col-sm-3">
                  <div class="card" style="width: 12rem;">
                    <div class="text-left">
                      <form class="d-flex" >
                        <h5 class="mt-1 pb-1 ps-2">Body Mary</h5>
                        <button class="btn mb-2 btn-yellow ms-2" type="button">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-suit-heart" viewBox="0 0 16 16">
                            <path d="m8 6.236-.894-1.789c-.222-.443-.607-1.08-1.152-1.595C5.418 2.345 4.776 2 4 2 2.324 2 1 3.326 1 4.92c0 1.211.554 2.066 1.868 3.37.337.334.721.695 1.146 1.093C5.122 10.423 6.5 11.717 8 13.447c1.5-1.73 2.878-3.024 3.986-4.064.425-.398.81-.76 1.146-1.093C14.446 6.986 15 6.131 15 4.92 15 3.326 13.676 2 12 2c-.777 0-1.418.345-1.954.852-.545.515-.93 1.152-1.152 1.595L8 6.236zm.392 8.292a.513.513 0 0 1-.784 0c-1.601-1.902-3.05-3.262-4.243-4.381C1.3 8.208 0 6.989 0 4.92 0 2.755 1.79 1 4 1c1.6 0 2.719 1.05 3.404 2.008.26.365.458.716.596.992a7.55 7.55 0 0 1 .596-.992C9.281 2.049 10.4 1 12 1c2.21 0 4 1.755 4 3.92 0 2.069-1.3 3.288-3.365 5.227-1.193 1.12-2.642 2.48-4.243 4.38z"/>
                          </svg>
                        </button>
                    </form>
                    </div>
                    <img src="Photos/cocktail.png" class="card-img-top" alt="..." width="30px" height="100px">
                    <div class="card-body">
                      <h5 class="card-title">Card title</h5>
                      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                      <a href="#" class="btn btn-primary">Details</a>
                    </div>
                  </div>
                </div> 
                <div class="col-sm-3">
                  <div class="card" style="width: 12rem;">
                    <div class="text-left">
                      <form class="d-flex" >
                        <h5 class="mt-1 pb-1 ps-2">Body Mary</h5>
                        <button class="btn mb-2 btn-yellow ms-2" type="button">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-suit-heart" viewBox="0 0 16 16">
                            <path d="m8 6.236-.894-1.789c-.222-.443-.607-1.08-1.152-1.595C5.418 2.345 4.776 2 4 2 2.324 2 1 3.326 1 4.92c0 1.211.554 2.066 1.868 3.37.337.334.721.695 1.146 1.093C5.122 10.423 6.5 11.717 8 13.447c1.5-1.73 2.878-3.024 3.986-4.064.425-.398.81-.76 1.146-1.093C14.446 6.986 15 6.131 15 4.92 15 3.326 13.676 2 12 2c-.777 0-1.418.345-1.954.852-.545.515-.93 1.152-1.152 1.595L8 6.236zm.392 8.292a.513.513 0 0 1-.784 0c-1.601-1.902-3.05-3.262-4.243-4.381C1.3 8.208 0 6.989 0 4.92 0 2.755 1.79 1 4 1c1.6 0 2.719 1.05 3.404 2.008.26.365.458.716.596.992a7.55 7.55 0 0 1 .596-.992C9.281 2.049 10.4 1 12 1c2.21 0 4 1.755 4 3.92 0 2.069-1.3 3.288-3.365 5.227-1.193 1.12-2.642 2.48-4.243 4.38z"/>
                          </svg>
                        </button>
                    </form>
                    </div>
                    <img src="Photos/cocktail.png" class="card-img-top" alt="..." width="30px" height="100px">
                    <div class="card-body">
                      <h5 class="card-title">Card title</h5>
                      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                      <a href="#" class="btn btn-primary">Details</a>
                    </div>
                  </div>
                </div> 
                
                <div class="col-sm-3">
                  <div class="card" style="width: 12rem;">
                    <div class="text-left">
                      <form class="d-flex" >
                        <h5 class="mt-1 pb-1 ps-2">Body Mary</h5>
                        <button class="btn mb-2 btn-yellow ms-2" type="button">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-suit-heart" viewBox="0 0 16 16">
                            <path d="m8 6.236-.894-1.789c-.222-.443-.607-1.08-1.152-1.595C5.418 2.345 4.776 2 4 2 2.324 2 1 3.326 1 4.92c0 1.211.554 2.066 1.868 3.37.337.334.721.695 1.146 1.093C5.122 10.423 6.5 11.717 8 13.447c1.5-1.73 2.878-3.024 3.986-4.064.425-.398.81-.76 1.146-1.093C14.446 6.986 15 6.131 15 4.92 15 3.326 13.676 2 12 2c-.777 0-1.418.345-1.954.852-.545.515-.93 1.152-1.152 1.595L8 6.236zm.392 8.292a.513.513 0 0 1-.784 0c-1.601-1.902-3.05-3.262-4.243-4.381C1.3 8.208 0 6.989 0 4.92 0 2.755 1.79 1 4 1c1.6 0 2.719 1.05 3.404 2.008.26.365.458.716.596.992a7.55 7.55 0 0 1 .596-.992C9.281 2.049 10.4 1 12 1c2.21 0 4 1.755 4 3.92 0 2.069-1.3 3.288-3.365 5.227-1.193 1.12-2.642 2.48-4.243 4.38z"/>
                          </svg>
                        </button>
                    </form>
                    </div>
                    <img src="Photos/cocktail.png" class="card-img-top" alt="..." width="30px" height="100px">
                    <div class="card-body">
                      <h5 class="card-title">Card title</h5>
                      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                      <a href="#" class="btn btn-primary">Details</a>
                    </div>
                  </div>
                </div> 
              </div>
              
              <div class="row mb-2">
                <div class="col-sm-3">
                  <div class="card" style="width: 12rem;">
                    <div class="text-left">
                      <form class="d-flex" >
                        <h5 class="mt-1 pb-1 ps-2">Body Mary</h5>
                        <button class="btn mb-2 btn-yellow ms-2" type="button">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-suit-heart" viewBox="0 0 16 16">
                            <path d="m8 6.236-.894-1.789c-.222-.443-.607-1.08-1.152-1.595C5.418 2.345 4.776 2 4 2 2.324 2 1 3.326 1 4.92c0 1.211.554 2.066 1.868 3.37.337.334.721.695 1.146 1.093C5.122 10.423 6.5 11.717 8 13.447c1.5-1.73 2.878-3.024 3.986-4.064.425-.398.81-.76 1.146-1.093C14.446 6.986 15 6.131 15 4.92 15 3.326 13.676 2 12 2c-.777 0-1.418.345-1.954.852-.545.515-.93 1.152-1.152 1.595L8 6.236zm.392 8.292a.513.513 0 0 1-.784 0c-1.601-1.902-3.05-3.262-4.243-4.381C1.3 8.208 0 6.989 0 4.92 0 2.755 1.79 1 4 1c1.6 0 2.719 1.05 3.404 2.008.26.365.458.716.596.992a7.55 7.55 0 0 1 .596-.992C9.281 2.049 10.4 1 12 1c2.21 0 4 1.755 4 3.92 0 2.069-1.3 3.288-3.365 5.227-1.193 1.12-2.642 2.48-4.243 4.38z"/>
                          </svg>
                        </button>
                    </form>
                    </div>
                    <img src="Photos/cocktail.png" class="card-img-top" alt="..." width="30px" height="100px">
                    <div class="card-body">
                      <h5 class="card-title">Card title</h5>
                      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                      <a href="#" class="btn btn-primary">Details</a>
                    </div>
                  </div>
                </div> 

                <div class="col-sm-3">
                  <div class="card" style="width: 12rem;">
                    <div class="text-left">
                      <form class="d-flex" >
                        <h5 class="mt-1 pb-1 ps-2">Body Mary</h5>
                        <button class="btn mb-2 btn-yellow ms-2" type="button">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-suit-heart" viewBox="0 0 16 16">
                            <path d="m8 6.236-.894-1.789c-.222-.443-.607-1.08-1.152-1.595C5.418 2.345 4.776 2 4 2 2.324 2 1 3.326 1 4.92c0 1.211.554 2.066 1.868 3.37.337.334.721.695 1.146 1.093C5.122 10.423 6.5 11.717 8 13.447c1.5-1.73 2.878-3.024 3.986-4.064.425-.398.81-.76 1.146-1.093C14.446 6.986 15 6.131 15 4.92 15 3.326 13.676 2 12 2c-.777 0-1.418.345-1.954.852-.545.515-.93 1.152-1.152 1.595L8 6.236zm.392 8.292a.513.513 0 0 1-.784 0c-1.601-1.902-3.05-3.262-4.243-4.381C1.3 8.208 0 6.989 0 4.92 0 2.755 1.79 1 4 1c1.6 0 2.719 1.05 3.404 2.008.26.365.458.716.596.992a7.55 7.55 0 0 1 .596-.992C9.281 2.049 10.4 1 12 1c2.21 0 4 1.755 4 3.92 0 2.069-1.3 3.288-3.365 5.227-1.193 1.12-2.642 2.48-4.243 4.38z"/>
                          </svg>
                        </button>
                    </form>
                    </div>
                    <img src="Photos/cocktail.png" class="card-img-top" alt="..." width="30px" height="100px">
                    <div class="card-body">
                      <h5 class="card-title">Card title</h5>
                      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                      <a href="#" class="btn btn-primary">Details</a>
                    </div>
                  </div>
                </div> 
                <div class="col-sm-3">
                  <div class="card" style="width: 12rem;">
                    <div class="text-left">
                      <form class="d-flex" >
                        <h5 class="mt-1 pb-1 ps-2">Body Mary</h5>
                        <button class="btn mb-2 btn-yellow ms-2" type="button">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-suit-heart" viewBox="0 0 16 16">
                            <path d="m8 6.236-.894-1.789c-.222-.443-.607-1.08-1.152-1.595C5.418 2.345 4.776 2 4 2 2.324 2 1 3.326 1 4.92c0 1.211.554 2.066 1.868 3.37.337.334.721.695 1.146 1.093C5.122 10.423 6.5 11.717 8 13.447c1.5-1.73 2.878-3.024 3.986-4.064.425-.398.81-.76 1.146-1.093C14.446 6.986 15 6.131 15 4.92 15 3.326 13.676 2 12 2c-.777 0-1.418.345-1.954.852-.545.515-.93 1.152-1.152 1.595L8 6.236zm.392 8.292a.513.513 0 0 1-.784 0c-1.601-1.902-3.05-3.262-4.243-4.381C1.3 8.208 0 6.989 0 4.92 0 2.755 1.79 1 4 1c1.6 0 2.719 1.05 3.404 2.008.26.365.458.716.596.992a7.55 7.55 0 0 1 .596-.992C9.281 2.049 10.4 1 12 1c2.21 0 4 1.755 4 3.92 0 2.069-1.3 3.288-3.365 5.227-1.193 1.12-2.642 2.48-4.243 4.38z"/>
                          </svg>
                        </button>
                    </form>
                    </div>
                    <img src="Photos/cocktail.png" class="card-img-top" alt="..." width="30px" height="100px">
                    <div class="card-body">
                      <h5 class="card-title">Card title</h5>
                      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                      <a href="#" class="btn btn-primary">Details</a>
                    </div>
                  </div>
                </div> 
                
                <div class="col-sm-3">
                  <div class="card" style="width: 12rem;">
                    <div class="text-left">
                      <form class="d-flex" >
                        <h5 class="mt-1 pb-1 ps-2">Body Mary</h5>
                        <button class="btn mb-2 btn-yellow ms-2" type="button">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-suit-heart" viewBox="0 0 16 16">
                            <path d="m8 6.236-.894-1.789c-.222-.443-.607-1.08-1.152-1.595C5.418 2.345 4.776 2 4 2 2.324 2 1 3.326 1 4.92c0 1.211.554 2.066 1.868 3.37.337.334.721.695 1.146 1.093C5.122 10.423 6.5 11.717 8 13.447c1.5-1.73 2.878-3.024 3.986-4.064.425-.398.81-.76 1.146-1.093C14.446 6.986 15 6.131 15 4.92 15 3.326 13.676 2 12 2c-.777 0-1.418.345-1.954.852-.545.515-.93 1.152-1.152 1.595L8 6.236zm.392 8.292a.513.513 0 0 1-.784 0c-1.601-1.902-3.05-3.262-4.243-4.381C1.3 8.208 0 6.989 0 4.92 0 2.755 1.79 1 4 1c1.6 0 2.719 1.05 3.404 2.008.26.365.458.716.596.992a7.55 7.55 0 0 1 .596-.992C9.281 2.049 10.4 1 12 1c2.21 0 4 1.755 4 3.92 0 2.069-1.3 3.288-3.365 5.227-1.193 1.12-2.642 2.48-4.243 4.38z"/>
                          </svg>
                        </button>
                    </form>
                    </div>
                    <img src="Photos/cocktail.png" class="card-img-top" alt="..." width="30px" height="100px">
                    <div class="card-body">
                      <h5 class="card-title">Card title</h5>
                      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                      <a href="#" class="btn btn-primary">Details</a>
                    </div>
                  </div>
                </div> 
              </div>
            </div>
          </div>
          <hr class="d-sm-none">
        </div>
      </main>
      <footer class="py-2 bg-dark ">
        <div class="container">
        <p class="m-0 text-center text-white">Footer</p>
        </div>
      </footer>
        
</body>
</html>