<?php
class Utilisateur
{
    private $ID;
    private $nom;
    private $listes;

    public function __construct ($ID, $nom)
    {
    $this->ID=$ID;
    $this->nom=$nom;
    $this->listes=array();
    }
    

    public function __get($propriete){
        return $this->$propriete;
    }

    public function __set($propriete,$val){
        $this->$propriete=$val;
    }

    public function __toString(){
        $str="ID : $this->ID<br/>";
        $str=$str."Nom : $this->nom<br/>";
        $str=$str."Mot de passe : $this->mdp<br/>";
    return $str;
    }
}

