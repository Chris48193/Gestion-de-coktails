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
</head>
<body>
    <!-- Barre de navigation -->
  <nav class="navbar navbar-expand-sm navbar-dark" style="background-color: #e2edf5;">
    <div class="container-fluid mb-10">
      <a class="navbar-brand" href="index.php"> <img src="PhotosSite/logo_trans.png" alt="Logo Site de coktails" width="100px" height="70px"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="mynavbar">
        <form class="d-flex">
          <button class="btn btn-yellow ms-2" type="button">Navigation</button>
        </form>
        <form class="d-flex" >
          <button class="btn btn-yellow ms-2" type="button" onclick="window.location.href='index.php?p=recettesLove'">Recettes 
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
        <form class="d-flex" action="index.php?p=login">
          <button class="btn btn-yellow ms-2" type="button" onclick="window.location.href='index.php?p=login';">Zone de Connexion</button>
        </form>
      </div>
    </div>
  </nav>
  <main>
    <?php  
      // Inclusions des differentes parties de la page
      if (isset($_GET['p'])) { 
        $fichier=$_GET['p'].'.php';
          if (file_exists($fichier))   include($fichier) ;
          else  echo "Erreur 404: la page demandée n'existe pas";
     }else{
        if (file_exists('ContenuIndex.php')) include('ContenuIndex.php');
        else  echo "Erreur 404: la page demandée n'existe pas";
     }
    ?>
  </main>   
  <footer class="py-2 bg-dark ">
    <div class="container">
    <p class="m-0 text-center text-white">Footer</p>
    </div>
  </footer>    
</body>
</html>