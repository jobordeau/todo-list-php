<?php
	class FrontControleur {
		function __construct() {
			session_start();
			if(isset($_REQUEST['action']) && !empty($_REQUEST['action'])){
				$action = $_REQUEST['action'];
			}
			$modele= new Utilisateur();
			$utilisateur=$modele->estUtilisateur();
			
			$listeAction_Utilisateur = array('afficherlistesprivees', 'ajouterlisteprivee', 'supprimerlisteprivee', 'renommerlisteprivee', 
			'ajouterTacheprivee', 'supprimerTacheprivee', 'renommerTacheprivee','modifierTacheprivee', 
			'deconnexion');
			
			if(in_array($action, $listeAction_Utilisateur)) {
				if(!$utilisateur) {
					new ControleurVisiteur('afficherlistes')
				} else {
					ControleurUtilisateur($action);
				}
			} else {
				ControleurVisiteur($action);
			}
		}
	}