<?php
class Liste
{
    private $ID;
    private $nom;
    private $isPrivate;

    public function __construct ($ID, $nom, $isPrivate)
    {
    $this->ID=$ID;
    $this->nom=$nom;
    $this->isPrivate=$isPrivate;

    }

    public function __toString(){
        $class=get_class($this);
        $str="";
        $str="$str Class : $class<br/>";
        $str="$str ID : $this->ID<br/>";
        $str="$str Nom : $this->nom<br/>";
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
$test=new Liste(58,'jojo',true);
echo $test;
echo $test->nom;

