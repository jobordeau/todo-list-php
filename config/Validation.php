<?php

namespace config;

class Validation {

    static function val_action($action) {

        if (!isset($action)) {
            throw new Exception('pas d\'action');
        }
    }

    static function inscription_form(string &$nom, string &$mdp, string &$conf, &$dVueEreur) {

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

        if ($mdp!=$conf) {
            $dVueEreur[] =	"Les mots de passe ne correspondent pas";
            $mdp="";
        }

        //tester si l'identifiant est déjà utilisé par une autre personne dans la bdd

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

        //tester si l'identifiant et le mot de passe correspondent à un compte dans la bdd
    }

}
?>