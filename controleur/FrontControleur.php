<?php
	require_once(__DIR__.'/../entites/Utilisateur.php');
	require_once(__DIR__.'/../modeles/ModeleUtilisateur.php');
	require_once(__DIR__.'/ControleurVisiteur.php');
	require_once(__DIR__.'/ControleurUtilisateur.php');

	class FrontControleur {

		function __construct() {
			session_start();
			//session_destroy(); // Pour reset si problème de session qui se récupère
			
			$mdlUtilisateur= new ModeleUtilisateur();

			if(isset($_REQUEST['action']) && !empty($_REQUEST['action'])){
				$action = $_REQUEST['action'];
			}
			else $action = "afficherlistes";

			$actionsUtilisateur = ['ajouterListePrivee', 'supprimerListePrivee','afficherModificationListePrivee', 'modifierListePrivee', 'ajouterTachePrivee','modifierEtatTachesPrivees' ,'supprimerTachePrivee','deconnexion'];
			
			if(in_array($action, $actionsUtilisateur)) {
				$utilisateur=$mdlUtilisateur->estUtilisateur();
				if($utilisateur) {
					new ControleurUtilisateur($action);
				} else {
					new ControleurVisiteur('connexion');
				}
			} else {
				new ControleurVisiteur($action);
			}
		}
		
	}

	new FrontControleur();
