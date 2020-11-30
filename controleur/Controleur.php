<?php

//chargement des classes
require_once(__DIR__.'/../config/Validation.php');
require_once(__DIR__.'/../modeles/Utilisateur.php');


//debut

//on initialise un tableau d'erreur
$dataVueErreur = array ();


$action=$_REQUEST['valider'];

switch($action) {

//pas d'action, on réinitialise 1er appel
case NULL:
	Reinit();
	break;


case "Créer un compte":
	Inscription();
	break;

case "Se connecter":
	Connexion();
	break;

//mauvaise action
default:
$dataVueErreur[] =	"Erreur d'appel php";
require (__DIR__.'/../vues/inscription.php');
break;
}

exit(0);


function Reinit()  {
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
		require (__DIR__.'/../vues/seConnecter.php');
	else 
	require (__DIR__.'/../vues/inscription.php');
}

function Connexion() {
	global $dataVueErreur;// nécessaire pour utiliser variables globales

	$nom=$_REQUEST['txtNom']; // txtNom = nom du champ texte dans le formulaire
	$mdp=$_REQUEST['txtMdp'];
	\config\Validation::connexion_form($nom,$mdp, $dataVueErreur);

$dataVue = array (
	'nom' => $nom,
	'mdp' => $mdp,
	);
	if(empty($dataVueErreur))
		require (__DIR__.'/../vues/listes.php');
	else 
	require (__DIR__.'/../vues/seConnecter.php');
}


?>
