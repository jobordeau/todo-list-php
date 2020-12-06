<?php

//chargement des classes
require_once(__DIR__.'/../config/Validation.php');
require_once(__DIR__.'/../données/Stub.php');
require_once(__DIR__.'/../modeles/ModeleListe.php');
require_once(__DIR__.'/../modeles/ModeleTache.php');
require_once(__DIR__.'/../modeles/ModeleUtilisateur.php');
//debut
session_start();
//on initialise un tableau d'erreur
$dataVueErreur = array ();
try{
	$action=$_REQUEST['action'];

	switch($action) {

	//pas d'action, on réinitialise 1er appel
	case NULL:
		initListes();
		break;
		
	case "Ajouter la liste":
		CreerListe();
		break;
		
	case "❌":
		SupprimerListe();
		break;

	//mauvaise action
	default:
	require (__DIR__.'/../vues/listes.php');
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


function initListes()  {	
	//Données pour tester la vue des listes sans base de données
	//$_SESSION['listeVisible'] =$listeVisible=Stub::creerListeVisible();
	$modele = new ModeleListe();
	$modeleTache = new ModeleTache();
	$listesPuliques=$modele->trouverListePublique();
	foreach($listesPuliques as $liste){
		$liste->taches=$modeleTache->trouverTacheListe($liste);
	}
	$_SESSION['listesPubliques']=$listesPuliques;
	if(isset($_SESSION['listesPrivees'])){
		$listesPrivees=$modele->trouverListeUtilisateur();
		foreach($listesPrivees as $liste){
			$liste->taches=$modeleTache->trouverTacheListe($liste);
		}
	}
	

	require (__DIR__.'/../vues/listes.php');
}

function CreerListe(){
	//création dans la base de donnée
	
	$IDListe=0;
	$IDTache=0;
	$nomListe=$_REQUEST['nomListe'];
	$nomTache=$_REQUEST['nomTache']; // txtNom = nom du champ texte dans le formulaire
	$privee=false;
	
	$tache=new Tache($IDTache,$nomTache,$privee);
	$liste=new Liste($IDListe,$nomListe,$privee);
	$liste->taches=array($tache);
	array_push($_SESSION['listeVisible'],$liste);
	require (__DIR__.'/../vues/listes.php');


}

function SupprimerListe(){
	//suppression dans la base de donnée
	//	...

	//temporaire juste pour tester
	unset($_SESSION['listeVisible'][0]);

	require (__DIR__.'/../vues/listes.php');
}


?>
