<?php

$rep=__DIR__.'/../';
$rep=str_replace('\\', '/', $rep);

// BDD

$base="projet_php";
$login="alann";
$mdp="user";
$dsn = "mysql:host=localhost;dbname=$base";

//Vues

$vues['connexion']='vues/connexion.php';
$vues['modifierListe']='vues/modifierListe.php';
$vues['newInscription']='vues/newInscription.php';
$vues['newlistes']='vues/newlistes.php';
$vues['newlistesPrivees']='vues/newlistesPrivees.php';
$vues['vueErreur']='vues/vueErreur.php';