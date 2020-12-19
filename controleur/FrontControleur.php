<?php
	require_once(__DIR__.'/../entites/Utilisateur.php');
	require_once(__DIR__.'/../modeles/ModeleUtilisateur.php');
	require_once(__DIR__.'ControleurVisiteur.php');
	require_once(__DIR__.'ControleurUtilisateur.php');

	class FrontControleur {
		function __construct() {
			session_start();
			
			$mdlUtilisateur= new ModeleUtilisateur();

			if(isset($_REQUEST['action']) && !empty($_REQUEST['action'])){
				$action = $_REQUEST['action'];
			}
	
			$actionsUtilisateur = ['afficherlistesprivees', 'ajouterlisteprivee', 'supprimerlisteprivee', 'renommerlisteprivee', 
									'ajouterTacheprivee', 'supprimerTacheprivee', 'renommerTacheprivee','modifierTacheprivee', 
									'deconnexion'];

			if(in_array($action, $actionsUtilisateur)) {
				$utilisateur=$mdlUtilisateur->estUtilisateur();

				if(!$utilisateur) {
					new ControleurVisiteur('connexion');
				} else {
					new ControleurUtilisateur($action);
				}
			} else {
				new ControleurVisiteur($action);
			}	
		}
	}