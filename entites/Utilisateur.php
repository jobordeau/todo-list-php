<?php
class Utilisateur
{
    private $ID;
    private $nom;
    private $mdp;
    private $listes;

    public function __construct ($ID, $nom, $mdp)
    {
    $this->ID=$ID;
    $this->nom=$nom;
    $this->mdp=$mdp;
    $this->listes=array();
    }

    public function __get($propriete){
        return $this->$propriete;
    }

    public function __set($propriete,$val){
        $this->$propriete=$val;
    }

    public function __toString(){
        $class=get_class($this);
        $str="";
        $str="$str Class : $class<br/>";
        $str="$str ID : $this->ID<br/>";
        $str="$str Nom : $this->nom<br/>";
        $str="Mot de passe : $this->mdp<br/>";
    return $str;
    }
}

