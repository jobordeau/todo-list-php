<?php

require_once(__DIR__.'/../entites/Utilisateur.php');


class ControleurUtilisateur { 

    function __construct($action) {
        try{
            switch($action) {
                
                case "afficherlistesprivees":
                    $this->afficherListesPrivees();
                    break;

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
                
                case "connexion":
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



    function afficherListesPrivees() {	
        $modele = new ModeleListe();
        $modeleTache = new ModeleTache();

        $listesPrivees=$modele->trouverListeUtilisateur($_SESSION['utilisateur']->ID);
        foreach($listesPrivees as $liste){
            $liste->taches=$modeleTache->trouverTacheListe($liste);
        }
        $_SESSION['listesPrivees']=$listesPrivees;
        
        require (__DIR__.'/../vues/listes.php');
    }

    function ajouterListePrivee(){
        $modeleListe=new ModeleListe();
        $modeleTache = new ModeleTache();

        $nomListe=$_REQUEST['nomListe'];
        $nomTache=$_REQUEST['nomTache'];
            
        $liste=$modeleListe->creerListePrivee($nomListe,$_SESSION['utilisateur']->ID);
        $tache=$modeleTache->creerTache($nomTache,true, $liste->ID);
            
        $_SESSION['listesPrivees']=$modeleListe->trouverListeUtilisateur($_SESSION['utilisateur']->ID);
        
        require (__DIR__.'/../vues/listes.php');
    }

    function supprimerListePrivee(){
        $indexPrivee=$_REQUEST['indexPrivee'];

        //suppression dans la base de donnée
        $modeleListe=new ModeleListe();
        $modeleTache = new ModeleTache();
            foreach($_SESSION['listesPrivees'][$indexPrivee]->taches as $tache){
                $modeleTache->supprimerTache($tache);
            }
            $modeleListe->supprimerListe($_SESSION['listesPrivees'][$indexPrivee]);
            unset($_SESSION['listesPrivees'][$indexPrivee]);
    
        require (__DIR__.'/../vues/listes.php');
    }

    function deconnexion(){
        $_SESSION = array();
        session_unset();
        session_destroy();	

        require (__DIR__.'/../vues/listes.php');
    }

}
