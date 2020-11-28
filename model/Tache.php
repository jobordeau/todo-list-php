<?php
class Tache
{
    private $ID;
    private $nom;
    private $description;
    private $faite;
    private $isPrivate;

    public function __construct ($ID, $nom, $description,$isPrivate)
    {
    $this->ID=$ID;
    $this->nom=$nom;
    $this->description=$description;
    $this->isDo=FALSE;
    $this->isPrivate=$isPrivate;
    }

    public function __toString(){
        $class=get_class($this);
        $str="";
        $str="$str Class : $class<br/>";
        $str="$str ID : $this->ID<br/>";
        $str="$str Nom : $this->nom<br/>";
        $str="$str Description: $this->description<br/>";
        if($this->isDo)
            $str="$str $class effectuée<br/>";
        else
            $str="$str $class non effectuée<br/>";
        if($this->isPrivate)
            $str="$str $class privée<br/>";
        else
            $str="$str $class public<br/>";
    return $str;
    }

    public function __get($propriete){
        return $this->$propriete;
    }

    public function __set($propriete,$val){
        $this->$propriete=$val;
    }
}



//temporaire c'est juste pour tester
$test=new Tache(58,'jojo', 'Faire les courses', false);
echo $test;