<?php
class Validation {

    static function val_action($action) {

        if (!isset($action)) {
            throw new Exception('pas d\'action');
        }
    }

    static function inscription_form(string &$nom, string &$mdp, string &$conf, &$dVueEreur) {

        if (!isset($nom)||$nom=="") {
            $dVueEreur[] =	"Identifiant invalide";
            $nom="";
        }

        if (strlen($nom)>30) {
            $dVueEreur[] =	"Identifiant trop long";
            $nom="";
        }else if(strlen($nom)<4) {
            $dVueEreur[] =	"Identifiant trop court";
            $nom="";
        }

        if ($nom != filter_var($nom, FILTER_SANITIZE_STRING))
        {
            $dVueEreur[] =	"tentative d'injection de code (attaque sécurité)";
            $nom="";

        }

        if (!isset($mdp)||$mdp=="") {
            $dVueEreur[] =	"Mot de passe invalide";
            $mdp="";
        }

        if (strlen($mdp)>30) {
            $dVueEreur[] =	"Mot de passe trop long";
            $mdp="";
        }

        if (strlen($mdp)<4) {
            $dVueEreur[] =	"Mot de passe trop court";
            $mdp="";
        }

        if ($mdp!=$conf) {
            $dVueEreur[] =	"Les mots de passe ne correspondent pas";
            $mdp="";
        }

    }

    static function connexion_form(string &$nom, string &$mdp, &$dVueEreur) {

        if (!isset($nom)||$nom=="") {
            $dVueEreur[] =	"Identifiant incorrect";
            $nom="";
        }

        if ($nom != filter_var($nom, FILTER_SANITIZE_STRING))
        {
            $dVueEreur[] =	"testative d'injection de code (attaque sécurité)";
            $nom="";

        }

        if (!isset($mdp)||$mdp=="") {
            $dVueEreur[] =	"Mot de passe invalide";
            $mdp="";
        }
    }

}
?>