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
		initInscription();
		break;


	case "Créer un compte":
		Inscription();
		break;

	case "Se connecter":
		Connexion();
		break;

	//mauvaise action
	default:
	require (__DIR__.'/../vues/inscription.php');
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


function initInscription()  {
$dataVue = array (
	'nom' => "",
	'mdp' => "",
	'conf' => "",
    );
    
	require (__DIR__.'/../vues/inscription.php');
}

function Inscription() {
	global $dataVueErreur;// nécessaire pour utiliser variables globales

	$nom=$_REQUEST['txtNom']; // txtNom = nom du champ texte dans le formulaire
	$mdp=$_REQUEST['txtMdp'];
	$conf=$_REQUEST['txtConf'];
	\config\Validation::inscription_form($nom,$mdp, $conf, $dataVueErreur);

$dataVue = array (
	'nom' => $nom,
	'mdp' => $mdp,
	'conf' => $conf,
	);
	if(empty($dataVueErreur))
	header('Location: /php/projet/controleur/ConseConnecter.php');
	else 
	require (__DIR__.'/../vues/inscription.php');
}


?>
