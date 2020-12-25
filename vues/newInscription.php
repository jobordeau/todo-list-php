<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        
         <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

       <!-- CSS custom -->

    </head>
    
    <body style="background-color: darkgray;">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
          <a class="navbar-brand" href="#">To Do List</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">

           
          <form method="post" class="form-inline my-2 my-lg-0" style="margin-right:10px;">
                <button name="action" value="afficherlistes" type="submit" class="btn btn-outline-primary my-2 my-sm-0">Liste</button>
            </form>

              <!-- AFFICHAGE CONNEXION/DECONNEXION -->
              <?php 
                if(isset($_SESSION['utilisateur'])) 
                    echo '
                    <form method="post" class="form-inline my-2 my-lg-0" style="margin-right:10px;">
                        <button name="action" type="submit" value="deconnexion" class="btn btn-outline-danger my-2 my-sm-0">Déconnexion</button>
                    </form>
                    ';
                else
                    echo '
                    <form method="post" class="form-inline my-2 my-lg-0" style="margin-right:10px;">
                        <button name="action" type="submit" value="afficherConnexion" class="btn btn-outline-info my-2 my-sm-0">Se connecter</button>
                    </form>
                    <form method="post" class="form-inline my-2 my-lg-0" style="margin-right:10px;">
                        <button name="action" type="submit" value="afficherInscription" class="btn btn-secondary my-2 my-sm-0">S\'inscrire</button>
                    </form>
                    ';
                ?>
                <!---->
              
          </div>
        </nav>
        
            
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-5">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 mb-4">Inscrivez-vous pour gérez vos listes personnelles :</h1>
                            </div>
                            <!-- CONNEXION-->
                            <form method="post">
                                <div class="form-group">
                                    <input name="login" type="text" class="form-control form-control-user" placeholder="Nom d'utilisateur" required>
                                </div>
                                <div class="form-group">
                                    <input name="mdp" type="password" class="form-control form-control-user" placeholder="Mot de passe" required>
                                </div>
                                <div class="form-group">
                                    <input name="verif" type="password" class="form-control form-control-user" placeholder="Vérification du mot de passe" required>
                                </div>
                                
                                <button name="action" type="submit" value="inscription" class="btn btn-primary btn-user btn-block">Inscription</button>
                            </form>
                            <!---->
                            <hr>
                            <form method="post" class="text-center">
                                <button name="action" type="submit" value="afficherConnexion" class="btn btn-link">Déjà un compte ? Connectez-vous.</button>
                            </form>
                            
                        </div>
                    </div>

                </div>

                <div>
                    <?php require('vueErreur.php');?>
                </div>

            </div>

        </div>

</div>
        
    </body>
</html>