<?php
class Tache
{
    private $ID;
    private $nom;
    private $description;
    private $faite;
    private $privee;

    public function __construct ($ID, $nom, $description,$privee)
    {
    $this->ID=$ID;
    $this->nom=$nom;
    $this->description=$description;
    $this->faite=false;
    $this->privee=$privee;
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
        $str="$str Description: $this->description<br/>";
        if($this->faite)
            $str="$str $class effectuée<br/>";
        else
            $str="$str $class non effectuée<br/>";
        if($this->privee)
            $str="$str $class privée<br/>";
        else
            $str="$str $class public<br/>";
    return $str;
    }
}

