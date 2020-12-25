<?php

require_once(__DIR__.'/../entites/Utilisateur.php');


class ControleurUtilisateur { 

    function __construct($action) {
        try{
            switch(strtolower($action)) {

                case "ajouterlisteprivee":
                    $this->ajouterListePrivee();
                    break;    
                
                case "supprimerlisteprivee":
                    $this->supprimerListePrivee();
                    break;

                //case "renommerlistePrivee":
                //    $this->renommerListePrivee();
                //    break;
                    
                /* Tâches :
                case "ajoutertache":
                    renommerListePrivee();
                    break;

                case "supprimertache":
                    renommerListePrivee();
                    break;

                case "renommertache":
                    renommerListePrivee();
                    break;
                */
                
                case "deconnexion":
                    $this->deconnexion();
                    break;

                default: //mauvaise action
                    throw new Exception(); // Erreure inattendue
                    break;
            }
        } catch (PDOException $e) {
            //erreur BDD
            $dVueEreur[] =	"Erreur inattendue!!! ";

        } catch (Exception $e2) {
            $dVueEreur[] =	"Erreur inattendue!!! ";
        }

    }
    


    ///////////////

                
    function ajouterListePrivee(){
        $modele=new ModeleListe();
        $nvListe=$_POST['nvListe'];
        // VERIF ICI

        $liste=$modele->creerListePrivee($nvListe, $_SESSION['utilisateur']->ID);

        ControleurVisiteur::afficherListes();
    }

    function supprimerListePrivee(){
        $modele=new ModeleListe();
        $modeleTache = new ModeleTache();
        $indexPrivee=$_POST['indexPrivee'];

        foreach($_SESSION['listesPrivees'][$indexPrivee]->taches as $tache){
            $modeleTache->supprimerTache($tache);
        }
        $modele->supprimerListe($_SESSION['listesPrivees'][$indexPrivee]);

        ControleurVisiteur::afficherListes();
    }

    function deconnexion(){
        unset($_SESSION['utilisateur']);

        require (__DIR__.'/../vues/newlistes.php');
    }

}
