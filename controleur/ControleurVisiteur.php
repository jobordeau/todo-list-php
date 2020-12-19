<?php

//chargement des classes
require_once(__DIR__.'/../config/Validation.php');
require_once(__DIR__.'/../données/Stub.php');
require_once(__DIR__.'/../modeles/ModeleListe.php');
require_once(__DIR__.'/../modeles/ModeleTache.php');
require_once(__DIR__.'/../modeles/ModeleUtilisateur.php');

//Chargement des classes // A potentiellement enelver et utiliser un autoloader ?
require_once(__DIR__.'/../config/Validation.php');
require_once(__DIR__.'/../entites/Utilisateur.php');



class ControleurVisiteur { 
    
    function __construct($action) {
        try{
            switch($action) {
                case "afficherlistes":
                    $this->afficherListes();
                    break;

                case "ajouterliste":
                    $this->ajouterListe();
                    break;
                    
                case "supprimerliste":
                    $this->supprimerListe();
                    break;

                //case "renommerliste":
                //    $this->renommerListe();
                //    break;

                /* Tâches :
                case "ajoutertache":
                    $this->ajouterTache();
                    break;

                case "supprimertache":
                    $this->supprimerTache();
                    break;

                case "renommertache":
                    $this->renommerTache();
                    break;

                case "modifiertache":
                    $this->modifierTache();
                    break;
                */

                case "inscription":
                    $this->inscription();
                    break;

                case "connexion":
                    $this->connexion();
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


    function afficherListes() {	
        $modele = new ModeleListe();
        $modeleTache = new ModeleTache();
        $listesPubliques=$modele->trouverListePublique();

        foreach($listesPubliques as $liste){
            $liste->taches=$modeleTache->trouverTacheListe($liste);
        }
        $_SESSION['listesPubliques']=$listesPubliques;        

        require (__DIR__.'/../vues/listes.php');
    }

    
    function ajouterListe(){
        $modele=new ModeleListe();
        $modeleTache = new ModeleTache();
        $nomListe=$_REQUEST['nomListe'];
        $nomTache=$_REQUEST['nomTache'];

        $liste=$modele->creerListePublique($nomListe);

        $_SESSION['listesPubliques']=$modele->trouverListePublique();
    
        require (__DIR__.'/../vues/listes.php');
    }


    function supprimerListe(){
        $indexPublique=$_REQUEST['indexPublique'];

        $modele=new ModeleListe();
        $modeleTache = new ModeleTache();

        foreach($_SESSION['listesPubliques'][$indexPublique]->taches as $tache){
            $modeleTache->supprimerTache($tache);
        }
        $modele->supprimerListe($_SESSION['listesPubliques'][$indexPublique]);

        unset($_SESSION['listesPubliques'][$indexPublique]); // PEUT ETRE QUI FAUT RECREER LE TABLEAU DES LISTES PLUTOT

        require (__DIR__.'/../vues/listes.php');
    }




    function inscription() {
        global $dataVueErreur;

        $nom=$_REQUEST['txtNom'];
        $mdp=$_REQUEST['txtMdp'];
        $conf=$_REQUEST['txtConf'];

        $mdlUtil=new ModeleUtilisateur();
        \config\Validation::inscription_form($nom,$mdp, $conf, $dataVueErreur);

        try{
            $utilisateur=$mdlUtil->creerUtilisateur($nom,$mdp);
        } catch(PDOException $e){
            $dataVueErreur[] =	"Cet utilisateur existe déjà";
        }
        
        if(empty($dataVueErreur)){
            $_SESSION['utilisateur']=$utilisateur;
            require (__DIR__.'/../vues/listes.php');
        }	
        else{
            require (__DIR__.'/../vues/inscription.php');
        }
    }


    function connexion() {
        global $dataVueErreur;

        $nom=$_REQUEST['txtNom'];
        $mdp=$_REQUEST['txtMdp'];

        $modele=new ModeleUtilisateur();

        \config\Validation::connexion_form($nom, $mdp, $utilisateur, $dataVueErreur);

        $utilisateur=$modele->authentification($nom,$mdp);

        if(!isset($utilisateur)) {
            $dataVueErreur[] =	"Mot de passe ou identifiant incorrect";
        }

        if(empty($dataVueErreur)){
            $_SESSION['utilisateur']=$utilisateur;
            require (__DIR__.'/../vues/listes.php');
        }
        else{
            require (__DIR__.'/../vues/seConnecter.php');
        } 
    }

}

