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

    <style>
        input[type=checkbox]:checked+label {
            text-decoration: line-through;
        }
    </style>

    <!-- Javascript custom pour récupérer la tache à supprimer -->



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
            if (isset($_SESSION['utilisateur']))
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

            <!-- COLONNE PUBLIQUE-->
            <div class="col container-fluid" style="background: #FFF6D6; margin: 10px;">
                <div class="row">
                    <p class="col text-center" style="background-color: #EDE5C7;">Listes publiques</p>
                </div>

                <!-- CHARGEMENT LISTES -->
                <?php
                $l = 0;
                foreach ($_SESSION['listesPubliques'] as $liste) {
                    echo "
                            <form method='post' id='formListe$l'>
                                <input name='indexPublique' type='text' value='$l' hidden>

                                <table class='table table-hover' >
                                    <thead >
                                        <tr>
                                            <th colspan='2'>$liste->nom</th>
                                        </tr>
                                    </thead>
                            </form>
                                    <tbody>";
                    echo "<form method='post' id='formTachesListe$l'>";
                    $t = 0;
                    // CHARGEMENT TACHES       
                    foreach ($liste->taches as $tache) {
                        if ($tache->faite) $state = "checked";
                        else $state = "unchecked";
                        echo "
                                <form method='post'>   
                                    <tr>
                                        <input name='indexListe' type='number' value='$l' hidden>
                                        <input name='indexTache' type='number' value='$t' hidden>
                                        <td>
                                            <input type='checkbox' name='checkbox$t' form='formTachesListe$l' style='margin-top: 11px;' $state>
                                            <label> $tache->nom <label>
                                        </td>

                                        <td width='10'>
                                            <button name='action' type='submit' value='supprimerTache' class='btn btn-outline-danger'>❌</button>
                                        </td>
                                    </tr>
                                </form>
                                ";
                        $t++;
                    }
                    // FIN TACHES

                    echo "      </form>
                                    </tbody>
                                </table>
                                <button name='action' type='submit' value='modifierEtatTaches' form='formTachesListe$l' style='margin: 5px;' class='btn btn-outline-success'>✓ Enregistrer l'état des tâches</button> 
                                
                                <button name='action' type='submit' value='afficherModificationListe' form='formListe$l' style='margin: 5px;' class='btn btn-outline-info' >🖊️ Modifier la liste</button>
                                <button name='action' type='submit' value='supprimerListe' form='formListe$l' style='margin: 5px;' class='btn btn-outline-danger'>❌ Supprimer la liste</button>
                            ";
                    $l++;
                }
                ?>
                <!--FIN LISTES-->

            </div>

            <!-- LISTES PRIVEES -->
            <?php if (isset($_SESSION['utilisateur'])) {
                require("newlistesPrivees.php");
            }
            ?>

        </div>


        <!-- CREATION LISTES -->
        <form method="post" class="form-group row" style="background-color: grey; padding: 10px;">
            <label class="col-2 col-form-label">Nouvelle liste :</label>
            <div class="col-10">
                <input name="nvListe" type="text" class="form-control" placeholder="Nom de la liste">
            </div>


            <button name='action' type='submit' value="ajouterListe" style="margin: 15px 15px 0px 0px" class="col-2 btn btn-primary">Créer liste</button>
            <!-- CREATION PRIVEE -->
            <?php if (isset($_SESSION['utilisateur'])) {
                echo '
                    <button name="action" type="submit" value="ajouterListePrivee" style="margin: 15px 0px 0px 15px;" class="col-2 btn btn-dark">Créer liste privée</button>
                    ';
            }
            ?>
        </form>
    </div>
    <div>
       <?php require('vueErreur.php');?>
    </div> 
</body>

</html>