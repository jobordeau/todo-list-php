<?php

//chargement des classes // A potentiellement enelver et utiliser un autoloader ?
require_once(__DIR__.'/../config/Validation.php');
require_once(__DIR__.'/../données/Stub.php');
require_once(__DIR__.'/../modeles/ModeleListe.php');
require_once(__DIR__.'/../modeles/ModeleTache.php');
require_once(__DIR__.'/../modeles/ModeleUtilisateur.php');
require_once(__DIR__.'/../entites/Utilisateur.php');


class ControleurVisiteur { 
    
    function __construct($action) {
        try{
            switch(strtolower($action)) {
                case NULL:
                case "afficherlistes":
                    $this->afficherListes();
                    break;

                case "afficherinscription":
                    $this->afficherInscription();
                    break;

                case "afficherconnexion":
                    $this->afficherConnexion();
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


    public static function afficherListes() {	
        $modele = new ModeleListe();
        $modeleTache = new ModeleTache();
        $listesPubliques=$modele->trouverListePublique();

        foreach($listesPubliques as $liste){
            $liste->taches=$modeleTache->trouverTacheListe($liste);
        }
        $_SESSION['listesPubliques']=$listesPubliques;        

        $mdlUtilisateur= new ModeleUtilisateur();

        if($mdlUtilisateur->estUtilisateur()){
            // Listes privées :
            $listesPrivees=$modele->trouverListeUtilisateur($_SESSION['utilisateur']->ID);
            foreach($listesPrivees as $liste){
                $liste->taches=$modeleTache->trouverTacheListe($liste);
            }
            $_SESSION['listesPrivees']=$listesPrivees;
        }

        unset($_REQUEST["action"]);
        require (__DIR__.'/../vues/newlistes.php');
    }

    
    function ajouterListe(){
        $modele=new ModeleListe();
        $nvListe=$_POST['nvListe'];

        $liste=$modele->creerListePublique($nvListe);

        $this->afficherListes();
    }

    
    function supprimerListe(){
        $modele=new ModeleListe();
        $modeleTache = new ModeleTache();
        $indexPublique=$_POST['indexPublique'];

        foreach($_SESSION['listesPubliques'][$indexPublique]->taches as $tache){
            $modeleTache->supprimerTache($tache);
        }
        $modele->supprimerListe($_SESSION['listesPubliques'][$indexPublique]);

        $this->afficherListes();
    }


    function afficherInscription(){
        require (__DIR__.'/../vues/newInscription.php');
    }

    function afficherConnexion(){
        require (__DIR__.'/../vues/connexion.php');
    }

    function inscription() {
        global $dataVueErreur;

        $nom=$_REQUEST['login'];
        $mdp=$_REQUEST['mdp'];
        $verif=$_REQUEST['verif'];

        $mdlUtil=new ModeleUtilisateur();
        Validation::inscription_form($nom,$mdp, $verif, $dataVueErreur);

        try{
            $utilisateur=$mdlUtil->creerUtilisateur($nom,$mdp);
        } catch(PDOException $e){
            $dataVueErreur[] =	"Cet utilisateur existe déjà";
        }
        
        if(empty($dataVueErreur)){
            $_SESSION['utilisateur']=$utilisateur;
            require (__DIR__.'/../vues/newlistes.php');
        }	
        else{
            require (__DIR__.'/../vues/newInscription.php');
        }
    }


    function connexion() {
        global $dataVueErreur;

        $nom=$_REQUEST['login'];
        $mdp=$_REQUEST['mdp'];
        
        $modele=new ModeleUtilisateur();

        Validation::connexion_form($nom, $mdp, $dataVueErreur);

        $utilisateur=$modele->authentification($nom,$mdp);
    
        if(!isset($utilisateur)) {
            $dataVueErreur[] =	"Mot de passe ou identifiant incorrect";
        }
        
        if(empty($dataVueErreur)){
            $_SESSION['utilisateur'] = $utilisateur;
            $this->afficherListes();
        }
        else{
            require (__DIR__.'/../vues/connexion.php');
        } 
    }

}

