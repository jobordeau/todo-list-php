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
                    afficherListes();
                    break;

                case "ajouterliste":
                    ajouterListe();
                    break;
                    
                case "supprimerliste":
                    supprimerListe();
                    break;

                case "renommerliste":
                    supprimerListe();
                    break;

                case "inscription":
                    inscription();
                    break;

                case "Se connecter":
                    connexion();
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
        $listesPuliques=$modele->trouverListePublique();
        foreach($listesPuliques as $liste){
            $liste->taches=$modeleTache->trouverTacheListe($liste);
        }
        $_SESSION['listesPubliques']=$listesPuliques;

        if(isset($_SESSION['utilisateur'])){
            $listesPrivees=$modele->trouverListeUtilisateur($_SESSION['utilisateur']->ID);
            foreach($listesPrivees as $liste){
                $liste->taches=$modeleTache->trouverTacheListe($liste);
            }
            $_SESSION['listesPrivees']=$listesPrivees;
        }
        

        require (__DIR__.'/../vues/listes.php');
    }

    function ajouterListe(){
        $modele=new ModeleListe();
        $modeleTache = new ModeleTache();
        $nomListe=$_REQUEST['nomListe'];
        $nomTache=$_REQUEST['nomTache'];
        $etatListe=$_REQUEST['etatListe'];  
        if(isset($etatListe)){
            $privee = true;
            
            $liste=$modele->creerListePrivee($nomListe,$_SESSION['utilisateur']->ID);
            $tache=$modeleTache->creerTache($nomTache,$privee, $liste->ID);
            
            $_SESSION['listesPrivees']=$modele->trouverListeUtilisateur($_SESSION['utilisateur']->ID);
            
        }else{
            $privee = false;

            $liste=$modele->creerListePublique($nomListe);
            $tache=$modeleTache->creerTache($nomTache,$privee, $liste->ID);

            $_SESSION['listesPubliques']=$modele->trouverListePublique();
        }

        
        require (__DIR__.'/../vues/listes.php');
    }

    function deconnexion(){
        $_SESSION['utilisateur']=NULL;
        require (__DIR__.'/../vues/listes.php');
    }

    function supprimerListe(){
        $indexPrivee=$_REQUEST['indexPrivee'];
        $indexPublique=$_REQUEST['indexPublique'];

        //suppression dans la base de donnée
        $modele=new ModeleListe();
        $modeleTache = new ModeleTache();
        if(isset($indexPrivee)){
            foreach($_SESSION['listesPrivees'][$indexPrivee]->taches as $tache){
                $modeleTache->supprimerTache($tache);
            }
            $modele->supprimerListe($_SESSION['listesPrivees'][$indexPrivee]);
            unset($_SESSION['listesPrivees'][$indexPrivee]);
        }else{
            foreach($_SESSION['listesPubliques'][$indexPublique]->taches as $tache){
                $modeleTache->supprimerTache($tache);
            }
            $modele->supprimerListe($_SESSION['listesPubliques'][$indexPublique]);
            unset($_SESSION['listesPubliques'][$indexPublique]);
        }
        require (__DIR__.'/../vues/listes.php');
    }


    function inscription() {
        global $dataVueErreur;// nécessaire pour utiliser variables globales

        $nom=$_REQUEST['txtNom']; // txtNom = nom du champ texte dans le formulaire
        $mdp=$_REQUEST['txtMdp'];
        $conf=$_REQUEST['txtConf'];

        $modele=new ModeleUtilisateur();
        $utilisateur=$modele->creerUtilisateur($nom,$mdp);
        \config\Validation::inscription_form($nom,$mdp, $conf, $dataVueErreur);
        
        if(empty($dataVueErreur)){
            $_SESSION['utilisateur']=$utilisateur;
            header('Location: /todo-liste-php/controleur/ConListes.php');
        }	
        else{
            require (__DIR__.'/../vues/inscription.php');
        } 
        
    }


    function connexion() {
        global $dataVueErreur;// nécessaire pour utiliser variables globales

        $nom=$_REQUEST['txtNom'];
        $mdp=$_REQUEST['txtMdp'];

        $modele=new ModeleUtilisateur();
        $utilisateur=$modele->authentification($nom,$mdp);
        \config\Validation::connexion_form($nom,$mdp, $utilisateur, $dataVueErreur);
        
        if(empty($dataVueErreur)){
            $_SESSION['utilisateur']=$utilisateur;
            header('Location: /todo-liste-php/controleur/ConListes.php');
        }
        else{
            require (__DIR__.'/../vues/seConnecter.php');
        } 
        
    }

}
