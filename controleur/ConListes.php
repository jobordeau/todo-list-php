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
	
	case "Se déconnecter":
		Deconnexion();
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

}
catch (Exception $e2)
	{
	$dVueEreur[] =	"Erreur inattendue!!! ";
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
	if(isset($_SESSION['utilisateur'])){
		$listesPrivees=$modele->trouverListeUtilisateur($_SESSION['utilisateur']->ID);
		foreach($listesPrivees as $liste){
			$liste->taches=$modeleTache->trouverTacheListe($liste);
		}
		$_SESSION['listesPrivees']=$listesPrivees;
	}
	

	require (__DIR__.'/../vues/listes.php');
}

function CreerListe(){
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

function SupprimerListe(){
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


function Deconnexion(){
	$_SESSION['utilisateur']=NULL;
	require (__DIR__.'/../vues/listes.php');
}


?>
