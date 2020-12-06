<?php
class Tache
{
    private $ID;
    private $nom;
    private $faite;
    private $privee;

    public function __construct ($ID, $nom, $privee, $faite = false)
    {
    $this->ID=$ID;
    $this->nom=$nom;
    $this->privee=$privee;
    $this->faite=$faite;
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
        if($this->faite)
            $str=$str."effectuée<br/>";
        else
            $str=$str."non effectuée<br/>";
        if($this->privee)
            $str=$str."privée<br/>";
        else
            $str=$str."publique<br/>";
    return $str;
    }
}

