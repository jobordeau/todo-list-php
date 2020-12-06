<?php

//chargement des classes
require_once(__DIR__.'/../config/Validation.php');
require_once(__DIR__.'/../entites/Utilisateur.php');

//debut
session_start();
//on initialise un tableau d'erreur
$dataVueErreur = array ();

try{
	$action=$_REQUEST['valider'];

	switch($action) {

	//pas d'action, on réinitialise 1er appel
	case NULL:
		initConnexion();
		break;

	case "Se connecter":
		Connexion();
		break;

	//mauvaise action
	default:
	require (__DIR__.'/../vues/seConnecter.php');
	break;
	}
} catch (PDOException $e)
{
	//erreur BD
	$dVueEreur[] =	"Erreur inattendue!!! ";
	require ($rep.$vues['erreur']);

}
catch (Exception $e2)
	{
	$dVueEreur[] =	"Erreur inattendue!!! ";
	require ($rep.$vues['erreur']);
	}

exit(0);


function initConnexion()  {
$dataVue = array (
	'nom' => "",
	'mdp' => "",
	);
	require (__DIR__.'/../vues/seConnecter.php');
}


function Connexion() {
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


?>
