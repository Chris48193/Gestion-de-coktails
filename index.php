<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="icon" type="image/png" sizes="16x16" href="PhotosSite/logo_trans.png">
    <link href="css/style.css" rel="stylesheet">
    <title>Coin des coktails</title>
</head>
<body>
<?php 
    error_reporting(1);
    include("fonctions.php");

    if(isset($_GET['role']) && $_GET['role'] == "deconnect") {
      include("./deconnection.php");
    }
  ?>
    <!-- Barre de navigation -->
  <nav class="navbar navbar-expand-sm navbar-dark" style="background-color: #e2edf5;">
    <div class="container-fluid mb-10">
      <a class="navbar-brand" href="index.php"> <img src="PhotosSite/logo_trans.png" alt="Logo Site de coktails" width="100" height="70"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="mynavbar">
        <form class="d-flex">
          <button class="btn btn-yellow ms-2" type="button" onclick="window.location.href='index.php'">Navigation</button>
        </form>
        <form class="d-flex" >
          <button class="btn btn-yellow ms-2" type="button" onclick="window.location.href='index.php?p=recettesLove'">Recettes 
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-heart-fill" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
            </svg>
          </button>
         </form>


        <form class="d-flex">
          <input class="form-control ms-2" type="text" placeholder="Chercher un aliment" id="search-field">
          <button class="btn border ms-2" type="button" id="search-coktail">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-search" viewBox="0 0 16 16">
              <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
            </svg>
          </button>
        </form>

        <div class="d-flex zone-connexion">
              <?php
                if(!isset($_SESSION['isLogin'])) { ?>
                <form class="d-flex" action="./testUser.php?function=login" method="POST">
                  <label for="login" class="form-label ms-2 mt-2">Login</label>
                  <input class="form-control ms-2 info" id="login" type="text" name="login" placeholder="">
                  <label for="password" class="form-label ms-2 mt-2">Mot de passe</label>
                  <input class="form-control ms-2 info" id="password" type="password" name="mdp" placeholder="">
                  <button class="btn btn-yellow bg-primary ms-2" type="submit">Connexion</button>
                </form>
                <button class="btn btn-yellow bg-primary ms-2" type="button" onclick="window.location.href='index.php?p=signup'">S'inscrire</button>
              <?php } else {
              ?>
                <form class="d-flex" action="index.php?p=modifierProfil&loggedIn=true" method="POST">
                <span class="space-form  mt-2">Bonjour <?php echo $_SESSION['login']; ?></span>
                <button class="btn btn-yellow bg-primary ms-2 " type="submit">&nbsp;&nbsp;Mon Profil&nbsp;&nbsp;</button>
              </form>
              <form class="d-flex">
                <a href="./index.php?role=deconnect" class="btn btn-yellow bg-primary ms-2">Deconnexion</a>
              </form>
           <?php }
          ?>

        </div>
      </div>
    </div>
  </nav>
  <main id="result-search">
      <!-- <div id="errorJS" class= "container m-3 p-3 bg-warning"></div> -->
      <?php
        //Affichage des erreurs
        if(isset($_GET['error'])) {
          echo '<div id="error" class= "container m-3 p-3 bg-warning">'.$_GET['error'].'</div>';
        }
      ?>
    
    <?php
      // Inclusions des differentes parties de la page
      if (isset($_GET['p'])) { 
        $fichier=$_GET['p'].'.php';
          if (file_exists($fichier))   include($fichier) ;
          else  echo "Erreur 404: la page demandée n'existe pas";
     }else{
        if (file_exists('contenuIndex.php')) include('contenuIndex.php');
        else  echo "Erreur 404: la page demandée n'existe pas";
     }
    ?>
  </main>   
  <footer class="py-2 bg-dark ">
    <div class="container">
    <p class="m-0 text-center text-white">Made with love <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-heart-fill" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
            </svg> by la Team Cocktails Metz</p>
    </div>
  </footer>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script>
      $(document).ready(function(){
          $(document).delegate('#search-coktail', 'click', function(){
              var entry = $('#search-field').val();
              
              if(entry != "") {
                  $.ajax({
                    type: 'GET',
                    url: './recherche_cocktails.php',
                    data: 'cocktail=' + encodeURIComponent(entry),
                    success: function(data){
                        if(data != ""){
                              document.getElementById('result-search').innerHTML = '';
                              document.getElementById('result-search').innerHTML = data;
                        } else {
                              document.getElementById('result-search').innerHTML = "Aucun utilisateur";
                        }
                    }
                  });
              }
          });

          // $('.like').click(function(){
          $(document).delegate('.like', 'click', function() {
              
              let id = this.id;
              let elem = $(this);

              $.ajax({
                type: 'GET',
                url: './recettePrefere.php',
                data: 'id=' + encodeURIComponent(id),
                success: function(data){
                  // document.getElementById('errorJS').innerHTML = data;
                  elem.attr("class", "dislike bi bi-heart-fill");
                  elem.attr("fill", "red");
                  elem.html('<path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>');
                  // location.reload(true);
                }
              });

          });

          // $('.dislike').click(function(){
          $(document).delegate('.dislike', 'click', function() {
            const urlParams = new URLSearchParams(window.location.search);
              
              let id = this.id;
              let elem = $(this);

              $.ajax({
                type: 'GET',
                url: './recetteDislike.php',
                data: 'id=' + encodeURIComponent(id),
                success: function(data){
                  // document.getElementById('errorJS').innerHTML = data;
                  elem.attr("class", "like bi bi-heart");
                  elem.attr("fill", "black");
                  elem.html('<path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>');
                  if(urlParams.get('p') == "recettesLove") {
                    location.reload(true);
                  }
                }
              });

          });
      });
  </script>
</body>
</html>