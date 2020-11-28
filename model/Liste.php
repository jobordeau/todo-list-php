<?php
class Liste
{
    private $ID;
    private $nom;
    private $privee;

    public function __construct ($ID, $nom, $privee)
    {
    $this->ID=$ID;
    $this->nom=$nom;
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
        if($this->privee)
            $str="$str $class privée<br/>";
        else
            $str="$str $class public<br/>";
    return $str;
    }

}


