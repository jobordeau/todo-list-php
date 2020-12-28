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
                <button name="action" value="afficherlistes" type="submit" class="btn btn-primary my-2 my-sm-0">Liste</button>
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
                        <button name="action" type="submit" value="afficherInscription" class="btn btn-outline-secondary my-2 my-sm-0">S\'inscrire</button>
                    </form>
                    ';
                ?>
                <!---->
              
            
          </div>
        </nav>
        
        
        <div class="container-fluid">
            <div class="row">
                
                <!-- COLONNE EDITION -->
                 <div class="col container-fluid" style="background: #a8ceff; margin: 10px;">
                     <div class="row">
                        <p class="col text-center" style="background-color:#99BBE8 ;">Édition de la liste</p>
                     </div>
                     
                     <!-- UNE LISTE -->
                    <form class="row" method="post" >
                       <table class="table table-hover" >
                        <thead >
                            <tr>
                                <th colspan="2">
                                    <div class="form-group">
                                        <?php
                                        echo '
                                        <input type="text" name="nomListe" value=\''.$_SESSION["listeActuelle"]->nom.'\' class="form-control" placeholder="Nom de la liste" >
                                        ';1
                                        ?>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <!-- TACHES -->
                            <?php
                            if($_SESSION["listeActuelle"]->privee) $privee = "Privee";
                            else $privee ="";
                            
                            $t = 0;
                            foreach($_SESSION["listeActuelle"]->taches as $tache){
                                if($tache->faite) $state = "checked"; else $state ="unchecked";
                                echo "
                            <tr>                                
                                <td>
                                  <input name='nvEtat$t' type='checkbox' style='margin-top: 11px;' $state>
                                </td>
                                <td>
                                    <div class='form-group'>
                                        <input name='nvTache$t' value='$tache->nom' type='text' class='form-control' placeholder='Nom de la tâche'>
                                      </div>
                                </td>
                            </tr>
                            ";
                            $t++;
                            }
                            
                            // <!-- FIN TACHES --> 
                        echo "
                        </tbody>
                        </table>
                        
                        <button name='action' type='submit' value='ajouterTache$privee' style='margin: 5px' class='btn btn-outline-info' >+ Ajouter une tâche</button>
                        <button name='action' type='submit' value='modifierListe$privee' style='margin: 5px;' class='btn btn-outline-success' >✓  Modifier liste</button>
                        ";
                        ?>
                </form>
                <!-- FIN LISTE -->         
                     
            </div>
                
        </div>
                
    </div>
                    
</div>
        
    </body>
</html>