<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Modification de profil</title>
</head>
<body>
    <section class="h-100 gradient-form" style="background-color: #eee;">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-xl-10">
              <div class="card rounded-3 text-black">
                <form action="dummytests/fonctions/testUser.php" method="post">
                  <div class="row g-0">
                    <div class="text-center">
                      <h4 class="mt-1 mb-5 pb-1">Nous sommes la team coktails de Metz</h4>
                      <p>Vous pouvez modifiez les informations que vous souhaitez</p>
                    </div>
                  </div>
                  <div class="row g-0">
                    <div class="col-lg-6">
                      <div class="card-body p-md-5 mx-md-4">
                        <div class="form-outline mb-4">
                          <input type="password" id="ancienMdp" name="ancienMdp" class="form-control" placeholder="Ancien mot de passe" />
                          <label class="form-label" for="ancienMdp">Ancien mot de passe</label>
                        </div>
        
                        <div class="form-outline mb-4">
                          <input type="password" id="mdp" name="mdp" class="form-control" placeholder="Nouveau mot de passe" />
                          <label class="form-label" for="mdp">Nouveau mot de passe</label>
                        </div>

                        <div class="form-outline mb-4">
                          <input type="text" id="nom" name="nom" class="form-control" placeholder="Modifiez votre nom" />
                          <label class="form-label" for="nom">Nom</label>
                        </div>

                        <div class="form-outline mb-4">
                          <input type="text" id="prenom" name="prenom" class="form-control" placeholder="Modifiez votre nom" />
                          <label class="form-label" for="prenom">Prénom</label>
                        </div>

                        <div class="form-outline mb-4">
                          <input type="email" id="email" name="email" class="form-control" placeholder="Email" />
                          <label class="form-label" for="email">Email</label>
                        </div>

                        <div class="form-outline mb-4">
                          <input type="tel" id="telephone" name="telephone" class="form-control" placeholder="Telephone" />
                          <label class="form-label" for="telephone">Telephone</label>
                        </div>
                      </div>
                    </div>
                    
                    <div class="col-lg-6">
                      <div class="card-body p-md-5 mx-md-4">
                        <div class="form-outline mb-4">
                          <select class="form-select" name="sexe" id="">
                            <option value="femme">Femme</option>
                            <option value="femme">Homme</option>
                          </select>
                          <label class="form-label" for="sexe" id="sexe">Sexe</label>
                        </div>
        
                        <div class="form-outline mb-4">
                          <input type="date" id="naissance" name="naissance" class="form-control" placeholder="" />
                          <label class="form-label" for="naissance">Date de naissance</label>
                        </div>

                        <div class="form-outline mb-4">
                          <input type="text" id="nomAdresse" name="nomAdresse" class="form-control" placeholder="11 Rue Dupont" />
                          <label class="form-label" for="nomAdresse">Adresse</label>
                        </div>

                        <div class="form-outline mb-4">
                          <input type="number" id="codePostal" name="codePostal" class="form-control" placeholder="57000" />
                          <label class="form-label" for="codePostal">Code Postal</label>
                        </div>

                        <div class="form-outline mb-4">
                          <input type="text" id="ville" name="ville" class="form-control" placeholder="" />
                          <label class="form-label" for="ville">Ville</label>
                        </div>     
                      </div>
                    </div>
                  </div>
                  <div class="row-0">
                    <div class="text-center pt-1 mb-5 pb-1">
                      <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit">Modifier mon profil</button>
                    </div>
                  </div> 
                </form>      
              </div>
            </div>
          </div>
        </div>
      </section>
    
</body>
</html>